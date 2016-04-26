<?php

namespace app\education\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use yii\data\SqlDataProvider;
use app\education\models\EvalWork;

/**
 * EvalWorkSearch represents the model behind the search form about `app\education\models\EvalWork`.
 */
class EvalWorkSearch extends EvalWork
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'hid', 'shid','sid'], 'integer'],
            [['desc','time','sname', 'star'], 'safe'],
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
        $query = EvalWork::find();

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
            'id' => $this->id,
            'shid' => $this->shid,
            'star' => $this->star,
        ]);

        $query->andFilterWhere(['like', 'desc', $this->desc]);

        return $dataProvider;
    }

    public function searchBySql($params)
    {        
        $id = $params['id'];
        $sql="SELECT a.*,b.`desc` as hdesc from eval_work as a,homework as b where a.hid = b.id and shid = $id order by time";

        $page = 1;
        if(isset($params['page'])){
            $page = $params['page'];
        }
        $pageSize = 10;
        if(isset($params['pageSize'])){
            $pageSize = $params['pageSize'];
        }

        $sqlCount = "select count(1) from ". EvalWork::tableName() ." as a where shid = $id ";
        $count = Yii::$app->db->createCommand($sqlCount)->queryScalar();
        $dataProvider = new SqlDataProvider([
            'sql' => $sql,
            'totalCount' =>$count,
            'pagination' => [
                'pageSize' => $pageSize,
                'page' => $page - 1,
            ]
        ]);
        return $dataProvider;
    }
}
