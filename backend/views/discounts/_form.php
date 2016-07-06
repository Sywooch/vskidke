<?php

use common\models\Categories;
use common\models\City;
use common\models\CompanyAddresses;
use common\models\DiscountAddresses;
use common\models\User;
use kartik\date\DatePicker;
use kartik\depdrop\DepDrop;
use kartik\file\FileInput;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Discounts */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="discounts-form">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

    <?= $form->field($model, 'user_id')
             ->dropDownList(
                 ArrayHelper::map(
                     User::find()->with('profile')->all(), 'id', 'profile.profile_name'),
                    [
                        'prompt' => 'Выбрать',
                        'id' => 'user-id'
                    ])
             ->label('Компания') ?>

    <?= $form->field($model, 'category_id')->dropDownList(ArrayHelper::map(Categories::find()->all(), 'category_id', 'category_name'), ['prompt' => 'Выбрать']) ?>

    <?= DepDrop::widget([
        'name' => 'addresses[]',
        'options' => ['id' => 'address-id'],
        'type' => DepDrop::TYPE_SELECT2,
        'select2Options' => [
            'pluginOptions' => [
                'allowClear'=>true,
                'multiple' => true,
            ]
        ],
        'pluginOptions'=>[
            'depends'=>['user-id'],
            'initialize' => true,
            'placeholder' => 'Выбрать аддресса',
            'url' => Url::to(['/discounts/get-addresses', 'id' => $model->discount_id ? $model->discount_id : null])
        ]
    ]) ?>

    <?= $form->field($model, 'discount_title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'discount_text')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'discount_date_start')->widget(DatePicker::className(), [
        'type' => DatePicker::TYPE_INPUT,
        'pluginOptions' => [
            'autoclose'=>true,
            'startDate' => date('Y-m-d'),
            'format' => 'yyyy-mm-dd'
        ]
    ]) ?>

    <?= $form->field($model, 'discount_date_end')->widget(DatePicker::className(), [
        'type' => DatePicker::TYPE_INPUT,
        'pluginOptions' => [
            'autoclose'=>true,
            'startDate' => date('Y-m-d'),
            'format' => 'yyyy-mm-dd'
        ]
    ]) ?>

    <?= $form->field($model, 'discount_app')->checkbox(); ?>

    <?= $form->field($model, 'discount_view_email')->checkbox() ?>

    <?= $form->field($model, 'discount_price')->textInput() ?>

    <?= $form->field($model, 'discount_old_price')->textInput() ?>

    <?= $form->field($model, 'discount_percent')->textInput() ?>

    <?= $form->field($model, 'discount_gift')->textarea(['rows' => 6]) ?>

    <?php if (!$model->isNewRecord && !empty($model->img)): ?>
        <?= $form->field($model, 'img')->widget(FileInput::className(), [
            'pluginOptions' => [
                'initialPreview' => [
                    Html::img(Yii::$app->params['uploadUrl'] .  $model->img, ['class'=>'file-preview-image', 'alt'=>$model->img, 'title'=>$model->img]),
                ],
                'showPreview' => true,
                'showRemove'  => false,
                'showUpload'  => false,
                'browseLabel' => 'Выбрать изображение',

            ],

        ])?>
    <?php else: ?>
        <?= $form->field($model, 'img')->widget(FileInput::className(), [
            'pluginOptions' => [
                'showPreview' => true,
                'showRemove'  => false,
                'showUpload'  => false,
                'browseLabel' => 'Выбрать изображение',
            ]

        ])?>
    <?php endif; ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
