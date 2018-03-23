<?php

/* @var $this yii\web\View */

$this->title = 'Post';

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

?>
<div class="row post-wrapper">
    <div class="post-content">
        <?= $model->content; ?>
    </div>

    <div class="author">
        Author : <?= $model->user_name; ?>
    </div>
    <div class="post-date">
        Published : <?= $model->created_at; ?>
    </div>
</div>




<div class="row">
    <div class="col-lg-6">
        <?php
        if (isset($comments) && !empty($comments)){ ?>
            <h1>Commnets</h1>
            <?php foreach ($comments as $comment){
                echo $this->render('commentView', [
                    'model' => $comment
                ]);
            }
        }else{ ?>
            <h1>No comments</h1>
       <?php }  ?>
    </div>
    <div class="col-lg-6">
        <h1>Comment form</h1>
        <?php $form = ActiveForm::begin(['id' => 'add-comment-form']); ?>

        <?= $form->field($modelform, 'user_name')->textInput(['autofocus' => true])->hint('Enter your name')->label('Name') ?>

        <?= $form->field($modelform, 'comment')->textarea(['rows' => 6])->hint('Enter your comment')->label('Comment') ?>

        <div class="form-group">
            <?= Html::submitButton('add comment', ['class' => 'btn btn-primary', 'name' => 'create-button']) ?>
        </div>

        <?php ActiveForm::end(); ?>
    </div>
</div>

