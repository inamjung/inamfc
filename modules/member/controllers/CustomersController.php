<?php

namespace app\modules\member\controllers;

use Yii;
use app\modules\member\models\Customers;
use app\modules\member\models\CustomersSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\Json;
use yii\helpers\Url;
use app\models\Chw;
use app\models\Amp;
use app\models\Tmb;
use kartik\widgets\DepDrop;
use yii\helpers\ArrayHelper;
use yii\web\UploadedFile;
use yii\helpers\BaseFileHelper;
use yii\helpers\html;
use kartik\mpdf\Pdf;

/**
 * CustomersController implements the CRUD actions for Customers model.
 */
class CustomersController extends Controller
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
     * Lists all Customers models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new CustomersSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
    public function actionIndexyii()
    {
        $searchModel = new CustomersSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('indexyii', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Customers model.
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
     * Creates a new Customers model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Customers();

        if ($model->load(Yii::$app->request->post())) {
            
            $model->createdate = date('Y-m-d');
            $file = UploadedFile::getInstance($model,'slip_img');
             
             if(isset($file->size) && $file->size!=0){
                $model->slip = $file->name;
                $file->saveAs('img/'.$file->name);                   
                }
            $model->save();
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Customers model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $programe = ArrayHelper::map($this->getPrograme($model->c),'id','name');
        $risktype = ArrayHelper::map($this->getRisktype($model->a),'id','name');

        if ($model->load(Yii::$app->request->post())) { 
            $file = UploadedFile::getInstance($model,'slip_img');
             
             if(isset($file->size) && $file->size!=0){
                $model->slip = $file->name;
                $file->saveAs('img/'.$file->name);                   
                }
            
            $model->save();
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
                'programe'=>$programe,
                'risktype'=>$risktype,
            ]);
        }
    }

    /**
     * Deletes an existing Customers model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Customers model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Customers the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Customers::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
    
     public function actionGetPrograme(){
        $out = [];
        if (isset($_POST['depdrop_parents'])){
            $parents = $_POST['depdrop_parents'];
            if ($parents != NULL){
                $c = $parents[0];
                $out = $this->getPrograme($c);
                echo Json::encode(['output'=>$out, 'selected'=>'']);
                return;
            }
        }
        echo Json::encode(['output'=>'', 'selected'=>'']);
    }    
    public function actionGetRisktype(){
        $out = [];
        if (isset($_POST['depdrop_parents'])){
            $ids = $_POST['depdrop_parents'];
            $c = empty($ids[0]) ? NULL : $ids[0];
            $a = empty($ids[1]) ? NULL : $ids[1];
            if ($c !=NULL){
                $data = $this->getRisktype($a);
                echo Json::encode(['output'=>$data, 'selected'=>'']);
                return;
            }
        }
        echo Json::encode(['output'=>'', 'selected'=>'']);
    }     
    protected function getPrograme($id){
        $datas = Amp::find()->where(['chw_id'=>$id])->all();
        return $this->MapData($datas,'id','name');
    }
    
    protected function getRisktype($id){
        $datas = Tmb::find()->where(['amp_id'=>$id])->all();
        return $this->MapData($datas,'id','name');
    }    
    protected function MapData($datas,$fieldID,$fieldName){
        $obj = [];
        foreach ($datas as $key => $value){
            array_push($obj, ['id'=>$value->{$fieldID},'name'=>$value->{$fieldName}]);
        }
        return $obj;
    }
    
    public function actionPrint($id) {
        // get your HTML raw content without any layouts or scripts
        $model = Customers::find()->where(['id' => $id])->one();
        $content = $this->renderPartial('print',[
            'model' => $model,
        ]);

        // setup kartik\mpdf\Pdf component
        $pdf = new Pdf([
            // set to use core fonts only
            'mode' => Pdf::MODE_CORE,
            // A4 paper format
            'format' => Pdf::FORMAT_A4,
            // portrait orientation
            'orientation' => Pdf::ORIENT_PORTRAIT,
            // stream to browser inline
            'destination' => Pdf::DEST_BROWSER,
            // your html content input
            'content' => $content,
            // format content from your own css file if needed or use the
            // enhanced bootstrap css built by Krajee for mPDF formatting 
            'cssFile' => '@vendor/kartik-v/yii2-mpdf/assets/kv-mpdf-bootstrap.min.css',
            // any css to be embedded if required
            'cssInline' => '.kv-heading-1{font-size:18px}',
            // set mPDF properties on the fly
            'options' => ['title' => 'เอกสารประกอบการสมัคร'],
            // call mPDF methods on the fly
            'methods' => [
            //'SetHeader' => ['Krajee Report Header'],
            // 'SetFooter' => ['{PAGENO}'],
               
            ]
        ]);
 

        // return the pdf output as per the destination setting

        return $pdf->render();
    }
    
    
}
