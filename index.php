<?php
class ATM {
	const BALANCE = 1;
	const DEPOSIT = 2;
	const WITHDRAWL = 3;

	// public $menu;
	public $balance = 10000;
	public $deposit;
	public $withdrawl;

	public function selectMenu() {
		$input = rtrim(fgets(STDIN));
		$this->check($input);
		// var_dump($this->check($input));

		return $input;
	}

	public function check($input) {
		if (!isset($input)) {
			echo "1~3のいずれかを入力してください" . "\n";
			return selectMenu();
		}

		if ($input === 0 || $input >= 4) {
			echo "1~3のいずれかで選択し直してください" . "\n";
			return selectMenu();
		}

	}

	public function balance() {
		$balance = $this->balance;
		echo "残高は" . $this->balance . "円です";
	}

	public function deposit() {
		$deposit = $this->deposit;
		$this->deposit = rtrim(fgets(STDIN));
		echo $this->deposit . "円入金しました";
	}

	public function withdrawl() {
		$withdrawl = $this->withdrawl;
		$this->withdrawl = rtrim(fgets(STDIN));
		echo $this->withdrawl . "円引き出しました";
	}

	public function main() {
		//メニュー選択
		$menu = $this->selectMenu();
// 		var_dump($menu);

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
}

$atm = new ATM;
$atm->main();

?>