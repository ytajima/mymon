<?php
class Debug {
	function getMain($hdata){
		$html = "
			<form id='updateDebugDataForm' name='updateDebugDataForm'>
			<table id='custom_admin' >
			<input type='hidden' id='type' name='type' value='confirm'>
			<tr>
			<!-- start debug -->
			<th>育成完了日時　※デバッグ時のみ使用</th>
			<td><span id='err_limit' class='error'></span><input type='text' name='limit' id='limit' value='".$_SESSION['limit']."'></td>
			</tr>
			<!-- end debug -->
			</table>
			</form>
			<br>
			<button class='customize' id='toMypage' type='submit'>戻る</button>
			<button class='customize' id='toUpdateDebugControl' type='button' onClick='toConfirm();'>更新内容を確認する</button>
		";
		return $html;
	}
	function getMainConfirm($data){
		$html = "
			<form id='updateDebugDataForm' name='updateDebugDataForm'>
			<table id='custom_admin' >
			<input type='hidden' id='type' name='type' value='complete'>
			<input type='hidden' id='Debugid' name='Debugid' value='".$_SESSION['Debugid']."'>
			<input type='hidden' id='email' name='email' value='".$_SESSION['email']."'>
			<!-- start debug -->
			<input type='hidden' id='limit' name='limit' value='".$_SESSION['limit']."'>
			<!-- end debug -->
			<!-- start debug -->
			<tr>
			<th>育成完了日時　※デバッグ時のみ使用</th>
			<td>".$_SESSION['limit']."</td>
			</tr>
			<!-- end debug -->

			</table>
			</form>
			<button class='customize' id='toUpdateDebugData' type='submit'>戻る</button>
			<button class='customize' id='toUpdateDebugControl' type='button' onClick='toComplete();'>更新する</button>
		";
		return $html;
	}
}
