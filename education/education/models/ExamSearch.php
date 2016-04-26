<?php

namespace app\education\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use yii\data\SqlDataProvider;
use app\education\models\Exam;

/**
 * ExamSearch represents the model behind the search form about `app\education\models\Exam`.
 */
class ExamSearch extends Exam
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'cid'], 'integer'],
            [['title', 'time','desc'], 'safe'],
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
        $sqlWhere = "";
        if(isset($params['cid'])){
           $cid = $params['cid'];
           if($cid!=''){
               $sqlWhere = $sqlWhere . " and a.cid =".$cid;
           }
        }

        $sql="SELECT a.*,b.icl_number,c.title from exam as a,info_class as b,outline as c where a.cid = icl_id and  c.id = a.title ";

        $page = 1;
        if(isset($params['page'])){
            $page = $params['page'];
        }
        $pageSize = 10;
        if(isset($params['pageSize'])){
            $pageSize = $params['pageSize'];
        }

        $sqlCount = "SELECT count(1) from exam as a,info_class as b,outline as c where a.cid = icl_id  and  c.id = a.title ".$sqlWhere;
        $count = Yii::$app->db->createCommand($sqlCount)->queryScalar();
        //echo $sql.$sqlWhere;
        $dataProvider = new SqlDataProvider([
            'sql' => $sql.$sqlWhere." order by a.time desc",
            'totalCount' =>$count,
            'pagination' => [
                'pageSize' => $pageSize,
                'page' => $page - 1,
            ]
        ]);
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
               $sqlWhere = $sqlWhere . " and a.sid =".$sid;
           }
        }
        if(isset($params['title'])){
           $title = $params['title'];
           if($title!=''){
               $sqlWhere = $sqlWhere . " and title like '%".$title."%'";
           }
        }

        if(isset($params['cid'])){
           $cid = $params['cid'];
           if($cid!='' && $cid!='0'){
               $sqlWhere = $sqlWhere . " and cid =".$cid;
           }
        }

        if(isset($params['tid'])){
           $tid = $params['tid'];
           if($tid!='' && $tid!='0'){
               $sqlWhere = $sqlWhere . " and cid in (SELECT id from class_teacher where tid=$tid)";
           }
        }

        if(isset($params['tname'])){
           $tname = $params['tname'];
           if($tname!=''){
               $sqlWhere = $sqlWhere . " and cid in (SELECT id from class_teacher where tid in (SELECT it_id from info_teacher where it_name like '%$tname%'))";
           }
        }


        if(isset($params['time'])){
           $time = $params['time'];
           if($time!=''){
               $sqlWhere = $sqlWhere . " and time ='".$time."'";
           }
        }

        if(isset($params['campus_id'])){
           $campus_id = $params['campus_id'];
           if($campus_id!='' and $campus_id!='0'){
               $sqlWhere = $sqlWhere . " and campus_id=$campus_id";
           }
        }
        
        $sql="SELECT a.id,c.is_name,b.title,a.score,b.time,b.`desc`,c.campus_id,icl_number from exam_score as a ,exam as b,info_student as c,info_class as d where a.sid = c.is_id and a.eid = b.id and b.cid = d.icl_id ";

        $page = 1;
        if(isset($params['page'])){
            $page = $params['page'];
        }
        $pageSize = 10;
        if(isset($params['pageSize'])){
            $pageSize = $params['pageSize'];
        }

        $sqlCount = "SELECT count(1) from exam_score as a ,exam as b,info_student as c where a.sid = c.is_id and a.eid = b.id ".$sqlWhere;
        $count = Yii::$app->db->createCommand($sqlCount)->queryScalar();
        //echo $sql.$sqlWhere;
        $dataProvider = new SqlDataProvider([
            'sql' => $sql.$sqlWhere." order by b.time desc",
            'totalCount' =>$count,
            'pagination' => [
                'pageSize' => $pageSize,
                'page' => $page - 1,
            ]
        ]);
        return $dataProvider;
    }
}
