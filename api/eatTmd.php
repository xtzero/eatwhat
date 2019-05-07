<?php
    require_once('lib/entry.php');
    class eatTmd extends entry{
        public function __construct(){
            parent::__construct();
        }

        public function run(){
            $this->param('id');
			$res = db::init() -> query("UPDATE eatwhat SET eatcount=eatcount+1 WHERE id={$this->id};");
            if($res){
				$_SESSION[$md5sql] = json_encode($res);
                ajax(0,'成功');
            }else{
                ajax(-1,'没有记录',[]);
            }
        }
    }

    runApp();