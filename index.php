<?php

//ログイン情報
class User {

	static public $user_list = array(
		1 => array(
			"id" => "1",
			"password" => "1234",
			"name" => "tanaka",
			"balance" => "100000"
		),
		2 =>array(
			"id" => "2",
			"password" => "3456",
			"name" => "suzuki",
			"balance" => "150000"
		)
	);

	public function getUserById($key) {
		var_dump(User::$user_list[$key]);
		return User::$user_list[$key];
		// return User::$user_list[$key]["id"];
	}

	// public function getPassByUser($key2) {
	// 	return User::$user_list[$key2]["password"];
	// }

	// public function getBalanceByUser($key3) {
	// 	return User::$user_list[$key3]["balance"];
	// }
}

//ATM機能
class ATM {
	const BALANCE = 1;
	const DEPOSIT = 2;
	const WITHDRAWL = 3;

	// public $id;
	// public $name;
	// public $pass;
	// public $input;
	public $getId;
	public $getPass;
	public $getuser;
	public $user;
	public $balance;
	public $deposit;
	public $withdrawl;

	public function __construct() {
		//ログイン
		$this->login();
	}

	public function login() {
		//id入力
		// $id = $this->id;
		echo "ユーザーIDを入力してください" . "\n";
		$inputID = rtrim(fgets(STDIN));
		$inputRes = $this->checkId($inputID);

		//Userクラスのユーザーリストにidがあるかチェック
          //なければエラー、再帰関数
		$userclass = new User;
		$getId = $userclass->getUserById($inputID)["id"];
		var_dump($getId);
		if ($getId !== $inputID) {
			echo "IDが一致しません。" . "\n";
			return $this->login();
		}

        //Userクラスから指定されたユーザー取得
		// $getuser = $userclass->getUserById($inputID);
		// var_dump($getuser);

        //パスワード取得
		// $pass = $this->pass;
		echo "パスワードを入力してください" . "\n";
		$inputPass = rtrim(fgets(STDIN));
		$inputRes = $this->checkId($inputPass);

        //取得したユーザーのパスワードと入力値が一致するかチェック
            //なければエラー、再帰関数
		$getPass = $userclass->getUserById($inputID)["password"];
		// $getPass = $userclass->getPassByUser($inputID);
		var_dump($getPass);
		if ($getPass !== $inputPass) {
			echo "パスワードが一致しません。" . "\n";
			return $this->login();
		}

        //問題なければ、プロパティの$userにセット
		$user = $userclass->getUserById($inputID)["balance"];
		$this->user = $user;
		// var_dump($user);
	}

	public function checkId($input) {
		if (!isset($input)) {
			echo "入力してください" . "\n";
			return $this->login();
		}

		if (!is_numeric($input)) {
			echo "数字で入力してください" . "\n";
			return $this->login();
		}
	}

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
		echo "1.残高照会 2.入金 3.引き出しの中から選択してください。";
		
		$input = rtrim(fgets(STDIN));
		$checkres = $this->check($input);

		if($checkres === false) {
			return $this->selectMenu();
		}
		
		return $input;
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

		$balance = $this->user;
		// $balance = $this->balance;
		// var_dump($user["balance"]);
		echo "残高は" . $balance . "円です";
	}

	public function deposit() {
		echo "いくら入金しますか?";
		$deposit = $this->deposit;
		$this->deposit = rtrim(fgets(STDIN));
		echo $this->deposit . "円入金しました" . "\n";
		$balance = $this->user;
		$balance = $balance + $this->deposit;
		echo "残高は" . $balance . "です。" . "\n";
	}

	public function withdrawl() {
		echo "いくら出金しますか?";
		$withdrawl = $this->withdrawl;
		$this->withdrawl = rtrim(fgets(STDIN));
		echo $this->withdrawl . "円引き出しました";
		$balance = $this->user;
		$balance = $balance - $this->withdrawl;
		echo "残高は" . $balance . "です。" . "\n";
	}

}

$atm = new ATM;
$atm->main();

?>