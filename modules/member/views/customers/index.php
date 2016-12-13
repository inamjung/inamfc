<?php

use yii\helpers\Html;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\member\models\CustomersSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'รายชื่อผู้สมัคร';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="customers-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('<i class="glyhpicon glyphicon-pencil"></i> สมัครเข้าร่วมอบรม', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        //'filterModel' => $searchModel,
        'formatter'=>['class'=>'yii\i18n\Formatter','nullDisplay'=>'-'],
        'hover'=>true,
        'striped'=>false,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
            'name',
           // 'addr',
            'work',
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
//             [
//              'attribute'=>'pay',
//              'format'=>'html',
//              'value'=> function($model){
//                    return $model->pay== 1 ? "<i class=\"glyphicon glyphicon-ok\"></i>" : "<i class=\"glyphicon glyphicon-remove\"></i>";
//                },                 
//            ],
//            [
//                        'label' => 'พิมพ์',
//                        // 'attribute' => 'telphone',        
//                        'format' => 'raw',
//                        'value' => function($model, $key, $widget) {
//                            return Html::a('<span class="glyphicon glyphicon-print"></span>' . ' ', [
//
//                                        'print',
//                                        'id' => $model['id'],
//                                            ],['target'=>'_blank',"data-pjax"=>"0"]);
//                        },
//                                'contentOptions' => ['class' => 'text-center'],
//                                'headerOptions' => ['class' => 'text-center'],
//                            ],   
//            [
//                        'label' => 'แก้ไขข้อมูล',
//                        // 'attribute' => 'telphone',        
//                        'format' => 'raw',
//                        'value' => function($model, $key, $widget) {
//                            return Html::a('<span class="glyphicon glyphicon-pencil"></span>' . ' ', [
//
//                                        'update',
//                                        'id' => $model['id'],
//                                            ]);
//                        },
//                                'contentOptions' => ['class' => 'text-center'],
//                                'headerOptions' => ['class' => 'text-center'],
//                            ],                    
            
            // 'p',
            // 'tel',            
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
