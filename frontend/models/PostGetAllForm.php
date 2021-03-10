<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use common\models\Post;

/**
 * Post Create form
 */
class PostGetAllForm extends Model
{
    public function getAll()
    {
        $request = Yii::$app->request->get();
        $deafultLimit = 5;
        $deafultOffset = 0;
        $limit = $request['limit'] ?? $deafultLimit;
        $offset = $request['offset'] ?? $deafultOffset;
        $post = Post::find()
            ->limit($limit)
            ->offset($offset)
            ->all();
        $postData = [];
        foreach ($post as $element) {
            $postData[] = $element->serializeToArray();
        }
        return $postData;
    }
}
