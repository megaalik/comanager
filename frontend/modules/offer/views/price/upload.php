<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
/* @var $this yii\web\View */
/* @var $searchModel common\models\PerformerSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Загрузка прайса';
$this->params['breadcrumbs'][] = $this->title;

?>

<h1><?= Html::encode($this->title) ?></h1>

<p>
<div class="price-form">


    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

        <?= $form->field($model, 'priceExcel')->fileInput() ?>
        <?=\yii\helpers\Html::submitButton('Загрузить прайс на сервер и обновить базу', ['class' => 'btn btn-success']) ?>

    <? ActiveForm::end() ?>
    <br><br>

</div>