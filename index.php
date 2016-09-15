<?php
session_start();

if(!isset($_SESSION['loginid']) || empty($_SESSION['loginid'])){
	$_SESSION = array();
}
else{
	header("HTTP/1.1 301 Moved Permanently");
	header("Location: /mypage.php");
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
<!--		<script type='text/javascript' src='js/index.js'></script>-->
<!--		<title>TOPページ</title>-->
<!--	</head>-->
<!--	<body>-->
<!--		<div id='content'>-->
<!--			<div id='header'>-->
<!--				<h2>TOPページ</h2>-->
<!--			</div>-->
<!--			<div id='main'>-->
<!--				<table class='index_table'>-->
<!--				<tr>-->
<!--				<td><button class='customize index_buttons' id='toLogin' type='submit'>ログイン</button></td>-->
<!--				<td><button class='customize index_buttons' id='toInputAttribute' type='submit'>アンケートに<br>答える</button></td>-->
<!--				</tr>-->
<!--				</table>-->
<!--			</div>-->
<!--			<div id='footer'>-->
<!--			</div>-->
<!--		</div>-->
<!--	</body>-->
<!--    <script type="text/javascript">-->
<!--        var $zoho= $zoho || {salesiq:{values:{},ready:function(){}}};var d=document;s=d.createElement("script");s.type="text/javascript";-->
<!--        s.defer=true;s.src="https:/salesiq.zoho.com/jica/float.ls?embedname=chat";-->
<!--        t=d.getElementsByTagName("script")[0];t.parentNode.insertBefore(s,t);-->
<!--        $zoho.salesiq.ready=function(embedinfo){$zoho.salesiq.floatbutton.visible("hide");}-->
<!--    </script>-->
<!--</html>-->
<!---->
<!DOCTYPE html>
<html lang="ja" prefix="og: http:/ogp.me/ns#"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>マインドモンスター</title>
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
</head>

<body class="home blog logged-in admin-bar  customize-support" style="visibility: visible;">
<div id="page" class="hfeed site">
    <header id="masthead" class="site-header" role="banner">
        <div class="container">
            <div class="col-sm-12">
                <div class="site-branding">
                    <div class="site-branding_text">
                        <h1 class="site-title"><a href="/" rel="home">マインドモンスター</a></h1>
                        <p class="site-description"></p>
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
                            <div class="entry-content">
                                <p>マインドモンスターとは？</p>

                            </div><!-- .entry-content -->
                            <div class="entry-content">
                                <p>マインドモンスターとは、３５問のセルフチェックを答えていただきます。
                                    問は東洋思想である「陰陽五行説」に準じた５つの感情を元に構成されており、回答に応じたモンスターを出現させ、現在の心理状況をセルフチェック出来るように設計されております。</p>
                                <p>お気軽にチェックしてみてください！</p>
                            </div><!-- .entry-content -->
                            <div class="more-link">
                                <a href="./inputAttribute.php">セルフチェックを始める</a>	</div>
                    </main><!-- #main -->
                </div><!-- #primary -->
            </div>
        </div><!-- .container -->

    </div><!-- #content -->
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