
<?php
require_once('dbc.php');

Class Blog extends Dbc
{
    protected $table_name='blog';
//3.カテゴリー名を表示
//引数:数字
//返り値:カテゴリーの文字列
    public  function setCategoryName($category){
    if ($category =='1'){
        return "日常";
    }elseif ($category=='2'){
        return "プログラミング";
    }else{
        return "その他";
    }
}//
public function blogCreate($blogs){
    $sql = "INSERT into $this->table_name(title,content,category,publish_status) values(:title, :content, :category, :publish_status)";
$dbh=$this->dbConnect();
$dbh->beginTransaction();

try{
    $stmt=$dbh->prepare($sql);
    $stmt->bindValue(':title',$blogs['title'],PDO::PARAM_STR);
    $stmt->bindValue(':content',$blogs['content'],PDO::PARAM_STR);
    $stmt->bindValue(':category',$blogs['category'],PDO::PARAM_INT);
    $stmt->bindValue(':publish_status',$blogs['publish_status'],PDO::PARAM_INT);
    $stmt->execute();
    echo'ブログを投稿しました';
    $dbh->commit();

}catch(PDOException $e){
    $dbh->rollBack();
    exit($e);
    }
}
public function blogUpdate($blogs){
    $sql = "UPDATE $this->table_name SET title =:title,content=:content,category=:category,publish_status=:publish_status where id=:id ";
    $dbh=$this->dbConnect();
    $dbh->beginTransaction();

try{
    $stmt=$dbh->prepare($sql);
    $stmt->bindValue(':title',$blogs['title'],PDO::PARAM_STR);
    $stmt->bindValue(':content',$blogs['content'],PDO::PARAM_STR);
    $stmt->bindValue(':category',$blogs['category'],PDO::PARAM_INT);
    $stmt->bindValue(':publish_status',$blogs['publish_status'],PDO::PARAM_INT);
    $stmt->bindValue(':id',$blogs['id'],PDO::PARAM_INT);

    $stmt->execute();
    echo'ブログを更新しました';
    $dbh->commit();

}catch(PDOException $e){
    $dbh->rollBack();
    exit($e);
    }
}
//ブログのバリデーション
public function blogVaridate($blogs){
    if(empty($blogs['title'])){
       exit ('タイトルを入力してください');
    }
    
    if(mb_strlen($blogs['title'])>191){
        exit('191以下へ');
    }
    
    if(empty($blogs['content'])){
        exit ('本文を入力してください');
     }
     if(empty($blogs['category'])){
        exit ('カテゴリーを入力してください');
     }
     if(empty($blogs['publish_status'])){
        exit ('ステータスを入力してください');
     }
 }

}
    ?>
