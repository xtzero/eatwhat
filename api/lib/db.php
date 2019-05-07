<?php
class db{
    private $db_host;                                           //数据库域名
    private $db_usr     =           'root';                     //数据库用户名
    private $db_pwd     =           '0587';                     //数据库密码
    private $db;                                                //当前数据库链接
    private static $obj =           null;                       //属性值为对象,默认为null

    private function  __construct(){
        $this->db_host = (strpos($_SERVER['HTTP_HOST'],'localhost') !== false)? '118.126.93.163:3306' : 'localhost';
        $db = mysqli_connect($this->db_host,$this->db_usr,$this->db_pwd);
        if($db){
            mysqli_select_db($db,'xt');
            mysqli_query($db,'set names \'utf8\'');
            $this->db = $db;

            return $this;
        }else{
            error('数据库链接失败：'.mysqli_error($db));
        }
    }

    public static function init(){
        if(self::$obj === null){
            self::$obj = new self();
        }

        return self::$obj;
    }

    public function query($sql,$dbResultToArray = false){
        if($this->db){
            $res = mysqli_query($this->db,$sql);
            if($dbResultToArray){
                $res = fetchDbResult($res);
            }

            return $res;
        }else{
            error('db instance not found!');
            die();
        }
    }
}

function fetchDbResult($dbResult){
    $data = [];
    while($row = mysqli_fetch_assoc($dbResult)){
        $data[] = $row;
    }

    return $data;
}