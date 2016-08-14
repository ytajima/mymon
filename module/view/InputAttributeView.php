<?php
class InputAttributeView {
	function selectOptions($data){
		$html = "";
		for($i = 0; $i < count($data); $i++){
			$html .= "<option value='".$data[$i]['attrcd']."'>".$data[$i]['attrname']."</option>";
		}
		return $html;
	}
}
