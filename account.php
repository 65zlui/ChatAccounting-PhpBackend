<?php

$data = array(
    "status" => "failed",
    "msg" => ""
);

do{
    try{
        //记账
        if(!isset($_GET['openid']) || !isset($_GET['item']) || !isset($_GET['type']) || !isset($_GET['price'])){
            $data['status'] = "missing_param";
            break;
        }
        $users_view = new users_view();
        if(!$users_view->is_exist($_GET['openid'])){
            $data['status'] = "invalid";
            break;
        }
        $bills_contr = new bills_contr($_GET['openid']);
        if(!$bills_contr->init_table()){
            break;
        }
        if(!$bills_contr->add($_GET['type'], $_GET['item'], $_GET['price'], date('Y-m-d H:i:s'))){
            break;
        }
        //消息回复
        $json_str = file_get_contents("/www/wwwroot/api.sunxiaochuan258.com/ChatAccounting/json/msg.json");
        $msg_json = json_decode($json_str, true);
        $pf = $users_view->get_preference($_GET['openid']);
        $data['msg'] = $msg_json[$pf][$_GET['type']][rand(0, count($msg_json[$pf][$_GET['type']]) - 1)];
        $data['status'] = "success";
    }
    catch(Exception $e){
        break;
    }
}while(0);

exit(json_encode($data, JSON_UNESCAPED_UNICODE));