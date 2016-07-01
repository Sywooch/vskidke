<?php
namespace frontend\models;

use common\helpers\StringHelper;
use Yii;
use yii\base\Model;
use common\models\User;

/**
 * Password reset request form
 */
class PasswordResetRequestForm extends Model
{
    public $email;


    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['email', 'filter', 'filter' => 'trim'],
            ['email', 'required', 'message' => 'Поле не может быть пустым'],
            ['email', 'email'],
            ['email', 'exist',
                'targetClass' => '\common\models\User',
                'filter' => ['status' => User::STATUS_ACTIVE],
                'message' => 'Пользователя с таким email не существует.'
            ],
        ];
    }

    /**
     * Sends an email with a link, for resetting the password.
     *
     * @return boolean whether the email was send
     */
    public function sendEmail()
    {
        /* @var $user User */
        $user = User::findOne([
            'status' => User::STATUS_ACTIVE,
            'email' => $this->email,
        ]);

        if (!$user) {
            return false;
        }else {
            $password = StringHelper::generatePassword();
            $user->setPassword($password);
        }
        
        if (!$user->save()) {
            return false;
        }

        return Yii::$app->mail->compose('@frontend/mail/newUserPassword', [
            'user'     => $user,
            'password' => $password
        ])
            ->setFrom(['lycifer31992@mail.ru' => Yii::$app->name])
            ->setTo($this->email)
            ->setSubject('Новый пароль ' . Yii::$app->name)
            ->send();
    }
}
