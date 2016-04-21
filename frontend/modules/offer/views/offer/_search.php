<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\OfferSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="offer-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'offer_date') ?>

    <?= $form->field($model, 'delivery_conditions') ?>

    <?= $form->field($model, 'price_type') ?>

    <?= $form->field($model, 'provider_costs') ?>

    <?php // echo $form->field($model, 'delivery_costs') ?>

    <?php // echo $form->field($model, 'local_delivery_costs') ?>

    <?php // echo $form->field($model, 'customs_duty') ?>

    <?php // echo $form->field($model, 'nds') ?>

    <?php // echo $form->field($model, 'service_costs') ?>

    <?php // echo $form->field($model, 'income_rate') ?>

    <?php // echo $form->field($model, 'registration_costs') ?>

    <?php // echo $form->field($model, 'marketing_costs') ?>

    <?php // echo $form->field($model, 'currency') ?>

    <?php // echo $form->field($model, 'currency_rate') ?>

    <?php // echo $form->field($model, 'total_price') ?>

    <?php // echo $form->field($model, 'total_price_nds') ?>

    <?php // echo $form->field($model, 'customer_id') ?>

    <?php // echo $form->field($model, 'city_id') ?>

    <?php // echo $form->field($model, 'performer_id') ?>

    <?php // echo $form->field($model, 'user_id') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
