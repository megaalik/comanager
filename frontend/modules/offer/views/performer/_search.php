<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\PerformerSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="performer-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'last_name') ?>

    <?= $form->field($model, 'first_name') ?>

    <?= $form->field($model, 'patronymic') ?>

    <?= $form->field($model, 'position') ?>

    <?php // echo $form->field($model, 'phone_num') ?>

    <?php // echo $form->field($model, 'mobile_num') ?>

    <?php // echo $form->field($model, 'email') ?>

    <?php // echo $form->field($model, 'singer') ?>

    <?php // echo $form->field($model, 'sign_image') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
