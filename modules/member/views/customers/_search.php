<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\member\models\CustomersSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="customers-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'name') ?>

    <?= $form->field($model, 'addr') ?>

    <?= $form->field($model, 't') ?>

    <?= $form->field($model, 'a') ?>

    <?php // echo $form->field($model, 'c') ?>

    <?php // echo $form->field($model, 'p') ?>

    <?php // echo $form->field($model, 'tel') ?>

    <?php // echo $form->field($model, 'work') ?>

    <?php // echo $form->field($model, 'pos') ?>

    <?php // echo $form->field($model, 'interest') ?>

    <?php // echo $form->field($model, 'money') ?>

    <?php // echo $form->field($model, 'pay') ?>

    <?php // echo $form->field($model, 'slip') ?>

    <?php // echo $form->field($model, 'fb') ?>

    <?php // echo $form->field($model, 'line') ?>

    <?php // echo $form->field($model, 'email') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
