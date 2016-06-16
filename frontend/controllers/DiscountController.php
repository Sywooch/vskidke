<?php
namespace frontend\controllers;

use common\models\Discounts;
use common\models\UploadForm;
use common\models\User;
use yii\data\Pagination;
use yii\helpers\Url;
use yii\web\UploadedFile;

class DiscountController extends Controller {

    public function actionIndex($categoryId = null, $limit = 10) {
        $query = Discounts::find()->where([
            '>=',
            'discount_date_end',
            date('yyyy-MM-dd')
        ]);

        if($categoryId) {
            $query->andWhere(['category_id' => $categoryId]);
        }

        $countQuery = clone $query;
        $pages      = new Pagination([
            'totalCount'     => $countQuery->count(),
            'pageSize'       => $limit,
            'forcePageParam' => false,
            'pageSizeParam'  => false,
        ]);

        $models = $query->offset($pages->offset)
            ->limit($pages->limit)
            ->all();

        return $this->render('index', [
            'models' => $models,
            'pages'  => $pages
        ]);
    }
    public function actionCreate() {
        $userModel     = $this->UserModel();
        $discountModel = new Discounts();
        $post = \Yii::$app->request->post();
//echo "<pre>";
//print_r(
//    $post
//);
//die();
//echo "</pre>";
        if($discountModel->load($post) && $discountModel->save()) {
            $uploadForm            = new UploadForm();
            $uploadForm->img       = UploadedFile::getInstance($discountModel, 'img');
            $uploadForm->model     = $discountModel;
            $uploadForm->directory = 'discount';
            $discountModel->img    = $uploadForm->upload(false);
            $discountModel->save();

            return $this->redirect(Url::to(['index']));
        }

        return $this->render('create', [
            'userModel'     => $userModel,
            'discountModel' => $discountModel
        ]);
    }

    public function actionView($id) {
        $discount = Discounts::findOne($id);
        $discount->discount_view += 1;
        $discount->save(false);


        return $this->render('view', [
            'discount' => $discount,
            'company'  => $discount->getUser()->with('profile')->one(),
        ]);
    }

    /**
     * @return User the loaded model
     */
    private function UserModel()
    {
        return User::find()->where(['id' => \Yii::$app->user->identity->getId()])->with('profile', 'addresses.city')->one();
    }
}