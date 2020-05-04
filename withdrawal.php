<?php
//引き出し

class Withdrawal extends Balance {
	private $balance;
	private $export;

	function __construct() {
		echo "いくら引き出されますか。" . "\n";
	}

	public function getRemaining($balance) {
		$this->balance = $balance;
	}

	public function getWithdrawal($export) {
		$this->export = $export;
	}

	public function setWithdrawal() {
		$this->export = trim(fgets(STDIN));

		echo $this->export . "円引き出しですね?" . "\n";
		echo "はいならばYを、いいえならばNを入力してください" . "\n";
		$res = trim(fgets(STDIN));

		if ($res === "Y") {
			echo $this->export . "円引き出しました" . "\n";
			return true;
		}else{
			echo "取引を中止いたしました" . "\n";
			return false;
		}
	}

	public function setBalanceAns() {
		$this->balance = $this->balance - $this->export;
		return "残高は" . $this->balance . "です。" . "\n";
	}

}

?>