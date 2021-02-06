<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\BasePost */

$this->title = 'Create BasePost';
$this->params['breadcrumbs'][] = ['label' => 'Posts', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="post-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>