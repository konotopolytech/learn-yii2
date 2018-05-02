<?php

namespace app\controllers\admin;

use Yii;
use yii\web\Controller;
use app\models\Articles;
use yii\helpers\Url;
use yii\web\NotFoundHttpException;
use yii\filters\AccessControl;

class ArticlesController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
//                 'only' => ['read', 'update', 'delete', 'add'],
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
    
    public function actionIndex() {
        $articles = Articles::find()->all();

        if ($articles === null) {
            throw new NotFoundHttpException('Articles not found');
        }

        return $this->render('index', ['title'=> 'Aticles', 'articles'=>$articles]);
    }


    public function actionRead($id) {
        $article = Articles::find()->where(['id' => $id])->one();
                
        if ($article === null) {
              throw new NotFoundHttpException('Article not found');
        }

        return $this->render('read', ['title'=> 'Aticles', 'article'=>$article]);
    }


    public function actionAdd() {
        $model = new Articles();

        if( $model->load(Yii::$app->request->post()) && $model->validate() ){
            if( $model->save() ){          
              Yii::$app->session->setFlash('success', "Article successfully created and has ID equal to " . $model->id);
            } else {
                Yii::$app->session->setFlash('error', "Article did not created");
            }
        }

        return $this->render('add', ['model' => $model]);   
    }
  

    public function actionUpdate($id) {
        $model = Articles::find()->where(['id' => $id])->one();

        if( $model->load(Yii::$app->request->post()) && $model->validate() ){
            if( $model->update() ){          
              Yii::$app->session->setFlash('success', "Article successfully updated");
            } else {
                Yii::$app->session->setFlash('error', "Article did not updated");
            }
        }

        return $this->render('add', ['model' => $model]);   
    }
  
  
    public function actionDelete($id) {
        $model = Articles::find()->where(['id' => $id])->one();
        
        if( $model->delete() ) {          
            Yii::$app->session->setFlash('success', "Article successfully deleted");
            return $this->redirect(['admin/articles']);
        } else {
            Yii::$app->session->setFlash('error', "Article did not deleted.");
        }
    }
}
