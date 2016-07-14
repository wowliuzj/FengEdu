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
class InfoSchoolSearch extends InfoSchool
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['is_id'], 'integer'],
            [['is_name', 'is_address', 'is_postcode', 'is_tel'], 'safe'],
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
        $query = InfoSchool::find();

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
            'is_id' => $this->is_id,
        ]);

        $query->andFilterWhere(['like', 'is_name', $this->is_name])
            ->andFilterWhere(['like', 'is_address', $this->is_address])
            ->andFilterWhere(['like', 'is_postcode', $this->is_postcode])
            ->andFilterWhere(['like', 'is_tel', $this->is_tel]);

        return $dataProvider;
    }

    public function searchBySql($params)
    {
        $sqlWhere = "";
        if(isset($params['id'])){
            $id = $params['id'];
            $sqlWhere = $sqlWhere . ' and id='.$id;
        }
        
        $sql="SELECT * from ". InfoSchool::tableName() . " where 1=1 ";

        $page = 1;
        if(isset($params['page'])){
            $page = $params['page'];
        }
        $pageSize = 10;
        if(isset($params['pageSize'])){
            $pageSize = $params['pageSize'];
        }

        $sqlCount = "select count(1) from ". InfoSchool::tableName() ." as a where 1=1 ".$sqlWhere;
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
