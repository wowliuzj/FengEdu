<?php

namespace app\education\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use yii\data\SqlDataProvider;
use app\education\models\StuWork;

/**
 * StuWorkSearch represents the model behind the search form about `app\education\models\StuWork`.
 */
class StuWorkSearch extends StuWork
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'cid', 'sid', 'hid', 'score'], 'integer'],
            [['img', 'sdesc'], 'safe'],
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
        $query = StuWork::find();

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
            'cid' => $this->cid,
            'sid' => $this->sid,
            'hid' => $this->hid,
            'score' => $this->score,
        ]);

        $query->andFilterWhere(['like', 'img', $this->img])
            ->andFilterWhere(['like', 'sdesc', $this->sdesc]);

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

        if(isset($params['cid'])){
           $cid = $params['cid'];
           if($cid!=''){
               $sqlWhere = $sqlWhere . " and cid =".$cid;
           }
        }

        if(isset($params['sid'])){
           $sid = $params['sid'];
           if($sid!=''){
               $sqlWhere = $sqlWhere . " and sid =".$sid;
           }
        }

        if(isset($params['hid'])){
           $hid = $params['hid'];
           if($hid!=''){
               $sqlWhere = $sqlWhere . " and hid =".$hid;
           }
        }

        if(isset($params['img'])){
           $img = $params['img'];
           if($img!=''){
               $sqlWhere = $sqlWhere . " and img like '%".$img."%'";
           }
        }

        if(isset($params['sdesc'])){
           $sdesc = $params['sdesc'];
           if($sdesc!=''){
               $sqlWhere = $sqlWhere . " and sdesc like '%".$sdesc."%'";
           }
        }

        if(isset($params['score'])){
           $score = $params['score'];
           if($score!=''){
               $sqlWhere = $sqlWhere . " and score =".$score;
           }
        }
        
        $sql="SELECT * from ". StuWork::tableName() . " where 1=1 ";

        $page = 1;
        if(isset($params['page'])){
            $page = $params['page'];
        }
        $pageSize = 10;
        if(isset($params['pageSize'])){
            $pageSize = $params['pageSize'];
        }

        $sqlCount = "select count(1) from ". StuWork::tableName() ." as a where 1=1 ".$sqlWhere;
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


    public function searchByQuery($params)
    {
        $sqlWhere = "";

        if(isset($params['tid'])){
           $tid = $params['tid'];
           if($tid!=''){
               $sqlWhere = $sqlWhere . " and tid=$tid";
           }
        }

        if(isset($params['tname'])){
           $tname = $params['tname'];
           if($tname!=''){
               $sqlWhere = $sqlWhere . " and it_name like '%$tname%'";
           }
        }
        if(isset($params['campus_id'])){
           $campus_id = $params['campus_id'];
           if($campus_id!='' and $campus_id!='0'){
               $sqlWhere = $sqlWhere . " and campus_id=$campus_id";
           }
        }
        if(isset($params['cid'])){
           $cid = $params['cid'];
           if($cid!='0'){
               $sqlWhere = $sqlWhere . " and cid =".$cid;
           }
        }

        $sql="SELECT * from stuwork_info where 1=1 ";

        $page = 1;
        if(isset($params['page'])){
            $page = $params['page'];
        }
        $pageSize = 10;
        if(isset($params['pageSize'])){
            $pageSize = $params['pageSize'];
        }

        $sqlCount = "select count(1) from stuwork_info as a where 1=1 ".$sqlWhere;
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

    public function searchByWall($data){
        $sql='';
        $sqlCount='';
        if(isset($data['start'])){
            $start=$data['start'];
            $end=$data['end'];
            $sql="SELECT * FROM work_wall_view wv left join stu_work sw on sw.id=wv.id where stime> '$start' and stime< '$end'";
            $sqlCount="SELECT count(1) FROM work_wall_view wv left join stu_work sw on sw.id=wv.id where stime> '$start' and stime< '$end'";
        }
        else{
            $sql="SELECT * from work_wall_view order by simg";
            $sqlCount = "select count(1) from work_wall_view";
        }

        $page = 1;
        if(isset($params['page'])){
            $page = $params['page'];
        }
        $pageSize = 24;
        if(isset($params['pageSize'])){
            $pageSize = $params['pageSize'];
        }
        $count = Yii::$app->db->createCommand($sqlCount)->queryScalar();
        $dataProvider = new SqlDataProvider([
            'sql' => $sql,
            'totalCount' =>$count,
            'pagination' => [
                'pageSize' => $pageSize,              
            ]
        ]);
        return $dataProvider;
    }
}
