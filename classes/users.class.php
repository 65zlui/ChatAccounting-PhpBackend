<?php

/**
 * Class users 用户模型类
 */
class users extends dbh{
    /**
     * @param $openid string OpenID
     * @return bool 执行状态
     */
    protected function add_user($openid){
        try {
            $sql = "INSERT INTO ac_users(openid) VALUES (?);";
            $stmt = $this->connect()->prepare($sql);
            $stmt->execute([$openid]);
            return true;
        } catch (Exception $e) {
            // echo $e;
            return false;
        }
    }

    /**
     * 获得某用户的信息
     * @param $param string 查询参数
     * @param $value string|int 查询值
     * @return array|string 返回结果，若出错返回"error"
     */
    protected function get_user($param, $value){
        try{
            $sql = "SELECT * FROM ac_users WHERE " . $param . " = ?;";
            $stmt = $this->connect()->prepare($sql);
            $stmt->execute([$value]);
            return $stmt->fetchAll();
        }
        catch(Exception $e){
            return "error";
        }
    }

    /**
     * 更新用户信息
     * @param $param string 查询参数
     * @param $value string|int 查询值
     * @param $target_param string 目标参数
     * @param $target_value string|int 目标值
     * @return bool 执行状态
     */
    protected function update_user($param, $value, $target_param, $target_value){
        try{
            $sql = "UPDATE ac_users SET " . $target_param . " = ? WHERE " . $param . " = ?;";
            $stmt = $this->connect()->prepare($sql);
            $stmt->execute([$target_value, $value]);
            return true;
        }
        catch(Exception $e){
            return false;
        }
    }

    /**
     * @param $param string 查询参数
     * @param $value string|int 查询值
     * @return bool 执行状态
     */
    protected function delete_user($param, $value){
        try{
            $sql = "DELETE FROM ac_users WHERE " . $param . " = ?;";
            $stmt = $this->connect()->prepare($sql);
            $stmt->execute([$value]);
            return true;
        }
        catch(Exception $e){
            return false;
        }
    }
}