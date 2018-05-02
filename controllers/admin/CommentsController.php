<?php

namespace app\controllers\admin;

use Yii;
use yii\web\Controller;
use app\models\Articles;
use app\models\Comments;
use yii\helpers\Url;
use yii\web\NotFoundHttpException;
use yii\filters\AccessControl;


class CommentsController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    // Allow only for authenticated users
                    [
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
        ];
    }
    
    public function actionIndex($id) {
        $comments = Comments::find()->where(['article_id' => $id])->orderBy(['id' => SORT_DESC]);
        $article = Articles::find()->where(['id' => $id])->one();

        if ($comments === null) {
            throw new NotFoundHttpException('Comments not found');
        }
                
        return $this->render('index', ['id' => $id, 'article' => $article, 'comments' => $comments]);
    }


    public function actionUpdate($id) {
        $model = Comments::find()->where(['id' => $id])->one();
        
        if( $model->load(Yii::$app->request->post()) && $model->validate() ){
            if( $model->update() ){          
                Yii::$app->session->setFlash('success', "Comments successfully updated");
            } else {
                Yii::$app->session->setFlash('error', "Comments did not updated");
            }
            return $this->redirect(Url::to(['admin/comments/index', 'id' => $model->article->id]));
        }

        return $this->render('update', ['model' => $model]);   
    }
  
  
    public function actionDelete($id) {
        $model = Comments::find()->where(['id' => $id])->one();
        
        if( $model->delete() ) {          
            Yii::$app->session->setFlash('success', "Comments successfully deleted");
        } else {
            Yii::$app->session->setFlash('error', "Article did not deleted.");
        }
        
        return $this->redirect(Url::to(['admin/comments/index', 'id' => $model->article->id]));
    }
}
