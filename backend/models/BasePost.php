<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "post".
 *
 * @property int $postId
 * @property int $userId
 * @property string|null $title
 * @property string|null $content
 * @property string|null $date
 *
 * @property BaseUser $user
 */
class BasePost extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'post';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
//            [['userId'], 'required'],
//            [['userId'], 'integer'],
//            [['content'], 'string'],
//            [['userId'], 'exist', 'skipOnError' => true, 'targetClass' => BaseUser::className(), 'targetAttribute' => ['userId' => 'userId']],
            [['title'], 'required'],
            [['title', 'content'], 'string'],
            [['date'], 'date', 'format' => 'php:Y-m-d'],
            [['date'], 'default', 'value' => date('Y-m-d')],
            [['title'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'postId' => 'BasePost ID',
            'userId' => 'BaseUser ID',
            'title' => 'Title',
            'content' => 'Content',
            'date' => 'Date',
        ];
    }

    /**
     * Gets query for [[BaseUser]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(BaseUser::className(), ['userId' => 'userId']);
    }
}
