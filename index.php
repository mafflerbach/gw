<?php


function getBoardlistPices($xpathStr) {
  $file = cache('boardlist', 'http://forum.gw2community.de/BoardList/');

  $dom = new DOMDocument();
  @$dom->loadHTML($file);

  $xpath = new DOMXPath($dom);
  $list = $xpath->query($xpathStr);

  return $list->item(0);
}

function cache($filename, $url) {
  if (file_exists('cache/'.$filename)) {
    $file = file_get_contents('cache/'.$filename);
  } else {
    $file = file_get_contents($url);
    file_put_contents('cache/'.$filename, $file);
  }

  return $file;
}



function getCalender($mode) {
  switch ($mode) {
    case 'week':
      $url = "http://forum.gw2community.de/calendar/weekly";
      $xpathStr = "//ol[@class='containerList']";
      break;
    case 'day':
      $url = "http://forum.gw2community.de/calendar/Daily/";
      $xpathStr = "//ol[@class='containerList']";
      break;
    default:
      break;
  }

  $file = cache($mode, $url);

  $dom = new DOMDocument();
  @$dom->loadHTML($file);

  $xpath = new DOMXPath($dom);
  $list = $xpath->query($xpathStr);

  return $list->item(0);

}

function attacheNode($node, array $attr = array()) {
  $newdoc = new DOMDocument();
  $elem = '<div';

  if (!empty($attr)) {
    $attributes = '';
    foreach($attr as $key => $val) {
      $attributes .= $key.'="'.$val.'"';
    }
    $elem .= ' '.$attributes;
  }
  $elem .= '/>';
  $newdoc->loadXML($elem);
  $node = $newdoc->importNode($node, true);
  $newdoc->documentElement->appendChild($node);
  return $newdoc->saveHTML();
}



$week = getCalender('week');
$day= getCalender('day');
$lastPosts = getBoardlistPices("//aside/div/fieldset[1]");
$lastActivations = getBoardlistPices("//aside/div/fieldset[2]");
$mostRecents = getBoardlistPices("//aside/div/fieldset[3]");
//$lastPosts = getBoardlistPices("//fieldset[@class=''dashboardBox and position()=0]");


$html = '<html>';
$html .= '<head>';
$html .= '<link rel="stylesheet" type="text/css" href="style.css"/>';
$html .= '</head>';
//$html .= attacheNode($day, array('id'=>"day"));
//$html .= attacheNode($week, array('id'=>"week"));
//$html .= attacheNode($lastPosts, array('id'=>"lastPost"));
//$html .= attacheNode($lastActivations, array('id'=>"lastActivs"));
$html .= attacheNode($mostRecents, array('id'=>"mostRecents"));
$html .= '<body>';
$html .= '</body>';
$html .= '</html>';

print($html);