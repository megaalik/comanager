<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use kartik\select2\Select2;

/* @var $this yii\web\View */
/* @var $model common\models\Customer */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="customer-form">

    <?php $form = ActiveForm::begin([
        'options' => ['class' => 'form-horizontal'],
        'fieldConfig' => [
            'template' => '{label}<div class="col-sm-4">{input}</div><div class="col-sm-6">{error}</div>',
            'labelOptions' => ['class' => 'col-sm-2 control-label'],
        ],
    ]); ?>

    <?php $org_type=\common\models\Org_type::find()->all();
        $items=ArrayHelper::map($org_type,'id','org_type_name');
        $params=[
            'prompt' => 'Выберите тип организации...',
            'style' => 'width:250px',
        ];
    ?>
    <?= $form->field($model, 'org_type')->dropDownList($items,$params) ?>

    <?= $form->field($model, 'org_name',[
        'template' => '{label} <div class="row"><div class="col-xs-5">{input}{error}{hint}</div></div>',
        ])->textInput(['maxlength' => true])?>

    <?php
        $data = ArrayHelper::map(\common\models\City::find()->all(), 'id', 'city_name' );
//        print_r($data);
    ?>

    <?= $form->field($model, 'city_id')->widget(Select2::classname(), [
        'data' => $data,
        'attribute' => 'city_id',
        'options' => ['placeholder' => 'Выберите город...','id' => 'city_id'],
        'pluginOptions' => [
            'allowClear' => true
        ],
        ]);
    ?>

    <?= $form->field($model, 'head_position')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'head_position_dp')->textInput(['maxlength' => true]) ?>


    <?= $form->field($model, 'male')->radioList(['Муж', 'Жен'])->label('Пол') ?>

    <?= $form->field($model, 'last_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'first_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'patronymic')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'last_name_dp')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'first_name_dp')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'patronimic_dp')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'contacts')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
