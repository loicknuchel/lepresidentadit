<?php
function isSourceType($sources, $type, &$selectedSource){
  if($sources != null && $sources != '') {
    foreach($sources as $key => $source){
      if($source['type'] == $type){
        $selectedSource = $source;
        return true;
      }
    }
  }
  return false;
}

function embedLink($link){
  if(preg_match('/youtube\.com/i', $link)){
    $pattern = '/(.*)v=([^&]+)(.*)/i';
    $replacement = 'http://www.youtube.com/embed/${2}?wmode=transparent';
    return preg_replace($pattern, $replacement, $link);
  } else if(preg_match('/dailymotion\.com/', $link)){
    $pattern = '/(.*)video\/([^_]+)(.*)/i';
    $replacement = 'http://www.dailymotion.com/embed/video/${2}';
    return preg_replace($pattern, $replacement, $link);
  } else {
    return null;
  }
}

function embedFrame($link){
  if(preg_match('/youtube\.com/i', $link)){
    return '<iframe frameborder="0" width="560" height="315" src="'.embedLink($link).'" allowfullscreen><param /></iframe>';
  } else if(preg_match('/dailymotion\.com/', $link)){
    return '<iframe frameborder="0" width="560" height="317" src="'.embedLink($link).'"></iframe>';
  } else {
    return null;
  }
}
?>