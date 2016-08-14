<?php
class UpdateUserView {
	function getMain($hdata){
		$html = "
			<p class='help'>! 「現在のパスワード」および「新しいパスワード」は、パスワードを変更する場合のみ入力してください !</p>
			<form id='updateUserDataForm' name='updateUserDataForm'>
			<table id='custom_admin' >
			<input type='hidden' id='type' name='type' value='confirm'>
			<tr>
			<th>表示名</th>
			<td><span id='err_userid' class='error'></span><input type='text' name='userid' id='userid' value='".$_SESSION['loginid']."'></td>
			</tr>
			<tr>
			<th>メールアドレス</th>
			<td><span id='err_email' class='error'></span><input type='text' name='email' id='email' value='".$_SESSION['loginemail']."'></td>
			</tr>
			<tr>
			<th>現在のパスワード</th>
			<td><span id='err_userpswd' class='error'></span><input type='password' name='userpswd' id='userpswd' value=''></td>
			</tr>
			<tr>
			<th>新しいパスワード</th>
			<td><span id='err_userpswd_new' class='error'></span><input type='password' name='userpswd_new' id='userpswd_new' value=''></td>
			</tr>
			<tr>
			<th>コース選択</th>
			<td>
		";
		for($i = 0; $i < count($hdata); $i++){
			if($hdata[$i]['attrcd'] == $_SESSION['logincs']){
				$html .= $hdata[$i]['attrname'];
			}
		}
		$html .= "
			</td>
			</tr>
			</table>
			</form>
			<button class='customize' id='toMypage' type='submit'>戻る</button>
			<button class='customize' id='toUpdateUserControl' type='button' onClick='toConfirm();'>更新内容を確認する</button>
		";
		return $html;
	}
	function getMainConfirm($data){
		$html = "
			<form id='updateUserDataForm' name='updateUserDataForm'>
			<table id='custom_admin' >
			<input type='hidden' id='type' name='type' value='complete'>
			<input type='hidden' id='userid' name='userid' value='".$_SESSION['userid']."'>
			<input type='hidden' id='email' name='email' value='".$_SESSION['email']."'>
			<input type='hidden' id='userpswd_new' name='userpswd_new' value='".$_SESSION['userpswd_new']."'>
			<tr>
			<th>表示名</th>
			<td>".$_SESSION['userid']."</td>
			</tr>
			<tr>
			<th>メールアドレス</th>
			<td>".$_SESSION['email']."</td>
			</tr>
			<tr>
			<th>パスワード</th>
			<td>
		";
		if(!empty($_SESSION['userpswd_new'])){
			$html .= "変更されています";
		}
		else{
			$html .= "変更なし";
		}
		$html .= "
			</td>
			</tr>
			<tr>
			<th>コース選択</th>
			<td>
		";
		for($i = 0; $i < count($data); $i++){
			if($data[$i]['attrcd'] == $_SESSION['logincs']){
				$html .= $data[$i]['attrname'];
			}
		}
		$html .= "
			</td>
			</tr>
			</table>
			</form>
			<button class='customize' id='toUpdateUserData' type='submit'>戻る</button>
			<button class='customize' id='toUpdateUserControl' type='button' onClick='toComplete();'>更新する</button>
		";
		return $html;
	}
}
