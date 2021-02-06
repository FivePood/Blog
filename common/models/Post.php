<?php
namespace common\models;

use Yii;

/**
 */
class Post extends BasePost
{
    public function findActivePost()
    {
        return Post::find()
            ->andWhere(['post.status' => Post::STATUS_ACTIVE]);
    }
}