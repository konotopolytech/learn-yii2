<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use app\models\Articles;
use app\models\Comments;
use yii\data\Pagination;
use yii\web\NotFoundHttpException;
use yii\web\Request;

class ArticlesController extends Controller
{
    const PUBLISHED = 1;
    const PAGE_SIZE = 5;
    private $articles;
    private $comments;
  
    function __construct($id, $module, $config = []) {
        parent::__construct($id, $module, $config = []);
        $this->articles = new Articles;
        $this->comments = new Comments;
    }
  
      
    public function actionIndex() {
        $query = $this->articles->find()->where(['public' => self::PUBLISHED]);
        $countQuery = clone $query;

        $pages = new Pagination(['totalCount' => $countQuery->count(), 'pageSize' => self::PAGE_SIZE]);
        $pages->pageSizeParam = true;
        
        $models = $query->offset($pages->offset)
            ->limit($pages->limit)
            ->all();

        return $this->render('index', [
             'models' => $models,             
             'pages' => $pages
        ]);        
    }


    public function actionShow($id) {        
        $article = $this->articles->find()->where([
            'id' => $id, 
            'public' => self::PUBLISHED])->one();
                
        if ($article === null) {
              throw new NotFoundHttpException('Asked article not found');
        }
                
        $urlQuery = parse_url(Yii::$app->request->referrer, PHP_URL_QUERY);
        
        return $this->render('read', [
            'article'=>$article, 
            'urlQuery' => isset($urlQuery) ? "?" . $urlQuery : "",
            'comments' => $article->comments,
            'commentsForm' => $this->comments
        ]);
    }
    
    
    public function actionComment($id) {        
        if( $this->comments->load(Yii::$app->request->post()) && $this->comments->validate() ){            
            if($this->comments->save()) {
                Yii::$app->session->setFlash('success', "Your comment has been added and would be published after moderation.");
            } else {
                Yii::$app->session->setFlash('error', "Your comment hasn't been created.");
            }
            
            return $this->redirect(['articles/show/', 'id' => $id]);
        }
    }
}
