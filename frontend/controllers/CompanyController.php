<?php
namespace frontend\controllers;

use common\models\User;
use yii\filters\AccessControl;
use \Yii;

class CompanyController extends Controller {
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
        ];
    }

    public function actionIndex()
    {
        $model = $this->findModel();
        if(\Yii::$app->request->isAjax && \Yii::$app->request->isPost) {
            $post = \Yii::$app->request->post();
            $model->relatedRecords['profile']->load($post);

            if($model->relatedRecords['profile']->save()) {
                $this->refresh();
            }
        }

        return $this->render('index', [
            'model' => $model,
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