<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use dosamigos\tinymce\TinyMce;

/* @var $this yii\web\View */
/* @var $model common\models\Config */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="config-form">

    <?php $form = ActiveForm::begin([
        'options' => ['class' => 'form-horizontal'],
        'fieldConfig' => [
            'template' => '{label}<div class="col-sm-10">{input}</div><div class="col-sm-6">{error}</div>',
            'labelOptions' => ['class' => 'col-sm-2 control-label'],
        ],
    ]); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'description')->textarea(['maxlength' => 255]) ?>

    <?= $form->field($model, 'price')->textInput(['maxlength' => 15]) ?>

    <?= $form->field($model, 'tech_spec')->textInput() ?>

    <?= $form->field($model, 'tech_task_name')->textarea(['maxlength' => true]) ?>

    <?= $form->field($model, 'short_desc')->widget(TinyMce::className(), [
        'options' => ['rows' => 6],
        'language' => 'ru',
        'clientOptions' => [
            'plugins' => [
                "advlist lists charmap print preview",
                "searchreplace visualblocks fullscreen",
                "insertdatetime table contextmenu paste"
            ],
            'toolbar' => "undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent"
        ]
    ]);?>

    <?= $form->field($model, 'long_desc')->widget(TinyMce::className(), [
        'options' => ['rows' => 6],
        'language' => 'ru',
        'clientOptions' => [
            'plugins' => [
                "advlist lists charmap print preview",
                "searchreplace visualblocks fullscreen",
                "insertdatetime table contextmenu paste"
            ],
            'toolbar' => "undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent"
        ]
    ]);?>


    <div class="form-group">
        <?= Html::submitButton('Далее->', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
