<?php

namespace app\education\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\education\models\Permission;

/**
 * PermissionSearch represents the model behind the search form about `app\education\models\Permission`.
 */
class PermissionSearch extends Permission
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['p_id', 'p_status'], 'integer'],
            [['p_name', 'p_alias'], 'safe'],
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
        $query = Permission::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);
        
        $query->andFilterWhere([
            'p_id' => $this->p_id,
            'p_status' => $this->p_status,
        ]);

        $query->andFilterWhere(['like', 'p_name', $this->p_name])
            ->andFilterWhere(['like', 'p_alias', $this->p_alias]);

        return $dataProvider;
    }
}
