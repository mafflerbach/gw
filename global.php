<?php


function getGallery() {
  return load('gallery', 'http://forum.gw2community.de/gallery/UnreadImageList/', '//*[@id="content"]/div[3]/div/ul/li');
}

function getBoardlistPices($xpathStr) {
  return load('boardlist', 'http://forum.gw2community.de/BoardList/',$xpathStr);
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

function load($name, $url, $xpathStr) {

  $file = cache($name, $url);

  $dom = new DOMDocument();
  @$dom->loadHTML(mb_convert_encoding($file, 'HTML-ENTITIES', 'UTF-8'));

  $xpath = new DOMXPath($dom);
  $list = $xpath->query($xpathStr);

  return $list;
}

function getAboutUs() {
  return load('about', 'http://forum.gw2community.de/CustomPage/?id=6',"//*[@id='cpHtml']/div");
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

  return load($mode,$url,  $xpathStr);
}

function attacheNode(DOMNodeList $node, array $attr = array()) {
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

  if (get_class($node) == 'DOMElement') {
    $node->removeAttribute('class');
    $node->removeAttribute('style');
    $node = $newdoc->importNode($node, true);
    $newdoc->documentElement->appendChild($node);
  } else {
    foreach ($node as $element) {
      $nodeel = $newdoc->importNode($element, true);
      $nodeel->removeAttribute('class');
      $nodeel->removeAttribute('style');
      $newdoc->documentElement->appendChild($nodeel);
    }
  }


  $xml = simplexml_load_string($newdoc->saveXML());
  print_r($xml);

  return $xml;
}



$week = getCalender('week');
$day= getCalender('day');
$lastPosts = getBoardlistPices("//aside/div/fieldset[1]");
$lastActivations = getBoardlistPices("//aside/div/fieldset[2]");
$mostRecents = getBoardlistPices("//aside/div/fieldset[3]");
$about= getAboutUs("//aside/div/fieldset[3]");

$html = '<html>';
$html .= '<head>';
$html .= '<link rel="stylesheet" type="text/css" href="style.css"/>';
$html .= '</head>';
//$html .= attacheNode($day, array('id'=>"day"));
//$html .= attacheNode($week, array('id'=>"week"));
//$html .= attacheNode($lastPosts, array('id'=>"lastPost"));
//$html .= attacheNode($lastActivations, array('id'=>"lastActivs"));
//$html .= attacheNode($mostRecents, array('id'=>"mostRecents"));
//$html .= attacheNode($about, array('id'=>"about"));
$html .= attacheNode(getGallery(), array('id'=>"gallery"));
$html .= '<body>';
$html .= '</body>';
$html .= '</html>';
