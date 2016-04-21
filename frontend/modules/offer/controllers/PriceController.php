<?php

namespace app\modules\offer\controllers;

use common\models\Component;
use common\widgets\Alert;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use Yii;
use yii\web\UploadedFile;
use yii\base\Exception;
use common\models\Pricefile;

class PriceController extends \yii\web\Controller
{
    public function actionIndex()
    {
        //return $this->render('index');
    }

    /**
     * Load a price Component model.
     * @return mixed
     */
    public function actionUpload()
    {
        $model = new Pricefile();
        $model->priceExcel = UploadedFile::getInstance($model, 'priceExcel');
        if ($model->upload()) {
            // file is uploaded successfully
            $this->updatePrice();
        }
        return $this->render('upload', ['model' => $model]);
    }

    /**
     * @throws \PHPExcel_Reader_Exception
     * @return true
     */
    public function updatePrice() {
        $path = Yii::getAlias("@frontend/web/uploads");
        $inputFileName = $path . DIRECTORY_SEPARATOR . "PriceKZT.xls";
        $inputFileType = \PHPExcel_IOFactory::identify($inputFileName);

        try{
            if ($inputFileType=='Excel5' or $inputFileType=='Excel2007') {
                $inputFileType = \PHPExcel_IOFactory::identify($inputFileName);
                $objReader = \PHPExcel_IOFactory::createReader($inputFileType);
                $objPHPExcel = $objReader->load($inputFileName);
            }
        }catch (Exception $e)
        {
            die('Error');
        }
        //$sheet = $objPHPExcel->getSheet(0);
        $rows_count = $objPHPExcel->getActiveSheet()->getHighestRow();
        $objPHPExcel->getActiveSheet()->getStyle('D3:E'.$rows_count)->getNumberFormat()->setFormatCode('dd.mm.yyyy');
        $sheetData = $objPHPExcel->getActiveSheet()->toArray(null,true,true,true);
        if ($sheetData['1']['B'] == 'PriceKZT') {
            $isPriceKZT = TRUE;
        } else {
            $isPriceKZT = FALSE;
        }
        //
        //var_dump($sheetData); var_dump($rows_count,$isPriceKZT);die;

        //return array($sheetData,$rows_count,$isPriceKZT);

        if ($isPriceKZT != true) {
            \Yii::$app->session->setFlash('warning', 'Это не файл прайса! Проверьте корректность файл прайса!');
        }else{

            //$components = Component::find()->asArray()->all();

            //print_r($components);die;
            $count_updated = 0;
            $count_inserted = 0;
            for ($row = 3; $row <= $rows_count; $row++) {
                $time = strtotime($sheetData[$row]['D']);
                $Price_date =  date('Y-m-d',$time);


                $component = Component::find()->where(['artcode' => $sheetData[$row]['A']])->one();
                if ($component == true){
                    $component->artcode = $sheetData[$row]['A'];
                    $component->name = $sheetData[$row]['B'];
                    $component->price = $sheetData[$row]['C'];
                    $component->price_date = $Price_date;
                    $component->eng_desc = $sheetData[$row]['E'];
                    $component->rus_desc = $sheetData[$row]['F'];
                    $component->save();

                    $count_updated = $count_updated + 1;
                }else{
                    $time = strtotime($sheetData[$row]['D']);
                    $Price_date =  date('y-m-d',$time);

                    $component_ins = new Component();
                    $component_ins->artcode = $sheetData[$row]['A'];
                    $component_ins->name = $sheetData[$row]['B'];
                    $component_ins->price = $sheetData[$row]['C'];
                    $component_ins->price_date = $Price_date;
                    $component_ins->eng_desc = $sheetData[$row]['E'];
                    $component_ins->rus_desc = $sheetData[$row]['F'];
                    $component_ins->save(); print_r($component->getErrors());

                    $count_inserted = $count_inserted + 1;
                }
            }
            \Yii::$app->session->setFlash('warning', 'Данные  прайса успешно загружены в базу!');
            \Yii::$app->session->setFlash('info',
                'Обновлено цен: '.$count_updated.'<br>Добавлено новых компонентов: '.$count_inserted.'<br>');

        }

    }
}