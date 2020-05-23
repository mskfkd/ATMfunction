<?php
​
class ATM {
	const BALANCE = 1;
	const DEPOSIT = 2;
	const WITHDRAWL = 3;
​
	// public $menu;
	public $balance;
	public $deposit;
	public $withdrawl;
​
	public function selectMenu() {
		$input = rtrim(fgets(STDIN));
​
		$checkres = $this->check($input);
		// var_dump($this->check($input));
​
		if($checkres === true){
			if ($input === 1) {
				echo "残高を確認します" . "\n";
				$menu = BALANCE;
				return $menu;
			}elseif ($input === 2) {
				echo "入金手続きに進みます" . "\n";
				$menu = DEPOSIT;
				return $menu;
			}elseif ($input === 3) {
				echo "出金手続きに進みます" . "\n";
				$menu = WITHDRAWL;
				return $menu;
			}
			
		}
		
	}
​
	public function check($input) {
		if (!isset($input)) {
			echo "1~3のいずれかを入力してください" . "\n";
			return false;
		}
​
		if ($input === 0 || $input >= 4) {
			echo "1~3のいずれかで選択し直してください" . "\n";
			return false;
		}
​
		return true;
	}
​
	public function DefineBalance() {
		$balance = $this->balance;
		$this->balance = 10000;
	}
​
	public function balance() {
		echo "残高は" . $this->balance . "円です";
	}
​
	public function DefineDeposit() {
		$deposit = $this->deposit;
	}
​
	public function deposit() {
		echo $this->deposit . "円入金しました";
	}
​
	public function Definewithdrawl() {
		$withdrawl = $this->withdrawl;
	}
​
	public function withdrawl() {
		echo $this->withdrawl . "円引き出しました";
	}
​
	public function main() {
		//メニュー選択
		$menu = $this->selectMenu();
		var_dump($menu);
​
		switch ($menu) {
			case self::BALANCE:
				$this->DefineBalance();
				$this->balance();
				break;
​
			case self::DEPOSIT:
				$this->DefineDeposit();
				$this->deposit();
				break;
			
			case self::WITHDRAWL:
				$this->Definewithdrawl();
				$this->withdrawl();
				break;
​
		}
	}
}
​
$atm = new ATM;
$atm->main();
​
?>