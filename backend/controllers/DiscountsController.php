<?php

namespace backend\controllers;

use common\models\CompanyAddresses;
use common\models\DiscountAddresses;
use common\models\UploadForm;
use Yii;
use common\models\Discounts;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use yii\helpers\ArrayHelper;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * DiscountsController implements the CRUD actions for Discounts model.
 */
class DiscountsController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Discounts models.
     * @return mixed
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Discounts::find(),
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Discounts model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Discounts model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Discounts();
        $post  = Yii::$app->request->post();

        if ($model->load($post) && $model->save()) {
            $uploadForm            = new UploadForm();
            $uploadForm->img       = UploadedFile::getInstance($model, 'img');
            $uploadForm->model     = $model;
            $uploadForm->directory = 'discount';

            $model->img = $uploadForm->upload();
            $model->date_create = date('Y-m-d');
            $model->save();

            if(isset($post['addresses'])) {
                DiscountAddresses::attachTags($post['addresses'], $model);
            }
            
            return $this->redirect(['view', 'id' => $model->discount_id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Discounts model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model  = $this->findModel($id);
        $oldImg = $model->img;
        $post = Yii::$app->request->post();
        
        if ($model->load(Yii::$app->request->post()) && $model->save(false)) {
            if (UploadedFile::getInstance($model, 'img')) {
                $uploadForm = new UploadForm();
                $uploadForm->img = UploadedFile::getInstance($model, 'img');
                $uploadForm->model = $model;
                $uploadForm->directory = 'discount';

                $model->img = $uploadForm->upload();
            } else {
                $model->img = $oldImg;
            }

            $model->save(false);

            if(isset($post['addresses'])) {
                DiscountAddresses::attachTags($post['addresses'], $model);
            }

            return $this->redirect(['view', 'id' => $model->discount_id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Discounts model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    public function actionGetAddresses($id = null) {
        if(Yii::$app->request->isAjax && Yii::$app->request->isPost) {
            $post      = Yii::$app->request->post();
            $userId    = $post['depdrop_parents']['0'];
            $result    = [];
            $selectedResult = [];
            $addresses = CompanyAddresses::find()->where(['user_id' => $userId])->with('city')->all();
            $selected  = DiscountAddresses::find()->where(['discount_id' => $id])->with('address.city')->all();
            $i         = 0;

            foreach ($addresses as $address) {
                $result[$i]['id']   = $address->id;
                $result[$i]['name'] = $address->relatedRecords['city']->city_name . ' ' . $address->address;
                $i++;
            }

            $i = 0;
            foreach ($selected as $select) {
                $selectedResult[$i]['id']   = $select->address_id;
                $selectedResult[$i]['name'] = $select->relatedRecords['address']->relatedRecords['city']->city_name . ' ' . $select->relatedRecords['address']->address;
                $i++;
            }

//            Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
            echo json_encode(['output' => $result, 'selected' => ""]);
            return;
        }
    }

    /**
     * Finds the Discounts model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Discounts the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Discounts::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
