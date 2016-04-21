<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\date\DatePicker;
use kartik\typeahead\TypeaheadBasic;
use yii\helpers\ArrayHelper;
use kartik\select2\Select2;

/* @var $this yii\web\View */
/* @var $model common\models\Offer */
/* @var $form yii\widgets\ActiveForm */
$total_price=100;

?>

<div class="offer-form">
    <p>
        <?= Html::a('Расчитать', ['calc'], ['class' => 'btn btn-success']) ?>
    </p>
    <?php $form = ActiveForm::begin(); ?>
    <?= $form->field($model, 'delivery_conditions')->hiddenInput(['value' => 'CIP'])->label(false) ?>
    <div class="row">

        <div class="col-md-4">
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
        </div>
        <div class="col-md-4">
            <?= $form->field($model, 'price_type')->dropDownList([
                'Стандарт' => 'Стандарт',
                'Перспектива' => 'Перспектива',
                'Индивидуальный' => 'Индивидуальный',
            ],
                ['prompt' => 'Выберите тип прайса ...']
            ) ?>
        </div>
        <div class="col-md-4">
            <?= $form->field($model, 'delivery_costs')->widget(TypeaheadBasic::className(), [
                'data' => ['500','1000','1500'],
                'options' => ['placeholder' => 'Введите стоимость доставки ...'],
            ]);?>
        </div>
    </div>
    <? $this->registerJs("

                    var form = document.forms.w0;
                    var provider_costs = form.elements.offer-provider_costs;

                    provider_costs.oninput =calc;
                    function calc(){
                    document.getElementById('offer-total-price').innerHTML = provider_costs.value;
                    }

                    calc();



                     alert($('#offer-delivery_conditions').find('option:selected').text());




                     $('#offer-delivery_conditions').click(function(){
                        $('#offer-nds').show();
                     });

                     $('#offer-delivery_conditions').click(function(){
                        $('#offer-nds').hide();
                     });



    ") ?>

    <div class="row">
        <div class="col-md-4"><?= $form->field($model, 'provider_costs')->textInput(['maxlength' => 20]) ?></div>
        <div class="col-md-4"><?= $form->field($model, 'service_costs')->textInput(['value' => '200']) ?></div>
        <div class="col-md-4"><?= $form->field($model, 'registration_costs')->textInput() ?></div>
    </div>

    <div class="row">

        <div class="col-md-4"><?= $form->field($model, 'marketing_costs')->textInput() ?></div>
        <div class="col-md-4"><?= $form->field($model, 'currency')->textInput(['readonly' => true, 'value' => 'USD']) ?></div>
    </div>

    <div class="row">
        <div class="col-md-4"><?= $form->field($model, 'currency_rate')->textInput() ?></div>
        <div class="col-md-4"><?= $form->field($model, 'total_price')->textInput(['readonly' => true, 'value' => $total_price]) ?></div>
        <div class="col-md-4"><?= $form->field($model, 'customer_id')->textInput() ?></div>
    </div>

    <div class="row">
        <div class="col-md-4"><?= $form->field($model, 'city_id')->textInput() ?></div>
        <div class="col-md-4"><?= $form->field($model, 'performer_id')->textInput(['maxlength' => true]) ?></div>
        <div class="col-md-4"><?= $form->field($model, 'user_id')->textInput() ?></div>
    </div>


    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Сохранить' : 'Обновить данные', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>


</div>
<?
//TODO Доделать выборку
//widget(Select2::classname(), [
//    'data' => ArrayHelper::map(\common\models\Customer::find()->all(), 'id', 'org_name' ),
//    'attribute' => 'customer_id',
//    'options' => ['placeholder' => 'Выберите клиента...','id' => 'customer_id'],
//    'pluginOptions' => [
//        'allowClear' => true
//    ],
//]);
?>