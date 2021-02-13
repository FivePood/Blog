<?php
namespace frontend\modules\api\v1\controllers;

use Yii;
use yii\web\Controller;
use yii\rest\ActiveController;
use frontend\modules\api\v1\models\Posts;


class PostsController extends ActiveController
{
    public $modelClass = 'common\models\Post';
}