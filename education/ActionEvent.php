<?php

namespace app\events;

use yii\base\Event;
use yii\db\Query;

class ActionEvent extends Event
{

    public static function assign()
    {
        $rows = (new Query())
            ->select('*')
            ->from('{{%config}}')
            ->all();

        $arr = array();
        foreach ($rows as $row) {
            $arr[$row['varname']] = $row['value'];
        }

        \Yii::$app->params = array_merge(\Yii::$app->params, $arr);
    }
}

