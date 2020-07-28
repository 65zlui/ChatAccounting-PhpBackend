<?php

$data = array(
    "status" => "failed"
);

do{
    if(!isset($_GET['openid']) || !isset($_GET['personality'])){
        $data['status'] = "missing_param";
        break;
    }
    $users_view = new users_view();
    if(!$users_view->is_exist($_GET['openid'])){
        $data['status'] = "invalid";
        break;
    }
    $users_contr = new users_contr();
    if(!$users_contr->set_preference($_GET['openid'], $_GET['personality'])){
        break;
    }
    $data['status'] = "success";
}while(0);

exit(json_encode($data, JSON_UNESCAPED_UNICODE));