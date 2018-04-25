<?php 
  use yii\helpers\Html;
  use yii\widgets\ActiveForm;
?>

<div class="col-xs-12">
    <h2><?= $model->comment; ?></h2>
</div>

<div class="col-xs-12">
<?php 
  $form = ActiveForm::begin([
      'id' => $model->id,
      'options' => [
        'class' => 'form-horizontal',
         'enctype' => 'multipart/form-data'
      ],
  ]); 
?>

<?= $form->field($model, 'id')->hiddenInput(['value' => $model->id])->label(false) ?>
<?= $form->field($model, 'enabled')->checkbox()->label("Set this comment as") ?>

<?= Html::submitButton('Save', ['class' => 'btn btn-primary']) ?>

<?php ActiveForm::end();?>
</div>