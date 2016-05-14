<?php

namespace app\education\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use yii\data\SqlDataProvider;
use app\education\models\Course;

/**
 * CourseSearch represents the model behind the search form about `app\education\models\Course`.
 */
class CourseSearch extends Course
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'year', 'num'], 'integer'],
            [['name', 'cnt'], 'safe'],
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
        $query = Course::find();

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
            'year' => $this->year,
            'num' => $this->num,
            'outline_id' => $params['outline_id'],
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'cnt', $this->cnt]);
        //var_dump($params, $dataProvider);die();
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

        if(isset($params['year'])){
           $year = $params['year'];
           if($year!=''){
               $sqlWhere = $sqlWhere . " and year =".$year;
           }
        }

        if(isset($params['name'])){
           $name = $params['name'];
           if($name!=''){
               $sqlWhere = $sqlWhere . " and name like '%".$name."%'";
           }
        }

        if(isset($params['cnt'])){
           $cnt = $params['cnt'];
           if($cnt!=''){
               $sqlWhere = $sqlWhere . " and cnt like '%".$cnt."%'";
           }
        }

        if(isset($params['outline_id'])){
           $outline_id = $params['outline_id'];
           if($outline_id!=''){
               $sqlWhere = $sqlWhere . " and outline_id =".$outline_id;
           }
        }

         if(isset($params['tid'])){
           $tid = $params['tid'];
           if($tid!=''){
               $sqlWhere = $sqlWhere . " and outline_id in(select id from outline where tid=$tid)";
           }
        }
        
        $sql="SELECT a.*,b.`cid` from ". Course::tableName() . " as a ,outline as b where a.outline_id = b.id ";

        $page = 1;
        if(isset($params['page'])){
            $page = $params['page'];
        }
        $pageSize = 10;
        if(isset($params['pageSize'])){
            $pageSize = $params['pageSize'];
        }

        $sqlCount = "select count(1) from ". Course::tableName() ." as a where 1=1 ".$sqlWhere;
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

    public function searchByTongji($params)
    {
        $sqlWhere = "";
        $join = "";
        if(isset($params['tid'])){
           $tid = $params['tid'];
           if($tid!='' and $tid!='0'){
               $sqlWhere = $sqlWhere . " and tid=$tid";
           }
        }

        if(isset($params['tname'])){
           $tname = $params['tname'];
           if($tname!=''){
               $sqlWhere = $sqlWhere . " and it_name like '%$tname%'";
           }
        }

        if(isset($params['cid'])){
           $cid = $params['cid'];
           if($cid!='0'){
               $sqlWhere = $sqlWhere . " and cid = $cid ";
           }
        }
        
        if(isset($params['cname'])){
           $cname = $params['cname'];
           if($cname!='0'){
               $sqlWhere = $sqlWhere . " and icl_number like '%$cname$' ";
           }
        }

        $session = Yii::$app->session;
        if(isset($session['USER_SESSION']['campus_id']) && $session['USER_SESSION']['campus_id']){
            $campus_id = $session['USER_SESSION']['campus_id'];
            if($campus_id){
                $join .= " inner join outline o on o.id = t.outline_id";
                $join .= " inner join info_class ic on o.cid = ic.icl_id and ic.campus_id = $campus_id ";
            }
        }

        $sql="SELECT * from course_info t ".$join." where 1=1 ";

        $page = 1;
        if(isset($params['page'])){
            $page = $params['page'];
        }
        $pageSize = 10;
        if(isset($params['pageSize'])){
            $pageSize = $params['pageSize'];
        }

        $sqlCount = "select count(1) from course_info t ".$join." where 1=1 ".$sqlWhere;
        $count = Yii::$app->db->createCommand($sqlCount)->queryScalar();
        //echo $sql.$sqlWhere;
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
