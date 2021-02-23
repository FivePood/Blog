<?php
namespace frontend\controllers;

use Yii;
use yii\rest\Controller;
use common\models\AccessToken;
use common\models\Post;


class PostController extends Controller
{
    public function actionCreate() //Апи для публикации поста в блог
    {
        $request = Yii::$app->request->post();
        $accessToken = new AccessToken();
        $post = new Post();
        $post->userId = $accessToken->getUserId($request['accessToken']);
        $post->content = $request['content'];
        $post->title = $request['title'];
        if ($post->save()) {
            return 'New post created';
        } else {
            return [
                'error' => $post,
            ];
        }
    }

    public function actionGetAll()  //Апи для получения всех публикаций в системе
    {
        $request = Yii::$app->request->get();
        $deafultLimit = 5;
        $deafultOffset = 0;
        $limit = $request['limit'] ?? $deafultLimit;
        $offset = $request['offset'] ?? $deafultOffset;
        $post = Post::find()->limit($limit)->offset($offset)->all();
        $postData = [];
        foreach ($post as $element) {
            $postData[] = $element->serializeToArray();
        }
        return $postData;
    }

    public function actionGetMy()  //Апи для получения моих публикаций
    {
        $request = Yii::$app->request->get();
        $deafultLimit = 5;
        $deafultOffset = 0;
        $limit = $request['limit'] ?? $deafultLimit;
        $offset = $request['offset'] ?? $deafultOffset;
        $accessToken = new AccessToken();
        $post = new Post();
        $post->userId = $accessToken->getUserId($request['accessToken']);
        if ($post->userId) {
            $post = Post::find()->where(['userId'=>$post->userId])->limit($limit)->offset($offset)->all();
            $postData = [];
            foreach ($post as $element) {
                $postData[] = $element->serializeToArray();
            }
            return $postData;
        } else {
            return 'You need to log in';
        }
    }
}