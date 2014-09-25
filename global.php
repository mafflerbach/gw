<?php


function getGallery() {
  $gal = load('gallery', 'http://forum.gw2community.de/gallery/ImageList/145-Community-Flashmobs-Dienstags-20-45-Uhr/', '//*[@id="content"]/div[3]/div/ul/li');
  $gal = attacheNode($gal);

  $i = 1;
  $port = '';
  $port .= '<div class="4u">';
  foreach ($gal->li as $list) {
    if ($i > 9) {
      continue;
    }
    $port .= '<article class="item">';
    $port .= '<a href="' . $list->a['href'] . '" class="image fit"><img src="' . $list->a->img['src'] . '" alt="" /></a>';
    $port .= '<header><h3>' . $list->div->p . '</h3></header>';
    $port .= '</article>';

    if ($i == 3 || $i == 6) {
      $port .= '</div><div class="4u">' ;
    }
    $i++;
  }
  $port .= '</div>';
  return $port;

}

function getBoardlistPices($xpathStr) {
  $board =  load('boardlist', 'http://forum.gw2community.de/BoardList/', $xpathStr);
  $board = attacheNode($board);
  return $board->fieldset->asXML();

}

function cache($filename, $url) {
  if (file_exists('cache/' . $filename)) {
    $file = file_get_contents('cache/' . $filename);
  } else {
    $file = file_get_contents($url);
    file_put_contents('cache/' . $filename, $file);
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
  $about = load('about', 'http://forum.gw2community.de/CustomPage/?id=6', "//*[@id='cpHtml']/div");
  $about = attacheNode($about);
    return $about->div->asXML();
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

  $nodes = load($mode, $url, $xpathStr);

  $nodes = attacheNode($nodes);

  $foo = "<fieldset><legend>Heutige Termine</legend>".$nodes->ol->asXML()."</fieldset>";

  return $foo;

}

function attacheNode(DOMNodeList $node, array $attr = array()) {
  $newdoc = new DOMDocument();
  $elem = '<div';

  if (!empty($attr)) {
    $attributes = '';
    foreach ($attr as $key => $val) {
      $attributes .= $key . '="' . $val . '"';
    }
    $elem .= ' ' . $attributes;
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

  return $xml;
}

function getOnAirTime($url) {

  $xpath = "//article/div/section/div/div/div[1]/div/div/table";

  $table = load('radio', $url, $xpath);

  $board = attacheNode($table);

  return $board->table->asXML();


}


$onAirUrl = 'http://forum.gw2community.de/Thread/1720-Guild-Waves-Sendeplan-15-09-2014-21-09-2014/';

$week = getCalender('week');
$day = getCalender('day');
$lastPosts = getBoardlistPices("//aside/div/fieldset[1]");
$lastActivations = getBoardlistPices("//aside/div/fieldset[2]");
$mostRecents = getBoardlistPices("//aside/div/fieldset[3]");
$about = getAboutUs("//aside/div/fieldset[3]");

$html = '<html>';
$html .= '<head>';
$html .= '<link rel="stylesheet" type="text/css" href="style.css"/>';
$html .= '</head>';
//$html .= attacheNode($day, array('id'=>"day"));
//$html .= attacheNode($week, array('id'=>"week"));
//$html .= attacheNode($lastPos ts, array('id'=>"lastPost"));
//$html .= attacheNode($lastActivations, array('id'=>"lastActivs"));
//$html .= attacheNode($mostRecents, array('id'=>"mostRecents"));
//$html .= attacheNode($about, array('id'=>"about"));
//  $html .= attacheNode(getGallery(), array('id'=>"gallery"));
$html .= '<body>';
$html .= '</body>';
$html .= '</html>';
