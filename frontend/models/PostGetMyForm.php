<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use common\models\AccessToken;
use common\models\Post;

/**
 * Post Create form
 */
class PostGetMyForm extends Model
{
    public function getMy()
    {
        $request = Yii::$app->request->get();
        $deafultLimit = 5;
        $deafultOffset = 0;
        $limit = $request['limit'] ?? $deafultLimit;
        $offset = $request['offset'] ?? $deafultOffset;
        $user = AccessToken::findUser($request['accessToken']);
        if (!($user)) {
            return null;
        }
        $postQuery = Post::find()
            ->where(['userId' => $user->userId])
            ->limit($limit)
            ->offset($offset);
        $postData = [];
        foreach ($postQuery->each() as $post) {
            $postData[] = $post->serializeToArray();
        }
        return [
            "post" => $postData,
        ];
    }
}
