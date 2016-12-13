<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\DocsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'เอกสาร';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="docs-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('เพิ่มเอกสาร', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?=
    GridView::widget([
        'dataProvider' => $dataProvider,
        //'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            // 'id',
            'title',
            [
                'label' => 'รายละเอียด',                     
                'format' => 'raw',
                'value' => function($model, $key, $widget) {
                    return Html::a('<span class="glyphicon glyphicon-search"></span>' . ' ', [
                                'view',
                                'id' => $model['id'],
                                    ]);
                },
                'headerOptions' => ['class' => 'text-center'],
                'contentOptions' => ['class' => 'text-center'],
            ],
//            'docs',
//            'covenant',
//            'ref',
                // 'expdate',
                // ['class' => 'yii\grid\ActionColumn'],
                ],
            ]);
            ?>
</div>
