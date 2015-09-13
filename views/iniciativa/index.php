<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Iniciativas';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="iniciativa-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            'fecha',
            'asunto',
            'descripcion:ntext',
        ],
    ]); ?>

    <p>
        <?= Html::a('Create Iniciativa', ['create'], ['class' => 'btn btn-success']) ?>
    </p>


</div>
