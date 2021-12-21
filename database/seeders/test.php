<?php

$page = file_get_contents("https://youtube.com");
$htmlLoader = new DOMDocument();
libxml_use_internal_errors(true);

$htmlLoader->loadHTML($page);

$xpath = new DOMXPath($htmlLoader);

// $html = $xpath->query('//a');
$links = $htmlLoader->getElementsByTagName("a");
// $html = $xpath->query('//*[@id="video-title-link"]');

foreach ($links as $link) :
	if ($link->getAttribute("aria-label")) : echo $link->getAttribute("href") . "\n";
	endif;
endforeach;
