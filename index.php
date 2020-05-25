<?php
class ATM {
	const BALANCE = 1;
	const DEPOSIT = 2;
	const WITHDRAWL = 3;

	public $balance = 10000;
	public $deposit;
	public $withdrawl;

	public function main() {
		//メニュー選択
		$menu = $this->selectMenu();

		switch ($menu) {
			case self::BALANCE:
			$this->balance();
			break;

			case self::DEPOSIT:
			$this->deposit();
			break;
			
			case self::WITHDRAWL:
			$this->withdrawl();
			break;

		}
	}

	public function selectMenu() {
		echo "いらっしゃいませ。1.残高照会 2.入金 3.引き出しの中から選択してください。";
		
		$input = rtrim(fgets(STDIN));
		$checkres = $this->check($input);

		if($checkres === true) {
			return $input;
		}else{
			return $this->selectMenu();
		}
	}

	public function check($input) {
		if (empty($input)) {
			echo "1~3のいずれかを入力してください" . "\n";
			return false;
		}

		if ($input === 0 || $input >= 4) {
			echo "1~3のいずれかで選択し直してください" . "\n";
			return false;
		}

		return true;
	}

	public function balance() {
		$balance = $this->balance;
		echo "残高は" . $this->balance . "円です";
	}

	public function deposit() {
		echo "いくら入金しますか?";
		$deposit = $this->deposit;
		$this->deposit = rtrim(fgets(STDIN));
		echo $this->deposit . "円入金しました" . "\n";
		$this->balance = $this->balance + $this->deposit;
		echo "残高は" . $this->balance . "です。" . "\n";
	}

	public function withdrawl() {
		echo "いくら出金しますか?";
		$withdrawl = $this->withdrawl;
		$this->withdrawl = rtrim(fgets(STDIN));
		echo $this->withdrawl . "円引き出しました";
		$this->balance = $this->balance - $this->withdrawl;
		echo "残高は" . $this->balance . "です。" . "\n";
	}

}

$atm = new ATM;
$atm->main();

?>