<?php
class ResultExecTestView {
	function img($name, $imgfilenm){
		$html = "<img alt='".$name."' title='".$name."' src='".$imgfilenm."'>";
		return $html;
	}
	function twitter($img, $val){
		$html = "<a href='https://twitter.com/share' class='twitter-share-button' data-text='テスト' data-url='http://www.goodworks-labo.com/share.php?img=".$img."&val=".$val."' data-lang='ja' data-count='vertical' data-dnt='true'>ツイート</a>";
		return $html;
	}
	function facebook($img, $val){
		$html = "<div class='fb-like' data-href='http://www.goodworks-labo.com/share.php?img=".$img."&val=".$val."' data-layout='box_count' data-action='like' data-show-faces='true' data-share='true'></div>";
		return $html;
	}
	function line($img, $val){
		$txt = "テスト。http://www.goodworks-labo.com/share.php?img=".$img."&val=".$val."";
		//$html = "<a href='http://line.me/R/msg/text/?".urlencode($txt)."'><img src='/img/linebutton_36x60.png' width='36' height='60' alt='LINEに送る' class='sc-li-img'></a>";
		$html = "<a href='http://line.me/R/msg/text/?".$txt."'><img src='/img/linebutton_36x60.png' width='36' height='60' alt='LINEに送る' class='sc-li-img'></a>";
		return $html;
	}
}
