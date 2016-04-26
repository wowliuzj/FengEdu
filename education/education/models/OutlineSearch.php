<?php

namespace app\education\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use yii\data\SqlDataProvider;
use app\education\models\Outline;

/**
 * OutlineSearch represents the model behind the search form about `app\education\models\Outline`.
 */
class OutlineSearch extends Outline
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'cid', 'tid'], 'integer'],
            [['title','time'], 'safe'],
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
        $query = Outline::find();

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
            'tid' => $this->tid,
        ]);

        $query->andFilterWhere(['like', 'title', $this->title]);

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

        if(isset($params['title'])){
           $title = $params['title'];
           if($title!=''){
               $sqlWhere = $sqlWhere . " and title like '%".$title."%'";
           }
        }

        if(isset($params['cid'])){
           $cid = $params['cid'];
           if($cid!='0'){
               $sqlWhere = $sqlWhere . " and cid =".$cid;
           }
        }

        if(isset($params['tid'])){
           $tid = $params['tid'];
           if($tid!=''){
               $sqlWhere = $sqlWhere . " and tid =".$tid;
           }
        }
        
        $sql="SELECT id,icl_number,title,time from outline,info_class where icl_id = cid ";

        $page = 1;
        if(isset($params['page'])){
            $page = $params['page'];
        }
        $pageSize = 10;
        if(isset($params['pageSize'])){
            $pageSize = $params['pageSize'];
        }

        $sqlCount = "select count(1) from ". Outline::tableName() ." as a where 1=1 ".$sqlWhere;
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
