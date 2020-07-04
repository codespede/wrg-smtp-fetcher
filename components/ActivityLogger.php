<?php
namespace app\components;
use app\models\Activities;
use yii\helpers\ArrayHelper;

class ActivityLogger extends \yii\base\Component{

	public function init(){
		//
	}

	public function log($action, $type = 'system', $uid = null, $searchParams = null){
		$activity = new Activities;
		if(is_array($searchParams))
			$searchParams = json_encode($searchParams);
		$activity->attributes = compact('action', 'type', 'uid', 'searchParams');
		$activity->save();
	}

}
