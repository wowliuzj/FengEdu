<?php

namespace app\education\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use yii\data\SqlDataProvider;
use app\education\models\InfoCampus;

/**
 * InfoCampusSearch represents the model behind the search form about `app\education\models\InfoCampus`.
 */
class InfoCampusSearch extends InfoCampus
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['ic_id'], 'integer'],
            [['ic_name', 'ic_address', 'ic_postcode', 'ic_tel'], 'safe'],
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
        $query = InfoCampus::find();

        $page = 1;
        if(isset($params['page'])){
            $page = $params['page'];
        }
        $pageSize = 10;
        if(isset($params['pageSize'])){
            $pageSize = $params['pageSize'];
        }

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => $pageSize,
                'page' => $page - 1,
            ]
        ]);

        $this->load($params,"");

        $query->andFilterWhere([
            'ic_id' => $this->ic_id,
        ]);

        $query->andFilterWhere(['like', 'ic_name', $this->ic_name])
            ->andFilterWhere(['like', 'ic_address', $this->ic_address])
            ->andFilterWhere(['like', 'ic_postcode', $this->ic_postcode])
            ->andFilterWhere(['like', 'ic_tel', $this->ic_tel]);

        return $dataProvider;
    }

    public function searchBySql($params)
    {
        $sqlWhere = "";
        if(isset($params['id'])){
            $id = $params['id'];
            $sqlWhere = $sqlWhere . ' and id='.$id;
        }
        
        $sql="SELECT * from ". InfoCampus::tableName() . " where 1=1 ";

        $page = 1;
        if(isset($params['page'])){
            $page = $params['page'];
        }
        $pageSize = 10;
        if(isset($params['pageSize'])){
            $pageSize = $params['pageSize'];
        }

        $sqlCount = "select count(1) from ". InfoCampus::tableName() ." as a where 1=1 ".$sqlWhere;
        $count = Yii::$app->db->createCommand($sqlCount)->queryScalar();
        $dataProvider = new SqlDataProvider([
            'sql' => $sql.$sqlWhere,
            'totalCount' =>$count,
            'pagination' => [
                'pageSize' => $pageSize,
                'page' => $page - 1,
            ]
        ]);
        return $dataProvider;
    }
}
