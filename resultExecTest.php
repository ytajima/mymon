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
<!--					<!-- Twitter -->
<!--					<li id='twitter' class="sc-tw"></li>-->
<!--					<!-- Facebook -->
<!--					<li id='facebook' class="sc-fb"></li>-->
<!--					<!-- LINE -->
<!--					<li id='line' class="sc-li"></li>-->
<!--				</ul>-->
<!--				<!-- Facebook用 -->
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
    <meta property="og:title" content="マインドモンスター">
    <meta property="og:description" content="">
    <meta property="og:url" content="http:/mymon.yourtalk.net/">
    <meta property="og:site_name" content="マインドモンスター">
    <meta name="twitter:card" content="summary">
    <meta name="twitter:description" content="">
    <meta name="twitter:title" content="マインドモンスター">

    <link rel="stylesheet" id="bootstrap-style-css" href="/css/bootstrap.css" type="text/css" media="all">
    <link rel="stylesheet" id="brood-style-css" href="/css/style.css" type="text/css" media="all">
    <link rel="stylesheet" href="/css/font-awesome.min.css" type='text/css'  media='screen' />
    <script type="text/javascript" src="/js/jquery.js"></script>
    <script type="text/javascript" src="/js/jquery-migrate.min.js"></script>
    <script type="text/javascript" src="/js/sakura.js"></script>
    <script type="text/javascript" src="/js/bootstrap.js"></script>
    <script type='text/javascript' src='/js/common/jquery-1.11.1.min.js'></script>
    <script type='text/javascript' src='/js/resultExecTest.js'></script>
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

                                <h2 class="entry-title">マイモンチェック結果</h2>
                            </header>
                            <div id='main'>
                                <table id='custom_admin_left' >
                                    <tr>
                                    <th id='charanm'></th>
                                    </tr>
                                    <tr>
                                    <td id='resultImg'></td>
                                    </tr>
                                </table>
                                <table id='custom_admin_right' >
                                    <tr>
                                    <th>コメント</th>
                                    </tr>
                                    <tr>
                                    <td id='resultCmt'></td>
                                    </tr>
                                </table>

                                <div class="entry-header">
                                    <h2 class="entry-title">自己肯定率
                                        <div id='selfPositiveRate' class="self-positive-rate">
                                        </div>
                                        ％
                                    </h2>
                                </div>
<!--                                <div id='clear'>-->
<!--                                    <button class='customize' id='toIndex' type='submit'>終了する</button>-->
<!--                                    <button class='customize' id='toInputUserData' type='submit'>ユーザ登録に進む</button>-->
<!--                                </div>-->
                            </div>
                            <div class="share short">
                                <div class="sns">
                                    <ul class="clearfix">
                                        <!--ツイートボタン-->
                                        <li class="twitter">
                                            <a target="blank" href="http://twitter.com/intent/tweet?url=http://mymon.yourtalk.net/index.php&text=マインドモンスター&tw_p=tweetbutton" onclick="window.open(this.href, 'tweetwindow', 'width=550, height=450,personalbar=0,toolbar=0,scrollbars=1,resizable=1'); return false;"><i class="fa fa-twitter"></i><span class="text">ツイート</span><span class="count"></span></a>
                                        </li>

                                        <!--Facebookボタン-->
                                        <li class="facebook">
                                            <a href="http://www.facebook.com/sharer.php?src=bm&u=http://mymon.yourtalk.net/index.php&t=" onclick="javascript:window.open(this.href, '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=300,width=600');return false;"><i class="fa fa-facebook"></i>
                                                <span class="text">シェア</span><span class="count"></span></a>
                                        </li>

                                        <!--はてブボタン-->
                                        <li class="hatebu">
                                            <a href="http://b.hatena.ne.jp/add?mode=confirm&url=http://mymon.yourtalk.net/index.php&title=マインドモンスター" onclick="window.open(this.href, 'HBwindow', 'width=600, height=400, menubar=no, toolbar=no, scrollbars=yes'); return false;" target="_blank"><span class="text">はてブ</span><span class="count"></span></a>
                                        </li>

                                        <!--Google+1ボタン-->
                                        <li class="googleplus">
                                            <a href="https://plusone.google.com/_/+1/confirm?hl=ja&url=http://mymon.yourtalk.net/index.php" onclick="window.open(this.href, 'window', 'width=550, height=450,personalbar=0,toolbar=0,scrollbars=1,resizable=1'); return false;" rel="tooltip" data-toggle="tooltip" data-placement="top" title="GooglePlusで共有"><i class="fa fa-google-plus"></i><span class="text">Google+</span><span class="count"></span></a>
                                        </li>

                                        <!--ポケットボタン-->
                                        <li class="pocket">
                                            <a href="http://getpocket.com/edit?url=http://mymon.yourtalk.net/index.php&title=マインドモンスター" onclick="window.open(this.href, 'FBwindow', 'width=550, height=350, menubar=no, toolbar=no, scrollbars=yes'); return false;"><i class="fa fa-get-pocket"></i><span class="text">Pocket</span><span class="count"></span></a></li>
                                    </ul>
                                </div>
                            </div>

                            <hr size="3" />
                            <div class="column-wrap cf ">
                                <div class="d-1of3 t-1of3 m-all">
                                    <a href="http://jikojyuyou.com/tore/"><img class="alignnone size-medium wp-image-74" src="http://glad.heteml.jp/ms/wp-content/uploads/2016/08/Fotolia_106545160_XS-300x200.jpg" alt="The women have a discussion with a smile" width="300" height="200" srcset="http://jikojyuyou.com/wp-content/uploads/2016/08/Fotolia_106545160_XS-300x200.jpg 300w, http://jikojyuyou.com/wp-content/uploads/2016/08/Fotolia_106545160_XS.jpg 424w" sizes="(max-width: 300px) 100vw, 300px" /></a></p>
                                    <div align="center"><a href="http://jikojyuyou.com/tore/">自己受容/実践トレーニング</a></div>
                                </div>
                                <div class="d-1of3 t-1of3 m-all"><a href="http://jikojyuyou.com/post_lp/semi/"><img class="alignnone size-medium wp-image-72" src="http://glad.heteml.jp/ms/wp-content/uploads/2016/08/Fotolia_115139310_XS-300x200.jpg" alt="講習会" width="300" height="200" srcset="http://jikojyuyou.com/wp-content/uploads/2016/08/Fotolia_115139310_XS-300x200.jpg 300w, http://jikojyuyou.com/wp-content/uploads/2016/08/Fotolia_115139310_XS.jpg 424w" sizes="(max-width: 300px) 100vw, 300px" /></a></p>
                                    <div align="center"><a href="http://jikojyuyou.com/post_lp/semi/">セミナーの情報はこちらから</a></div>
                                </div>
                                <div class="d-1of3 t-1of3 m-all"><a href="http://p.yourtalk.net/self/"><img class="alignnone size-medium wp-image-73" src="http://glad.heteml.jp/ms/wp-content/uploads/2016/08/Fotolia_93745114_XS-300x200.jpg" alt="日本の僧" width="300" height="200" srcset="http://jikojyuyou.com/wp-content/uploads/2016/08/Fotolia_93745114_XS-300x200.jpg 300w, http://jikojyuyou.com/wp-content/uploads/2016/08/Fotolia_93745114_XS.jpg 424w" sizes="(max-width: 300px) 100vw, 300px" /></a></p>
                                    <div align="center"><a href="http://p.yourtalk.net/self/">禅・こころの合宿</a></div>
                                </div>
                            </div>
                            <hr size="3" />
                            <div class="column-wrap cf ">
                                <div class="d-1of3 t-1of3 m-all">
                                    <a href="http://yourtalk.net/"><img class="alignnone size-medium wp-image-81" src="http://glad.heteml.jp/ms/wp-content/uploads/2016/08/yourtalk-300x183.jpg" alt="yourtalk" width="300" height="183" srcset="http://jikojyuyou.com/wp-content/uploads/2016/08/yourtalk-300x183.jpg 300w, http://jikojyuyou.com/wp-content/uploads/2016/08/yourtalk-768x469.jpg 768w, http://jikojyuyou.com/wp-content/uploads/2016/08/yourtalk.jpg 933w" sizes="(max-width: 300px) 100vw, 300px" /></a></p>
                                    <div align="center"><a href="http://yourtalk.net/">YourTalk ゆっとく!?サイト</a></div>
                                </div>
                                <div class="d-1of3 t-1of3 m-all"><a href="http://mymon.yourtalk.net/index.php"><img class="alignnone size-medium wp-image-92" src="http://glad.heteml.jp/ms/wp-content/uploads/2016/08/hi-1-300x185.jpg" alt="hi" width="300" height="185" /></a></p>
                                    <div align="center"><a href="http://mymon.yourtalk.net/index.php">マインドモンスター</a></div>
                                </div>
                                <div class="d-1of3 t-1of3 m-all"><a href="http://jikojyuyou.com/ari/"><img class="alignnone size-medium wp-image-83" src="http://glad.heteml.jp/ms/wp-content/uploads/2016/08/ありのまま図２-300x185.jpg" alt="ありのまま図２" width="300" height="185" srcset="http://jikojyuyou.com/wp-content/uploads/2016/08/ありのまま図２-300x185.jpg 300w, http://jikojyuyou.com/wp-content/uploads/2016/08/ありのまま図２.jpg 464w" sizes="(max-width: 300px) 100vw, 300px" /></a></p>
                                    <div align="center"><a href="http://jikojyuyou.com/ari/">ありのままの自分動画解説</a></div>
                                </div>
                            </div>

                            <p>&nbsp;</p><h1 style="text-align: center;">
                                <span style="font-size: 24pt; background-color: #ffff00;">ご登録はお済ですか！？</span></h1><p style="text-align: center;">最新の情報をお伝えいたします！！</p><table class="submit" style="border: 2px solid #000000; height: 380px; width: 100%; background-color: #f3f1f2;" border="2" frame="border" rules="all" align="center"><tbody><tr><td style="width: 100%;"><dl><!-- Note :
   - You can modify the font style and form style to suit your website.
   - Code lines with comments “Do not remove this code”  are required for the form to work properly, make sure that you do not remove these lines of code.
   - The Mandatory check script can modified as to suit your business needs.
   - It is important that you test the modified form before going live.-->
                                        </dl><div id="crmWebToEntityForm" style="width: 100%; margin: auto; text-align: center;"><form accept-charset="UTF-8" action="https://crm.zoho.com/crm/WebToLeadForm" method="POST" name="WebToLeads1401379000001120001"><!-- Do not remove this code. --> <input style="display: none;" name="xnQsjsdp" type="text" value="4ded5f79135d4f50336b0869e5905005626168f994583a26d1704c092c00a794" /> <input id="zc_gad" name="zc_gad" type="hidden" value="" /> <input style="display: none;" name="xmIwtLD" type="text" value="5e973a9e38e2a656594a7304e171628fe1ea1b672a72f844d2a48097d4b1c2f6" /> <input style="display: none;" name="actionType" type="text" value="TGVhZHM=" /> <input style="display: none;" name="returnURL" type="text" value="http://mymon.yourtalk.net/index.php" /> <!-- Do not remove this code. --> <input id="ldeskuid" style="display: none;" name="ldeskuid" type="text" /> <input id="LDTuvid" style="display: none;" name="LDTuvid" type="text" /><table style="width: 90%; color: black; height: 320px; background-color: #f3f1f2;"><tbody><tr><td style="color: black; font-family: Arial; font-size: 18px;" colspan="2"><span style="color: #f3f1f2;"><strong>okabejun</strong></span></td></tr><tr><td style="text-align: center;"><span style="nowrap: nowrap; font-size: 16px; font-family: Arial; width: 200px; line-height: 22px;">　姓　　<span style="color: red;">*</span></span> <input style="width: 250px;" maxlength="80" name="Last Name" type="text" /></td></tr><tr><td style="text-align: center;"><span style="nowrap: nowrap; font-size: 16px; font-family: Arial; width: 200px; line-height: 22px;">　名　　</span> <input style="width: 250px;" maxlength="40" name="First Name" type="text" /></td></tr><tr><td style="text-align: center;"><span style="nowrap: nowrap; font-size: 16px; font-family: Arial; width: 200px; line-height: 22px;">メール   <span style="color: red;">*</span></span> <input style="width: 250px;" maxlength="100" name="Email" type="text" /></td></tr><tr><td style="text-align: center;"><span style="nowrap: nowrap; font-size: 16px; font-family: Arial; width: 200px; line-height: 22px;">携帯電話</span> <input style="width: 250px;" maxlength="30" name="Mobile" type="text" /></td></tr></tbody></table><input class="btn-blue-sma" name="submit" type="submit" value="登録" align="left" /><script>// <![CDATA[
                                                    var mndFileds=new Array('Last Name','Email');
                                                    var fldLangVal=new Array('姓','メール');
                                                    var name='';
                                                    var email='';

                                                    function checkMandatory() {
                                                        for(i=0;i<mndFileds.length;i++) {
                                                            var fieldObj=document.forms['WebToLeads1401379000001120001'][mndFileds[i]];
                                                            if(fieldObj) {
                                                                if (((fieldObj.value).replace(/^\s+|\s+$/g, '')).length==0) {
                                                                    if(fieldObj.type =='file')
                                                                    {
                                                                        alert('アップロードするファイルを選択してください');
                                                                        fieldObj.focus();
                                                                        return false;
                                                                    }
                                                                    alert(fldLangVal[i] +' を入力してください。');
                                                                    fieldObj.focus();
                                                                    return false;
                                                                }  else if(fieldObj.nodeName=='SELECT') {
                                                                    if(fieldObj.options[fieldObj.selectedIndex].value=='-None-') {
                                                                        alert(fldLangVal[i] +' を入力してください。');
                                                                        fieldObj.focus();
                                                                        return false;
                                                                    }
                                                                } else if(fieldObj.type =='checkbox'){
                                                                    if(fieldObj.checked == false){
                                                                        alert('Please accept  '+fldLangVal[i]);
                                                                        fieldObj.focus();
                                                                        return false;
                                                                    }
                                                                }
                                                                try {
                                                                    if(fieldObj.name == 'Last Name') {
                                                                        name = fieldObj.value;
                                                                    }
                                                                } catch (e) {}
                                                            }
                                                        }
                                                        trackVisitor();
                                                    }
                                                    // ]]></script><script id="VisitorTracking" type="text/javascript">// <![CDATA[
                                                    var $zoho= $zoho || {salesiq:{values:{},ready:function(){$zoho.salesiq.floatbutton.visible('hide');}}};var d=document;s=d.createElement('script');s.type='text/javascript';s.defer=true;s.src='https://salesiq.zoho.com/jica/float.ls?embedname=embed2.chat';t=d.getElementsByTagName('script')[0];t.parentNode.insertBefore(s,t);function trackVisitor(){try{if($zoho){var LDTuvidObj = document.forms['WebToLeads1401379000001120001']['LDTuvid'];if(LDTuvidObj){LDTuvidObj.value = $zoho.salesiq.visitor.uniqueid();}var firstnameObj = document.forms['WebToLeads1401379000001120001']['First Name'];if(firstnameObj){name = firstnameObj.value +' '+name;}$zoho.salesiq.visitor.name(name);var emailObj = document.forms['WebToLeads1401379000001120001']['Email'];if(emailObj){email = emailObj.value;$zoho.salesiq.visitor.email(email);}}} catch(e){}}
                                                    // ]]></script></form></div></td></tr></tbody></table>


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