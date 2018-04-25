<?php
use yii\helpers\Url;
use yii\helpers\Html;
use yii\grid\GridView;
use yii\data\ActiveDataProvider;
use app\models\Comments;
?>

<h4>Comments of the "<?= $article->title ?>"</h4>

<?php
$dataProvider = new ActiveDataProvider([
  'query' => $comments,
  'pagination' => [
      'pageSize' => 20,
  ]  
]);

echo GridView::widget([
    'dataProvider' => $dataProvider,
    'columns' => [
        'id',
        'comment:text',
        'enabled:boolean',
        
        [
          'class' => 'yii\grid\ActionColumn',
          'header' => 'Actions',
          'template' => '{update}{delete}',
          'buttons' => [
            'update' => function ($url, $model) {
                return Html::a('<span class="glyphicon glyphicon-pencil"></span>', $url, [
                    'title' => 'Update',
                    'class' => 'table-button'
                ]);
            },
            'delete' => function ($url, $model) {
                return Html::a('<span class="glyphicon glyphicon-trash"></span>', $url, [
                    'title' => 'Delete',
                    'class' => 'table-button'
                ]);
            },
          ],
            
          'urlCreator' => function ($action, $model, $key, $index) {
            if ($action === 'update') {
                $url = Url::to(['admin/comments/update/'. $model->id]);
                return $url;
            }
            if ($action === 'delete') {
                $url = Url::to(['admin/comments/delete/'. $model->id]);
                return $url;
            }
          }
        ],
    ],
]);
?>

<h6><?= Html::a('Return to Articles', Url::to(['admin/articles'])) ?></h6>