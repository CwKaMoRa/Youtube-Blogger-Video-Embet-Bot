<html>
<head>
<meta charset="utf-8" /> 
</head><body>
<?php
error_reporting(0); // hepsini kapatır
set_time_limit(0);
	 function siteConnect($site)
	 {
		  $ch = curl_init();
		  $hc = "YahooSeeker-Testing/v3.9 (compatible; Mozilla 4.0; MSIE 5.5; Yahoo! Search - Web Search)";
		  curl_setopt($ch, CURLOPT_REFERER, 'http://www.google.com');
		  curl_setopt($ch, CURLOPT_URL, $site);
		  curl_setopt($ch, CURLOPT_USERAGENT, $hc);
		  curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		  curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_ANY);
		  curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		  curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);

		  $site = curl_exec($ch);
		  curl_close($ch);
		  $site= preg_replace('/(?:(?:\r\n|\r|\n|\t|\0|\x0B)\s*)/sim', "", $site);
		    preg_match_all('@<a dir="ltr" href="(.*?)" class=" yt-uix-sessionlink" title="(.*?)" data-sessionlink="(.*?)">(.*?)</a>@si',$site,$ChannelName);
			preg_match_all('@<span class="yt-subscription-button-subscriber-count-branded-horizontal yt-uix-tooltip" title=" abone" tabindex="0">(.*?)</span>@',$site,$AboneSayisi);
			preg_match_all('@<a class="yt-uix-sessionlink yt-uix-tile-link  spf-link  yt-ui-ellipsis yt-ui-ellipsis-2" dir="ltr" title="(.*?)"  aria-describedby="description-id-(.*?)" data-sessionlink="(.*?)" href="/watch\?v\=(.*?)">(.*?)</a>@',$site,$VideoName);
			preg_match_all('@<ul class="yt-lockup-meta-info"><li>(.*?) görüntüleme</li><li>(.*?) (.*?) önce</li></ul>@',$site,$VideoIzlenme);

				echo '<pre>';
				//print_r($ChannelName);//Kanal İsimler
				//print_r($AboneSayisi);//Abone Sayısı
				//print_r($VideoName);//Video adı - Video Linki - Resim Linki
				//print_r($VideoIzlenme);// İzlenme Sayısı - Gün
				echo '</pre>';
					if($VideoIzlenme[3][0] == "gün")
					{
						if($VideoIzlenme[2][0] == 1){
							$Hesapla = number_format(str_replace(".","",$VideoIzlenme[1][0])/24, 0, ',', '.');
							echo "<img height='100' width='200' src='https://i.ytimg.com/vi/".$VideoName[4][0]."/mqdefault.jpg'/>";
							echo "<a href='http://www.youtube.com/embed/".$VideoName[4][0]."'>Link</a>";
							echo "<b>Gün</b> ".$Hesapla." <a href=\"https://www.blogger.com/blog-this.g?n=".$VideoName[5][0]."&source=youtube&b=<iframe width='100%25' height='480' src='http://www.youtube.com/embed/".$VideoName[4][0]."' frameborder='0' allowfullscreen></iframe><img border='0' height='0' alt='thumb' width='0' src='https://i.ytimg.com/vi/".$VideoName[4][0]."/mqdefault.jpg'/>\">".substr($VideoName[5][0],0,60)."</a></br>";
						}
					};
					
					if($VideoIzlenme[3][0] == "saat"){
						$Hesapla = number_format(str_replace(".","",$VideoIzlenme[1][0])/$VideoIzlenme[2][0], 0, ',', '.');
						echo "<img height='100' width='200' src='https://i.ytimg.com/vi/".$VideoName[4][0]."/mqdefault.jpg'/>";
						echo "<a href='http://www.youtube.com/embed/".$VideoName[4][0]."' target='_blank' >Link</a>";
						echo "<b>Saat</b> ".$Hesapla." <a href=\"https://www.blogger.com/blog-this.g?n=".$VideoName[5][0]."&source=youtube&b=<iframe width='100%25' height='480' src='http://www.youtube.com/embed/".$VideoName[4][0]."' frameborder='0' allowfullscreen></iframe><img border='0' height='0' alt='thumb' width='0' src='https://i.ytimg.com/vi/".$VideoName[4][0]."/mqdefault.jpg'/>\" target='_blank'>".substr($VideoName[5][0],0,60)."</a></br>";
					};	
					
		return $Kanallar=$ChannelName[1];
	 }
	 //$Kanallar = siteConnect('https://www.youtube.com/channels/gaming');// Oyun
	 
	 //$Kanallar = siteConnect('https://www.youtube.com/channels/cooking_health');//Yemek sağlık
	 $Kanallar = siteConnect('https://www.youtube.com/channels/sports');
		
		$say=0;
		for($say=0;$say<100;$say++)
		{
			siteConnect('https://www.youtube.com'.$Kanallar[$say].'/videos');
		}
?></body></html>
