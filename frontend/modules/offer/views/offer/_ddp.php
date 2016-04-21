<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\date\DatePicker;
use kartik\typeahead\TypeaheadBasic;

/* @var $this yii\web\View */
/* @var $model common\models\Offer */
/* @var $form yii\widgets\ActiveForm */


?>

<div class="offer-form">
    <p>
        <?= Html::a('Расчитать', ['calc'], ['class' => 'btn btn-success']) ?>
    </p>
    <?php $form = ActiveForm::begin([
        'options' => ['class' => 'form-inline'],
        'fieldConfig' => [
            'template' => '{label}<div class="col-sm-4">{input}</div><div class="col-sm-6">{error}</div>',
            'labelOptions' => ['class' => 'col-sm-3 control-label'],
        ],
    ]); ?>

    <?= $form->field($model, 'offer_date')->widget(DatePicker::classname(), [
        'name' => 'Дата оформления',
        //'value' => '10.03.2014',
        'readonly' => true,
        'language' => 'ru',
        'options' => ['placeholder' => 'Выберите дату оформления КП ...'],
        'pluginOptions' => [
            'autoclose'=>true,
            'format' => 'mm.dd.yyyy'
        ]
    ]);
    ?>


    <?= $form->field($model, 'delivery_conditions')->dropDownList([
        'CIP' => 'CIP',
        'DDP' => 'DDP'
    ],
        ['prompt' => 'Выберите условия доставки ...']
    ) ?>


    <?= $form->field($model, 'price_type')->dropDownList([
        'Стандарт' => 'Стандарт',
        'Перспектива' => 'Перспектива',
        'Индивидуальный' => 'Индивидуальный',
    ],
        ['prompt' => 'Выберите тип прайса ...']
    ) ?>

    <?= $form->field($model, 'provider_costs')->textInput(['maxlength' => 20]) ?>

    <?= $form->field($model, 'delivery_costs')->widget(TypeaheadBasic::className(), [
        'data' => ['500','1000','1500'],
        'options' => ['placeholder' => 'Введите стоимость доставки ...'],
    ]);?>

    <?= $form->field($model, 'local_delivery_costs')->textInput() ?>

    <?= $form->field($model, 'customs_duty')->textInput() ?>

    <?= $form->field($model, 'nds')->textInput() ?>

    <?= $form->field($model, 'service_costs')->textInput() ?>

    <?= $form->field($model, 'income_rate')->textInput() ?>

    <?= $form->field($model, 'registration_costs')->textInput() ?>

    <?= $form->field($model, 'marketing_costs')->textInput() ?>

    <?= $form->field($model, 'currency')->textInput(['readonly' => true, 'value' => 'USD']) ?>

    <?= $form->field($model, 'currency_rate')->textInput() ?>

    <?= $form->field($model, 'total_price')->textInput(['readonly' => true, 'value' => '0']) ?>

    <?= $form->field($model, 'total_price_nds')->textInput() ?>

    <?= $form->field($model, 'customer_id')->textInput() ?>

    <?= $form->field($model, 'city_id')->textInput() ?>

    <?= $form->field($model, 'performer_id')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'user_id')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Сохранить' : 'Обновить данные', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>


</div>
