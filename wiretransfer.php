<?php

//振込
class Wiretransfer extends Balance {
	private $bank;
	private $branch;
	private $account;
	private $balance;
	private $gift;

	function __construct() {
		echo "どの銀行に振り込まれますか" . "\n";
		echo "1~4のなかから選択してください" . "\n";
		echo "1.楽しい銀行　2.なんかすごい銀行　3.やばい銀行　4.たぶん銀行" . "\n";
	}

	//バリデーション
	public function check($checkInput) {
	//入力が空でないか
		if(!isset($checkInput)) {
			echo "1~4の中からいずれかを選択し、入力してください。";
			return falese;
		}

	//1~4を入力しているか
		if($checkInput >= 5 && $checkInput !== 0) {
			echo "1~4のいずれかを入力してください。";
			return false;
		}

		return true;
	}

	//どの銀行に振り込むか選択入力
	public function getBank($bank) {
		$this->bank = $bank;
	}

	public function setBank() {
		$this->bank = trim(fgets(STDIN));
		$checkBank = check($this->bank);
	}

	//どの支店に振り込むか
	public function getBranch($branch) {
		$this->branch = $branch;
	}

	public function setBranch() {
		echo "どの支店に振り込まれますか" . "\n";
		echo "1~4の中からいずれかを選択し、入力してください。" . "\n";
		echo "1.バラ支店　2.ユリ支店　3.ほし支店　4.つき支店" . "\n";

		$this->branch = trim(fgets(STDIN));
		$checkBranch = check($this->branch);
	}

	//どの口座に振り込むか
	public function getAccount($account) {
		$this->account = $account;
	}

	public function setAccount() {
		echo "どの口座に振り込まれますか" . "\n";
		echo "1~4の中からいずれかを選択し、入力してください。" . "\n";
		echo "1.山田さんの口座　2.実家の口座　3.ほし支店　4.つき支店" . "\n";

		$this->account = trim(fgets(STDIN));
		$checkAccount = check($this->account);
	}

	//銀行、支店、口座選択内容の確認
	public function comfirm() {
		if ($checkBank === true && $checkBranch === true && $checkAccount === true) {
			echo $this->bank . $this->branch . $this->account . "宛ですね" . "\n";
		}else {
			echo "最初からやり直してください";
			return falese;
		}
	}

	//振込金額について
	public function getRemaining($balance) {
		$this->balance = $balance;
	}

	public function getWiretransfer($gift) {
		$this->gift = $gift;
	}

	public function setWiretransfer() {
		$this->gift = trim(fgets(STDIN));

		echo $this->gift . "円振込ですね?" . "\n";
		echo "はいならばYを、いいえならばNを入力してください" . "\n";
		$res = trim(fgets(STDIN));

		if ($res === "Y") {
			echo $this->gift . "円振込ました" . "\n";
			return true;
		}else{
			echo "取引を中止いたしました" . "\n";
			return false;
		}
	}

	public function setBalanceAns() {
		$this->balance = $this->balance - $this->gift;
		return "残高は" . $this->balance . "です。" . "\n";
	}
}
?>