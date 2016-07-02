<?php
namespace frontend\models;

use yii\base\Model;
use yii\base\InvalidParamException;
use common\models\User;

/**
 * Password reset form
 */
class ResetPasswordForm extends Model
{
    public $password;
    public $new_password;
    public $password_repeat;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['password', 'required', 'message' => 'Поле не может быть пустым'],
            ['password', 'validatePassword'],
            ['new_password', 'required', 'message' => 'Поле не может быть пустым'],
            ['new_password', 'string', 'min' => 6, 'message' => 'Пароль должен состоять не мение час из 6 символов'],
            ['password_repeat', 'compare', 'compareAttribute' => 'new_password', 'message' => "Пароли не совпадают"]
        ];
    }

    public function validatePassword()
    {
        if (!$this->hasErrors()) {
            /** @var User $user */
            $user = $this->getUser();

            if (!$user || !$user->validatePassword($this->password)) {
                $this->addError('password', 'Неверный пароль.');
            }
        }
    }


    /**
     * Resets password.
     *
     * @return boolean if password was reset.
     */
    public function resetPassword()
    {
        $user = $this->getUser();
        $user->setPassword($this->password);
        $user->removePasswordResetToken();

        return $user->save(false);
    }

    public function getUser() {
        return \Yii::$app->user->identity;
    }
}
