<?php 
  use yii\helpers\Html;
  use yii\widgets\ActiveForm;
?>

<?= Html::a('Go home', ['admin/articles']) ?>

<?php 
  $form = ActiveForm::begin([
      'id' => 'AddArticle',
      'options' => [
        'class' => 'form-horizontal',
         'enctype' => 'multipart/form-data'
      ],
  ]); 
?>

<?= $form->field($model, 'title') ?>
<?= $form->field($model, 'body')->textarea() ?>
<?= $form->field($model, 'public')->checkbox() ?>

<?= Html::submitButton('Save', ['class' => 'btn btn-primary']) ?>

<?php ActiveForm::end();?>

