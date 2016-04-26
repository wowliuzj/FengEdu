<?php

namespace app\education\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\education\models\Access;

/**
 * AccessSearch represents the model behind the search form about `app\education\models\Access`.
 */
class AccessSearch extends Access
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['r_id', 'p_id', 'ac_r', 'ac_w'], 'integer'],
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
        $query = Access::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        $query->andFilterWhere([
            'r_id' => $this->r_id,
            'p_id' => $this->p_id,
            'ac_r' => $this->ac_r,
            'ac_w' => $this->ac_w,
        ]);

        return $dataProvider;
    }
}
