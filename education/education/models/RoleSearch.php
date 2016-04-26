<?php

namespace app\education\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\education\models\Role;

/**
 * RoleSearch represents the model behind the search form about `app\education\models\Role`.
 */
class RoleSearch extends Role
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['r_id', 'r_status'], 'integer'],
            [['r_name'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
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
        $query = Role::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        $query->andFilterWhere([
            'r_id' => $this->r_id,
            'r_status' => $this->r_status,
        ]);

        $query->andFilterWhere(['like', 'r_name', $this->r_name]);

        return $dataProvider;
    }
}
