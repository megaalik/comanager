<?php

use yii\widgets\Pjax;
use yii\helpers\Html;
use kartik\grid\GridView;



/* @var $this yii\web\View */
/* @var $model common\models\Config */
/* @var $form yii\widgets\ActiveForm */
$this->title = 'Редактирование конфигурации: ' . $configName;
$this->params['breadcrumbs'][] = ['label' => 'Конфигурации', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $configName, 'url' => ['view', 'id' => $id]];
$this->params['breadcrumbs'][] = 'Редактирование';
?>

<?php $form = \yii\bootstrap\ActiveForm::begin(); ?>

    <div><h1><p>Конфигурация: <?= $configName ?></p></h1></div>

    <div class="row"><?php Pjax::begin(); ?>

        <div class="col-lg-5"><h3>Компоненты для добавления в конфигурацию:</h3><?= GridView::widget([
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,
                'tableOptions' => [
                    'class' => ''
                ],
                'export' => false,
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],

                    'id',
                    'artcode',
                    'name',
                    'price',

                    [
                        'class' => 'kartik\grid\ActionColumn',
                        'header'=>'Добавить',
                        //'headerOptions' => ['width' => '80'],
                        'template' => '{add-component-config}',
                        'buttons' => [
                            'add-component-config' => function ($url,$model,$key) {
                                return Html::a('<span class="btn glyphicon glyphicon-arrow-right"></span>', $url);
                            },
                        ],
                    ],
                ],
            ]); ?></div>


        <!--  Вывод списка компонентов данной конфигурации -->
        <h3>Список компонентов кофнфигурации:</h3>
        <div class="col-lg-6 col-lg-offset-0"><?= GridView::widget([
                'dataProvider' => $dataProvider2,
                'export' => false,
                'pjax' => true,
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],

                    //'config_id',
                    'componentName',
                    'ArtCode',
                    'count',
                    'summ',


                    [
                        'class' => 'kartik\grid\ActionColumn',
                        'header'=>'Удалить',
                        //'headerOptions' => ['width' => '80'],
                        'template' => '{remove-component-config}',
                        'buttons' => [
                            'remove-component-config' => function ($url,$model,$key) {
                                return Html::a('<span class="btn glyphicon glyphicon-remove"></span>', $url);
                            },
                        ],
                    ],
                ],
            ]); ?></div>


    <?php Pjax::end(); ?></div>

    <div class="form-group">
        <?= \yii\helpers\Html::submitButton('Сохранить',
            ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

<?php \yii\bootstrap\ActiveForm::end(); ?>