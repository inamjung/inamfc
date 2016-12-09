<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\member\models\Customers */

$this->title = 'Update Customers: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Customers', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="customers-update">

<!--    <h1><?= Html::encode($this->title) ?></h1>-->

      <div class="panel panel-success">
        <div class="panel-heading">           
                <h4>แก้ไข : ข้อมูลผู้เข้าร่วมอบรม Yii2 16 - 18 มค 2560</h4>
            </div>            
        <div class="panel-body">
             <?= $this->render('_form', [
        'model' => $model,
        'programe'=>$programe,
        'risktype'=>$risktype         
    ]) ?>
        </div>
    </div>
</div>
