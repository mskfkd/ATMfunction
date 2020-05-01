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
		return $this->customer;
	}
}

//暗証番号
class Authhentication {

}

//入金
class Deposit {

}

//引き出し
class Withdrawal {

}

//振込
class Wiretransfer {

}

$controll = new Controll;
$input = trim(fgets(STDIN));
$controll->guest($input);
$controll->check();
$controll->res();

?>