<?php

namespace app\education\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use yii\data\SqlDataProvider;
use app\education\models\Message;

/**
 * MessageSearch represents the model behind the search form about `app\education\models\Message`.
 */
class MessageSearch extends Message
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'sid'], 'integer'],
            [['title', 'cnt', 'reply_msg','time'], 'safe'],
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
        $query = Message::find();

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
            'sid' => $this->sid,
        ]);

        $query->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'cnt', $this->cnt])
            ->andFilterWhere(['like', 'reply_msg', $this->reply_msg]);

        return $dataProvider;
    }

    public function searchBySql($params)
    {
        $sqlWhere = "a.sid = b.is_id ";
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

        if(isset($params['cnt'])){
           $cnt = $params['cnt'];
           if($cnt!=''){
               $sqlWhere = $sqlWhere . " and cnt like '%".$cnt."%'";
           }
        }

        if(isset($params['reply_msg'])){
           $reply_msg = $params['reply_msg'];
           if($reply_msg!=''){
               $sqlWhere = $sqlWhere . " and reply_msg like '%".$reply_msg."%'";
           }
        }

        if(isset($params['sid'])){
           $sid = $params['sid'];
           if($sid!=''){
               $sqlWhere = $sqlWhere . " and sid =".$sid;
           }
        }

         if(isset($params['csid'])){
           $csid = $params['csid'];
           if($csid!=''){
               $sqlWhere = $sqlWhere . " and sid in (SELECT is_id from info_student where  icl_id in(SELECT icl_id from info_class where icl_tid=$csid))";
           }
        }
        
        $sql="SELECT a.*,b.is_name,b.is_sex from message as a,info_student as b where  ";

        $page = 1;
        if(isset($params['page'])){
            $page = $params['page'];
        }
        $pageSize = 10;
        if(isset($params['pageSize'])){
            $pageSize = $params['pageSize'];
        }

        $sqlCount = "SELECT count(1) from message as a,info_student as b where ".$sqlWhere;
        $count = Yii::$app->db->createCommand($sqlCount)->queryScalar();
        //echo $sql.$sqlWhere." order by a.time desc";
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
}
