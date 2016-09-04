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
<!--		<link rel="stylesheet" href="css/share-button.css" type='text/css'  media='screen' />-->
<!--		<script type='text/javascript' src='js/common/jquery-1.11.1.min.js'></script>-->
<!--		<script type='text/javascript' src="js/share-button.js"></script>-->
<!--		<script type='text/javascript' src='js/resultExecTest.js'></script>-->
<!--		<title>テスト結果表示</title>-->
<!--	</head>-->
<!--	<body>-->
<!--		<div id='content'>-->
<!--			<div id='header'>-->
<!--				<h2>テスト結果表示</h2>-->
<!--			</div>-->
<!--			<div id='main'>-->
<!--				<div id='main_left'>-->
<!--					<table id='custom_admin_left' >-->
<!--						<tr>-->
<!--						<th id='charanm'></th>-->
<!--						</tr>-->
<!--						<tr>-->
<!--						<td id='resultImg'></td>-->
<!--						</tr>-->
<!--					</table>-->
<!--				</div>-->
<!--				<div id='main_right'>-->
<!--					<table id='custom_admin_right' >-->
<!--						<tr>-->
<!--						<th>コメント</th>-->
<!--						</tr>-->
<!--						<tr>-->
<!--						<td id='resultCmt'></td>-->
<!--						</tr>-->
<!--					</table>-->
<!--				</div>-->
<!--				<div id='clear'>-->
<!--					<button class='customize' id='toIndex' type='submit'>終了する</button>-->
<!--					<button class='customize' id='toInputUserData' type='submit'>ユーザ登録に進む</button>-->
<!--				</div>-->
<!--			</div>-->
<!--			<div id='footer'>-->
<!--			</div>-->
<!--			<div class="social-area">-->
<!--				<ul class="social-button">-->
<!--					<!-- Twitter -->-->
<!--					<li id='twitter' class="sc-tw"></li>-->
<!--					<!-- Facebook -->-->
<!--					<li id='facebook' class="sc-fb"></li>-->
<!--					<!-- LINE -->-->
<!--					<li id='line' class="sc-li"></li>-->
<!--				</ul>-->
<!--				<!-- Facebook用 -->-->
<!--				<div id="fb-root"></div>-->
<!--			</div>-->
<!--		</div>-->
<!--<script type="text/javascript">-->
<!--var $zoho= $zoho || {salesiq:{values:{},ready:function(){}}};var d=document;s=d.createElement("script");s.type="text/javascript";-->
<!--s.defer=true;s.src="https://salesiq.zoho.com/jica/float.ls?embedname=chat";-->
<!--t=d.getElementsByTagName("script")[0];t.parentNode.insertBefore(s,t);-->
<!--$zoho.salesiq.ready=function(embedinfo){$zoho.salesiq.floatbutton.visible("hide");}-->
<!--</script>-->
<!--	</body>-->
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
    <meta property="og:title" content="マイモンカウンセリング">
    <meta property="og:description" content="">
    <meta property="og:url" content="http:/mymon.yourtalk.net/">
    <meta property="og:site_name" content="マイモンカウンセリング">
    <meta name="twitter:card" content="summary">
    <meta name="twitter:description" content="">
    <meta name="twitter:title" content="マイモンカウンセリング">

    <link rel="stylesheet" id="bootstrap-style-css" href="/css/bootstrap.css" type="text/css" media="all">
    <link rel="stylesheet" id="brood-style-css" href="/css/style.css" type="text/css" media="all">
    <link rel="stylesheet" href="/css/share-button.css" type='text/css'  media='screen' />
    <script type="text/javascript" src="/js/jquery.js"></script>
    <script type="text/javascript" src="/js/jquery-migrate.min.js"></script>
    <script type="text/javascript" src="/js/sakura.js"></script>
    <script type="text/javascript" src="/js/bootstrap.js"></script>
    <script type='text/javascript' src='/js/common/jquery-1.11.1.min.js'></script>
    <script type='text/javascript' src='/js/resultExecTest.js'></script>
    <title>心理テスト</title>
</head>

<body class="home blog logged-in admin-bar  customize-support" style="visibility: visible;">
<div id="page" class="hfeed site">
    <header id="masthead" class="site-header" role="banner">
        <div class="container">
            <div class="col-sm-12">
                <div class="site-branding">
                    <div class="site-branding_text">
                        <h1 class="site-title"><a href="/" rel="home">マイモンカウンセリング</a></h1>
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
                    <ul class="nav navbar-nav"><li><a href="./inputAttribute.php">心理テスト</a></li></ul>
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

                                <h2 class="entry-title">テスト結果表示</h2>
                            </header>
                            <div id='main'>
                                <div id='main_left'>
                                    <table id='custom_admin_left' >
                                        <tr>
                                        <th id='charanm'></th>
                                        </tr>
                                        <tr>
                                        <td id='resultImg'></td>
                                        </tr>
                                    </table>
                                </div>
                                <div id='main_right'>
                                    <table id='custom_admin_right' >
                                        <tr>
                                        <th>コメント</th>
                                        </tr>
                                        <tr>
                                        <td id='resultCmt'></td>
                                        </tr>
                                    </table>
                                </div>
<!--                                <div id='clear'>-->
<!--                                    <button class='customize' id='toIndex' type='submit'>終了する</button>-->
<!--                                    <button class='customize' id='toInputUserData' type='submit'>ユーザ登録に進む</button>-->
<!--                                </div>-->
                            </div>
                            <div id='footer'>
                            </div>
                            <div class="social-area">
                                <ul class="social-button">
                                    <!-- Twitter -->
                                    <li id='twitter' class="sc-tw"></li>
                                    <!-- Facebook -->
                                    <li id='facebook' class="sc-fb"></li>
                                    <!-- LINE -->
                                    <li id='line' class="sc-li"></li>
                                </ul>
                                <!-- Facebook用 -->
                                <div id="fb-root"></div>
                            </div>
                    </main><!-- #main -->
                </div><!-- #primary -->
            </div>
        </div><!-- .container -->

    </div><!-- #content -->
    <footer id="colophon" class="site-footer" role="contentinfo">
        <div class="site-info">
            Proudly Powered by mymon<span class="sep"></span></div><!-- .site-info -->
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