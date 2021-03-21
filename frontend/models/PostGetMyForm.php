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
    public $limit;
    public $offset;
    public $query;

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['limit', 'offset'], 'required'],
        ];
    }

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
        $this->query = Post::find()
            ->where(['userId' => $user->userId])
            ->limit($limit)
            ->offset($offset);
        return true;

    }

    public function seriazliedPostMyArray()
    {
        $result = [];
        foreach ($this->query->each() as $post) {
            $result[] = $post->serializeToArray();
        }
        return $result;
    }
}
