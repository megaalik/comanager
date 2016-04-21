<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Config */


$this->title = 'Редактирование конфигурации: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Конфигурации', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Редактирование';
?>

<?php $form = \yii\bootstrap\ActiveForm::begin([
    'options' => ['enctype' => 'multipart/form-data']
]); ?>

    <div class="row">
        <?
        echo $form->field($model, 'config_image')->widget(\kartik\file\FileInput::classname(),[
            'options' => [
                'accept' => 'image/*', //здесь указываем какие данные будем загружать
            ],
            'pluginOptions' => [
                'uploadUrl' => \yii\helpers\Url::to(['file-upload-image']),
                'uploadExtraData' => [
                    'id' => $model->id, // доп поля для передачи с ajax запросом
                ],
                'allowedFileExtensions' =>  ['jpg', 'png','gif'],
                'initialPreview' => $image,
                'showUpload' => true,
                'showRemove' => false,
                'dropZoneEnabled' => false,
                'overwriteInitial'=>true,
                'mainClass' => 'input-group-md'
            ]
        ]);
        ?>

    </div>

    <div class="form-group">
        <?= \yii\helpers\Html::submitButton('Далее-->',
                ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

<?php \yii\bootstrap\ActiveForm::end(); ?>