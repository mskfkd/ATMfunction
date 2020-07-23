<?php
require_once('index.php');

class MenuValidation {
	private $error_msgs = [];

	public function check($input) {//メニュー選択のバリデーション
		$error_msgs = $this->error_msgs;

		if (empty($input)) {
			$this->error_msgs[] = "認識できませんでした" . "\n";
			return $this->MenuerrorRes();
		}

		if (!ATM::MENU_LIST[$input]) {
			$this->error_msgs[] = "1~3のいずれかで選択し直してください" . "\n";
			return $this->MenuerrorRes();
		}

		return true;

	}

	public function MenuerrorRes() {
		return false;
	}

	public function getErrorMessage() {
		return $this->error_msgs;
	}
}
?>