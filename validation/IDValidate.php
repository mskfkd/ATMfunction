<?php
require_once('index.php');
require_once('BaseValidation.php');

class IDValidation extends BaseValidation {
	
		//Userクラスのユーザーリストにidがあるかチェック
	public function UserListCheck($inputID) {
		$userlist = new User;
		$checkIDRes = $userlist->isExistUserId($inputID);
		if ($checkIDRes === false) {
			$this->error_msgs[] = "入力されたIDは登録されていません" . "\n";
			return false;
		}

		return true;
	}

}

?>