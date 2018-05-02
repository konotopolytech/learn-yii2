<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;
use yii\web\IdentityInterface;

class User extends ActiveRecord implements IdentityInterface
{
    public static function tableName(){
        return 'users';
    }
    
    
//     public function rules(){
//         return [
//             [ [ 'username', 'email', 'pwd' ], 'required', 'message'=>'Please prompt all fields values' ],
//             [ 'email', 'email' ],
//             [ 'admin', 'boolean' ],
//         ];
//     }
    
    public static function findIdentity($id)
    {
        return static::findOne($id);
    }

    public static function findIdentityByAccessToken($token, $type = null)
    {
        return static::findOne(['access_token' => $token]);
    }

    public function getId()
    {
        return $this->id;
    }
    
    public function findByUsername($username) {
        return static::findOne([ 'username' => $username ]);
    }
    
    public function validatePassword($password) {
        return Yii::$app->getSecurity()->validatePassword($password, $this->pwd);
    }

    public function getAuthKey()
    {
//         return $this->authKey;
    }

    public function validateAuthKey($authKey)
    {
//         return $this->authKey === $authKey;
    }
}
