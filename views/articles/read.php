<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

?>

<div class="col-xs-12">
    <h1 class="page-title"><?= $article->title; ?></h1>
    <?php
        $this->params['breadcrumbs'][] = $article->title;
        echo $article->body . "<br/>";
        echo $article->date_create;
    ?>
</div>

<h4>Comments</h4>
<?php foreach($comments as $comment): ?>
    <div class="col-xs-12">
        <?php if($comment->enabled): ?>
            <p><?= $comment->comment; ?></p>
        <?php endif ?>
    </div>
<?php endforeach?>

<?php 
  $form = ActiveForm::begin([
      'action' => ['articles/comment', 'id' => $article->id],
      'method' => 'post',
      'id' => $article->id,
      'options' => [
        'class' => 'form-horizontal',
        'enctype' => 'multipart/form-data'
      ],
  ]); 
?>
<?= $form->field($commentsForm, 'article_id')->hiddenInput(['value'=>$article->id])->label(false) ?>
<?= $form->field($commentsForm, 'comment')->textarea()->label(false) ?>
<?= Html::submitButton('Save', ['class' => 'btn btn-primary']) ?>
<?php ActiveForm::end();?>

