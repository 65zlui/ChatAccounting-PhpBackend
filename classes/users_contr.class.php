<?php

/**
 * Class users_contr 用户控制类
 */
class users_contr extends users{
    /**
     * 添加新用户
     * @param $openid string OpenID
     * @return bool 执行状态
     */
    public function create_user($openid){
        return $this->add_user($openid);
    }

    /**
     * @param $openid string OpenID
     * @param $preference string 偏好
     * @return bool 执行状态
     */
    public function set_preference($openid, $preference){
        return $this->update_user("openid", $openid, "preference", $preference);
    }
}