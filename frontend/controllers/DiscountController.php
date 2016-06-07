<?php
namespace frontend\controllers;

use common\models\Discounts;
use common\models\User;

class DiscountController extends Controller {
    public function actionIndex() {
        $userModel     = $this->findModel();
        $discountModel = new Discounts();
        $post = \Yii::$app->request->post();
//        echo "<pre>";
//        print_r(
//            $post
//        );
//        die();
//        echo "</pre>";
        return $this->render('index', [
            'userModel'     => $userModel,
            'discountModel' => $discountModel
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