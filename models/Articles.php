<?php

namespace app\models;
use yii\db\ActiveRecord;
use yii\behaviors\TimestampBehavior;
use yii\db\Expression;


class Articles extends ActiveRecord
{
    public static function tableName(){
        return 'articles';
    }
   
  
    public function rules(){
        return [
            [ 'title', 'required', 'message'=>'Please put the title' ],
            [ 'body', 'required', 'message'=>'Please put the body' ],
            [ 'public', 'boolean' ]
        ];
    }
    
  
    public function behaviors()
    {
        return [
            [
                'class' => TimestampBehavior::className(),
                'createdAtAttribute' => 'date_create',
                'updatedAtAttribute' => 'date_update',
                'value' => new Expression('NOW()'),
            ],
        ];
    }
  
    public function getComments()
    {
        return $this->hasMany(Comments::className(), ['article_id' => 'id']);
    }
}
      