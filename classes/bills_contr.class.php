<?php

/**
 * Class bills_contr 账单操作类
 */
class bills_contr extends bills{
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
     * 初始化表
     * @return bool 执行状态
     */
    public function init_table(){
        try{
            return $this->init($this->id);
        }
        catch(Exception $e){
            return false;
        }
    }

    /**
     * @param $type string 消费类型
     * @param $item string 消费条目
     * @param $price float 消费金额
     * @param $date string 消费时间
     * @return bool 执行状态
     */
    public function add($type, $item, $price, $date){
        if($this->init_table()){
            return $this->add_bill($this->id, $type, $item, $price, $date);
        }
        return false;
    }
}