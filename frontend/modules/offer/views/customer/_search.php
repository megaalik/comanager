<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\CustomerSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="customer-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'org_type') ?>

    <?= $form->field($model, 'org_name') ?>

    <?= $form->field($model, 'city') ?>

    <?= $form->field($model, 'head_position') ?>

    <?php // echo $form->field($model, 'head_position_dp') ?>

    <?php // echo $form->field($model, 'male') ?>

    <?php // echo $form->field($model, 'last_name') ?>

    <?php // echo $form->field($model, 'first_name') ?>

    <?php // echo $form->field($model, 'patronymic') ?>

    <?php // echo $form->field($model, 'last_name_dp') ?>

    <?php // echo $form->field($model, 'first_name_dp') ?>

    <?php // echo $form->field($model, 'patronimic_dp') ?>

    <?php // echo $form->field($model, 'contacts') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
