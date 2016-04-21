<?php

namespace app\modules\offer\controllers;

use common\models\ComponentConfig;
use common\models\ComponentSearch;
use common\models\Component;
use common\models\Trash;
use Yii;
use common\models\Config;
use common\models\ConfigSearch;
use yii\helpers\BaseFileHelper;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;
use Imagine\Image\Point;
use yii\imagine\Image;
use Imagine\Image\Box;
use yii\helpers\Url;
use yii\data\ActiveDataProvider;

/**
 * ConfigController implements the CRUD actions for Config model.
 */
class ConfigController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Config models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ConfigSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionAddToTrash($id){
        $in_trash = \common\models\Trash::find()->where(['config_id' => $id])->exists();
        if($in_trash){
            $this->redirect(['/offer/trash']);
        }else{
            $trash = new Trash();
            $trash->config_id =$id;
            $config = $this->findModel($id);
            $trash->name = $config->name;
            $trash->description = $config->description;
            $trash->count = 1;
            $trash->price = $config->price;
            $trash->summ = $trash->count * $trash->price;
            $trash->user_id = 1; //TODO доделать выборку пользователя
            $trash->save();
            return $this->redirect(['index']);
        }
        return true;

    }

    /**
     * Displays a single Config model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Config model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Config();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['step2']);
            //return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Config model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['step2']);
            //return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    public function actionFileUploadImage(){

        if(Yii::$app->request->isPost){
            //$id = Yii::$app->request->post("id");
            $id = Yii::$app->locator->cache->get('id');
            $path = Yii::getAlias("@frontend/web/uploads/conf_img");

            $model = Config::findOne($id); //var_dump($model);die;
            //$model->scenario = 'step2';

            $file = UploadedFile::getInstance($model,'config_image');// var_dump($file);die;
            if($file) {
                $name = $id.'.'.$file->extension;
                $file->saveAs($path .DIRECTORY_SEPARATOR .$name); //var_dump($name);die;

                $image  = $path .DIRECTORY_SEPARATOR .$name;

                $model->config_image = $name;
                $model->save();

                Image::frame($image, 0, '666', 0)
                    ->thumbnail(new Box(200, 200))
                    ->save($image, ['quality' => 100]);

                return true;
            }


        }
        return true;
    }

    /**
     * @return mixed
     */
    public function actionStep2(){
        $id = Yii::$app->locator->cache->get('id'); //echo $id; die;
        $model = Config::findOne($id);
        $image = [];
        if($config_image = $model->config_image){
            $image[] =  '<img src="/uploads/conf_img/' . $config_image . '" width=250>';
        }
        //print_r($image);die;

        if(Yii::$app->request->isPost){
            $this->actionFileUploadImage();
            \Yii::$app->session->setFlash('info', 'Картинка конфигурации успешно сохранена!');
            $this->redirect(Url::to(['config/step3/']));


        }



        return $this->render("step2",['model' => $model,'image' => $image]);
    }

    public function actionStep3(){
        $id = Yii::$app->locator->cache->get('id'); //echo $id; die;
        $configName = Yii::$app->locator->cache->get('confgiName');
        $model = new ComponentConfig();

       if(Yii::$app->request->isPost) {

           $this->redirect(Url::to(['config/']));
       }
           $searchModel = new ComponentSearch();
           $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

           $query = ComponentConfig::find()->where(['config_id' => $id]);
           $dataProvider2 = new ActiveDataProvider([
               'query' => $query,

           ]);//var_dump($dataProvider2);die;


           return $this->render('step3', [
               'model' => $model,
               'searchModel' => $searchModel,
               'dataProvider' => $dataProvider,
               'dataProvider2' => $dataProvider2,
               'id' => $id,
               'configName' => $configName,
           ]);


    }

    public function actionAddComponentConfig($id){
        $config_id = Yii::$app->locator->cache->get('id');

        //if(Yii::$app->request->isPost){
            $component_config = new ComponentConfig();
            $component_config->config_id = $config_id;
            $component_config->component_id = $id;

            $component = Component::findOne($id);//->where(['id' => $id]);  var_dump($component);die;


            $component_config->summ = $component->price; // var_dump($component->price);die;
            if($component_config->save()){
                \Yii::$app->session->setFlash('info', 'Компонент с АртКодом '.$component->artcode.' успешно добавлен в конфигурацию');
            }else{
                \Yii::$app->session->setFlash('danger', 'Компонент с АртКодом '.$component->artcode.' уже есть в данной конфигурации');
            }

            return $this->redirect(['step3']);




            //$this->refresh();
        //}
    }

    public function actionRemoveComponentConfig($id){
        $config_id = Yii::$app->locator->cache->get('id');

        //if(Yii::$app->request->isPost){

        $component_config = ComponentConfig::findOne($id);//->where(['id' => $id]);  var_dump($component);die;
        $component_config->delete($id);


        return $this->redirect(['step3']);

        //}
    }


    /**
     * Deletes an existing Config model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $path = Yii::getAlias("@frontend/web/uploads/conf_img");
        $config = Config::findOne($id);
        $config_image_file  = $path .DIRECTORY_SEPARATOR .$config->config_image; //echo $config_image_file;die;
        unlink($config_image_file);
        ComponentConfig::deleteAll('config_id = '.$id);

        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Config model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Config the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Config::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
