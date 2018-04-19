<?php
use yii\helpers\Html;
?>

<?= Html::a('Go home', ['admin/articles']) ?>

<h2>Admin panel</h2>
<h1><?= $article->title; ?></h1>
<?php
  echo $article->body . "<br/>";
  echo $article->date_create;
?>