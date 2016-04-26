<?php

namespace app\education\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use yii\data\SqlDataProvider;
use app\education\models\Reply;

/**
 * ReplySearch represents the model behind the search form about `app\education\models\Reply`.
 */
class ReplySearch extends Reply
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'tid', 'floor', 'sid'], 'integer'],
            [['name', 'content', 'time'], 'safe'],
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
        $query = Reply::find();

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
            'tid' => $this->tid,
            'floor' => $this->floor,
            'sid' => $this->sid,
            'time' => $this->time,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'content', $this->content]);

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

        if(isset($params['tid'])){
           $tid = $params['tid'];
           if($tid!=''){
               $sqlWhere = $sqlWhere . " and tid =".$tid;
           }
        }

        if(isset($params['floor'])){
           $floor = $params['floor'];
           if($floor!=''){
               $sqlWhere = $sqlWhere . " and floor =".$floor;
           }
        }

        if(isset($params['sid'])){
           $sid = $params['sid'];
           if($sid!=''){
               $sqlWhere = $sqlWhere . " and sid =".$sid;
           }
        }

        if(isset($params['name'])){
           $name = $params['name'];
           if($name!=''){
               $sqlWhere = $sqlWhere . " and name like '%".$name."%'";
           }
        }

        if(isset($params['content'])){
           $content = $params['content'];
           if($content!=''){
               $sqlWhere = $sqlWhere . " and content like '%".$content."%'";
           }
        }

        if(isset($params['time'])){
           $time = $params['time'];
           if($time!=''){
               $sqlWhere = $sqlWhere . " and time ='".$time."'";
           }
        }
        
        $sql="SELECT * from ". Reply::tableName() . " where 1=1 ";

        $page = 1;
        if(isset($params['page'])){
            $page = $params['page'];
        }
        $pageSize = 10;
        if(isset($params['pageSize'])){
            $pageSize = $params['pageSize'];
        }

        $sqlCount = "select count(1) from ". Reply::tableName() ." as a where 1=1 ".$sqlWhere;
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
