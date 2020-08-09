<?php

require_once('validation/IDValidate.php');
require_once('validation/PassValidate.php');
require_once('validation/MenuValidate.php');
require_once('validation/ReplayResValidate.php');

//ログイン情報
class User {

	public $user_list = array(
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

	public function isExistUserId($inputID) {
		$user_list = $this->user_list;
		if($inputID !== $this->user_list[$inputID]["id"]) {
			return false;
		}
	}

	public function getUserById($key) {
		return $this->user_list[$key];		
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
		$IDVali = new IDValidation;
		$inputRes = $IDVali->check($inputID);
		$listcheckRes = $IDVali->UserListCheck($inputID);
		if ($inputRes === false) {
			echo implode(",", $IDVali->getErrorMessage());
			return $this->login();
		}elseif ($listcheckRes !== true) {
			echo implode(",", $IDVali->getErrorMessage());
			return $this->login();
		}

        //Userクラスから指定されたユーザー取得
		$userlist = new User;
		$user = $userlist->getUserById($inputID);
		$getId = $user["id"];

		var_dump($user);
		$this->loginPass($user);

        //問題なければ、プロパティの$userにセット
		$this->user = $user;

	}

	public function loginPass($user) {

		//パスワード取得
		echo "パスワードを入力してください" . "\n";
		$inputPass = rtrim(fgets(STDIN));
		$PassVali = new PassValidation;
		$inputRes = $PassVali->check($inputPass);
		if ($inputRes === false) {
			echo implode(",", $PassVali->getErrorMessage());
			return $this->loginPass($user);
		}

		//取得したユーザーのパスワードと入力値が一致するかチェック
		$getPass = $user["password"];

		if ($getPass !== $inputPass) {
			echo "パスワードが一致しません。" . "\n";
			return $this->loginPass($user);
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
		$MenuVali = new MenuValidation;
		$checkres = $MenuVali->check($input);
		if($checkres === false) {
			echo implode(",", $MenuVali->getErrorMessage());
			return $this->selectMenu();
		}

		return $input;
	}


	public function balance() {//残高照会
		$balance = $this->user["balance"];
		echo "残高は" . $balance . "円です" . "\n";
		$this->replay();
	}

	public function deposit() {//入金
		echo "いくら入金しますか?";
		$deposit = rtrim(fgets(STDIN));

		if (empty($deposit)) {
			echo "認識できませんでした。もう一度入力してください。" . "\n";
			return $this->deposit();
		}

		if (!is_numeric($deposit)) {
			echo "数字で入力してください" . "\n";
			return $this->deposit();
		}
		
		echo $deposit . "円入金しました" . "\n";
		$balance = $this->user["balance"];
		$balance = $balance + $deposit;
		echo "残高は" . $balance . "円です。" . "\n";
		$this->replay();
	}

	public function withdrawl() {//出金
		echo "いくら出金しますか?";
		$withdrawl = rtrim(fgets(STDIN));

		if (empty($withdrawl)) {
			echo "認識できませんでした。もう一度入力してください。" . "\n";
			return $this->withdrawl();
		}

		if (!is_numeric($withdrawl)) {
			echo "数字で入力してください" . "\n";
			return $this->withdrawl();
		}

		echo $withdrawl . "円引き出しました";
		$balance = $this->user["balance"];
		$balance = $balance - $withdrawl;
		echo "残高は" . $balance . "円です。" . "\n";
		$this->replay();
	}

	public function replay() {
		//機能を引き続き使うか確認
		echo "他にも手続きされますか? y:はい か n:いいえを入力してください" . "\n";
		$inputReplay = rtrim(fgets(STDIN));

		//入力内容確認
		$ReResVali = new ReplayResValidation;
		$inputRes = $ReResVali->check($inputReplay);
		if ($inputRes === false) {
			echo implode(",", $ReResVali->getErrorMessage());
			return $this->replay();
		}

		if ($inputReplay === self::YES) {
			return $this->main();
		}else if($inputReplay === self::NO){
			echo "ご利用ありがとうございました。" . "\n";
			return;
		}
	}

}//class ATM

$atm = new ATM;
$atm->main();

?>