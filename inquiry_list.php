<?php

$data = array(
    "status" => "failed",
    "data" => ""
);

do{
    try{
        if(!isset($_GET['openid'])){
            $data['status'] = "missing_param";
            break;
        }
        $users_view = new users_view();
        if(!$users_view->is_exist($_GET['openid'])){
            $data['status'] = "invalid";
            break;
        }
        $bills_view = new bills_view($_GET['openid']);
        $list = $bills_view->get_list();
        if(false == $list){
            $data['status'] = "not_exist";
            break;
        }
        $data['status'] = "success";
        $data['data'] = $list;
    }
    catch(Exception $e){
        break;
    }
}while(0);

exit(json_encode($data, JSON_UNESCAPED_UNICODE));