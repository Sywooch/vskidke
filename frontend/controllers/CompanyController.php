<?php
namespace frontend\controllers;

use common\models\UploadForm;
use common\models\User;
use yii\filters\AccessControl;
use \Yii;
use yii\web\UploadedFile;

class CompanyController extends Controller {
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
        ];
    }

    public function actionIndex()
    {
        $model   = $this->findModel();
        $profile = $model->relatedRecords['profile'];
//        if(\Yii::$app->request->isAjax && \Yii::$app->request->isPost) {
            $post = \Yii::$app->request->post();
//            $model->relatedRecords['profile']->load($post);

            if($profile->load($post) && $profile->save()) {
                $uploadForm            = new UploadForm();
                $uploadForm->img       = UploadedFile::getInstance($profile, 'img');
                $uploadForm->model     = $profile;
                $uploadForm->directory = 'profile';

                $profile->img = $uploadForm->upload();
                $profile->save();

                $this->refresh();
            }
//        }

        return $this->render('index', [
            'model' => $model,
        ]);
    }

    /**
     * @return User the loaded model
     */
    private function findModel()
    {
        return User::find()->where(['id' => \Yii::$app->user->identity->getId()])->with('profile')->one();
    }
}