<?php
// use yii\helpers\Html;
?>
<!-- <h1>Admin: <?//= $title; ?></h1> -->
<?php

//   foreach($articles as $article){  
//     echo $article->id . "<br/>";
//     echo $article->title . "<br/>";    
//     echo $article->date_create . "<br/><br/><br/>";

//   }
?>

<?php
use yii\helpers\Url;
use yii\helpers\Html;
use yii\grid\GridView;
use yii\data\ActiveDataProvider;
use app\models\Articles;
?>

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
          'template' => '{view}{update}{delete}',
          'buttons' => [
            'view' => function ($url, $model) {
                return Html::a('<span class="glyphicon glyphicon-eye-open"></span>', $url, [
                            'title' => 'View',
                ]);
            },

            'update' => function ($url, $model) {
                return Html::a('<span class="glyphicon glyphicon-pencil"></span>', $url, [
                            'title' => 'Update',
                ]);
            },
            'delete' => function ($url, $model) {
                return Html::a('<span class="glyphicon glyphicon-trash"></span>', $url, [
                            'title' => 'Delete',
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

          }
        ],
    ],
]);
?>