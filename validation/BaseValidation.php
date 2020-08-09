<?php

class BaseValidation {
	private $error_msgs = [];

	public function check($input) {
		$error_msgs = $this->error_msgs;

		if (empty($input)) {
			$this->error_msgs[] = "認識できませんでした" . "\n";
			return false;
		}

		if (!is_numeric($input)) {
			$this->error_msgs[] = "数字で入力してください" . "\n";
			return false;
		}

		return true;
	}//function check

	public function getErrorMessage() {
		return $this->error_msgs;
	}
}



?>