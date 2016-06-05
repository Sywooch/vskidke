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
        $model = $this->findModel();
//        if(\Yii::$app->request->isAjax && \Yii::$app->request->isPost) {
            $post = \Yii::$app->request->post();
//            $model->relatedRecords['profile']->load($post);

            if($model->relatedRecords['profile']->load($post) && $model->relatedRecords['profile']->save()) {
                $uploadForm            = new UploadForm();
                $uploadForm->img       = UploadedFile::getInstance($model->relatedRecords['profile'], 'profile_img');
                $uploadForm->model     = $model->relatedRecords['profile'];
                $uploadForm->directory = 'profile';
                $uploadForm->attribute = 'profile_img';

                $model->relatedRecords['profile']->profile_img = $uploadForm->upload(false);
                $model->relatedRecords['profile']->save();

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
        return User::find(\Yii::$app->user->identity->getId())->with('profile')->one();
    }
}