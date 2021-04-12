<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\valute\models\Currency */

$this->title = 'Create Currency';
$this->params['breadcrumbs'][] = ['label' => 'Currencies', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="currency-create">

    <h1><?= Html::encode($this->title) ?></h1>
    <h3><?= $info ?></h3>
   <?php 
      if( !empty($data) ) 
      	   print_r($data); 
   ?>   

</div>

<form method = 'post' action="?">
<label> Sanani kiriting. </label><br/>	
<input type="hidden" name='url' value="http://www.cbr.ru/scripts/XML_daily.asp?date_req=<?=$date?>&d=0">
<label class="urldata"> 
	http://www.cbr.ru/scripts/XML_daily.asp?date_req=
	<input type='date' name='date' id="date" />&d=0
</label>
<input type="submit" name='save' value="Save"/>
</form>	

