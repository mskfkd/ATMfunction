<?php
require_once('index.php');
require_once('BaseValidation.php');

class ReplayResValidation extends BaseValidation {

	public function check($inputReplay) {

		if (empty($inputReplay)) {
			$this->error_msgs[] = "認識できませんでした" . "\n";
			return false;
		}

		if (!ATM::RES_MENU[$inputReplay]) {
			$this->error_msgs[] = "y:はい か n:いいえを入力してください" . "\n";
			return false;
		}

		return true;

	}

}

?>