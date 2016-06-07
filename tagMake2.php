<html>
	<head>
		<div class="head">
		<title>タグ追加</title>
			<link href="kanristyle.css" rel="stylesheet" type="text/css">
	</head>
<body>
		<h1>タグ追加</h1>
	<div align="right">
		<h3><a href='./kanri.php'>管理TOPページへ戻る</a><br></h3>
		<h3><a href='./tagTop.php'>タグTOPページへ戻る</a><br></h3>
		</div></div>

			<?php

			session_start(); //session開始

			require_once 'DBmanager.php'; //DBマネージャーの読み込み
			$con = connect(); //データベース接続
			

			sessionCheck($_SESSION['id'],$_SESSION['pass']);//セッションの確認

			echo "<center><H2>タグ名：".$_POST['tagName']."</H2>";//タグ名表示
			echo "<H2>タグ区分：";
				if($_POST['tagKubun']==0){echo "大分類タグ";}
		   else if($_POST['tagKubun']==1){echo "中分類タグ";}
				else					 {echo "感覚タグ";}
				echo "</H2></center>";//タグ区分表示


			echo "<div class='left'><form action='./tagMakeKakunin.php' method = 'POST'>";
			
				if ($_POST['tagKubun'] == '1') {//中分類タグなら
					echo "<H3>連携させたい大分類タグを選択してください</H3>";
					$tagAll = tagSelectAllKubun("0");	//指定された区分のタグ全てを取得
					//１ループでタグ1つがチェックボックス形式で表示され、データが無くなるとループを抜けます。
					foreach($tagAll as $data){
					echo "<input name='RenkeiTag[]' type='checkbox' value='".$data[0]."'>". $data[1]."<br>";
					}
				}
				
				if ($_POST['tagKubun'] == '0') {//大分類タグなら
					echo "<H3>連携させたい中分類タグを選択してください</H3>";
					$tagAll = tagSelectAllKubun("1");	//指定された区分のタグ全てを取得
					//１ループでタグ1つがチェックボックス形式で表示され、データが無くなるとループを抜けます。
					foreach($tagAll as $data){
					echo "<input name='RenkeiTag[]' type='checkbox' value='".$data[0]."'>". $data[1]."<br>";
					}
				}
				
				if ($_POST['tagKubun'] != '0') {//大分類タグ以外なら
					echo "<H3>連携させたい職業を選択してください</H3>";
					$jobAll = jobAll();	//全ての職業を取得
					//１ループでタグ1つがチェックボックス形式で表示され、データが無くなるとループを抜けます。
					foreach($jobAll as $data){
					echo "<input name='RenkeiJob[]' type='checkbox' value='".$data[0]."'>". $data[1]."<br>";
					}
				}

			echo "<input type='hidden' name='tagName' value='".$_POST['tagName']."'>";
			echo "<input type='hidden' name='tagKubun' value='".$_POST['tagKubun']."'>";
			
			echo "</div><center><input type='submit' value='確認画面へ'/>";
			echo "</form>";
			
			dconnect($con); //データベース切断

			?>
		</center>
	</body>
</html>
