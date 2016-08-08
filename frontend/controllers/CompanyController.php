<?php
namespace frontend\controllers;

use common\models\CompanyAddresses;
use common\models\UploadForm;
use common\models\User;
use frontend\models\ResetPasswordForm;
use yii\db\Expression;
use yii\filters\AccessControl;
use \Yii;
use yii\sphinx\Query;
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
        $oldImg  = $profile->img;
        
        if(\Yii::$app->request->isAjax && \Yii::$app->request->isPost) {
            if($profile->load($post) && $profile->save()) {
                if(UploadedFile::getInstance($profile, 'img')) {
                    $uploadForm            = new UploadForm();
                    $uploadForm->img       = UploadedFile::getInstance($profile, 'img');
                    $uploadForm->model     = $profile;
                    $uploadForm->directory = 'profile';

                    $profile->img = $uploadForm->upload();
                } else {
                    $profile->img = $oldImg;
                }

                $profile->save();

                Yii::$app->getSession()->setFlash('message', 'Данные успешно сохранены');

                return $this->refresh();
            }

        }
        
        return $this->render('index', [
            'model' => $model,
        ]);
    }

    public function actionAddAddress() {
        $address = new CompanyAddresses();
        $post    = Yii::$app->request->post();

        $addressData = json_decode(
            file_get_contents(
                'https://maps.google.com/maps/api/geocode/json?address=' . urlencode($post['city'] . ' ' . $post['address']) .'&sensor=false'
            )
        );

        $post['lat'] = $addressData->results[0]->geometry->location->lat;
        $post['lng'] = $addressData->results[0]->geometry->location->lng;

        $address->setAttributes($post);
        $address->save(false);

        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;

        return [
            'coordinates'  => $addressData->results[0]->geometry->location,
            'address'      => $address->getCity()->one()->city_name . ', ' . $address->address . ', тел. ' . $address->phone,
        ];
    }

    public function actionEditPassword() {
        $user  = $this->findModel();
        $model = new ResetPasswordForm();

        if(Yii::$app->request->isPost) {
            $post = Yii::$app->request->post();

            if($model->load($post) && $model->validate()) {
                $model->resetPassword();
                Yii::$app->getSession()->setFlash('message', 'Пароль успешно изменен.');

                $this->refresh();
            }
        }

        return $this->render('edit-password', [
            'user'  => $user,
            'model' => $model
        ]);
    }
    
    private function findModel()
    {
        return User::find()->where(['id' => \Yii::$app->user->identity->getId()])->with('profile', 'addresses.city')->one();
    }
}