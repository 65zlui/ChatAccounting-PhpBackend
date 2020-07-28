<?php

/**
 * Class dbh Database Handler
 */
class dbh{
    private $host;
    private $db_name;
    private $username;
    private $db_pwd;

    private function get_param(){
        try{
            $json_str = file_get_contents("/www/wwwroot/api.sunxiaochuan258.com/ChatAccounting/json/config.json");
            $config_json = json_decode($json_str, true);
            $this->host = $config_json['db_info']['host'];
            $this->db_name = $config_json['db_info']['db_name'];
            $this->username = $config_json['db_info']['username'];
            $this->db_pwd = $config_json['db_info']['pwd'];
        }
        catch(Exception $e){
            return false;
        }
        return true;
    }

    protected function connect(){
        if(!$this->get_param()){
            return false;
        }
        try {
            $dsn = "mysql:host=" . $this->host . ";dbname=" . $this->db_name;
            // echo $dsn . "\n";
            $pdo = new PDO($dsn, $this->username, $this->db_pwd);
            $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
            // $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $pdo;
        }
        catch(Exception $e){
            return false;
        }
    }
}