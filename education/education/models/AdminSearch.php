<?php

namespace app\education\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use yii\data\SqlDataProvider;
use app\education\models\Admin;

/**
 * AdminSearch represents the model behind the search form about `app\education\models\Admin`.
 */
class AdminSearch extends Admin
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['a_id', 'r_id', 'a_status','campus_id'], 'integer'],
            [['a_name', 'a_pwd', 'a_salt', 'a_ip'], 'safe'],
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
        $query = Admin::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'a_id' => $this->a_id,
            'r_id' => $this->r_id,
            'a_status' => $this->a_status,
        ]);

        $query->andFilterWhere(['like', 'a_name', $this->a_name])
            ->andFilterWhere(['like', 'a_pwd', $this->a_pwd])
            ->andFilterWhere(['like', 'a_salt', $this->a_salt])
            ->andFilterWhere(['like', 'a_ip', $this->a_ip]);

        return $dataProvider;
    }

    public function searchBySql($params)
    {
        $sqlWhere = "";
        $sqlCount = "";
        $sql="";
        $type = $params['type'];
        if($type == 1){
            $sql = "SELECT a_id,a_name,b.it_name as aname,b.it_tel as phone from admin as a,info_teacher as b where ";
            $sqlCount = " SELECT count(1) from admin as a,info_teacher as b where ";
            $sqlWhere = $sqlWhere . " a.fid = b.it_id and ftype in(3,4) ";
            if(isset($params['name'])){
                $name = $params['name'];
                if($name!=''){
                   $sqlWhere = $sqlWhere . " and b.it_name like '%$name%'";
                }
            }

            if(isset($params['phone'])){
                $phone = $params['phone'];
                if($phone!=''){
                   $sqlWhere = $sqlWhere . " and b.it_tel like '%$phone%'";
                }
            }
        }else if($type == 2){
            $sql = "SELECT a_id,a_name,b.is_name as aname,b.is_tel as phone from admin as a,info_student as b where ";
            $sqlWhere = $sqlWhere . "  a.fid = b.is_id and ftype = 6 ";
            $sqlCount = " SELECT count(1) from admin as a,info_student as b where ";      
            if(isset($params['name'])){
                $name = $params['name'];
                if($name!=''){
                   $sqlWhere = $sqlWhere . " and b.is_name like '%$name%'";
                }
            }

            if(isset($params['phone'])){
                $phone = $params['phone'];
                if($phone!=''){
                   $sqlWhere = $sqlWhere . " and b.is_tel like '%$phone%'";
                }
            }
        }else if($type == 3){
            $sql = "SELECT a_id,a_name,b.parent_name as aname,b.parent_phone as phone from admin as a,info_student as b where ";
            $sqlWhere = $sqlWhere . "  a.fid = b.is_id and ftype = 5 ";
            $sqlCount = " SELECT count(1) from admin as a,info_student as b where ";      
            if(isset($params['name'])){
                $name = $params['name'];
                if($name!=''){
                   $sqlWhere = $sqlWhere . " and b.parent_name like '%$name%'";
                }
            }

            if(isset($params['phone'])){
                $phone = $params['phone'];
                if($phone!=''){
                   $sqlWhere = $sqlWhere . " and b.parent_phone like '%$phone%'";
                }
            }
        }else{
            
        }

        $page = 1;
        if(isset($params['page'])){
            $page = $params['page'];
        }
        $pageSize = 10;
        if(isset($params['pageSize'])){
            $pageSize = $params['pageSize'];
        }

        $count = Yii::$app->db->createCommand($sqlCount.$sqlWhere)->queryScalar();
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

    public function getAdminByName($userName)
    {
       $user = Admin::find()->where(array('a_name'=>$userName))->one();
       return $user;
    }

    public function hasPhone($phone)
    {
        $list = Yii::$app->db->createCommand("select a_id from admin where a_name=:name",[':name'=>$phone])->queryAll();
        if(count($list) > 0){
            return true;
        }else{
            return false;
        }
    }

    public function adminInfo($fid,$ftype){
        //echo $fid,$ftype; 
        $sql = "";
        if($ftype == 1){
            return ['name'=>'管理员','cid'=>0,'campus_id'=>0];
        }else if($ftype == 2){
            return ['name'=>'信息管理员','cid'=>0,'campus_id'=>0];
        }else if($ftype == 7){
            return ['name'=>'总部管理员','cid'=>0,'campus_id'=>0];
        }else if($ftype == 8){
            return ['name'=>'校区管理员','cid'=>0,'campus_id'=>0];
        }else if($ftype == 3 or $ftype==4){
            $sql = "select it_name as name,0 as cid,campus_id from info_teacher where it_id=$fid";
        }else if($ftype == 5){
            $sql ="select parent_name as name,icl_id as cid,campus_id from info_student where is_id=$fid";
        }else if($ftype == 6){
            $sql ="select is_name as name,icl_id as cid,campus_id from info_student where is_id=$fid";
        }
        //echo $sql;
        $info = Yii::$app->db->createCommand($sql)->queryOne();
        return $info;
    }
}
