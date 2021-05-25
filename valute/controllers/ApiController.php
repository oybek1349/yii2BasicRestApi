<?php

namespace app\modules\valute\controllers;
use app\modules\valute\models\Currency;

class ApiController extends \yii\rest\ActiveController
{
    
    public $modelClass = Currency::class;

    public function actions(){

    	$actions = parent::actions();

    	unset($actions['delete'],$actions['update'],$actions['create'],$actions['options']);

    	$actions['index']['prepareDataProvider'] = [$this, 'prepareDataProvider'];

    	return $actions;   
    }

    public function prepareDataProvider(){    
     
      \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
      
      if ( !empty($_GET['valuteID']) and !empty($_GET['from']) and !empty($_GET['to']) ):
        
        $from = date('U', strtotime($_GET['from']));
        $to = date('U', strtotime($_GET['to']));
        
        $query = "SELECT * FROM currency WHERE date>:f and date<:t and valuteID=:v";

        $currency = \Yii::$app->db->createCommand( $query )->
        bindValues([          
          ':f' => $from,
          ':t' => $to,
          ':v' => $_GET['valuteID']
        ])->queryAll();

      else: $currency = Currency::find()->all();

      endif; 
      
      return ( count($currency) > 0 )? $currency: 'Данные не найдено!';

    } 
  
}
