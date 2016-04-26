<?php

namespace app\education\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use yii\data\SqlDataProvider;
use app\education\models\Activity;

/**
 * ActivitySearch represents the model behind the search form about `app\education\models\Activity`.
 */
class ActivitySearch extends Activity
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'type', 'cid', 'is_shared'], 'integer'],
            [['name', 'time', 'desc', 'img', 'shared_cnt'], 'safe'],
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
        $query = Activity::find();

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
            'type' => $this->type,
            'time' => $this->time,
            'cid' => $this->cid,
            'is_shared' => $this->is_shared,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'desc', $this->desc])
            ->andFilterWhere(['like', 'img', $this->img])
            ->andFilterWhere(['like', 'shared_cnt', $this->shared_cnt]);

        return $dataProvider;
    }

    public function searchBySql($params)
    {
        $sqlWhere = "";
        if(isset($params['type'])){
           $type = $params['type'];
           if($type!=''){
               $sqlWhere = $sqlWhere . " and type =".$type;
           }
        }

        if(isset($params['name'])){
           $name = $params['name'];
           if($name!=''){
               $sqlWhere = $sqlWhere . " and name like '%".$name."%'";
           }
        }

        if(isset($params['time'])){
           $time = $params['time'];
           if($time!=''){
               $sqlWhere = $sqlWhere . " and time ='".$time."'";
           }
        }

        if(isset($params['cid'])){
           $cid = $params['cid'];
           if($cid!=''){
               $sqlWhere = $sqlWhere . " and cid =".$cid;
           }
        }

        if(isset($params['ftype'])){
            $ftype = $params['ftype'];
            $fid = $params['fid'];
            if($ftype == 3 or $ftype == 4){
               $sqlWhere = $sqlWhere . " and cid in (select cid from class_teacher where tid=$fid)";
            }else{
                $sqlWhere = $sqlWhere . " and cid in (select icl_id from info_student where is_id=$fid)";
            }
        }

        if(isset($params['campus_id'])){
           $campus_id = $params['campus_id'];
           if($campus_id!='' and $campus_id!='0'){
               $sqlWhere = $sqlWhere . " and campus_id=$campus_id";
           }
        }
        
        $sql="SELECT a.*,campus_id,icl_number from ". Activity::tableName() . " as a,info_class as b where a.cid = b.icl_id ";

        $page = 1;
        if(isset($params['page'])){
            $page = $params['page'];
        }
        $pageSize = 10;
        if(isset($params['pageSize'])){
            $pageSize = $params['pageSize'];
        }

        $sqlCount = "select count(1) from ". Activity::tableName() ." as a,info_class as b where a.cid = b.icl_id ".$sqlWhere;
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
