<?php
    require_once('lib/entry.php');
    class addLog extends entry{
        public function __construct(){
            parent::__construct();
        }

        public function run(){
            $this->param('food,phone');
            $now = time();
            $db = db::init();
            $insert = $db -> query("INSERT INTO eatwhat(food,create_at,valid) VALUES('{$this->food}','{$now}',1)");
            if($insert){
                ajax(0,'成功',[]);
            }else{
                ajax(-1,'添加失败',[]);
            }
        }
    }

    runApp();