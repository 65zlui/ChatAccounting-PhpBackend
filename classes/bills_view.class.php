<?php

/**
 * Class bills_view 账单视图类
 */
class bills_view extends bills{
    /**
     * @var int 用户ID
     */
    private $id;

    /**
     * bills_contr constructor.
     * @param $openid string OpenID
     */
    public function __construct($openid){
        $user_view = new users_view();
        $this->id = $user_view->get_id($openid);
    }

    /**
     * 获取消费记录
     * @return array|bool 执行结果，错误返回0
     */
    public function get_list(){
        return $this->get_all($this->id);
    }

    /**
     * 按月获取统计信息
     * @param $month string 目标月份
     * @return array|bool 执行结果，错误返回0
     */
    public function get_statistics_by_month($month){
        try{
            $start = new DateTime($month);
            $start = $start->format('Y-m-d H:i:s');
            $end = new DateTime($month . " +1 month");
            $end = $end->format('Y-m-d H:i:s');
            if(!$start || !$end){
                return false;
            }
            return $this->get_statistics($this->id, $start, $end);
        }
        catch(Exception $e){
            return false;
        }
    }
}