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
            'eauth' => array(
                // required to disable csrf validation on OpenID requests
                'class' => \nodge\eauth\openid\ControllerBehavior::className(),
                'only' => array('login'),
            ),
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

        return $this->redirect(Url::to(['/discount/index']));
    }

    /**
     * @return string|\yii\web\Response
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $serviceName = Yii::$app->getRequest()->getQueryParam('service');
        if (isset($serviceName)) {
            /** @var $eauth \nodge\eauth\ServiceBase */
            $eauth = Yii::$app->get('eauth')->getIdentity($serviceName);
            $eauth->setRedirectUrl(Yii::$app->getUser()->getReturnUrl());
            $eauth->setCancelUrl(Yii::$app->getUrlManager()->createAbsoluteUrl('/site/login'));

            try {
                if ($eauth->authenticate()) {
                    $identity = User::findByEAuth($eauth);

                    if(isset($identity->email)) {
                        $user = User::findByUserEmail($identity->email);

                        if($user) {
                            Yii::$app->getUser()->login($user);
                        } else {
                            $user = User::find()->where(['auth_key' => $identity->auth_key])->one();

                            if($user) {
                                Yii::$app->getUser()->login($user);
                            } else {
                                $identity->save(false);

                                $profile = new UserProfile();
                                $profile->user_id = $identity->id;
                                $profile->save();

                                Yii::$app->getSession()->setFlash('message', 'Спасибо за регистрацию на нашем сайте');
                            }
                        }
                    } else {
                        $user = User::find()->where(['auth_key' => $identity->auth_key])->one();

                        if($user) {
                            Yii::$app->getUser()->login($user);
                        } else {
                            $identity->save(false);

                            $profile = new UserProfile();
                            $profile->user_id = $identity->id;
                            $profile->save();

                            Yii::$app->getUser()->login($identity);

                            Yii::$app->getSession()->setFlash('message', 'Спасибо за регистрацию на нашем сайте');
                        }
                    }

                    // special redirect with closing popup window
                    $eauth->redirect();
                }
                else {
                    // close popup window and redirect to cancelUrl
                    $eauth->cancel();
                }
            }
            catch (\nodge\eauth\ErrorException $e) {
                // save error to show it later
                Yii::$app->getSession()->setFlash('message', 'EAuthException: '.$e->getMessage());

                // close popup window and redirect to cancelUrl
//              $eauth->cancel();
                $eauth->redirect($eauth->getCancelUrl());
            }
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
                Yii::$app->getSession()->setFlash('message', 'На ваш email отправлено письмо с подтверждением регистрации');

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
                'message',
                'Email успешно подтвержден, данные авторизации оправлены вам на почту'
            );
        } else {
            Yii::$app->getSession()->setFlash('message', 'Время токена истекло');
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
                Yii::$app->getSession()->setFlash('message', Yii::t('app', 'EMAIL_SENT_PASSWORD_RECOVERY'));

                return $this->goHome();
            } else {
                Yii::$app->getSession()->setFlash('message', Yii::t('app', 'PROBLEMS_SHIPMENT'));
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
            Yii::$app->getSession()->setFlash('message', Yii::t('app', 'PASSWORD_SUCCESS_CHANGE'));

            return $this->goHome();
        }

        return $this->render('passwordReset', [
            'model' => $model,
        ]);
    }
}
