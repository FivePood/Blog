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

    public function getAll()
    {
        $deafultLimit = 5;
        $deafultOffset = 0;
        $limit = $request['limit'] ?? $deafultLimit;
        $offset = $request['offset'] ?? $deafultOffset;
        $this->query = Post::find()
            ->limit($limit)
            ->offset($offset);
        return true;
    }

    public function seriazliedPostAllArray()
    {
        $result = [];
        foreach ($this->query->each() as $post) {
            $result[] = $post->serializeToArray();
        }
        return $result;
    }
}
