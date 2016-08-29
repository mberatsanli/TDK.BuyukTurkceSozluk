<?php
function TDK_BuyukTurkceSozluk($kelime){
	$data = array('kelime' => $kelime, 'ayn' => 'tam', 'kategori' => 'verilst');
	$ch = curl_init();
	curl_setopt ($ch, CURLOPT_URL, "http://tdk.gov.tr/index.php?option=com_bts&arama=kelime");
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_BINARYTRANSFER, true);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
	curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
	curl_setopt ($ch, CURLOPT_REFERER, "http://www.google.com/");
	curl_setopt ($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (compatible; Googlebot/2.1; +[url]http://www.google.com/bot.html)");
	$sonuc = curl_exec($ch);
	$sonuc = preg_replace('#<script(.*?)>(.*?)</script>#is', '', $sonuc);
	$sonuc = preg_replace('#<style(.*?)>(.*?)</style>#is', '', $sonuc);
	$sonuc = preg_replace('#<title>(.*?)</title>#is', '', $sonuc);
	preg_match_all('@<table>(.*?)</table>@si',$sonuc, $veri_derece1);
	preg_match_all('@<p class="thomicb">(.*?)</p>@si',$veri_derece1[0][0] ,$icerik);
	return $icerik[0][0];
	curl_close($ch);
}

echo TDK_BuyukTurkceSozluk("Atatürk");
?>
