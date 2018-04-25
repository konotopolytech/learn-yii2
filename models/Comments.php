<?php

namespace app\models;
use yii\db\ActiveRecord;
use yii\behaviors\TimestampBehavior;
use yii\db\Expression;


class Comments extends ActiveRecord
{
 
    public function rules(){
        return [
            [ 'article_id', 'required'],
            [ ['article_id'], 'integer'],
            [ 'comment', 'required', 'message'=>'Please put the comment' ],
            [ 'enabled', 'boolean']
        ];
    }
  
  
    public function behaviors()
    {
        return [
            [
                'class' => TimestampBehavior::className(),
                'createdAtAttribute' => 'date_create',
                'updatedAtAttribute' => false,                
                'value' => new Expression('NOW()'),
            ],
        ];
    }
    
    public function getArticle()
    {
        return $this->hasOne(Articles::className(), ['id' => 'article_id']);
    }
}