<?php

namespace app\education\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use yii\data\SqlDataProvider;
use app\models\Questionnaire;

/**
 * QuestionnaireSearch represents the model behind the search form about `app\models\Questionnaire`.
 */
class QuestionnaireSearch extends Questionnaire
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'type', 'option', 'teacher_id', 'campus_id', 'school_id', 'category'], 'integer'],
            [['title', 'question'], 'safe'],
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
        $query = Questionnaire::find();

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
            'option' => $this->option,
            'teacher_id' => $this->teacher_id,
            'campus_id' => $this->campus_id,
            'school_id' => $this->school_id,
            'category' => $this->category,
        ]);

        $query->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'question', $this->question]);

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

        if(isset($params['type'])){
           $type = $params['type'];
           if($type!=''){
               $sqlWhere = $sqlWhere . " and type =".$type;
           }
        }

        if(isset($params['option'])){
           $option = $params['option'];
           if($option!=''){
               $sqlWhere = $sqlWhere . " and option =".$option;
           }
        }

        if(isset($params['teacher_id'])){
           $teacher_id = $params['teacher_id'];
           if($teacher_id!=''){
               $sqlWhere = $sqlWhere . " and teacher_id =".$teacher_id;
           }
        }

        if(isset($params['campus_id'])){
           $campus_id = $params['campus_id'];
           if($campus_id!=''){
               $sqlWhere = $sqlWhere . " and campus_id =".$campus_id;
           }
        }

        if(isset($params['school_id'])){
           $school_id = $params['school_id'];
           if($school_id!=''){
               $sqlWhere = $sqlWhere . " and school_id =".$school_id;
           }
        }

        if(isset($params['category'])){
           $category = $params['category'];
           if($category!=''){
               $sqlWhere = $sqlWhere . " and category =".$category;
           }
        }

        if(isset($params['question'])){
           $question = $params['question'];
           if($question!=''){
               $sqlWhere = $sqlWhere . " and question like '%".$question."%'";
           }
        }
        
        $sql="SELECT * from ". Questionnaire::tableName() . " where 1=1 ";

        $page = 1;
        if(isset($params['page'])){
            $page = $params['page'];
        }
        $pageSize = 10;
        if(isset($params['pageSize'])){
            $pageSize = $params['pageSize'];
        }

        $sqlCount = "select count(1) from ". Questionnaire::tableName() ." as a where 1=1 ".$sqlWhere;
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

    public function searchByCategory($category)
    {
        $sqlWhere = "";

                $sqlWhere = $sqlWhere . " and category =".$category;


        $sql="SELECT * from ". Questionnaire::tableName() . " where 1=1 ";

        $page = 1;
        if(isset($params['page'])){
            $page = $params['page'];
        }
        $pageSize = 100;
        if(isset($params['pageSize'])){
            $pageSize = $params['pageSize'];
        }

        $sqlCount = "select count(1) from ". Questionnaire::tableName() ." as a where 1=1 ".$sqlWhere;
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
