<?php
    require_once 'models/Model.php';
    // モデル(M)
    // ユーザーの設計図
    class User extends Model{
        // プロパティ
        public $id; // ID
        public $name; // 名前
        public $age; // 年齢
        public $gender; // 性別
        public $created_at; // 登録日時
        // コンストラクタ
        public function __construct($name='', $age='', $gender=''){
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
        
        // 全テーブル情報を取得するメソッド
        public static function all(){
            try {
                $pdo = self::get_connection();
                $stmt = $pdo->query('SELECT * FROM users ORDER BY id DESC');
                // フェッチの結果を、Userクラスのインスタンスにマッピングする
                $stmt->setFetchMode(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE, 'User');
                $users = $stmt->fetchAll();
                self::close_connection($pdo, $stmt);
                // Userクラスのインスタンスの配列を返す
                return $users;
            } catch (PDOException $e) {
                return 'PDO exception: ' . $e->getMessage();
            }
        }
    }