<?php

use yii\helpers\Html;
use yii\widgets\Pjax;
use kartik\grid\GridView;
use yii\helpers\ArrayHelper;
/* @var $this yii\web\View */
/* @var $searchModel common\models\ConfigSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Конфигурации';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="config-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Создать', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
<?php Pjax::begin(); ?>    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'tableOptions' => [
            'class' => ''
        ],
        'export' => false,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'name',
            'description',
            'price',
            'tech_task_name',
            // 'short_desc:ntext',
            // 'long_desc:ntext',
            // 'config_image',
            // 'deleted',

            [
                'class' => 'kartik\grid\ActionColumn',
                'header'=>'Действия',
                //'headerOptions' => ['width' => '80'],
                'template' => '{view}{update}{delete}{add-to-trash}',
                'buttons' => [
                    'add-to-trash' => function ($url,$model,$key) {
                        $in_trash = \common\models\Trash::find()->where(['config_id' => substr($url, -1)])->exists();
                        if($in_trash){
                            return Html::a('<span class="btn btn-warning">В корзине</span>', $url);
                        }else{
                            return Html::a('<span class="btn btn-success">Добавить в корзиу</span>', $url);
                        }
                    },
                ],
            ],
        ],
    ]); ?>
<?php Pjax::end(); ?></div>
