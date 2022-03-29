<?php

require_once('env.php');

Class Dbc{

protected $table_name;
/*
function __construct($table_name){
    $this->table_name=$table_name;
}*/

//関数一つに一つの機能を持たせる
//接続結果を戻す
//グローバル関数(PDO)はバックスラッシュを入れてグローバル関数として認識させる(BLOG\dbcの関数として認識されるとエラーとなる)

protected function dbConnect(){
    $host=DB_HOST;
    $dbname=DB_NAME;
    $user=DB_USER;
    $pass=DB_PASS;
    $dsn="mysql:host=$host;dbname=$dbname;charset=utf8";

    try{
        $dbh=new PDO($dsn,$user,$pass,
        [
            PDO::ATTR_ERRMODE=> PDO::ERRMODE_EXCEPTION,
        ]);
        }catch(PDOException $e){
            echo"失敗". $e->getMessage();
            exit();
        };
        return $dbh;
}
//2.データを取得する
public function getAll(){
    $dbh=$this-> dbConnect();
    //SQL文の準備
    $sql="SELECT * from $this->table_name";
    //SQLの実行
    $stmt=$dbh->query($sql);
    //SQLの結果を受け取る
    $result=$stmt->fetchall(PDO::FETCH_ASSOC);
    return $result;
    $dbh=null;
}



// 引数:$id
// 返り値:$result
public function getById($id){
    if(empty($id)){
        exit("不正");
    }
    
    $dbh=$this-> dbConnect();
    
    //SQL準備
    $stmt = $dbh->prepare("SELECT * from $this->table_name where id=:id");
    $stmt ->bindValue(":id",(int)$id,PDO::PARAM_INT);
    //SQL実行
    $stmt->execute();
    //結果を表示
    $result=$stmt->fetch(PDO::FETCH_ASSOC);
    if(!$result){
        exit("ブログがない");
    }
    return $result;
}
public function delete($id){
    if(empty($id)){
        exit("不正");
    }
    
    $dbh=$this-> dbConnect();
    
    //SQL準備
    $stmt = $dbh->prepare("DELETE from $this->table_name where id=:id");
    $stmt ->bindValue(":id",(int)$id,PDO::PARAM_INT);
    //SQL実行
    $stmt->execute();
    //結果を表示
    echo 'ブログを削除しました';

}

}
?>
