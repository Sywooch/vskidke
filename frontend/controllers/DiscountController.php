<?php
namespace frontend\controllers;

use common\models\Discounts;
use common\models\UploadForm;
use common\models\User;
use yii\web\UploadedFile;

class DiscountController extends Controller {
    public function actionIndex() {
        $userModel     = $this->UserModel();
        $discountModel = new Discounts();
        $post = \Yii::$app->request->post();

        if($discountModel->load($post) && $discountModel->save()) {
            $uploadForm            = new UploadForm();
            $uploadForm->img       = UploadedFile::getInstance($discountModel, 'img');
            $uploadForm->model     = $discountModel;
            $uploadForm->directory = 'discount';
            $discountModel->img    = $uploadForm->upload(false);
            $discountModel->save();

            $this->refresh();
        }

        return $this->render('index', [
            'userModel'     => $userModel,
            'discountModel' => $discountModel
        ]);
    }

    public function actionView($id) {

    }

    /**
     * @return User the loaded model
     */
    private function UserModel()
    {
        return User::find(\Yii::$app->user->identity->getId())->with('profile')->one();
    }
}