<?php

namespace app\education\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use yii\data\SqlDataProvider;
use app\education\models\Option;

/**
 * OptionSearch represents the model behind the search form about `app\education\models\Option`.
 */
class OptionSearch extends Option
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'school_id', 'user_id'], 'integer'],
            [['title', 'option1', 'option2', 'option3', 'option4', 'option5'], 'safe'],
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
        $query = Option::find();

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
            'school_id' => $this->school_id,
            'user_id' => $this->user_id,
        ]);

        $query->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'option1', $this->option1])
            ->andFilterWhere(['like', 'option2', $this->option2])
            ->andFilterWhere(['like', 'option3', $this->option3])
            ->andFilterWhere(['like', 'option4', $this->option4])
            ->andFilterWhere(['like', 'option5', $this->option5]);

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

        if(isset($params['option1'])){
           $option1 = $params['option1'];
           if($option1!=''){
               $sqlWhere = $sqlWhere . " and option1 like '%".$option1."%'";
           }
        }

        if(isset($params['option2'])){
           $option2 = $params['option2'];
           if($option2!=''){
               $sqlWhere = $sqlWhere . " and option2 like '%".$option2."%'";
           }
        }

        if(isset($params['option3'])){
           $option3 = $params['option3'];
           if($option3!=''){
               $sqlWhere = $sqlWhere . " and option3 like '%".$option3."%'";
           }
        }

        if(isset($params['option4'])){
           $option4 = $params['option4'];
           if($option4!=''){
               $sqlWhere = $sqlWhere . " and option4 like '%".$option4."%'";
           }
        }

        if(isset($params['option5'])){
           $option5 = $params['option5'];
           if($option5!=''){
               $sqlWhere = $sqlWhere . " and option5 like '%".$option5."%'";
           }
        }

        if(isset($params['school_id'])){
           $school_id = $params['school_id'];
           if($school_id!=''){
               $sqlWhere = $sqlWhere . " and school_id =".$school_id;
           }
        }

        if(isset($params['user_id'])){
           $user_id = $params['user_id'];
           if($user_id!=''){
               $sqlWhere = $sqlWhere . " and user_id =".$user_id;
           }
        }
        
        $sql="SELECT * from ". Option::tableName() . " where 1=1 ";

        $page = 1;
        if(isset($params['page'])){
            $page = $params['page'];
        }
        $pageSize = 10;
        if(isset($params['pageSize'])){
            $pageSize = $params['pageSize'];
        }

        $sqlCount = "select count(1) from ". Option::tableName() ." as a where 1=1 ".$sqlWhere;
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
