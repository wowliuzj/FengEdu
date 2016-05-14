<?php

namespace app\education\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use yii\data\SqlDataProvider;
use app\education\models\Teacher;

/**
 * TeacherSearch represents the model behind the search form about `app\education\models\Teacher`.
 */
class TeacherSearch extends Teacher
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['it_id','it_type','campus_id'], 'integer'],
            [['it_name', 'it_start_date', 'it_sex', 'it_birthday', 'it_marry', 'it_tel', 'it_address', 'it_email', 'it_note', 'it_id_card', 'it_edu'], 'safe'],
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
        $query = Teacher::find();

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
            'it_id' => $this->it_id,
            'it_start_date' => $this->it_start_date,
            'it_birthday' => $this->it_birthday,
        ]);

        $session = Yii::$app->session;
        if($session['USER_SESSION']['campus_id'])
        $query->andFilterWhere([
                                   'campus_id' => $session['USER_SESSION']['campus_id'],
                               ]);

        $query->andFilterWhere(['like', 'it_name', $this->it_name])
            ->andFilterWhere(['like', 'it_sex', $this->it_sex])
            ->andFilterWhere(['like', 'it_marry', $this->it_marry])
            ->andFilterWhere(['like', 'it_tel', $this->it_tel])
            ->andFilterWhere(['like', 'it_address', $this->it_address])
            ->andFilterWhere(['like', 'it_email', $this->it_email])
            ->andFilterWhere(['like', 'it_note', $this->it_note])
            ->andFilterWhere(['like', 'it_id_card', $this->it_id_card])
            ->andFilterWhere(['like', 'it_edu', $this->it_edu]);

        return $dataProvider;
    }

    public function searchBySql($params)
    {
        $sqlWhere = "";
        $join = "";
       if(isset($params['it_id'])){
           $it_id = $params['it_id'];
           if($it_id!=''){
               $sqlWhere = $sqlWhere . " and it_id =".$it_id;
           }
        }

        if(isset($params['it_name'])){
           $it_name = $params['it_name'];
           if($it_name!=''){
               $sqlWhere = $sqlWhere . " and it_name like '%".$it_name."%'";
           }
        }

        if(isset($params['it_start_date'])){
           $it_start_date = $params['it_start_date'];
           if($it_start_date!=''){
               $sqlWhere = $sqlWhere . " and it_start_date ='".$it_start_date."'";
           }
        }

        if(isset($params['it_sex'])){
           $it_sex = $params['it_sex'];
           if($it_sex!=''){
               $sqlWhere = $sqlWhere . " and it_sex like '%".$it_sex."%'";
           }
        }

        if(isset($params['it_birthday'])){
           $it_birthday = $params['it_birthday'];
           if($it_birthday!=''){
               $sqlWhere = $sqlWhere . " and it_birthday ='".$it_birthday."'";
           }
        }

        if(isset($params['it_marry'])){
           $it_marry = $params['it_marry'];
           if($it_marry!=''){
               $sqlWhere = $sqlWhere . " and it_marry like '%".$it_marry."%'";
           }
        }

        if(isset($params['it_tel'])){
           $it_tel = $params['it_tel'];
           if($it_tel!=''){
               $sqlWhere = $sqlWhere . " and it_tel like '%".$it_tel."%'";
           }
        }

        if(isset($params['it_address'])){
           $it_address = $params['it_address'];
           if($it_address!=''){
               $sqlWhere = $sqlWhere . " and it_address like '%".$it_address."%'";
           }
        }

        if(isset($params['it_email'])){
           $it_email = $params['it_email'];
           if($it_email!=''){
               $sqlWhere = $sqlWhere . " and it_email like '%".$it_email."%'";
           }
        }

        if(isset($params['it_note'])){
           $it_note = $params['it_note'];
           if($it_note!=''){
               $sqlWhere = $sqlWhere . " and it_note like '%".$it_note."%'";
           }
        }

        if(isset($params['it_id_card'])){
           $it_id_card = $params['it_id_card'];
           if($it_id_card!=''){
               $sqlWhere = $sqlWhere . " and it_id_card like '%".$it_id_card."%'";
           }
        }

        if(isset($params['it_edu'])){
           $it_edu = $params['it_edu'];
           if($it_edu!=''){
               $sqlWhere = $sqlWhere . " and it_edu like '%".$it_edu."%'";
           }
        }

        $session = Yii::$app->session;
        if(isset($session['USER_SESSION']['campus_id']) && $session['USER_SESSION']['campus_id']){
            $campus_id = $session['USER_SESSION']['campus_id'];
            if($campus_id!=''){
                $sqlWhere = $sqlWhere . " and t.campus_id = ".$campus_id." ";
            }
        }

        if(isset($params['cid']) && $params['cid'])
        {
            $join .= " inner join info_class c on c.icl_tid = t.it_id and c.icl_id = {$params['cid']} ";
            //$join .= " left join class_teacher ct on ct.tid = t.it_id and ct.cid = {$params['cid']} ";
        }
        
        $sql="SELECT * from ". Teacher::tableName() . " t ". $join . " where 1=1 ".$sqlWhere;

        $page = 1;
        if(isset($params['page'])){
            $page = $params['page'];
        }
        $pageSize = 10;
        if(isset($params['pageSize'])){
            $pageSize = $params['pageSize'];
        }

        $sqlCount = "select count(1) from ". Teacher::tableName() ." as t ". $join . " where 1=1 ".$sqlWhere;
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
