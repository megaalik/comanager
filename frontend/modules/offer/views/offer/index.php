<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel common\models\OfferSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Offers';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="offer-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Offer', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
<?php Pjax::begin(); ?>    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'offer_date',
            'delivery_conditions',
            'price_type',
            //'provider_costs',
            // 'delivery_costs',
            // 'local_delivery_costs',
            // 'customs_duty',
            // 'nds',
            // 'service_costs',
            // 'income_rate',
            // 'registration_costs',
            // 'marketing_costs',
            // 'currency',
            // 'currency_rate',
            'total_price',
            // 'total_price_nds',
            // 'customer_id',
            // 'city_id',
            // 'performer_id',
            // 'user_id',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
<?php Pjax::end(); ?></div>
