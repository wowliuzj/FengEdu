<?php

namespace app\education\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use yii\data\SqlDataProvider;
use app\education\models\Topic;

/**
 * TopicSearch represents the model behind the search form about `app\education\models\Topic`.
 */
class TopicSearch extends Topic
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'sid'], 'integer'],
            [['title', 'desc', 'time','name'], 'safe'],
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
        $query = Topic::find();

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
            ],
            'sort'=>['defaultOrder' =>['time'=>SORT_DESC]]
        ]);

        $this->load($params,"");

        $query->andFilterWhere([
            'id' => $this->id,
            'sid' => $this->sid,
            'time' => $this->time,
        ]);

        $query->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'desc', $this->desc]);

        return $dataProvider;
    }

    public function searchBySql($params)
    {
        $sqlWhere = "";
       if(isset($params['id'])){
           $id = $params['id'];
           if($id!=''){
               $sqlWhere = $sqlWhere . " and id =".$id;
           }
        }

        if(isset($params['sid'])){
           $sid = $params['sid'];
           if($sid!=''){
               $sqlWhere = $sqlWhere . " and sid =".$sid;
           }
        }

        if(isset($params['title'])){
           $title = $params['title'];
           if($title!=''){
               $sqlWhere = $sqlWhere . " and title like '%".$title."%'";
           }
        }

        if(isset($params['desc'])){
           $desc = $params['desc'];
           if($desc!=''){
               $sqlWhere = $sqlWhere . " and desc like '%".$desc."%'";
           }
        }

        if(isset($params['time'])){
           $time = $params['time'];
           if($time!=''){
               $sqlWhere = $sqlWhere . " and time ='".$time."'";
           }
        }
        
        $sql="SELECT * from ". Topic::tableName() . " where 1=1 ";

        $page = 1;
        if(isset($params['page'])){
            $page = $params['page'];
        }
        $pageSize = 10;
        if(isset($params['pageSize'])){
            $pageSize = $params['pageSize'];
        }

        $sqlCount = "select count(1) from ". Topic::tableName() ." as a where 1=1 ".$sqlWhere;
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
