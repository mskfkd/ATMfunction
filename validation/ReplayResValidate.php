<?php
require_once('index.php');

class ReplayResValidation {
	private $error_msgs = [];

	public function check($inputReplay) {
		$error_msgs = $this->error_msgs;

		if (empty($inputReplay)) {
			$this->error_msgs[] = "認識できませんでした" . "\n";
			return $this->ReplayerrorRes();
		}

		if (!ATM::RES_MENU[$inputReplay]) {
			$this->error_msgs[] = "y:はい か n:いいえを入力してください" . "\n";
			return $this->ReplayerrorRes();
		}

		return true;

	}

	public function ReplayerrorRes() {
		return false;
	}

	public function getErrorMessage() {
		return $this->error_msgs;
	}
}

?>