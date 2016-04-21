<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\date\DatePicker;
use kartik\typeahead\TypeaheadBasic;
use kartik\tabs\TabsX;

/* @var $this yii\web\View */
/* @var $model common\models\Offer */
/* @var $form yii\widgets\ActiveForm */

$items = [
    [
        'label'=>'<i class="glyphicon glyphicon-usd"></i> CIP',
        'content'=>$this->render('_cip', [
            'model' => $model,
        ]),
        'active'=>true
    ],
    [
        'label'=>'<i class="glyphicon glyphicon-credit-card"></i> DDP',
        'content'=>$this->render('_ddp', [
            'model' => $model,
        ])
    ],
    [
        'label'=>'<i class="glyphicon glyphicon-king"></i> Disabled',
        'headerOptions' => ['class'=>'disabled']
    ],
];

?>
<?= TabsX::widget([
'items'=>$items,
'position'=>TabsX::POS_ABOVE,
'encodeLabels'=>false
]);?>
