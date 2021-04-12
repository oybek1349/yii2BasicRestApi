<?php

namespace app\modules\valute\controllers;

use Yii;
use app\modules\valute\models\Currency;
use app\modules\valute\models\CurrencySearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\data\ActiveDataProvider;
/**
 * ValuteController implements the CRUD actions for Currency model.
 */
class ValuteController extends Controller
{
    /**
     * {@inheritdoc}
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
     * Lists all Currency models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new CurrencySearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Currency model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Currency model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
                
        $data = [];
        $date = (!empty($_POST['date']))? date('d/m/Y', strtotime($_POST['date'])) : '';

      if( !empty($date) ):       
        
         $urlfile = "http://www.cbr.ru/scripts/XML_daily.asp?date_req={$date}&d=0";
        
         $unixdate = date('U', strtotime($date));   
        
         $xml = @file_get_contents($urlfile);

         $xml_str = simplexml_load_string($xml);

         $json = json_encode($xml_str);
         $data = json_decode($json, true);         
         
         $arrData = null;

         foreach($data['Valute'] as $arr){

           $arrData[] = [ $arr['@attributes']['ID'], $arr['NumCode'], $arr['CharCode'], $arr['Name'], $arr['Value'], $unixdate ];          
        
         } 

             Yii::$app->db->createCommand()->batchInsert(Currency::tableName(), ['valuteID', 'numCode', 'charCode', 'name', 'value', 'date'], $arrData )->execute();      

            return $this->render('create', [
            'data' => $data,
            'info' => 'Quyagi malumotlar bazaga saqlandi.',
        ]);
      endif;        

        return $this->render('create', [
            'data' => $data,            
        ]);
    }

    /**
     * Updates an existing Currency model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Currency model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Currency model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Currency the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Currency::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
