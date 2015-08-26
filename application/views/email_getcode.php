<?php
	//print_r($code_text_row);
	
?>
<!DOCTYPE html>
<html lang="zh-tw">
<head>
	<meta charset="utf-8">
	<title>Ingress啟動碼</title>
	<style>
	body{
		color:#222222;
		background:url("img/bg.png") repeat-x #222222;		
		margin: 1% 20%;		
	}

	</style>
</head>
<body>

<div id="container">
	<div id="body">	
	<br>
	<div style="width:90%;min-width:50%;font-family:'open sans',arial,sans-serif;font-size:13px;background-color:black;color:#ddd;padding:.5em;line-height:1.3em">	
	<div style="margin: 20px; width:800px;min-height:52px;float:left;clear:both;vertical-align:middle;margin-top:10px;margin-bottom:20px"><a href="https://play.google.com/store/apps/details?id=com.nianticproject.ingress" target="_blank"><img src="http://commondatastorage.googleapis.com/ingress-invite-img/playbadge.png" alt="Google Play Store Logo" style="width:149px;min-height:52px;margin-right:1.5em;float:left"></a><span style="color:white;font-weight:bold;min-height:52px;float:left;line-height:24px;font-size:1.5em">你的ACTIVATION CODE:<br><span style="color:red"><?php echo $code_text_row['code'];?></span></span></div>
	<div style="margin: 20px;display:block;max-width:90%;clear:both"> <span style="display:block">Ingress已經開始啟動了.</span> <span style="display:block;margin:1em 0">雖然你的生活"看似"正常，但這世界卻已經被滲透了.  在歐洲，某些科學家解放了一股神祕的能量，並且已經蔓延至全世界了。這股力量的來源跟目的無法被證實，但是某些研究學者相信這力量會影響到我們的思考。我們必須控制它，或是等著被它所控制。</span> <span style="display:block;margin:1em 0">目前有兩個陣營  光明軍(The Enlightened)想要散播這股力量，而反抗軍(The Resistance)則是力抗這股力量，以保護我們僅剩的人類意志。</span></div>
	<div style="margin: 20px;background-color:#072a2d;width:90%;min-width:580px;max-width:900px;min-height:356px;float:left;border:1px solid #7fffff;vertical-align:middle;display:inline-block;clear:both;padding:1em">
		<div style="width:65%;float:left;padding-top:1em">
			<span style="display:block;color:#d8ffff;font-weight:bold">整個世界都是遊戲的一部份</span>
			<span style="color:#7fffff;display:block;padding:.2em .2em .8em .2em">在真實世界使用你的Android裝置，並且安裝Ingress的應用程式來在這世界移動著，探索並且接觸這股神祕能量，獲得物品來幫助你進行探索，部署裝備去奪取領地，以及跟其他同陣營玩家聯手來使自己陣營壯大。</span>
			<span style="color:#d8ffff;font-weight:bold">戰略指引</span><span style="color:#7fffff;display:block;padding:.2em .2em .8em .2em">最重要的關鍵就是要在戶外進行行動。在全世界，遵循其他玩家的進度，並且計畫出你的下一個步驟，並且與其他玩家經由 <a href="http://www.ingress.com/intel" style="color:#7fffff" target="_blank">Intel Map</a>來進行通訊</span>
			<span style="color:#d8ffff;font-weight:bold">什麼是Niantic Project?</span><span style="color:#7fffff;display:block;padding:.2em .2em .8em .2em">這只是個遊戲?  在 <a href="http://www.nianticproject.com/" style="color:#7fffff" target="_blank">Investigation Board</a> 有著加密過的線索以及密碼。 強大的秘密以及更多的遊戲科技等著你來解開。</span>
			<span style="color:#d8ffff;font-weight:bold">邀請你的朋友們吧</span><span style="color:#7fffff;display:block;padding:.2em .2em .8em .2em">這個星球的計畫是跨全世界的。成群結隊的玩家們一起行動會比起一個人單打獨鬥會更有效率，跨越城鎮間、都市間或是跨國的合作將可以帶來最終的勝利</span>
			<span style="color:#d8ffff;font-weight:bold">Ingress Taiwan Google+社群</span><span style="color:#7fffff;display:block;padding:.2em .2em .8em .2em">這是ㄧ個由台灣Ingress幹員所組成的一個社群，互相分享台灣Ingress相關資訊與情報。<a href="https://plus.google.com/u/0/communities/105093873281779892074" style="color:#00a8a8" target="_blank">按這進入</a></span>
		</div>
		<img src="http://commondatastorage.googleapis.com/ingress-invite-img/scrshot.png" alt="Ingress App Screen Image" style="width:186px;min-height:375px;float:right"></div><div style="color:#00a8a8;font-size:small;clear:both;min-height:1em;line-height:2em;max-width:600px">
	</div>
	<div style="clear:both;color:#7fffff;padding:.2em .2em .8em .2em"><span style="margin:.6em 0;color:#00a8a8;display:block">參閱<a href="http://support.google.com/ingress" style="color:#00a8a8" target="_blank">玩家說明中心</a>來知道更多訊息</span></div></div>
	</div>
	<div id="footer">		
	</div>
</div>
<script type="text/javascript">

  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-18420763-4']);
  _gaq.push(['_setDomainName', 'conic.me']);
  _gaq.push(['_setAllowLinker', true]);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();

</script>
</body>
</html>