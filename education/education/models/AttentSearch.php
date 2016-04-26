<?php

namespace app\education\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use yii\data\SqlDataProvider;
use app\education\models\Attent;

/**
 * AttentSearch represents the model behind the search form about `app\education\models\Attent`.
 */
class AttentSearch extends Attent
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'cid', 'sid', 'status'], 'integer'],
            [['time'], 'safe'],
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
        $sqlWhere = " ";
        $time = date("Y-m-d");
        if(isset($params['time'])){
            if($params['time'] != ''){
               $time = $params['time'];
            }
        }
        $sqlWhere = $sqlWhere ."and time ='$time' ";
        if(isset($params['cid'])){
            $icl_id = $params['cid'];
            if($icl_id == '0'){
                $session = Yii::$app->session;
                $tid = $session['USER_SESSION']['fid'];
                $sqlWhere = $sqlWhere . " and cid in (SELECT id from class_teacher where tid=$tid)";
            }else{
               $sqlWhere = $sqlWhere . ' and cid='.$icl_id;
            }
        }

        $sql = 'SELECT id,is_name,time,c.`status`,icl_number from attent as c,info_student,info_class as a where is_id = sid and cid = a.`icl_id`';
        $page = 1;
        if(isset($params['page'])){
            $page = $params['page'];
        }
        $pageSize = 10;
        if(isset($params['pageSize'])){
            $pageSize = $params['pageSize'];
        }
        $sqlCount = "select count(1) from attent where 1=1 ".$sqlWhere;
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
    
    public function tongji($params)
    {
        $sqlWhere = " ";
        if(isset($params['start_time'])){
            $start_time = $params['start_time'];
            $sqlWhere = $sqlWhere ."and time >='$start_time' ";
        }
        if(isset($params['end_time'])){
            $end_time = $params['end_time'];
            $sqlWhere = $sqlWhere . "and time <= '$end_time' ";
        }
        if(isset($params['cid'])){
            $icl_id = $params['cid'];
            if($icl_id == '0'){
                $session = Yii::$app->session;
                $ftype = $session['USER_SESSION']['ftype'];
                if($ftype == 3 || $ftype == 4){
                    $tid = $session['USER_SESSION']['fid'];
                    $sqlWhere = $sqlWhere . " and cid in (SELECT id from class_teacher where tid=$tid)";    
                }else if($ftype == 5 || $ftype == 6){
                     $cid = $session['USER_SESSION']['cid'];
                     $sqlWhere = $sqlWhere . ' and cid='.$cid;
                }
            }else{
               $sqlWhere = $sqlWhere . ' and cid='.$icl_id;
            }
        }

        if(isset($params['campus_id'])){
           $campus_id = $params['campus_id'];
           if($campus_id!='' and $campus_id!='0'){
               $sqlWhere = $sqlWhere . " and campus_id=$campus_id";
           }
        }
        
        if(isset($params['sid'])){
            $sid = $params['sid'];
            if($sid != ''){
                $sqlWhere = $sqlWhere . "and sid = $sid ";
            }
        }
         if(isset($params['is_name'])){
            $is_name = $params['is_name'];
            if($is_name != ''){
                $sqlWhere = $sqlWhere . "and is_name like '%$is_name%' ";
            }
        }
        $sql = 'select is_name,sum(case when `status`=1 then 1 else 0 end) as s1,sum(case when `status`=0 then 1 else 0 end) as s0,sum(case when `status`=2 then 1 else 0 end) as s2,sum(case when `status`=3 then 1 else 0 end) as s3,sum(case when `status`=4 then 1 else 0 end) as s4,sum(case when `status`=5 then 1 else 0 end) as s5 from attent,info_student where  is_id = sid ';
        //echo $sql.$sqlWhere;
        $page = 1;
        if(isset($params['page'])){
            $page = $params['page'];
        }
        $pageSize = 10;
        if(isset($params['pageSize'])){
            $pageSize = $params['pageSize'];
        }
        $sqlCount = "select count(1) from (select count(1) from attent,info_student where  is_id = sid ".$sqlWhere." group by sid) as a";
        $count = Yii::$app->db->createCommand($sqlCount)->queryScalar();
        $dataProvider = new SqlDataProvider([
            'sql' => $sql.$sqlWhere." group by sid",
            'pagination' => [
                'pageSize' => $pageSize,
                'page' => $page - 1,
            ],
            'totalCount' =>$count,
        ]);
    
        return $dataProvider;
    }
}
