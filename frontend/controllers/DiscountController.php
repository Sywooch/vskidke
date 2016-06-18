<?php
namespace frontend\controllers;

use common\models\Categories;
use common\models\City;
use common\models\DiscountAddresses;
use common\models\Discounts;
use common\models\UploadForm;
use common\models\User;
use yii\base\Model;
use yii\data\Pagination;
use yii\filters\AccessControl;
use yii\helpers\Url;
use yii\web\UploadedFile;

/**
 * Class DiscountController
 * @package frontend\controllers
 * @author Maksim Nikitenko <lycifer3.mn@gmail.com>
 */
class DiscountController extends BaseController {

    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['create'],
                'rules' => [
                    [
                        'allow' => true,
                        'actions' => ['create'],
                        'roles' => ['@'],
                    ],
                ],
            ],
        ];
    }

    /**
     * @param null $category
     * @param int $limit
     * @return string
     */
    public function actionIndex($category = null, $limit = 10, $popular = null, $new = null) {
        $query = Discounts::find()->joinWith('address', true, 'LEFT JOIN')
                                  ->where(['>=', 'discount_date_end', date('Y-m-d')])
                                  ->andWhere(['company_addresses.city_id' => City::getCityId()])
                                  ->orderBy([
                                      'discounts.discount_view' => $popular == 'SORT_DESC' ? SORT_DESC : SORT_ASC,
                                      'discounts.date_create' => $new == 'SORT_DESC' ? SORT_DESC : SORT_ASC
                                  ]);

        if($category) {
            $query->andWhere(['category_id' => $category]);
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
            'models'  => $models,
            'pages'   => $pages,
            'popular' => $popular,
            'new'     => $new
        ]);
    }

    /**
     * @return string|\yii\web\Response
     */
    public function actionCreate() {
        $userModel     = $this->UserModel();
        $discountModel = new Discounts();
        $post          = \Yii::$app->request->post();

        if($discountModel->load($post) && $discountModel->save()) {
            $uploadForm            = new UploadForm();
            $uploadForm->img       = UploadedFile::getInstance($discountModel, 'img');
            $uploadForm->model     = $discountModel;
            $uploadForm->directory = 'discount';
            $discountModel->img    = $uploadForm->upload(false);
            $discountModel->date_create = date('Y-m-d');
            $discountModel->save();

            $modelAddresses = [];
            foreach($post['DiscountAddresses'] as $model ) {
                $modelAddresses[] = new DiscountAddresses();
            }

            if(Model::loadMultiple($modelAddresses, $post)) {
                foreach ($modelAddresses as $model) {
                    $model->discount_id = $discountModel->discount_id;
                    $model->save(false);
                }
            }

            return $this->redirect(Url::to(['index']));
        }

        return $this->render('create', [
            'userModel'         => $userModel,
            'discountModel'     => $discountModel,
        ]);
    }

    /**
     * @param $id
     * @return string
     */
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