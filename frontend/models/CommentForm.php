<?php

namespace frontend\models;

use yii\base\Model;

class CommentForm extends Model {
    public $name;
    public $text;

    public function rules() {
        return [
            [['name', 'text'], 'required', 'message' => 'Поле не может быть пустым'],
            [['name', 'text'], 'filter', 'filter' => 'trim'],
            [['name', 'text'], 'filter', 'filter' => function($value){return strip_tags($value);}],
        ];
    }
}