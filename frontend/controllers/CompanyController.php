<?php
namespace frontend\controllers;

use common\models\CompanyAddresses;
use common\models\UploadForm;
use common\models\User;
use yii\filters\AccessControl;
use \Yii;
use yii\web\UploadedFile;

class CompanyController extends BaseController {
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
        $post    = \Yii::$app->request->post();

        if(\Yii::$app->request->isAjax && \Yii::$app->request->isPost) {
            if($profile->load($post) && $profile->save()) {
                $uploadForm            = new UploadForm();
                $uploadForm->img       = UploadedFile::getInstance($profile, 'img');
                $uploadForm->model     = $profile;
                $uploadForm->directory = 'profile';

                $profile->img = $uploadForm->upload();
                $profile->save();

                \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;

                Yii::$app->getSession()->setFlash('success', 'Данные успешно сохранены');
            }
        }
        
        return $this->render('index', [
            'model' => $model,
        ]);
    }

    public function actionAddAddress() {
        $address = new CompanyAddresses();
        $post    = Yii::$app->request->post();
        $address->setAttributes($post);
        $address->save();

        $addressData = json_decode(
            file_get_contents(
                'https://maps.google.com/maps/api/geocode/json?address=' . urlencode($post['city'] . ' ' . $post['address']) .'&sensor=false'
            )
        );

        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;

        return [
            'coordinates' => $addressData->results[0]->geometry->location,
            'address'     => $address->getCity()->one()->city_name . ', ' . $address->address . ', тел. ' . $address->phone
        ];
    }

    /**
     * @return User the loaded model
     */
    private function findModel()
    {
        return User::find()->where(['id' => \Yii::$app->user->identity->getId()])->with('profile', 'addresses.city')->one();
    }
}