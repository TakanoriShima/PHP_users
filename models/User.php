<?php
    // モデル(M)
    // ユーザーの設計図
    class User {
        // プロパティ
        public $name; // 名前
        public $age; // 年齢
        public $gender; // 性別
        // コンストラクタ
        public function __construct($name, $age, $gender){
            // プロパティの初期化
            $this->name = $name;
            $this->age = $age;
            $this->gender = $gender;
            // print $this->name . 'が生まれた' . PHP_EOL;
            // print "{$this->name}が生まれた\n";
        }
        public function drink(){
            if($this->age >= 20){
                return 'お酒OK' . PHP_EOL;
            }else{
                return 'お酒NG' . PHP_EOL;
            }
        }
    }