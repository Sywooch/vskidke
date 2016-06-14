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

    public function actionMaps() {
        $post = Yii::$app->request->post();

        $addressData = json_decode(
            file_get_contents(
                'https://maps.google.com/maps/api/geocode/json?address=' . urlencode($post['city'] . ' ' . $post['address']) .'&sensor=false'
            )
        );

        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        return $addressData->results[0]->geometry->location;
    }

    /**
     * @return User the loaded model
     */
    private function findModel()
    {
        return User::find()->where(['id' => \Yii::$app->user->identity->getId()])->with('profile')->one();
    }
}