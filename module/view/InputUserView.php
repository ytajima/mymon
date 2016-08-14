<?php
class InputUserView {
	function getMain($data){
		if(!isset($_SESSION['userid'])){
			// セッション情報の初期化
			$_SESSION['userid'] = '';
			$_SESSION['userpswd'] = '';
			$_SESSION['userpswd_conf'] = '';
			$_SESSION['email'] = '';
			$_SESSION['course'] = '';
		}
		$html = "
			<form id='inputUserDataForm' name='inputUserDataForm'>
			<table id='custom_admin' >
			<input type='hidden' name='csrf-requested-token' value='".$_SESSION['csrf-requested-token']."'>
			<input type='hidden' id='type' name='type' value='confirm'>
			<tr>
			<th>表示名</th>
			<td><span id='err_userid' class='error'></span><input type='text' name='userid' id='userid' value='".$_SESSION['userid']."'></td>
			</tr>
			<tr>
			<th>メールアドレス</th>
			<td><span id='err_email' class='error'></span><input type='text' name='email' id='email' value='".$_SESSION['email']."'></td>
			</tr>
			<tr>
			<th>パスワード</th>
			<td><span id='err_userpswd' class='error'></span><input type='password' name='userpswd' id='userpswd' value='".$_SESSION['userpswd']."'></td>
			</tr>
			<tr>
			<th>確認用パスワード</th>
			<td><span id='err_userpswd_conf' class='error'></span><input type='password' name='userpswd_conf' id='userpswd_conf' value='".$_SESSION['userpswd_conf']."'></td>
			</tr>
			<tr>
			<th>コース選択</th>
			<td><select id='course' name='course'>
		";
		for($i = 0; $i < count($data); $i++){
			if($data[$i]['attrcd'] == $_SESSION['course']){
				$html .= "<option value='".$data[$i]['attrcd']."' selected>".$data[$i]['attrname']."</option>";
			}
			else{
				$html .= "<option value='".$data[$i]['attrcd']."'>".$data[$i]['attrname']."</option>";
			}
		}
		$html .= "
			</select></td>
			</tr>
			</table>
			</form>
			<button class='customize' id='toInputUserControl' type='button' onClick='toConfirm();'>登録内容を確認する</button>
		";
		return $html;
	}
	function getMainConfirm($data){
		$html = "
			<form id='inputUserDataForm' name='inputUserDataForm'>
			<table id='custom_admin' >
			<input type='hidden' name='csrf-requested-token' value='".$_SESSION['csrf-requested-token']."'>
			<input type='hidden' id='type' name='type' value='complete'>
			<input type='hidden' id='userid' name='userid' value='".$_SESSION['userid']."'>
			<input type='hidden' id='email' name='email' value='".$_SESSION['email']."'>
			<input type='hidden' id='course' name='course' value='".$_SESSION['course']."'>
			<input type='hidden' id='userpswd' name='userpswd' value='".$_SESSION['userpswd']."'>
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
			<td>非表示</td>
			</tr>
			<tr>
			<th>コース選択</th>
			<td>
		";
		for($i = 0; $i < count($data); $i++){
			if($data[$i]['attrcd'] == $_SESSION['course']){
				$html .= $data[$i]['attrname'];
			}
		}
		$html .= "
			</td>
			</tr>
			</table>
			</form>
			<button class='customize' id='toInputUserData' type='submit'>戻る</button>
			<button class='customize' id='toInputUserControl' type='button' onClick='toComplete();'>登録する</button>
		";
		return $html;
	}
}
