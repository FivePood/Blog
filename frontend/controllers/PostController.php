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
        $postForm = new PostCreateForm();
        $postForm->load(Yii::$app->request->bodyParams, '');
        if ($postModel = $postForm->create()) {
//        if ($postForm->create()) {
            return [
                'post' => $postModel,
//                'post' => $postForm->post->serializeToArray(), //обращение к serializeToArray не происходит
            ];
        }
        return [
            'error' => $postForm->getErrors(),
        ];
    }

    public function actionGetAll()  //Апи для получения всех публикаций в системе
    {
        $postForm = new PostGetAllForm();
        $postForm->load(Yii::$app->request->get(), '');
        if ($postForm->getAll()) {
            return [
                'post' => $postForm->seriazliedPostAllArray(),
            ];
        }
        return [
            'error' => $postForm->getErrors(),
        ];
    }

    public function actionGetMy()  //Апи для получения моих публикаций
    {
        $postForm = new PostGetMyForm();
        $postForm->load(Yii::$app->request->get(), '');
        if ($postForm->getMy()) {
            return [
                'post' => $postForm->seriazliedPostMyArray(),
            ];
        }
        return [
            'error' => $postForm->getErrors(),
        ];
    }
}