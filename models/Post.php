<?php

namespace app\models;

use yii;
use yii\db\ActiveRecord;
use yii\behaviors\TimestampBehavior;
use yii\db\Expression;

class Post extends ActiveRecord
{

    /**
     * @return array the validation rules.
     */
    public function rules()
    {

        return [
            [['user_name', 'content'], 'required'],
            [['user_name', 'content'], 'default'],
        ];
    }


    public function beforeSave($insert) {
        if ($this->isNewRecord)
            $this->created_at = new \yii\db\Expression('NOW()');;

        return parent::beforeSave($insert);
    }




}