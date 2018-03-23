<?php

namespace app\models;


use yii\base\Model;


/**
 * ContactForm is the model behind the contact form.
 */
class AddCommentForm extends Model
{
    public $user_name;
    public $comment;

    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            [['user_name', 'comment'], 'required'],
            [['user_name', 'comment'], 'default'],
        ];
    }

}
