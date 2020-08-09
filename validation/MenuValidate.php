<?php
require_once('index.php');
require_once('BaseValidation.php');

class MenuValidation extends BaseValidation {

	public function check($input) {//メニュー選択のバリデーション

		if (empty($input)) {
			$this->error_msgs[] = "認識できませんでした" . "\n";
			return false;
		}

		if (!ATM::MENU_LIST[$input]) {
			$this->error_msgs[] = "1~3のいずれかで選択し直してください" . "\n";
			return false;
		}

		return true;

	}

}
?>