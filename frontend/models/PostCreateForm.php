<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use common\models\AccessToken;
use common\models\Post;

/**
 * Post Create form
 */
class PostCreateForm extends Model
{
    public $title;
    public $content;
    public $accessToken;

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title', 'content'], 'required'],
        ];
    }

    public function create()
    {
        $request = Yii::$app->request->post();
        $token = new AccessToken();
        $post = new Post();
        $post->userId = $token->getUserId($request['accessToken']);
        $post->content = $this->content;
        $post->title = $this->title;
        if (!$post->save()) {
            return null;
        }
        return $post->serializeToArray();
    }
}