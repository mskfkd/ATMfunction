<!-- 69 ATM -->

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
		if($this->customer >= 5) {
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
	private $pin;

	function __construct() {
		echo "暗証番号数字4桁を入力してください。" . "\n";
	}

	public function getPin($pin) {
		$this->pin = $pin;
	}

	public function check() {
		if(!isset($this->pin)) {
		echo "暗証番号数字4桁を入力してください。" . "\n";
		return false;
		}

		if(strlen($this->pin) !== 4) {
			echo "4桁で入力してください。" . "\n";
		}
	}

	public function setpin() {
		return true;
	}
}



$controll = new Controll;
$input = trim(fgets(STDIN));
$controll->guest($input);
$controll->check();

$authhentication = new Authhentication;
if($controll->res() === true) {
	$inputpin = trim(fgets(STDIN));
	$authhentication->check($inputpin);
	$authhentication->setpin();
}else {
	echo "エラーです" . "\n";
}

?>