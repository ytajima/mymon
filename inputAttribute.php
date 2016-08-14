<?php
session_start();
?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset='UTF-8'>
		<meta http-equiv='Pragma' content='no-cache' />
		<meta http-equiv='cache-control' content='no-cache' />
		<meta http-equiv='expires' content='0' />
		<meta name="viewport" content="initial-scale=1.0" />
		<link rel='stylesheet' href='css/common_for_sp_320.css' type='text/css'  media='screen' />
		<link rel='stylesheet' href='css/common_for_sp_375.css' type='text/css'  media='screen' />
		<link rel='stylesheet' href='css/common.css' type='text/css'  media='screen' />
		<script type='text/javascript'  src='js/common/jquery-1.11.1.min.js'></script>
		<script type='text/javascript' src='js/inputAttribute.js'></script>
		<title>アンケート</title>
	</head>
	<body>
		<div id='content'>
			<div id='header'>
				<h2>アンケート</h2>
			</div>
			<div id='main'>
				<form id='inputAttributeForm' name='inputAttributeForm'>
				<input type="hidden" name='type' value='commit'>
				<table id='custom_admin' >
					<tr>
					<th>年代</th><td id='content'><select id='age' name='age'></select></td>
					</tr>
					<tr>
					<th>性別</th><td id='content'><select id='gender' name='gender'></select></td>
					</tr>
					<tr>
					<td colspan='2'>
						<button class='customize' id='toIndex' type='submit'>戻る</button>
						<button class='customize' id='toInputAttributeControl' type='submit'>テストを受ける</button>
					</td>
					</tr>
				</table>
			</div>
			<div id='footer'>
			</div>
		</div>
	</body>
</html>
