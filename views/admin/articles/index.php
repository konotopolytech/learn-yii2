<?php
use yii\helpers\Url;
use yii\helpers\Html;
use yii\grid\GridView;
use yii\data\ActiveDataProvider;
use app\models\Articles;
?>

<h1 class="page-title">Articles</h1>

<h4><?= Html::a('Add article', ['admin/articles/add']) ?></h4>

<?php
$dataProvider = new ActiveDataProvider([
  'query' => Articles::find()->orderBy(['date_create' => SORT_DESC]),
  'pagination' => [
      'pageSize' => 20,
  ]  
]);

echo GridView::widget([
    'dataProvider' => $dataProvider,
    'columns' => [
        ['class' => 'yii\grid\SerialColumn'],

        'id',
        'title:text',
        'body:text',
        'public:boolean',
        [
            'attribute' => 'date_create',
            'format' => ['datetime', 'php:d-m-Y H:m:s']
        ],
        [
            'attribute' => 'date_update',
            'format' => ['datetime', 'php:d-m-Y H:m:s']
        ],

        [
          'class' => 'yii\grid\ActionColumn',
          'header' => 'Actions',
          'template' => '{view}{update}{delete}{comments}',
          'options' => ['class' => 'button-column'],
          'buttons' => [
            'view' => function ($url, $model) {
                return Html::a('<span class="glyphicon glyphicon-eye-open"></span>', $url, [
                    'title' => 'View',
                    'class' => 'table-button'
                ]);
            },

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
            'comments' => function ($url, $model) {
                return Html::a('<span class="glyphicon glyphicon-th-list"></span>', $url, [
                    'title' => 'Comments',
                    'class' => 'table-button'
                ]);
            }

          ],
          'urlCreator' => function ($action, $model, $key, $index) {
            if ($action === 'view') {
                $url = Url::to(['admin/articles/'. $model->id]);
                return $url;
            }

            if ($action === 'update') {
                $url = Url::to(['admin/articles/update/'. $model->id]);
                return $url;
            }
            if ($action === 'delete') {
                $url = Url::to(['admin/articles/delete/'. $model->id]);
                return $url;
            }
            if ($action === 'comments') {
                $url = Url::to(['admin/comments/'. $model->id]);
                return $url;
            }
          }
        ],
    ],
]);
?>