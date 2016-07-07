<?php

namespace backend\controllers;

use common\models\City;
use common\models\Discounts;
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

        $userCommand = $oldDb->createCommand('SELECT lead, content, percent, create_moment FROM discounts');
        $users = $userCommand->queryAll();

        $userModel = new Discounts();

        foreach ($users as $user) {
            $userModel->category_id = 1;
            $userModel->user_id = 15;
            $userModel->discount_title = $user['lead'];
            $userModel->discount_text = strip_tags($user['content']);
            $userModel->discount_date_start = date('Y-m-d');
            $userModel->discount_date_end = date('Y-m-d', strtotime("+10 days"));
            $userModel->discount_percent = $user['percent'];
            $userModel->date_create = date('Y-m-d', $user['create_moment']);
            $userModel->save();
            $userModel = new Discounts();
        }

        echo 'Скидки перелиты';
    }
}