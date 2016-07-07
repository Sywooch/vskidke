<?php

namespace backend\controllers;

use common\models\User;
use common\models\UserProfile;
use yii\web\Controller;

class ParseOldDbController extends Controller {
    public function actionIndex() {
        $oldDb = new \yii\db\Connection([
            'dsn' => 'mysql:host=94.100.221.44;dbname=vsk_old',
            'username' => 'vskidki_vskidke',
            'password' => '0SSXsgFhFx',
            'charset' => 'utf8',
        ]);
        $oldDb->open();

        $userCommand = $oldDb->createCommand('SELECT * FROM _users WHERE login REGEXP \'^[A-Z0-9._%-]+@[A-Z0-9.-]+\.[A-Z]{2,4}$\';');
        $users = $userCommand->queryAll();

        $userModel = new User();
        $profileModel = new UserProfile();

        foreach ($users as $user) {
            $userModel->email = $user['login'];
            $userModel->status = User::STATUS_ACTIVE;
//            $userModel->setPassword(123456);
            $userModel->save(false);
            $profileModel->user_id = $userModel->id;
            $profileModel->profile_name = $user['name'];
            $profileModel->profile_phone = $user['phone'];
            $profileModel->profile_site = $user['site'];
            $profileModel->save(false);
            $profileModel = new UserProfile();
            $userModel = new User();
        }

        \Yii::$app->db->createCommand()->batchInsert(User::tableName(), ['password_hash'], [\Yii::$app->security->generatePasswordHash(123456)]);

        echo 'Компании перелиты';
    }

    public function actionSetPass() {
        $users = User::find()->where(['password_hash' => ''])->all();
        foreach ($users as $user) {
            $user->setPassword(123456);
            $user->save();
        }

    }
}