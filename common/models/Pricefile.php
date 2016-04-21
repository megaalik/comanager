<?php
namespace common\models;

use Yii;
use yii\base\Model;
use yii\web\UploadedFile;

class Pricefile extends Model
{
/**
* @var UploadedFile
*/
    public $priceExcel;

    public function rules()
    {
        return [
        [['priceExcel'], 'file', 'skipOnEmpty' => false,
            'extensions' => ['xls', 'xlsx'],
            'checkExtensionByMimeType' => false,
            'mimeTypes' => ['application/vnd.ms-excel',
                            'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet']],
        ];
    }

    //Загрузка файла прайса
    public function upload()
    {
        if ($this->validate()) {
            $path = Yii::getAlias("@frontend/web/uploads");
            $name = 'PriceKZT';

            $this->priceExcel->saveAs($path . DIRECTORY_SEPARATOR . $name . '.' . 'xls');//$this->priceExcel->extension);
            return true;
        } else {
        return false;
        }
    }
}