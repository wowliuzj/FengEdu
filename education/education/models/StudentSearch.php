<?php

namespace app\education\models;

use Yii;
use yii\base\Model;
use yii\data\SqlDataProvider;
use app\education\models\Student;

/**
 * StudentSearch represents the model behind the search form about `app\education\models\Student`.
 */
class StudentSearch extends Student
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['is_id', 'is_name', 'is_hometown', 'is_sex', 'is_birthday', 'is_province', 'is_city', 'is_county', 'is_zone', 'is_address', 'is_id_card', 'is_politics', 'ico_id', 'id_id', 'icl_id', 'is_email', 'is_tel', 'is_room', 'is_room_number', 'is_study_date','parent_name','parent_phone'], 'safe'],
            [['is_grade', 'is_status','is_age','campus_id'], 'integer'],
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
     * @return SqlDataProvider
     */
    public function search($params)
    {
        $sqlWhere = "";
        if(isset($params['icl_id'])){
            $icl_id = $params['icl_id'];
            if($icl_id == '0'){
                $session = Yii::$app->session;
                $tid = $session['USER_SESSION']['fid'];
                $sqlWhere = $sqlWhere . " and (a.icl_id in (SELECT id from class_teacher where tid=$tid) or b.icl_tid=$tid)";
            }else{
               $sqlWhere = $sqlWhere . ' and a.icl_id='.$icl_id;
            }
        }
        if(isset($params['is_name'])){
            $is_name = $params['is_name'];
            if($is_name!=''){
                $sqlWhere = $sqlWhere . " and is_name like '%".$is_name."%'";
            }
        }
        $sql="SELECT a.is_id,is_name,icl_number,is_status from info_student as a,info_class as b where a.icl_id=b.icl_id ";

        $page = 1;
        if(isset($params['page'])){
            $page = $params['page'];
        }
        $pageSize = 10;
        if(isset($params['pageSize'])){
            $pageSize = $params['pageSize'];
        }

        $sqlCount = "select count(1) from info_student as a,info_class as b where  a.icl_id=b.icl_id ".$sqlWhere;
        $count = Yii::$app->db->createCommand($sqlCount)->queryScalar();
        //echo $sql.$sqlWhere;
        $dataProvider = new SqlDataProvider([
            'sql' => $sql.$sqlWhere." order by a.is_id desc",
            'totalCount' =>$count,
            'pagination' => [
                'pageSize' => $pageSize,
                'page' => $page - 1,
            ]
        ]);
        return $dataProvider;
    }

    public function searchByExam($params)
    {
        $icl_id = $params['icl_id'];
         $eid = $params['eid'];
        $sql="SELECT a.is_id,is_name,icl_number,score , e.title
              from info_student as a 
              LEFT  JOIN info_class as b on a.icl_id=b.icl_id 
              LEFT  JOIN exam_score as c on a.is_id = c.sid  and eid=$eid 
              left join exam e on e.cid = b.icl_id and e.id = $eid 
              where a.icl_id=$icl_id";

        $page = 1;
        if(isset($params['page'])){
            $page = $params['page'];
        }
        $pageSize = 10;
        if(isset($params['pageSize'])){
            $pageSize = $params['pageSize'];
        }
      

        $sqlCount = "select count(1) from info_student where icl_id=$icl_id";
        $count = Yii::$app->db->createCommand($sqlCount)->queryScalar();
        //echo $sql.$sqlWhere;
        $dataProvider = new SqlDataProvider([
            'sql' => $sql." order by a.is_id desc",
            'totalCount' =>$count,
            'pagination' => [
                'pageSize' => $pageSize,
                'page' => $page - 1,
            ]
        ]);
        return $dataProvider;
    }

}
