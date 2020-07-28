<?php

/**
 * Class users_view 用户视图类
 */
class users_view extends users{
    /**
    * 检查用户是否存在
    * @param $openid string OpenID
    * @return bool|string 存在为真，不存在为假，错误为"error"
    */
    public function is_exist($openid){
        try{
            $result = $this->get_user("openid", $openid);
            // echo $result[0]['id'];
            if($result[0]['ID']){
                return true;
            }
            return false;
        }
        catch(Exception $e){
            return false;
        }
    }

    /**
     * 获取用户偏好
     * @param $openid string OpenID
     * @return bool|string 用户的偏好，出错返回0
     */
    public function get_preference($openid){
        try{
            $result = $this->get_user("openid", $openid);
            if($result == "error"){
                return false;
            }
            return $result[0]['preference'];
        }
        catch(Exception $e){
            return false;
        }
    }

    /**
     * 获取用户id
     * @param $openid string OpenID
     * @return bool|int 用户的ID，失败返回0
     */
    public function get_id($openid){
        try{
            $result = $this->get_user("openid", $openid);
            if($result == "error"){
                return false;
            }
            return $result[0]['ID'];
        }
        catch(Exception $e){
            return false;
        }
    }
}