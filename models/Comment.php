<?php

namespace app\models;

use yii\db\ActiveRecord;

class Comment extends ActiveRecord
{
    /**
     * @return array the validation rules.
     */
    public function rules()
    {

        return [
            [['author_name', 'content'], 'required'],
            [['author_name', 'content'], 'default'],
        ];
    }


    public function beforeSave($insert) {
        if ($this->isNewRecord)
            $this->created_at = new \yii\db\Expression('NOW()');;

        return parent::beforeSave($insert);
    }
}