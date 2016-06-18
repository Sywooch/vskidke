<?php
namespace frontend\controllers;

use common\helpers\StringHelper;
use common\models\Discounts;
use common\models\User;
use common\models\UserProfile;
use frontend\models\EmailConfirmForm;
use Yii;
use yii\base\InvalidParamException;
use yii\data\Pagination;
use yii\helpers\Url;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\LoginForm;
use frontend\models\PasswordResetRequestForm;
use frontend\models\ResetPasswordForm;
use frontend\models\SignupForm;
use frontend\models\ContactForm;
use yii\web\Cookie;
use yii\web\NotFoundHttpException;

/**
 * Site controller
 */
class SiteController extends BaseController
{
    /**
     * @return array
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['login', 'logout', 'signup'],
                'rules' => [
                    [
                        'allow' => true,
                        'actions' => ['login', 'signup'],
                        'roles' => ['?'],
                    ],
                    [
                        'allow' => true,
                        'actions' => ['logout'],
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs'  => [
                'class'   => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post', 'get'],
                ],
            ],
        ];
    }

    /**
     * @return array
     */
    public function actions()
    {
        return [
            'captcha' => [
                'class'           => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    public function actionIndex()
    {
        $cookies = \Yii::$app->response->cookies;
        $city    = \Yii::$app->request->cookies;

        if(Yii::$app->request->isAjax && Yii::$app->request->isPost) {
            $post = Yii::$app->request->post();

            $cookies->remove('city');
            $cookies->add(new Cookie(['name' => 'city', 'value' => $post['city']]));

            return $post['city'];
        }
    }

    /**
     * @return string|\yii\web\Response
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->redirect(Url::to(['/company/index']));
        } else {
            return $this->renderAjax('login', [
                'model' => $model,
            ]);
        }
    }

    /**
     * @return \yii\web\Response
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * @return string|\yii\web\Response
     */
    public function actionSignup()
    {
        $model = new SignupForm();
        if ($model->load(Yii::$app->request->post())) {
            if ($user = $model->signup()) {
                Yii::$app->getSession()->setFlash('success', 'На ваш email отправлено письмо с подтверждением регистрации');

                return $this->goHome();
            }
        }

        return $this->renderAjax('signup', [
            'model' => $model,
        ]);
    }

    /**
     * @param $token
     *
     * @return \yii\web\Response
     * @throws \yii\web\BadRequestHttpException
     */
    public function actionEmailConfirm($token)
    {
        try {
            $model = new EmailConfirmForm($token);
        } catch (InvalidParamException $e) {
            throw new BadRequestHttpException($e->getMessage());
        }

        if ($model->confirmEmail()) {
            /** @var User $user */
            $user     = $model->getUser();
            $password = StringHelper::generatePassword();
            $user->setPassword($password);

            if($user->save()) {
                $profile = new UserProfile();
                $profile->user_id = $user->id;
                $profile->save();

                Yii::$app->mail->compose('@frontend/mail/authorizationData', [
                    'user'     => $user,
                    'password' => $password
                ])
                    ->setFrom(['lycifer31992@mail.ru' => Yii::$app->name])
                    ->setTo($user->email)
                    ->setSubject('Email confirmation for ' . Yii::$app->name)
                    ->send();
            }


            Yii::$app->getSession()->setFlash(
                'success',
                'Email успешно подтвержден, данные авторизации оправлены вам на почту'
            );
        } else {
            Yii::$app->getSession()->setFlash('error', 'Время токена истекло');
        }

        return $this->goHome();
    }

    /**
     * @return string|\yii\web\Response
     */
    public function actionPasswordResetRequest()
    {
        $model = new PasswordResetRequestForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail()) {
                Yii::$app->getSession()->setFlash('success', Yii::t('app', 'EMAIL_SENT_PASSWORD_RECOVERY'));

                return $this->goHome();
            } else {
                Yii::$app->getSession()->setFlash('error', Yii::t('app', 'PROBLEMS_SHIPMENT'));
            }
        }

        return $this->render('passwordResetRequest', [
            'model' => $model,
        ]);
    }

    /**
     * @param $token
     *
     * @return string|\yii\web\Response
     * @throws \yii\web\BadRequestHttpException
     */
    public function actionPasswordReset($token)
    {
        try {
            $model = new ResetPasswordForm($token);
        } catch (InvalidParamException $e) {
            throw new BadRequestHttpException($e->getMessage());
        }

        if ($model->load(Yii::$app->request->post()) && $model->validate() && $model->resetPassword()) {
            Yii::$app->getSession()->setFlash('success', Yii::t('app', 'PASSWORD_SUCCESS_CHANGE'));

            return $this->goHome();
        }

        return $this->render('passwordReset', [
            'model' => $model,
        ]);
    }
}
