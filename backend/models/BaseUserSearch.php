<?php

namespace backend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\BaseUser;

/**
 * BaseUserSearch represents the model behind the search form of `app\models\BaseUser`.
 */
class BaseUserSearch extends BaseUser
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['userId', 'status'], 'integer'],
            [['username', 'authKey', 'passwordHash', 'passwordResetToken', 'email', 'createdAt', 'updatedAt', 'verificationToken'], 'safe'],
//            [['userId', 'status', 'createdAt', 'updatedAt'], 'integer'],
//            [['username', 'authKey', 'passwordHash', 'passwordResetToken', 'email', 'verificationToken'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = BaseUser::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'userId' => $this->userId,
            'status' => $this->status,
            'createdAt' => $this->createdAt,
            'updatedAt' => $this->updatedAt,
        ]);

        $query->andFilterWhere(['like', 'username', $this->username])
            ->andFilterWhere(['like', 'authKey', $this->authKey])
            ->andFilterWhere(['like', 'passwordHash', $this->passwordHash])
            ->andFilterWhere(['like', 'passwordResetToken', $this->passwordResetToken])
            ->andFilterWhere(['like', 'email', $this->email])
            ->andFilterWhere(['like', 'verificationToken', $this->verificationToken]);

        return $dataProvider;
    }
}
