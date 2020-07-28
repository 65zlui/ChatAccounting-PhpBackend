<?php

/**
 * Class bills 账单模型类
 */
class bills extends dbh{
    /**
     * 初始化帐单表
     * @param $id int 用户ID
     * @return bool 执行状态
     */
    protected function init($id){
        try{
            $sql = "
                CREATE TABLE IF NOT EXISTS bill_" . $id . " (
                    ID INT(10) PRIMARY KEY AUTO_INCREMENT NOT NULL,
                    type VARCHAR(256) NOT NULL,
                    item TEXT NOT NULL,
                    price DECIMAL(9,2) NOT NULL,
                    account_date DATETIME NOT NULL
                );
            ";
            $stmt = $this->connect()->prepare($sql);
            $stmt->execute();
            return true;
        }
        catch(Exception $e){
            return false;
        }
    }

    /**
     * 添加消费记录
     * @param $id int 用户ID
     * @param $type string 消费类型
     * @param $item string 消费条目
     * @param $price float 消费金额
     * @param $date string 消费实践
     * @return bool 执行状态
     */
    protected function add_bill($id, $type, $item, $price, $date){
        try{
            $sql = "INSERT INTO bill_" . $id . " (type, item, price, account_date) VALUES (?, ?, ?, ?);";
            $stmt = $this->connect()->prepare($sql);
            $stmt->execute([$type, $item, $price, $date]);
            return true;
        }
        catch(Exception $e){
            return false;
        }
    }

    /**
     * 获取消费记录
     * @param $id int 用户ID
     * @return array|bool 执行结果，出错返回0
     */
    protected function get_all($id){
        try{
            $sql = "SELECT item, type, price, account_date FROM bill_" . $id . " ORDER BY account_date DESC;";
            $stmt = $this->connect()->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll();
        }
        catch(Exception $e){
            return false;
        }
    }

    /**
     * 获取统计数据
     * @param $id int 用户ID
     * @param $start string 开始统计实践
     * @param $end string 结束统计时间
     * @return array|bool 执行结果，出错返回0
     */
    protected function get_statistics($id, $start, $end){
        try{
            $sql = "SELECT type, SUM(price) AS price FROM bill_" . $id . " WHERE account_date BETWEEN '" . $start . "' AND '" . $end . "' GROUP BY type ORDER BY price DESC;";
            //echo $sql;
            $stmt = $this->connect()->prepare($sql);
            $stmt->execute([$start, $end]);
            return $stmt->fetchAll();
        }
        catch(Exception $e){
            return false;
        }
    }
}