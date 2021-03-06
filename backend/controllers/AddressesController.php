<?php

namespace backend\controllers;

use common\models\City;
use Yii;
use common\models\CompanyAddresses;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * AddressesController implements the CRUD actions for CompanyAddresses model.
 */
class AddressesController extends Controller
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
     * Lists all CompanyAddresses models.
     * @return mixed
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => CompanyAddresses::find(),
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single CompanyAddresses model.
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
     * Creates a new CompanyAddresses model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new CompanyAddresses();
        $post = Yii::$app->request->post();

        if ($model->load($post) && $model->save()) {
            $addressData = json_decode(
                file_get_contents(
                    'https://maps.google.com/maps/api/geocode/json?address=' . urlencode(City::getCityName($post['CompanyAddresses']['city_id']) . ' ' . $post['CompanyAddresses']['address']) .'&sensor=false'
                )
            );

            $model->lat = $addressData->results[0]->geometry->location->lat;
            $model->lng = $addressData->results[0]->geometry->location->lng;
            $model->save(false);

            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing CompanyAddresses model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $post = Yii::$app->request->post();

        if ($model->load($post) && $model->save()) {
            $addressData = json_decode(
                file_get_contents(
                    'https://maps.google.com/maps/api/geocode/json?address=' . urlencode(City::getCityName($post['CompanyAddresses']['city_id']) . ' ' . $post['CompanyAddresses']['address']) .'&sensor=false'
                )
            );

            $model->lat = $addressData->results[0]->geometry->location->lat;
            $model->lng = $addressData->results[0]->geometry->location->lng;
            $model->save(false);

            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing CompanyAddresses model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the CompanyAddresses model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return CompanyAddresses the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = CompanyAddresses::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
