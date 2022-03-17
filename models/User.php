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
        
        // データを1件登録するメソッド
        public function save(){
            try {
                $pdo = self::get_connection();
                // 新規ユーザー登録の時
                if($this->id === null){
                    $stmt = $pdo->prepare("INSERT INTO users (name, age, gender) VALUES (:name, :age, :gender)");
                    // バインド処理
                    $stmt->bindParam(':name', $this->name, PDO::PARAM_STR);
                    $stmt->bindParam(':age', $this->age, PDO::PARAM_INT);
                    $stmt->bindParam(':gender', $this->gender, PDO::PARAM_STR);
                    // 実行
                    $stmt->execute();
                }else{ // 更新の時
                    $stmt = $pdo->prepare("UPDATE users SET name=:name, age=:age, gender=:gender WHERE id=:id");
                    // バインド処理
                    $stmt->bindParam(':name', $this->name, PDO::PARAM_STR);
                    $stmt->bindParam(':age', $this->age, PDO::PARAM_INT);
                    $stmt->bindParam(':gender', $this->gender, PDO::PARAM_STR);
                    $stmt->bindParam(':id', $this->id, PDO::PARAM_INT);
                    // 実行
                    $stmt->execute();
                }
                
                self::close_connection($pdo, $stmt);
                if($this->id === null){
                    return $this->name . "さんの新規ユーザー登録が成功しました。";
                }else{
                    return $this->id . "のユーザー情報を更新しました。";
                }
                
            } catch (PDOException $e) {
                return 'PDO exception: ' . $e->getMessage();
            }
        }
        
        // 指定されたidからデータを1件取得するメソッド
        public static function find($id){
            try {
                $pdo = self::get_connection();
                $stmt = $pdo->prepare("SELECT * FROM users WHERE id=:id");
                // バインド処理
                $stmt->bindParam(':id', $id, PDO::PARAM_INT);
                // 実行
                $stmt->execute();
                // フェッチの結果を、Userクラスのインスタンスにマッピングする
                $stmt->setFetchMode(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE, 'User');
                $user = $stmt->fetch();
                self::close_connection($pdo, $stmt);
                // Userクラスのインスタンスを返す
                return $user;
                
            } catch (PDOException $e) {
                return 'PDO exception: ' . $e->getMessage();
            }
        }
        
        // インスタンスをMySQLから削除するメソッド
        public function delete(){
             try {
                $pdo = self::get_connection();
                $stmt = $pdo->prepare("DELETE FROM users WHERE id=:id");
                // バインド処理
                $stmt->bindParam(':id', $this->id, PDO::PARAM_INT);
    
                // 実行
                $stmt->execute();
                self::close_connection($pdo, $stmt);
                return $this->name . "さんの登録を削除しました。";
                
            } catch (PDOException $e) {
                return 'PDO exception: ' . $e->getMessage();
            }
        }
        
        public static function destroy($id){
             try {
                $pdo = self::get_connection();
                $stmt = $pdo->prepare("DELETE FROM users WHERE id=:id");
                // バインド処理
                $stmt->bindParam(':id', $id, PDO::PARAM_INT);
                $name = (self::find($id))->name;
                // 実行
                $stmt->execute();
                self::close_connection($pdo, $stmt);
                return $name . "さんの登録を削除しました。";
                
            } catch (PDOException $e) {
                return 'PDO exception: ' . $e->getMessage();
            }
        }
    }