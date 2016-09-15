<?php
session_start();

if(!isset($_SESSION['csrf-requested-token']) || empty($_SESSION['csrf-requested-token'])){
	header("HTTP/1.1 301 Moved Permanently");
	header("Location: /index.php");
	exit;
}
?>

<!--<!DOCTYPE html>-->
<!--<html>-->
<!--	<head>-->
<!--		<meta charset='UTF-8'>-->
<!--		<meta http-equiv='Pragma' content='no-cache' />-->
<!--		<meta http-equiv='cache-control' content='no-cache' />-->
<!--		<meta http-equiv='expires' content='0' />-->
<!--		<meta name="viewport" content="initial-scale=1.0" />-->
<!--		<link rel='stylesheet' href='css/common_for_sp_320.css' type='text/css'  media='screen' />-->
<!--		<link rel='stylesheet' href='css/common_for_sp_375.css' type='text/css'  media='screen' />-->
<!--		<link rel='stylesheet' href='css/common.css' type='text/css'  media='screen' />-->
<!--		<script type='text/javascript'  src='js/common/jquery-1.11.1.min.js'></script>-->
<!--		<script type='text/javascript' src='js/inputExecTest.js'></script>-->
<!--		<title>マイモンチェック</title>-->
<!--	</head>-->
<!--	<body>-->
<!--		<div id='content'>-->
<!--			<div id='header'>-->
<!--				<h2>マイモンチェック</h2>-->
<!--			</div>-->
<!--			<div id='main'>-->
<!--				<form id='inputExecTestForm' name='inputExecTestForm'>-->
<!--				<input type="hidden" name='csrf-requested-token' value='--><?//= $_SESSION['csrf-requested-token']?><!--'>-->
<!--				<input type="hidden" id='contentid' name='contentid' value=''>-->
<!--				<input type="hidden" id='type' name='type' value='next'>-->
<!--				<div id='contentData'>-->
<!--				</div>-->
<!--				<table class='index_table'>-->
<!--					<tr>-->
<!--						<td id='answer_select'>-->
<!--							<input type='radio' name='answer' id='on' value='0'>-->
<!--							<label for='on' class='switch-on'>はい</label>-->
<!--							<input type='radio' name='answer' id='off' value='1'>-->
<!--							<label for='off' class='switch-off'>いいえ</label>-->
<!--						</td>-->
<!--					</tr>-->
<!--					<tr>-->
<!--						<td>-->
<!--							<button class='customize' id='toBack' type='submit'>前に戻る</button>-->
<!--							&nbsp;<span id ='pagenate'><span id ='questionNum'></span>/<span id ='maxcount'></span></span>&nbsp;-->
<!--							<button class='customize' id='toExecTestControl' type='submit'>次の質問へ</button>-->
<!--						</td>-->
<!--					</tr>-->
<!--				</table>-->
<!--				</form>-->
<!--			</div>-->
<!--			<div id='footer'>-->
<!--			</div>-->
<!--		</div>-->
<!--		<div id="modal-content">-->
<!--			<p>分析処理中・・・</p>-->
<!--		</div>-->
<!--		<div id="modal-overlay"></div>-->
<!--<script type="text/javascript">-->
<!--    var $zoho= $zoho || {salesiq:{values:{},ready:function(){}}};var d=document;s=d.createElement("script");s.type="text/javascript";-->
<!--    s.defer=true;s.src="https://salesiq.zoho.com/jica/float.ls?embedname=chat";-->
<!--    t=d.getElementsByTagName("script")[0];t.parentNode.insertBefore(s,t);-->
<!--    $zoho.salesiq.ready=function(embedinfo){$zoho.salesiq.floatbutton.visible("hide");}-->
<!--</script>-->
<!--</body>-->
<!--</html>-->
<!DOCTYPE html>
<html lang="ja" prefix="og: http:/ogp.me/ns#"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta charset='UTF-8'>
    <meta http-equiv='Pragma' content='no-cache' />
    <meta http-equiv='cache-control' content='no-cache' />
    <meta http-equiv='expires' content='0' />
    <meta name="description" content="">
    <meta name="robots" content="noindex,follow,noodp">
    <link rel="canonical" href="http:/mymon.yourtalk.net/">
    <meta property="og:locale" content="ja_JP">
    <meta property="og:type" content="website">
    <meta property="og:title" content="マインドモンスター">
    <meta property="og:description" content="">
    <meta property="og:url" content="http:/mymon.yourtalk.net/">
    <meta property="og:site_name" content="マインドモンスター">
    <meta name="twitter:card" content="summary">
    <meta name="twitter:description" content="">
    <meta name="twitter:title" content="マインドモンスター">

    <link rel="stylesheet" id="bootstrap-style-css" href="/css/bootstrap.css" type="text/css" media="all">
    <link rel="stylesheet" id="brood-style-css" href="/css/style.css" type="text/css" media="all">
    <script type="text/javascript" src="/js/jquery.js"></script>
    <script type="text/javascript" src="/js/jquery-migrate.min.js"></script>
    <script type="text/javascript" src="/js/sakura.js"></script>
    <script type="text/javascript" src="/js/bootstrap.js"></script>
    <script type='text/javascript' src='/js/common/jquery-1.11.1.min.js'></script>
    <script type='text/javascript' src='/js/inputExecTest.js'></script>
    <title>マイモンチェック</title>
</head>

<body class="home blog logged-in admin-bar  customize-support" style="visibility: visible;">
<div id="page" class="hfeed site">
    <header id="masthead" class="site-header" role="banner">
        <div class="container">
            <div class="col-sm-12">
                <div class="site-branding">
                    <div class="site-branding_text">
                        <h1 class="site-title"><a href="/" rel="home">マインドモンスター</a></h1>
                        <p class="site-description">
                        </p>
                    </div><!-- .site-branding_text -->
                    <button data-target="#site-navigation" data-toggle="collapse" class="navbar-toggle" type="button" aria-expanded="true">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                </div><!-- .site-branding -->
                <nav id="site-navigation" class="main-navigation navbar-collapse collapse" role="navigation">
<!--                    <ul class="nav navbar-nav"><li><a href="./login.php">ログイン</a></li></ul>-->
                    <ul class="nav navbar-nav"><li><a href="./inputAttribute.php">マイモンチェック</a></li></ul>
                </nav><!-- #site-navigation -->
            </div>
        </div>
    </header><!-- #masthead -->
    <div id="content" class="site-content">
        <div class="container">
            <div class="col-md-8">
                <div id="primary" class="content-area">
                    <main id="main" class="site-main" role="main">
                        <article id="post-1" class="post-1 post type-post status-publish format-standard hentry category-1">
                            <header class="entry-header">

                                <h2 class="entry-title">マイモンチェック</h2>
                            </header>
                            <div id='main'>
                                <form id='inputExecTestForm' name='inputExecTestForm'>
                                <input type="hidden" name='csrf-requested-token' value='<?= $_SESSION['csrf-requested-token']?>'>
                                <input type="hidden" id='contentid' name='contentid' value=''>
                                <input type="hidden" id='type' name='type' value='next'>
                                <div id='contentData'>
                                </div>
                                <table class='index_table'>
                                    <tr>
                                        <td id='answer_select'>
                                            <input type='radio' name='answer' id='on' value='0'>
                                            <label for='on' class='switch-on'>はい</label>
                                            <input type='radio' name='answer' id='off' value='1'>
                                            <label for='off' class='switch-off'>いいえ</label>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="more-link">
                                                <button class='customize' id='toBack' type='submit'>前に戻る</button>
                                                &nbsp;<span id ='pagenate'><span id ='questionNum'></span>/<span id ='maxcount'></span></span>&nbsp;
                                                <button class='customize' id='toExecTestControl' type='submit' >次の質問へ</button>
                                            </div>
<!--                                            <div class="more-link">-->
<!--                                                <a href="javascript" id='toBack' type='submit'>前に戻る</a>-->
<!--                                                &nbsp;<span id ='pagenate'><span id ='questionNum'></span>/<span id ='maxcount'></span></span>&nbsp;-->
<!--                                                <a href="javascript" id='toExecTestControl' type='submit'>次の質問へ</a>-->
<!--                                            </div>-->
                                        </td>
                                    </tr>
                                </table>
                                </form>
                            </div>
                    </main><!-- #main -->
                </div><!-- #primary -->
            </div>
        </div><!-- .container -->
    </div><!-- #content -->
    <div id="modal-content">
        <p>分析処理中・・・</p>
    </div>
    <div id="modal-overlay"></div>

    <footer id="colophon" class="site-footer" role="contentinfo">
        <div class="site-info">
            ©Copyright2016 「自己受容」 実践サイト.All Rights Reserved.<span class="sep"></span></div><!-- .site-info -->
    </footer><!-- #colophon -->
</div><!-- #page -->
<script type="text/javascript">
    var $zoho= $zoho || {salesiq:{values:{},ready:function(){}}};var d=document;s=d.createElement("script");s.type="text/javascript";
    s.defer=true;s.src="https://salesiq.zoho.com/jica/float.ls?embedname=chat";
    t=d.getElementsByTagName("script")[0];t.parentNode.insertBefore(s,t);
    $zoho.salesiq.ready=function(embedinfo){$zoho.salesiq.floatbutton.visible("hide");}
</script>
</body>
</html>