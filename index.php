<?php

//ログイン
class Controll {
	public $customer;

	function __construct() {
		echo "いらっしゃいませ。どうされますか?" . "\n";
		echo "1～4の中から選択してください。" . "\n";
		echo "1.残高確認、2.入金、3.引き出し、4.振込" . "\n";
	}

	public function guest($customer) {
		$this->customer = $customer;
		// $this->customer = trim(fgets(STDIN));
	}

	//バリデーション
	public function check() {
	//入力が空でないか
		if(!isset($this->customer)) {
			echo "1~4の中からいずれかを選択し、入力してください。";
			return falese;
		}

	//1~4を入力しているか
		if($this->customer >= 5 && $this->customer !== 0) {
			echo "1~4のいずれかを入力してください。";
			return false;
		}
	}

	public function res() {
		return true;
	}
}

//暗証番号
class Authhentication {
	private $pin = 1234;

	function __construct() {
		echo "暗証番号数字4桁を入力してください。" . "\n";
	}

	public function getPin($pin) {
		$this->pin = $pin;
		// $this->pin = 1234;
	}

	public function setcheck() {
		if(!isset($this->pin)) {
			echo "暗証番号数字4桁を入力してください。" . "\n";
			return false;
			// var_dump($this->pin);
		}

		if(strlen($this->pin) !== 4) {
			echo "4桁で入力してください。" . "\n";
		}
	}

	public function pinjudge() {
		return true;
	}
}

//選択
$controll = new Controll;
$input = trim(fgets(STDIN));
$controll->guest($input);
$controll->check();

//暗証番号認証
$authhentication = new Authhentication;
if($controll->res() === true) {
	$inputpin = trim(fgets(STDIN));
	$authhentication->setcheck($inputpin);
	$pinjudge = $authhentication->pinjudge();

}

//選択後の操作
if ($pinjudge === true) {
	if ($input === 1) { //残高参照
		require("balancecheck.php");
		$balance = new Balance;
		$balance->getRemaining();
		$balance->setBalanceAns();
	}elseif ($input === 2) { //入金
		require("deposit.php");
		$deposit = new Deposit;
		$inputPlus = trim(fgets(STDIN));
		$deposit->getRemaining();
		$deposit->getDeposit($inputPlus);
		$deposit->setBalanceAns();
	}elseif ($input === 3) { //引き出し
		require("withdrawal.php");
		$withdrawal = new Withdrawal;
		$exportMinus = trim(fgets(STDIN));
		$withdrawal->getRemaining();
		$withdrawal->getWithdrawal($exportMinus);
		$withdrawal->setWithdrawal();
		$withdrawal->setBalanceAns();
	}elseif ($input === 4) { //振込
		require("wiretransfer.php");
		$wiretransfer = new Wiretransfer;
		$inputBank = trim(fgets(STDIN));
		$wiretransfer->getBank($inputBank);
		$wiretransfer->setBank();
		$wiretransfer->getBranch();
		$wiretransfer->setBranch();
		$wiretransfer->getAccount();
		$wiretransfer->setAccount();
		$wiretransfer->comfirm();
		$wiretransfer->getRemaining();
		$wiretransfer->getWiretransfer();
		$wiretransfer->setWiretransfer();
		$wiretransfer->setBalanceAns();
	}
}else {
	echo "エラーです" . "\n";
}


?>