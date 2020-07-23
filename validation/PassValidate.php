<?php

class PassValidation {
	private $error_msgs = [];

	public function check($inputP) {
		$error_msgs = $this->error_msgs;

		if (empty($inputP)) {
			$this->error_msgs[] = "認識できませんでした" . "\n";
			return $this->PasserrorRes();
		}

		if (!is_numeric($inputP)) {
			$this->error_msgs[] = "パスワードは数字で入力してください" . "\n";
			return $this->PasserrorRes();
		}

		return true;

	}

	public function PasserrorRes() {
		return false;
	}

	public function getErrorMessage() {
		return $this->error_msgs;
	}
}

?>