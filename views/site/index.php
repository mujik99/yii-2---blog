<?php

/* @var $this yii\web\View */

$this->title = 'Blog';

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\bootstrap\Carousel;

?>
<div class="site-index">

    <div class="jumbotron">
<?php

if (!empty($carousel)){
    echo Carousel::widget([
        'items' => $carousel,
        'options' => ['class' => 'carousel slide', 'data-interval' => '10000'],
        'controls' => [
            '<span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>',
            '<span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>'
        ]
    ]);

}

?>
    </div>

    <div class="body-content">

        <div class="row">
            <div class="col-lg-6">

                    <?php
                    if (isset($posts) && !empty($posts)){?>
                <h2>posts</h2>
                    <?php foreach ($posts as $post){
                        echo $this->render('shortView', [
                            'model' => $post
                        ]);
                    }}else{ ?>
                        <h2>posts</h2>
                   <?php } ?>
            </div>
            <div class="col-lg-6">
                <h2>add Post</h2>

                <?php $form = ActiveForm::begin(['id' => 'add-post-form']); ?>

                    <?= $form->field($model, 'user_name')->textInput(['autofocus' => false])->hint('Enter your name')->label('Name') ?>

                    <?= $form->field($model, 'message')->textarea(['rows' => 6])->hint('Enter your message')->label('Message') ?>

                    <div class="form-group">
                        <?= Html::submitButton('create', ['class' => 'btn btn-primary', 'name' => 'create-button']) ?>
                    </div>

                <?php ActiveForm::end(); ?>
            </div>
        </div>

    </div>
</div>
