<?php

namespace common\models;

use Yii;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "accessToken".
 *
 * @property int $accessTokenId
 * @property int $userId
 * @property string $accessToken
 *
 * @property User $user
 */
class AccessToken extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'accessToken';
    }

    protected function generateToken()
    {
        $this->accessToken = \Yii::$app->security->generateRandomString();
    }
}