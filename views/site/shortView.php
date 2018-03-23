<?php
use yii\helpers\Html;
?>

<div class="post">
    <div class="content">
        <?= \yii\helpers\StringHelper::truncate($model['content'],100,'...'); ?>
    </div>

    <div class="meta">
        <p>Автор: <?= $model['user_name'] ?> <br>Дата публикации: <?= $model['created_at'] ?> <br> Коментариев: <?= $model['cnt_comments'] ?> </p>
    </div>

    <?= Html::a('read', ['post', 'id' => $model['id']], ['class' => 'btn btn-success']) ?>
</div>

