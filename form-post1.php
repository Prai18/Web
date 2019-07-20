<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<link rel="stylesheet" type="text/css" href="source-box.css" media="screen">
<title>フォームからPOSTで送信されたデータを表示 - サンプル1 - PHP入門</title>
</head>
<body>
<form method="POST" action="form-post1.php">
<label>ソースコードを入力してください：</label>
<br>
<textarea name="sourcecode" rows="4" cols="40" id="src"></textarea><br>
<input type="submit" value="送信" />
</form>
<?php

if (isset($_POST["sourcecode"])){         // ソースコードが入力されたときに実行
          $sourcecode = $_POST["sourcecode"];  	 //POSTのデータを変数$nameに格納
          if( get_magic_quotes_gpc() ) { 
            $sourcecode = stripslashes("$sourcecode"); 
          }    	//クォートをエスケープする


            $write = $sourcecode;  	//新しく書き込むデータを <> で区切って整形
            $file = fopen ("sample.py","w+");  	 //書き込み用モードでデータを開く
            flock ($file, LOCK_EX); 	 //ファイルロック開始
            fputs ($file,$write);   	//書き込み処理
            flock ($file, LOCK_UN);  	  //ファイルロック解除
            fclose ($file); 		 //ファイルを閉じる
            
            $command="python sample.py ";
            exec($command,$output);
            print "$output[0]\n";
            print "$output[1]\n";
          }
?>
</body>
</html>
