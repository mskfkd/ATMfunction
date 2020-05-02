<?php
//引き出し

class Withdrawal extends Balance {
	

	public function getRemaining($balance) {
		$this->balance = $balance;
	}

	public function setBalanceAns() {
		return "残高は" . $this->balance . "です。" . "\n";
	}

}

?>