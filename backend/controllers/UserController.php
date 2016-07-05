<?php

namespace backend\controllers;

use common\models\UploadForm;
use common\models\UserProfile;
use Yii;
use common\models\User;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * UserController implements the CRUD actions for User model.
 */
class UserController extends Controller
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
     * Lists all User models.
     * @return mixed
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => User::find()->with('profile'),
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single User model.
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
     * Creates a new User model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model   = new User();
        $profile = new UserProfile();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $model->setPassword(123456);
            $model->save();

            if ($profile->load(Yii::$app->request->post())) {
                $profile->user_id = $model->id;
                if($profile->save()) {
                    $uploadForm            = new UploadForm();
                    $uploadForm->img       = UploadedFile::getInstance($profile, 'img');
                    $uploadForm->model     = $profile;
                    $uploadForm->directory = 'profile';

                    $profile->img = $uploadForm->upload();
                    $profile->save();
                }
            }
            Yii::$app->getSession()->setFlash('success', 'Данные успешно сохранены');

            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
                'profile' => $profile
            ]);
        }
    }

    /**
     * Updates an existing User model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $profile = $model->getProfile()->one();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            if ($profile->load(Yii::$app->request->post() && $profile->save())) {
                $uploadForm            = new UploadForm();
                $uploadForm->img       = UploadedFile::getInstance($profile, 'img');
                $uploadForm->model     = $profile;
                $uploadForm->directory = 'profile';

                $profile->img = $uploadForm->upload();
                $profile->save();
            }

            Yii::$app->getSession()->setFlash('success', 'Данные успешно сохранены');

            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model'   => $model,
                'profile' => $profile
            ]);
        }
    }

    /**
     * Deletes an existing User model.
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
     * Finds the User model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return User the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = User::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
