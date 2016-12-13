<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\widgets\FileInput;

/* @var $this yii\web\View */
/* @var $model app\models\Docs */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="docs-form">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'description')->textarea(['row' => 5]) ?>
    <?= $form->field($model, 'expdate')->textInput() ?>

 
    
   
                        <?= $form->field($model, 'docs[]')->widget(FileInput::classname(), [
                            'options' => [
                                //'accept' => 'image/*',
                                'multiple' => true
                                ],
                            'pluginOptions' => [
                                'initialPreview'=>$model->initialPreview($model->docs,'docs','file'),
                                'initialPreviewConfig'=>$model->initialPreview($model->docs,'docs','config'),
                                'allowedFileExtensions'=>['jpg','png','pdf','doc','docx','xls','xlsx'],
                                'showPreview' => true,
                                'showCaption' => true,
                                'showRemove' => true,
                                'showUpload' => false,
                                'overwriteInitial'=>false
                             ]
                            ]); 
                        ?>
                  
           

    
<?= $form->field($model, 'ref')->hiddenInput()->label(false); ?>  
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
