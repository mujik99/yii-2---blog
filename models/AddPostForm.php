<?php

namespace app\models;

use yii\base\Model;


/**
 * ContactForm is the model behind the contact form.
 */
class AddPostForm extends Model
{
    public $user_name;
    public $message;


    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            [['user_name', 'message'], 'required'],
            [['user_name', 'message'], 'default'],
        ];
    }


}
