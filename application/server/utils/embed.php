<?php
function embedLink($link){
  if(preg_match('/youtube\.com/i', $link)){
    $pattern = '/(.*)v=([^&]+)(.*)/i';
    $replacement = 'http://www.youtube.com/embed/${2}?wmode=transparent';
    return preg_replace($pattern, $replacement, $link);
  } else if(preg_match('/dailymotion\.com/', $link)){
    $pattern = '/(.*)video\/([^_]+)(.*)/i';
    $replacement = 'http://www.dailymotion.com/embed/video/${2}';
    return preg_replace($pattern, $replacement, $link);
  } else if(preg_match('/\.pdf$/', $link)){
    return 'http://docs.google.com/gview?url='.$link.'&embedded=true';
  } else {
    return $link;
  }
}

function embedFrame($link){
  if(preg_match('/youtube\.com/i', $link)){
    return '<iframe frameborder="0" width="560" height="315" src="'.embedLink($link).'" allowfullscreen><param /></iframe>';
  } else if(preg_match('/dailymotion\.com/', $link)){
    return '<iframe frameborder="0" width="560" height="317" src="'.embedLink($link).'"></iframe>';
  } else if(preg_match('/\.jpg$/', $link) || preg_match('/\.gif$/', $link) || preg_match('/\.png$/', $link)){
    return '<a href="'.$link.'"><img src="'.embedLink($link).'" style="height: 317px;" /></a>';
  } else if(preg_match('/\.pdf$/', $link)){
    return '<iframe src="'.embedLink($link).'" style="width:100%; height:500px;" frameborder="0"></iframe>';
  } else {
    return '';
  }
}
?>