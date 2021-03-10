<?php
namespace frontend\controllers;

use Yii;
use yii\rest\Controller;
use frontend\models\PostCreateForm;
use frontend\models\PostGetAllForm;
use frontend\models\PostGetMyForm;


class PostController extends Controller
{
    public function actionCreate() //Апи для публикации поста в блог
    {
        $post = new PostCreateForm();
        $post->load(Yii::$app->request->bodyParams, '');
        if ($postQuery = $post->create()) {
            return [
                $postQuery,
            ];
        }
        return [
            'error' => $post->getErrors(),
        ];
    }

    public function actionGetAll()  //Апи для получения всех публикаций в системе
    {
        $post = new PostGetAllForm();
        if ($postQuery = $post->getAll()) {
            return [
                $postQuery,
            ];
        }
        return [
            'error' => $post->getErrors(),
        ];
    }

    public function actionGetMy()  //Апи для получения моих публикаций
    {
        $post = new PostGetMyForm();
        if ($postQuery = $post->getMy()) {
            return [
                $postQuery,
            ];
        }
        return [
            'error' => $post->getErrors(),
        ];
    }
}