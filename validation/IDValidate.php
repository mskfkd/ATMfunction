<?php
require_once('index.php');

class IDValidation {
	private $error_msgs = [];

	public function check($inputID) {
		$error_msgs = $this->error_msgs;

		if (empty($inputID)) {
			$this->error_msgs[] = "認識できませんでした" . "\n";
			return $this->IDerrorRes();
		}

		if (!is_numeric($inputID)) {
			$this->error_msgs[] = "IDは数字で入力してください" . "\n";
			return $this->IDerrorRes();
		}

		//Userクラスのユーザーリストにidがあるかチェック
		$userlist = new User;
		$checkIDRes = $userlist->isExistUserId($inputID);
		if ($checkIDRes === false) {
			$this->error_msgs[] = "入力されたIDは登録されていません" . "\n";
			return $this->IDerrorRes();
		}

		return true;
	}//function check

	public function IDerrorRes() {
		return false;
	}

	public function getErrorMessage() {
		return $this->error_msgs;
	}
}

?>