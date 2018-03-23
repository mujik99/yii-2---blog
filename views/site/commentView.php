<?php
use yii\helpers\Html;
?>


<div class="comment">
    <div class="content">
        <?= $model->content ?>
    </div>
    <div class="meta">
        <p>Автор: <?= $model->author_name ?> Дата публикации: <?= $model->created_at ?></p>
    </div>
</div>
