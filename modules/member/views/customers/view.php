<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\modules\member\models\Customers */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Customers', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="customers-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>
  

    <?= DetailView::widget([
        'model' => $model,
        'formatter'=>['class'=>'yii\i18n\Formatter','nullDisplay'=>'-'],
        'attributes' => [
            //'id',
            'createdate',
            'name',
            'addr',
           
             [
              'attribute'=>'t',             
              'value'=>$model->tmbon->name,
            ],
            [
              'attribute'=>'a',             
              'value'=>$model->ampur->name,
            ],
            [
              'attribute'=>'c',             
              'value'=>$model->chwt->name,
            ],           
            'p',
            'tel',
            'work',
            'pos',
            'interest',  
            [
              'attribute'=>'pay',
              'format'=>'html',
                'value'=> $model->pay== 1 ? "<i class=\"glyphicon glyphicon-ok\"></i>" : "<i class=\"glyphicon glyphicon-remove\"></i>",
            ],
            'pay',
            'paydate',
            'money',
            'slip',
            'fb',
            'line',
            'email:email',
        ],
    ]) ?>
  <div>                
         <?= Html::img('img/'.$model->slip,['class'=>'thumbnail img-responsive','style'=>'widht: 100 px;'])?>
  </div>
</div>
