<?php
    require_once('lib/entry.php');
    class all extends entry{
        public function __construct(){
            parent::__construct();
        }

        public function run(){
            $db = db::init();
            $res = $db -> query("SELECT * FROM eatwhat WHERE 1",true);
            if($res){
                ajax(0,'成功',count($res));
            }else{
                ajax(-1,'没有了',[]);
            }
        }
    }

    runApp();