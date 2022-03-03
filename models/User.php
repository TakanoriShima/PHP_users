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
        // 入力値を検証するメソッド
        public function validate(){
            $errors = array();
            if($this->name === ''){
                $errors[] = '名前を入力してください';
            }
            if($this->age === ''){
                $errors[] = '年齢を入力してください';
            }else if(!preg_match('/^[0-9]+$/', $this->age)){
                $errors[] = '年齢は正の整数を入力してください';
            }
            return $errors;
        }
    }