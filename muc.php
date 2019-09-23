<?php
include "curl.php";

function regis($reff,$no,$kirim)
{
    echo "Nabila Tools - Mucho Shopping\nThanks To : Muhammad Ikhsan Aprilyadi f.t Pandu Aji\n\nReff : ";
    $reff = trim(fgets(STDIN));
    echo "Nomer HP : ";
    $no   = trim(fgets(STDIN));
    echo "whatsapp or sms\nkirim OTP Melalui : ";
    $kirim   = trim(fgets(STDIN));
    $headers = array("Host: api.mucho.id",
                     "content-length: 83",
                     "accept: application/json, text/plain, */*",
                     "origin: https://mobile.mucho.id",
                     "save-data: on",
                     "user-agent: Mozilla/5.0 (Linux; Android 8.1.0; Redmi 6) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/77.0.3865.92 Mobile Safari/537.36",
                     "sec-fetch-mode: cors",
                     "content-type: application/json;charset=UTF-8",
                     "sec-fetch-site: same-site",
                     "referer: https://mobile.mucho.id/invite/index.html?inviterId=".$reff."&language=2",);
    $curl     = curl("https://api.mucho.id/core/signup/mobile/code",'{"countryCode":"62","mobile":"'.$no.'","platform":"H5","preferredMethod":"'.$kirim.'"}',$headers);
    echo "Otp : ";
    $otp      = trim(fgets(STDIN));
    $headers1 = array("Host: uc.mucho.id",
                      "content-length: 62",
                      "accept: application/json, text/plain, */*",
                      "origin: https://mobile.mucho.id",
                      "save-data: on",
                      "user-agent: Mozilla/5.0 (Linux; Android 8.1.0; Redmi 6) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/77.0.3865.92 Mobile Safari/537.36",
                      "sec-fetch-mode: cors",
                      "content-type: application/json;charset=UTF-8",
                      "sec-fetch-site: same-site",
                      "referer: https://mobile.mucho.id/invite/index.html?inviterId=".$reff."&language=2",);
    $curl1   = curl("https://uc.mucho.id/user/signup",'{"countryCode":"62","mobile":"'.$no.'","smsCode":"'.$otp.'"}',$headers1);
    $hash_id = fetch_value($curl1,'"hashid":"','"');
    $name    = fetch_value($curl1,'"name":"+','"');
    $curl2   = curl("https://activity.mucho.id/redPacket/genZhuli?inviterId=".$reff."&inviteeId=".$hash_id."&inviteeName=%2B".$name."&source=1&userHeadUrl=0");

    echo ((strpos($curl2,"Successful") !== false) ? "Success" : "Failed")."\n==============\n";
}

while (true) {
    echo regis($reff,$no,$kirim);
}
?>
