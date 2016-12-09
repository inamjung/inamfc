<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\member\models\CustomersSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Customers';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="customers-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Customers', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        //'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
            'name',
           // 'addr',
             [            
                'attribute' => 't',
                 'value'=> 'tmbon.name', 
             ],
            [            
                'attribute' => 'a',
                 'value'=> 'ampur.name',
             ],
             [            
                'attribute' => 'c',
                 'value'=> 'chwt.name',
             ],
             [
              'attribute'=>'pay',
              'format'=>'html',
              'value'=> function($model){
                    return $model->pay== 1 ? "<i class=\"glyphicon glyphicon-ok\"></i>" : "<i class=\"glyphicon glyphicon-remove\"></i>";
                },                 
            ],
            
            // 'p',
            // 'tel',
            // 'work',
            // 'pos',
            // 'interest',
            // 'money',
            
//        [
//            'class' => 'kartik\grid\BooleanColumn',
//            'attribute' => 'pay',            
//        ],
            // 'slip',
            // 'fb',
            // 'line',
            // 'email:email',

            //['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
