<?php
define('API_KEY','303323571:AAFeY2yE2Q8LL5aA7VKpV4ELIB_NsFN8xRE');
/*
  created by DR.RASMUS && @DR_RASMUS && @VIZARD_TM
  */
//----######------
function makereq($method,$datas=[]){
    $url = "https://api.telegram.org/bot".API_KEY."/".$method;
    $ch = curl_init();
    curl_setopt($ch,CURLOPT_URL,$url);
    curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
    curl_setopt($ch,CURLOPT_POSTFIELDS,http_build_query($datas));
    $res = curl_exec($ch);
    if(curl_error($ch)){
        var_dump(curl_error($ch));
    }else{
        return json_decode($res);
    }
}
//##############=--API_REQ
function apiRequest($method, $parameters) {
  if (!is_string($method)) {
    error_log("Method name must be a string\n");
    return false;
  }
  if (!$parameters) {
    $parameters = array();
  } else if (!is_array($parameters)) {
    error_log("Parameters must be an array\n");
    return false;
  }
  foreach ($parameters as $key => &$val) {
    // encoding to JSON array parameters, for example reply_markup
    if (!is_numeric($val) && !is_string($val)) {
      $val = json_encode($val);
    }
  }
  $url = "https://api.telegram.org/bot".API_KEY."/".$method.'?'.http_build_query($parameters);
  $handle = curl_init($url);
  curl_setopt($handle, CURLOPT_RETURNTRANSFER, true);
  curl_setopt($handle, CURLOPT_CONNECTTIMEOUT, 5);
  curl_setopt($handle, CURLOPT_TIMEOUT, 60);
  return exec_curl_request($handle);
}
//----######------
//---------
$update = json_decode(file_get_contents('php://input'));
var_dump($update);
//=========
$chat_id = $update->message->chat->id;
$textmessage = isset($update->message->text)?$update->message->text:'';
if (strpos($textmessage , "/spam" ) !== false ) {
    $text = str_replace("/spam","",$textmessage);
if ($text != "") {
$textt = explode(" ",$text);
  if ($textt['2'] != "" && $textt['1'] != "") {
  $t = $textt['1'];
  $te = $textt['2'];
  for($y=1;$y<=$t;$y++){
  makereq('sendmessage',[
  'chat_id'=>$chat_id,
  'text'=>"$te",
  ]);
  }
  }
  }
  }
  if ($textmessage == "/start"){
  makereq('sendmessage',[
  'chat_id'=>$chat_id,
  'text'=>"سلام به این اسپمر خوش اومدی منو توی گروهات اد کن و از دستور زیر استفاده کن
  /spam TEDAD MATN
  TEDAD:تعداد پیام ارسالی
  MATN:متن مورد نظر
  مثال:
  /spam 50 @VIZARD_TM",
  ]);
  }
  /*
  created by DR.RASMUS && @DR_RASMUS && @VIZARD_TM
  */
  ?>