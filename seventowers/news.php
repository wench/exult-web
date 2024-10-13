<?php
$HEADLINE = "News";
$TITLE_IMAGE = "newstitle.png";
$CUSTOM_PARSE = true;

include_once "base.inc";

if (isset($_REQUEST["showall"])) {
	$showall = true;
} else {
	$showall = false;
}

include_once "content/news.dat";

output_boxes();
$tpl->parse("MAIN", "main");
$tpl->FastPrint();
