<?php
$data = array(
    "status" => "failed",
    "msg" => ""
);

do{
    try{
        if(!isset($_GET['msg'])){
            $data['status'] = "missing_param";
            break;
        }
        $result = json_decode(file_get_contents("http://api.qingyunke.com/api.php?key=free&appid=0&msg=" . $_GET['msg']), JSON_UNESCAPED_UNICODE);
        if($result['result']){
            $data['status'] = "failed";
            break;
        }
        $data['msg'] = $result['content'];
        $data['status'] = "success";
    }
    catch(Exception $e){
        $data['status'] = "failed";
        break;
    }
}while(0);

exit(json_encode($data, JSON_UNESCAPED_UNICODE));