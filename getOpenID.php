<?php
$data = array(
    "status" => "failed",
    "OpenID" => "",
    "openid" => ""
);
do{
    try{
        if(!isset($_GET['code'])){
            $data['status'] = "missing_param";
            break;
        }
        $appid = "wxecbe9250362c5373";
        $secret = "2d197ab4de63bc5487ad57d1e963eda2";
        $result = json_decode(file_get_contents("https://api.weixin.qq.com/sns/jscode2session?appid=$appid&secret=$secret&js_code=" . $_GET['code'] ."&grant_type=authorization_code"), true);
        if($result['errcode'] != 0){
            $data['status'] = "failed";
            break;
        }
        $data['openid'] = $result['openid'];
        $data['OpenID'] = $result['openid'];
        $users_view = new users_view();
        if(!$users_view->is_exist($result['openid'])){
            $users_contr = new users_contr();
            if(!$users_contr->create_user($result['openid'])){
                break;
            }
        }
        $data['status'] = "success";
    }
    catch(Exception $e){
        $data['status'] = "failed";
        break;
    }
}while(0);
exit(json_encode($data));