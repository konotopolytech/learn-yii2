<?php
use yii\helpers\Url;
use yii\helpers\Html;
use yii\widgets\LinkPager;

$this->title = 'Articles';
$this->params['breadcrumbs'][] = $this->title;

?>

<h1 class="page-title"><?= $this->title; ?></h1>

<?php foreach ($models as $model): ?>
  <div class="article">
      <h3> <?= $model->title ?> </h3>
      <?= Html::a('Read more...', ['articles/' . $model->id]) ?>
  </div>
<?php endforeach; ?>

<?= LinkPager::widget(['pagination' => $pages]); ?>