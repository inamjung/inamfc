<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\modules\member\models\Customers */

$this->title = 'Create Customers';
$this->params['breadcrumbs'][] = ['label' => 'Customers', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="customers-create">

<!--    <h1><?= Html::encode($this->title) ?></h1>-->
    <div class="panel panel-success">
        <div class="panel-heading">           
                <h4>บันทึกข้อมูลผู้เข้าร่วมอบรม Yii2 16 - 18 มค 2560</h4>
            </div>            
        <div class="panel-body">
             <?= $this->render('_form', [
        'model' => $model,
        'programe'=>[],
        'risktype'=>[],         
    ]) ?>
        </div>
    </div>
</div>
