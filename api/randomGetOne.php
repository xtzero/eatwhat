<?php
    require_once('lib/entry.php');
    class randomGetOne extends entry{
        public function __construct(){
            parent::__construct();
        }

        public function run(){
            $db = db::init();
            $_total = $db::init() -> query("SELECT COUNT(*) AS count FROM eatwhat WHERE 1",true);
            if($_total){
                $randNum = (int)(rand(0,$_total[0]['count']-1));
                $res = $db::init() -> query("SELECT * FROM eatwhat LIMIT {$randNum},1",true);
                if($res){
                    $res[0]['create_at'] = date('Y-m-d H:i:s',$res[0]['create_at']);
                    ajax(0,'成功',$res[0]);
                }else{
                    ajax(-1,'没有数据',[]);    
                }
            }else{
                ajax(-1,'没有数据',[]);
            }
        }
    }

    runApp();