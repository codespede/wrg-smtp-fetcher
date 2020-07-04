<?php

namespace app\models\search;

use Yii;
use yii\data\ActiveDataProvider;
use app\models\Emails;
use yii\base\Model;

/**
 * AttributesSearch represents the model behind the search form about `common\models\Attributes`.
 */
class EmailsSearch extends Emails
{  
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['from', 'to', 'body', 'dateSent', 'uid', 'msgNo', 'subject'], 'string']
            //[['title', 'scope', 'code', 'field', 'validation'], 'safe'],
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

        $query = Emails::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere(['REGEXP', 'id', strval($this->id ) ]);
        $query->andFilterWhere(['REGEXP', 'from', strval($this->from ) ]);
        $query->andFilterWhere(['REGEXP', 'to', strval($this->to ) ]);
        $query->andFilterWhere(['REGEXP', 'body', strval($this->body ) ]);
        $query->andFilterWhere(['REGEXP', 'uid', strval($this->uid ) ]);
        $query->andFilterWhere(['REGEXP', 'msgNo', strval($this->msgNo ) ]);
        $query->andFilterWhere(['REGEXP', 'dateSent', strval($this->dateSent ) ]);
        $query->andFilterWhere(['REGEXP', 'subject', strval($this->subject ) ]);

        $searchParams = [];
        $searching = false;
        foreach($this->attributes as $attribute => $value){
        	if($value != ""){
        		$searching = true;
        		$searchParams[$attribute] = $value;
        	}
        }

        if($searching)
        	Yii::$app->logger->log('search', 'user', null, $searchParams);

        // $query->andFilterWhere([
        //     'id' => $this->id,
        //     'from' => $this->from,
        //     'to' => $this->to,
        //     'body' => $this->body,
        //     'dateSent' => $this->dateSent,
        // ]);

        return $dataProvider;
	}
}
