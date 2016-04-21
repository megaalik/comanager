<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Trash */

$this->title = 'Create Trash';
$this->params['breadcrumbs'][] = ['label' => 'Trashes', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="trash-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
