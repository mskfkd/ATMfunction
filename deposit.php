<?php
//入金
class Deposit extends Balance {
	private $balance;
	private $plusmoney;

	function __construct() {
		echo "いくら入金しますか。" . "\n";
	}

	public function getRemaining($balance) {
		$this->balance = $balance;
		$this->balance = 10000;
	}

	public function getDeposit($plusmoney) {
		$this->plusmoney = $plusmoney;
	}

	public function setBalanceAns() {
		$this->balance = $this->balance + $this->plusmoney;
		return "残高は" . $this->balance . "です。" . "\n";
	}
}


?>