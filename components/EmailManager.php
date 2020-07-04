<?php
namespace app\components;
use app\models\Emails;
use yii\helpers\ArrayHelper;
use app\models\Settings;
use Yii;

class EmailManager extends \yii\base\Component{
	public $host;
	public $username;
	public $password;
	public $port;
	public $connection;

	public function init(){
		if($this->host == "" || $this->username == "" || $this->password == ""){
			$this->host = Settings::findSetting('email_host');
			$this->username = Settings::findSetting('email_username');
			$this->password = Settings::findSetting('email_password');
		}
		if(is_null($this->connection))
			$this->connect();
	}

	public function connect(){
		$connect_to = "{{$this->host}:{$this->port}/imap/ssl/novalidate-cert}INBOX";
        if(!$this->connection = \imap_open($connect_to, $this->username, $this->password))
            throw new Exception(("Can't connect to '$connect_to': " . imap_last_error()), 1);
        return $this->connection;
	}

	public function fetch(){
		$info = imap_check($this->connection);
		Yii::$app->logger->log('fetch');
		return imap_fetch_overview($this->connection, "1:{$info->Nmsgs}", 0);
	}

	public function delete($uid){
		imap_delete($this->connection, $uid, FT_UID);
		if(imap_expunge($this->connection))
			Yii::$app->logger->log('delete', 'user', $uid);
	}

	public function fetchAndSave(){
		$fetchedEmails = $this->fetch();
		$emails = ArrayHelper::map(Emails::find()->all(), 'msgNo', function($model){ return $model; });
		//var_dump($fetchedEmails);
		foreach($fetchedEmails as $fetchedEmail){
			$email = new Emails;
			if(array_key_exists($fetchedEmail->msgno, $emails))
				$email = $emails[$fetchedEmail->msgno];
			$body = imap_fetchbody($this->connection, $fetchedEmail->uid, 1, FT_UID | FT_PEEK);
			$structure = imap_fetchstructure($this->connection, $fetchedEmail->msgno);
			//var_dump($structure->parts[1]);
			$email->attributes = [
				'uid' => $fetchedEmail->uid,
				'msgNo' => $fetchedEmail->msgno,
				'from' => $fetchedEmail->from,
				'to' => $fetchedEmail->to,
				'subject' => $fetchedEmail->subject,
				'body' => in_array($structure->parts[1]->encoding, [3, 4])? imap_base64($body) : ($structure->parts[1]->encoding == 1? imap_8bit($body) : imap_qprint($body)),
				'dateSent' => date('Y-m-d H:i:s', strtotime($fetchedEmail->date))
			];
			$email->save(false);
		}
	}
}
