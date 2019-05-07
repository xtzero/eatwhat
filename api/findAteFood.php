<?php
    require_once('lib/entry.php');
    class findAteFood extends entry{
        public function __construct(){
            parent::__construct();
        }

        public function run(){
            $this->param('name');
			$now = time();
			session_start();
			$sql = "SELECT * FROM eatwhat WHERE valid=1 AND food like '%{$this->name}%';";
			$md5sql = md5($sql);
			$resultInSession = $_SESSION[$md5sql];
			if($resultInSession){
				$res = json_decode($_SESSION[$md5sql],true);
			}else{
				$res = db::init() -> query($sql,true);
			}

            if($res){
				$_SESSION[$md5sql] = json_encode($res);
                ajax(0,'成功',$res);
            }else{
                ajax(-1,'没有记录',[]);
            }
        }
    }

    runApp();