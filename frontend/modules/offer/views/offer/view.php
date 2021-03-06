<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Offer */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Offers', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="offer-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'offer_date',
            'delivery_conditions',
            'price_type',
            'provider_costs',
            'delivery_costs',
            'local_delivery_costs',
            'customs_duty',
            'nds',
            'service_costs',
            'income_rate',
            'registration_costs',
            'marketing_costs',
            'currency',
            'currency_rate',
            'total_price',
            'total_price_nds',
            'customer_id',
            'city_id',
            'performer_id',
            'user_id',
        ],
    ]) ?>

</div>
