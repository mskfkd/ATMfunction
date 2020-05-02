<?php
//残高確認

class Balance{
	private $balance;

	public function getRemaining($balance) {
		$this->balance = $balance;
		$this->balance = 10000;
	}

	public function setBalanceAns() {
		return "残高は" . $this->balance . "です。" . "\n";
	}
}

?>