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

	public function setDeposit() {
		$this->plusmoney = trim(fgets(STDIN));

		echo $this->plusmoney . "円入金ですね?" . "\n";
		echo "はいならばYを、いいえならばNを入力してください" . "\n";
		$res = trim(fgets(STDIN));

		if ($res === "Y") {
			echo $this->plusmoney . "円入金しました" . "\n";
			return true;
		}else{
			echo "取引を中止いたしました" . "\n";
			return false;
		}
	}

	public function setBalanceAns() {
		$this->balance = $this->balance + $this->plusmoney;
		return "残高は" . $this->balance . "です。" . "\n";
	}
}


?>