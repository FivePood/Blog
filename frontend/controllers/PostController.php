<?php
namespace frontend\controllers;

use Yii;
use yii\rest\ActiveController;


class PostController extends ActiveController
{
    public $modelClass = 'common\models\Post';

    public function actionList()
    {
        return [
            [
                'userId' => 1,
                'text' => 'test post',
            ],
        ];
    }
}