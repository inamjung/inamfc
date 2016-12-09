<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\Chw;
use app\models\Amp;
use app\models\Tmb;
use kartik\widgets\Select2;
use kartik\widgets\DepDrop;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model app\modules\member\models\Customers */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="customers-form">

    <?php $form = ActiveForm::begin([
         'options' => ['enctype' => 'multipart/form-data'],
    ]); ?>
    
    <div class="row">
        <div class="col-sm-offset-2 col-sm-4">
            <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-xs-6 col-sm-6 col-md-6">
            <?= $form->field($model, 'addr')->textarea(['row' => 3]) ?>
        </div>        
    </div>
    
    <div class="row">        
        <div class="col-xs-3 col-sm-3 col-md-3">
            <?= $form->field($model, 'c')->widget(kartik\widgets\Select2::className(),[
                'data'=> yii\helpers\ArrayHelper::map(\app\models\Chw::find()->all(), 'id', 'name'),
                'options'=>[
                    'placeholder'=>'-- ระบุจังหวัด --'                    
                ],
                'pluginOptions'=>[
                    'allowClear'=>true
                ]
            ]) ?>
        </div>
        <div class="col-xs-3 col-sm-3 col-md-3">
             <?=
            $form->field($model, 'a')->widget(DepDrop::className(), [
                        'data' => [$programe],
                        'options' => ['placeholder' => '<--คลิกเลือกหรือพิมพ์ชื่อโปรแกรม-->'],
                        'type' => DepDrop::TYPE_SELECT2,
                        'select2Options' => ['pluginOptions' => ['allowClear' => true]],
                        'pluginOptions' => [
                            'depends' => ['customers-c'],            
                            'url' => yii\helpers\Url::to(['/member/customers/get-programe']),
                            'loadingText' => 'Loading1...',
                        ],
                    ]);
            ?>
        </div>
        <div class="col-xs-3 col-sm-3 col-md-3">
             <?=
            $form->field($model, 't')->widget(DepDrop::className(), [
                        'data' => [$risktype],
                        'options' => ['placeholder' => '<--คลิกเลือกหรือพิมพ์รายการความเสี่ยง-->',
                            //'disabled'=>true, 
                            ],                        
                        'type' => DepDrop::TYPE_SELECT2,
                        'select2Options' => ['pluginOptions' => ['allowClear' => true]],
                        'pluginOptions' => [
                            'depends' => ['customers-c', 'customers-a'],            
                            'url' => yii\helpers\Url::to(['/member/customers/get-risktype']),
                            'loadingText' => 'Loading2...',
                        ],
                    ]);
            ?>
        </div>
        <div class="col-xs-3 col-sm-3 col-md-3">
            <?= $form->field($model, 'p')->textInput(['maxlength' => true]) ?>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-4 col-sm-4 col-md-4">
            <?= $form->field($model, 'work')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-xs-4 col-sm-4 col-md-4">
            <?= $form->field($model, 'pos')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-xs-4 col-sm-4 col-md-4">
            <?= $form->field($model, 'tel')->textInput(['maxlength' => true]) ?>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-4 col-sm-4 col-md-4">
            <?= $form->field($model, 'fb')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-xs-4 col-sm-4 col-md-4">
            <?= $form->field($model, 'line')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-xs-4 col-sm-4 col-md-4">
            <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>
        </div>
    </div>
    <hr>
    <div class="row">
        <div class="col-xs-4 col-sm-4 col-md-4">
             <?= $form->field($model, 'pay')->radioList(['1'=>'ชำระแล้ว','0'=>'ยังไม่ชำระ']) ?>
        </div>
        <div class="col-xs-4 col-sm-4 col-md-4">
            <?= $form->field($model, 'paydate')->widget(yii\jui\DatePicker::className(),[
                'language' => 'th',
                'dateFormat' => 'yyyy-MM-dd',
                'clientOptions' => [
                    'changeMonth' => true,
                    'changeYear' => TRUE
                ],
                'options' => ['class' => 'form-control']
                
            ]) ?>
        </div>
        <div class="col-xs-4 col-sm-4 col-md-4">
            <?= $form->field($model, 'money')->textInput(['maxlength' => true]) ?>
        </div>
    </div>    
   <div class="row">        
                    <div class="col-xs-12 col-sm-12 col-md-12  ">
                <?= $form->field($model, 'slip_img')->label('หลักฐานการจ่าย')->fileInput() ?>       
                    </div>    
                </div>     
                        <?php if ($model->slip) { ?>
                            <?= Html::img('img/' . $model->slip, ['class' => 'img-responsive img-circle', 'width' => '150px;']); ?>
                <?php } ?> 

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
