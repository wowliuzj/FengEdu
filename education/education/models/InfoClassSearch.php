<?php

namespace app\education\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\education\models\InfoClass;

/**
 * InfoClassSearch represents the model behind the search form about `app\education\models\InfoClass`.
 */
class InfoClassSearch extends InfoClass
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['icl_id', 'icl_number', 'icl_note'], 'safe'],
            [['icl_tid', 'icl_year'], 'integer'],
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
        $query = InfoClass::find();

        $page = 1;
        if(isset($params['page'])){
            $page = $params['page'];
        }
        $pageSize = 10;
        if(isset($params['pageSize'])){
            $pageSize = $params['pageSize'];
        }

        $this->load($params,"");
        
        $query->andFilterWhere([
            'icl_tid' => $this->icl_tid,
            'icl_year' => $this->icl_year,
        ]);
        
        $query->andFilterWhere(['like', 'icl_id', $this->icl_id])
            ->andFilterWhere(['like', 'icl_number', $this->icl_number])
            ->andFilterWhere(['like', 'icl_note', $this->icl_note]);

        $session = Yii::$app->session;
        $ftype = $session['USER_SESSION']['ftype'];
        if($ftype == 8 or $ftype == 3 or $ftype == 4)
        {
            $query->andFilterWhere(['like', 'campus_id', $session['USER_SESSION']['campus_id']]);
        }

        $dataProvider = new ActiveDataProvider([
                                                   'query' => $query,
                                                   'pagination' => [
                                                       'pageSize' => $pageSize,
                                                       'page' => $page - 1,
                                                   ],
                                                   'sort'=>['defaultOrder' =>['status'=>SORT_ASC]]
                                               ]);

        return $dataProvider;
    }
}
