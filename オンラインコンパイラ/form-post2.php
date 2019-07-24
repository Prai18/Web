<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <link rel="stylesheet" type="text/css" href="source-box2.css" media="screen">
  <title>フォームからPOSTで送信されたデータを表示 - サンプル2 - PHP入門 - Webkaru</title>
</head>
<body>
 <!--  ///////////////////////////////////////////////////// -->
 <div class="main">
  <div class="main1">
    <?php
    
if (isset($_POST["sourcecode"])){         // ソースコードが入力されたときに実行
  $sourcecode = $_POST["sourcecode"];
  $source=htmlspecialchars($sourcecode);

  if( get_magic_quotes_gpc() ) { 
    $sourcecode = stripslashes("$sourcecode"); 
     }     //クォートをエスケープする


    $write = $sourcecode;   //新しく書き込むデータを <> で区切って整形
    $file = fopen ("sample.py","w+");    //書き込み用モードでデータを開く
    flock ($file, LOCK_EX);    //ファイルロック開始
    fputs ($file,$write);     //書き込み処理
    flock ($file, LOCK_UN);     //ファイルロック解除
    fclose ($file);      //ファイルを閉じる
  }

  ?>
  <p>〜ソースコード〜</p>
  <div class="srcprint">
    <?= isset($sourcecode) ? nl2br(htmlspecialchars($sourcecode, ENT_QUOTES)) : ""?>
  </div>

  <p>〜実行結果〜</p>
  <div class="result">
    <?php  $command="python sample.py";
    exec($command,$output);
    print "$output[0]\n";
    print "$output[1]\n";
    ?> 
  </div>
</div>
<!--  ///////////////////////////////////////////////////// -->
<div class="main2">
  <?php
  try {
  // DBへ接続
    $dbh = new PDO('sqlite:./users.db');
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if (@$_POST['msg'] != ''){

      $sql="INSERT INTO keijiban(comment) VALUES(:comment)";
      $statement=$dbh->prepare($sql);
      $statement->bindParam(':comment',$_POST['msg']);

      $statement->execute();
    }

 //////////////////コメントの表示///////////////////////////  
    $sql = 'SELECT * FROM keijiban';
    $res = $dbh->query($sql);
/////////////////////////////////////////////////////////  

  } catch(PDOException $e) {

    echo $e->getMessage();
    die();
  }



// 接続を閉じる
  $dbh = null;

  ?>

  <form action="form-post2.php" method="post">
    <p>〜メッセージ〜<br>
      <textarea name="msg" rows="5" cols="30" class="tea">
      </textarea><br>
      <div class="cmt">
        <input type="hidden" name="sourcecode" value="<?= isset($sourcecode) ? htmlspecialchars($sourcecode, ENT_QUOTES) : "" ?>">
        <input type="submit" value="送る">
        <input type="reset" value="クリア"></p>
      </form>


      <?php
      foreach( $res as $value ) {
        echo "$value[comment]<br>";
      }
      ?>
    </div>
  </div>
</div>
</body>
</html>
