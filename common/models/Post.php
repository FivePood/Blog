<?php
namespace common\models;

/**
 */
class Post extends BasePost
{
    public function findActivePost()
    {
        return Post::find()
            ->andWhere(['post.status' => Post::STATUS_ACTIVE]);
    }

    public static function findByUserId($id)
    {
        return static::findAll(['userId'=>$id]);
    }

    public function serializeToArray()
    {
        $data = [];
        $authorUser = $this->user;

        $data['title'] = $this->title;
        $data['content'] = $this->content;
        $data['date'] = $this->date;
        $data['author'] = !empty($authorUser) ? $authorUser->username : null;
        return $data;
    }
}