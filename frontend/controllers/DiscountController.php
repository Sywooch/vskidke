<?php
namespace frontend\controllers;

use common\models\Categories;
use common\models\City;
use common\models\Comment;
use common\models\DiscountAddresses;
use common\models\Discounts;
use common\models\UploadForm;
use common\models\User;
use frontend\models\CommentForm;
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
                'only' => ['create', 'my-discounts'],
                'rules' => [
                    [
                        'allow' => true,
                        'actions' => ['create', 'my-discounts'],
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
    public function actionIndex($category = null, $limit = 10, $popular = null, $new = null, $q = null) {
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

        if($q) {
            $query->andWhere('discount_title' . ' like "%' . $q .'%"')
                  ->orWhere('discount_text' . ' like "%' . $q .'%"');
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
    public function actionCreate($id = null) {
        $userModel = $this->UserModel();
        
        if($id) {
            $discountModel = Discounts::findOne($id);
        } else {
            $discountModel = new Discounts();
        }

        $post = \Yii::$app->request->post();

        if($discountModel->load($post) && $discountModel->save()) {
            $uploadForm                 = new UploadForm();
            $uploadForm->img            = UploadedFile::getInstance($discountModel, 'img');
            $uploadForm->model          = $discountModel;
            $uploadForm->directory      = 'discount';
            $discountModel->img         = $uploadForm->upload(false);
            $discountModel->date_create = date('Y-m-d');
            $discountModel->save();

            if($id) {
                DiscountAddresses::deleteAll(['discount_id' => $discountModel->discount_id]);
            }

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
            'userModel'     => $userModel,
            'discountModel' => $discountModel,
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
        $comments = $discount->getComments()->where(['status' => Comment::STATUS_ACTIVE])->all();

        return $this->render('view', [
            'discount' => $discount,
            'company'  => $discount->getUser()->with('profile')->one(),
            'comment'  => new Comment(),
            'comments' => $comments
        ]);
    }
    
    public function actionComment() {
        $comment = new Comment();
        if(\Yii::$app->request->isPost) {
            $post = \Yii::$app->request->post();

            if($comment->load($post) && $comment->save()) {
                \Yii::$app->getSession()->setFlash(
                    'message',
                    'Спасибо за ваш отзыв, он пояпится на сайте после модерации'
                );

                return $this->redirect(Url::to(['/discount/view', 'id' => $post['Comment']['discount_id']]));
            }
        }
    }

    /**
     * @param null $category
     * @param int $limit
     * @return string
     */
    public function actionArchive($category = null, $limit = 10) {
        $query = Discounts::find()->joinWith('address', true, 'LEFT JOIN')
            ->where(['<', 'discount_date_end', date('Y-m-d')])
            ->andWhere(['company_addresses.city_id' => City::getCityId()]);

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

        return $this->render('archive', [
            'models'  => $models,
            'pages'   => $pages,
        ]);
    }

    /**
     * @param null $category
     * @param int $limit
     * @param bool $archive
     * @param bool $active
     * @return string
     */
    public function actionMyDiscounts($category = null, $limit = 10, $archive = false, $active = false) {
        $user  = $this->UserModel();
        $query = Discounts::find()->where(['user_id' => $user->id]);

        if($active) {
            $query->andWhere(['>=', 'discount_date_end', date('Y-m-d')]);
        } elseif ($archive) {
            $query->andWhere(['<', 'discount_date_end', date('Y-m-d')]);
        }

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

        return $this->render('my-discounts', [
            'models'  => $models,
            'pages'   => $pages,
            'archive' => $archive,
            'active'  => $active
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