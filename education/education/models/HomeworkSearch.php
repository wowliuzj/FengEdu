<?php

namespace app\education\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use yii\data\SqlDataProvider;
use app\education\models\Homework;

/**
 * HomeworkSearch represents the model behind the search form about `app\education\models\Homework`.
 */
class HomeworkSearch extends Homework
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'cid','course_id','num'], 'integer'],
            [['time', 'img', 'desc', 'finish_time','title'], 'safe'],
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
        $query = Homework::find();

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
            'time' => $this->time,
            'finish_time' => $this->finish_time,
        ]);

        $query->andFilterWhere(['like', 'img', $this->img])
            ->andFilterWhere(['like', 'desc', $this->desc]);

        return $dataProvider;
    }

    public function searchBySql($params,$campus)
    {
		$sqlLeft="left join stu_work b on a.id = b.hid";
        $sqlWhere = "";
       if(isset($params['id'])){
           $id = $params['id'];
           if($id!=''){
               $sqlWhere = $sqlWhere . " and id =".$id;
           }
        }

        if(isset($params['cid'])){
           $cid = $params['cid'];
           if($cid!='0'){
               $sqlWhere = $sqlWhere . " and a.cid =".$cid;
           }
        }

        if(isset($params['time'])){
           $time = $params['time'];
           if($time!=''){
               $sqlWhere = $sqlWhere . " and time ='".$time."'";
           }
        }

        if(isset($params['title'])){
           $title = $params['title'];
           if($title!=''){
               $sqlWhere = $sqlWhere . " and title like '%".$title."%'";
           }
        }
        if(isset($params['status'])){
           $status = $params['status'];
           if($status == 1){
               $sqlWhere = $sqlWhere . " and score >= 0";
           }else{
                $sqlWhere = $sqlWhere . " and (score = -1 or score is null)";
           }
        }

        if(isset($params['finish_time'])){
           $finish_time = $params['finish_time'];
           if($finish_time!=''){
               $sqlWhere = $sqlWhere . " and finish_time ='".$finish_time."'";
           }
        }

        //是否已经做了作业
        if(isset($params['is_finish'])){
           $is_finish = $params['is_finish'];
           if($is_finish == 1){
              // $sqlWhere = $sqlWhere . " and (simg is not null or sdesc is not null)";
           }
        }

        if(isset($params['ftype'])){
           $ftype = $params['ftype'];
           $sid = $params['fid'];
            if($ftype == 6){
				$sqlLeft="left join stu_work b on a.id = b.hid and  b.sid=$sid";
                $sqlWhere = $sqlWhere . " and a.cid in (SELECT icl_id from info_student where is_id=$sid)";
            }else if($ftype == 5){
                $sqlWhere = $sqlWhere . " and  a.cid in (SELECT icl_id from info_student where is_id=$sid) and b.sid = $sid";
            }else if($ftype == 4){
                $sqlWhere = $sqlWhere . " and a.tid=$sid";
            }else{
               $sqlWhere = $sqlWhere . " and a.cid in (SELECT cid from class_teacher where tid=$sid)";
            }
        }
        $sqlWhere = $sqlWhere . " and a.cid in (SELECT icl_id FROM info_class where campus_id=".$campus.")";
        
        $sql="select a.img,a.`desc`,a.time,a.title,it_name,score,a.id as hid,b.id as shid,b.sid,b.stime as stime,b.simg as simg,b.sdesc as sdesc,b.ttime as ttime,b.tdesc as tdesc,
(select count(1) from eval_work where (eval_work.shid = b.id)) as ecount 
from homework as a ".$sqlLeft." left join info_teacher as c on a.tid = c.it_id where 1=1";

        //echo $sql.$sqlWhere;
        $page = 1;
        if(isset($params['page'])){
            $page = $params['page'];
        }
        $pageSize = 10;
        if(isset($params['pageSize'])){
            $pageSize = $params['pageSize'];
        }
        $sqlCount = "SELECT count(1) from homework as a ".$sqlLeft." left join info_teacher as c on a.tid = c.it_id where 1=1 ".$sqlWhere;
        $count = Yii::$app->db->createCommand($sqlCount)->queryScalar();
        $dataProvider = new SqlDataProvider([
            'sql' => $sql.$sqlWhere." order by a.time desc",
            'totalCount' =>$count,
            'pagination' => [
                'pageSize' => $pageSize,
                'page' => $page - 1,
            ]
        ]);;
        return $dataProvider;
    }

    public function searchByTeacher($params)
    {
        $sqlWhere = "";
        if(isset($params['cid'])){
           $cid = $params['cid'];
           if($cid!='0'){
               $sqlWhere = $sqlWhere . " and a.cid =".$cid;
           }
        }

        if(isset($params['title'])){
           $title = $params['title'];
           if($title!=''){
               $sqlWhere = $sqlWhere . " and title like '%".$title."%'";
           }
        }

        //$sqlWhere = $sqlWhere . " and (simg is not null or sdesc is not null) and score=-1";

        if(isset($params['finish_time'])){
           $finish_time = $params['finish_time'];
           if($finish_time!=''){
               $sqlWhere = $sqlWhere . " and finish_time ='".$finish_time."'";
           }
        }

        if(isset($params['ftype'])){
           $ftype = $params['ftype'];
           $sid = $params['fid'];
            if($ftype == 6){
                $sqlWhere = $sqlWhere . " and a.cid in (SELECT icl_id from info_student where is_id=$sid)";
            }else if($ftype == 5){
                $sqlWhere = $sqlWhere . " and  a.cid in (SELECT icl_id from info_student where is_id=$sid) and b.sid = $sid";
            }else if($ftype == 4){
                $sqlWhere = $sqlWhere . " and a.tid=$sid";
            }
        }
        
        $sql="select a.img,a.`desc`,a.time,a.title,icl_number,finish_time,is_name,score,a.id as hid,b.id as shid,b.sid,b.stime as stime,b.simg as simg,b.sdesc as sdesc,b.ttime as ttime,b.tdesc as tdesc, 
              wu.path, wu.file as upload_img, wu.img_file, wu.thumb_img
              from homework as a 
              inner join stu_work b on a.id = b.hid and b.stime is not null 
              left join info_student as c on b.sid = c.is_id 
              left join info_class as d on a.cid = d.icl_id 
              left join stu_work_upload wu on b.id = wu.stu_work_id
              where 1=1 ";

        //echo $sql.$sqlWhere;
        $page = 1;
        if(isset($params['page'])){
            $page = $params['page'];
        }
        $pageSize = 10;
        if(isset($params['pageSize'])){
            $pageSize = $params['pageSize'];
        }

        $sqlCount = "SELECT count(1) from homework as a left join view_homework as b on a.id = b.bhid  where 1=1 ".$sqlWhere;
        $count = Yii::$app->db->createCommand($sqlCount)->queryScalar();
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

    public function searchByTongji($params,$campus)
    {

        $sqlWhere = "";
        if(isset($params['cid'])){
            $cid = $params['cid'];
            if($cid!='0'){
              $sqlWhere = $sqlWhere . ' and cid='.$cid;  
            }
            else{
                $sqlWhere = $sqlWhere . ' and cid in (SELECT icl_id FROM info_class where campus_id='.$campus.' )';
            }
        }
        else{
            $sqlWhere = $sqlWhere . ' and cid in (SELECT icl_id FROM info_class where campus_id='.$campus.' )';
        }

        if(isset($params['start_time'])){
            $start_time = $params['start_time'];
            if($start_time!='' and $start_time!='开始时间'){
              $sqlWhere = $sqlWhere ." and date_format(time, '%Y-%m-%d') >='$start_time' ";
            }
            
        }

        if(isset($params['end_time'])){
            $end_time = $params['end_time'];
            if($end_time!='' and $end_time!='结束时间'){
              $sqlWhere = $sqlWhere . "and date_format(time, '%Y-%m-%d') <= '$end_time' ";
            }
        }
        
        if(isset($params['tid'])){
            $tid = $params['tid'];
            $sqlWhere = $sqlWhere . "and tid = '$tid' ";
        }

        $sql="SELECT id,tid,cid,title,icl_number from homework,info_class where cid = icl_id ";

        $page = 1;
        if(isset($params['page'])){
            $page = $params['page'];
        }
        $pageSize = 10;
        if(isset($params['pageSize'])){
            $pageSize = $params['pageSize'];
        }

        $sqlCount = "select count(1) from homework as a where 1=1 ".$sqlWhere;
        $count = Yii::$app->db->createCommand($sqlCount)->queryScalar();
        $dataProvider = new SqlDataProvider([
            'sql' => $sql.$sqlWhere." order by id",
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
        if(isset($params['cid'])){
            $cid = $params['cid'];
            if($cid!='0'){
              $sqlWhere = $sqlWhere . ' and cid='.$cid;  
            }
        }

        if(isset($params['tname'])){
            $tname = $params['tname'];
            if($tname!=''){
              $sqlWhere = $sqlWhere ." and it_name like '%$tname%' ";
            }
            
        }
        if(isset($params['campus_id'])){
           $campus_id = $params['campus_id'];
           if($campus_id!='' and $campus_id!='0'){
               $sqlWhere = $sqlWhere . " and campus_id=$campus_id";
           }
        }
        if(isset($params['tid'])){
            $tid = $params['tid'];
            $sqlWhere = $sqlWhere . " and tid = '$tid' ";
        }

        $sql="SELECT * from homework_info where 1=1 ";

        $page = 1;
        if(isset($params['page'])){
            $page = $params['page'];
        }
        $pageSize = 10;
        if(isset($params['pageSize'])){
            $pageSize = $params['pageSize'];
        }

        $sqlCount = "select count(1) from homework_info as a where 1=1 ".$sqlWhere;
        $count = Yii::$app->db->createCommand($sqlCount)->queryScalar();
        $dataProvider = new SqlDataProvider([
            'sql' => $sql.$sqlWhere." order by id",
            'totalCount' =>$count,
            'pagination' => [
                'pageSize' => $pageSize,
                'page' => $page - 1,
            ]
        ]);
        return $dataProvider;
    }
}
