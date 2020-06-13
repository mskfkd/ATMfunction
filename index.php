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

	public static function isExistUserId($inputID) {
		if($inputID !== User::$user_list[$inputID]["id"]) {
			echo "登録されているIDと一致しません" . "\n";
			return false;
		}
	}

	public function getUserById($key) {
		var_dump(User::$user_list[$key]);
		return User::$user_list[$key];		
	}

}

//ATM機能
class ATM {
	const BALANCE = 1;
	const DEPOSIT = 2;
	const WITHDRAWL = 3;
	const MENU_LIST = array(
		1 => BALANCE,
		2 => DEPOSIT,
		3 => WITHDRAWL
	);

	const YES = "y";
	const NO = "n";
	const RES_MENU = array(
		"y" => YES,
		"n" => NO
	);

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
		echo "ユーザーIDを入力してください" . "\n";
		$inputID = rtrim(fgets(STDIN));
		$inputRes = $this->checkId($inputID);
		if ($inputRes === false) {
			return $this->login();
		}

		//Userクラスのユーザーリストにidがあるかチェック
          //なければエラー、再帰関数
		$storageID = User::isExistUserId($inputID);
		if($storageID === false) {
			return $this->login();
		}

        //Userクラスから指定されたユーザー取得
		$user = User::getUserById($inputID);
		$getId = $user["id"];

		$this->loginPass();

//取得したユーザーのパスワードと入力値が一致するかチェック
        //なければエラー、再帰関数
		$getPass = $user["password"];
		if ($getPass !== $this->inputPass) {
			echo "パスワードが一致しません。" . "\n";
			return $this->loginPass();
		}

        //問題なければ、プロパティの$userにセット
		$this->user = $user;
	}

	public function loginPass() {
		//パスワード取得
		echo "パスワードを入力してください" . "\n";
		$inputPass = $this->inputPass;
		$this->inputPass = rtrim(fgets(STDIN));
		$inputRes = $this->checkPass($this->inputPass);
		if ($this->inputPass === false) {
			return $this->loginPass();
		}
	}

	public function checkId($inputID) {
		if (!isset($inputID)) {
			echo "IDを入力してください" . "\n";
			return false;
		}

		if (!is_numeric($inputID)) {
			echo "IDは数字で入力してください" . "\n";
			return false;
		}
	}

	public function checkPass($inputPass) {
		if (!isset($inputPass)) {
			echo "パスワードを入力してください" . "\n";
			return false;
		}

		if (!is_numeric($inputPass)) {
			echo "パスワードは数字で入力してください" . "\n";
			return false;
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

	public function check($input) {//メニュー選択のバリデーション
		if (!isset($input)) {
			echo "1~3のいずれかを入力してください" . "\n";
			return false;
		}

		if (!self::MENU_LIST[$input]) {
			var_dump(self::MENU_LIST[$input]);
			var_dump($input);
			echo "1~3のいずれかで選択し直してください" . "\n";
			return false;
		}
		return true;

	}

	public function balance() {//残高照会
		$balance = $this->user["balance"];
		echo "残高は" . $balance . "円です";
		$this->replay();
	}

	public function deposit() {//入金
		echo "いくら入金しますか?";
		$deposit = rtrim(fgets(STDIN));
		echo $deposit . "円入金しました" . "\n";
		$balance = $this->user["balance"];
		$balance = $balance + $deposit;
		echo "残高は" . $balance . "です。" . "\n";
		$this->replay();
	}

	public function withdrawl() {//出金
		echo "いくら出金しますか?";
		$withdrawl = rtrim(fgets(STDIN));
		echo $withdrawl . "円引き出しました";
		$balance = $this->user["balance"];
		$balance = $balance - $withdrawl;
		echo "残高は" . $balance . "です。" . "\n";
		$this->replay();
	}

	public function replay() {
		//機能を引き続き使うか確認
		echo "他にも手続きされますか? y:はい か n:いいえを入力してください" . "\n";
		$inputReplay = rtrim(fgets(STDIN));

		//入力内容確認
		$inputRes = $this->checkReplayRes($inputReplay);
		if ($inputRes === false) {
			return $this->replay();
		}

		if ($inputReplay === self::YES) {
			return $this->main();
		}else if($inputReplay === self::NO){
			echo "ご利用ありがとうございました。" . "\n";
			return;
		}
	}

	public function checkReplayRes($inputReplay) {
		if (!isset($inputReplay)) {
			echo "はいであればyを、いいえであればnを入力してください" . "\n";
			return false;
		}

		if (!self::RES_MENU[$inputReplay]) {
			echo "y:はい か n:いいえを入力してください" . "\n";
			return false;
		}
	}
}//class ATM

$atm = new ATM;
$atm->main();

?>