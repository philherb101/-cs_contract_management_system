<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var frontend\models\MasterActivity $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="master-activity-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'activity_code')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'activity_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'created_at')->textInput() ?>

    <?= $form->field($model, 'updated_at')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
