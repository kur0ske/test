<html>
	<head>
		<meta http-equiv="REFRESH" content="2;URL=./tagTop.php">
		<title>タグ情報更新</title>
	</head>
	<body>
		<h1>タグ情報更新</h1>

			<?php

			session_start(); //session開始

			require_once 'DBmanager.php'; //DBマネージャーの読み込み
			$con = connect(); //データベース接続

			sessionCheck($_SESSION['id'],$_SESSION['pass']);//セッションの確認

			//選択されたタグを更新する
			tagUpdate($_POST['tagZyoho']);
			if ($_POST['tagZyoho'][2] != 2) {
			trDelete($_POST['tagZyoho'][0]);
				if(isset($_POST['kanrenTag'])){
					foreach( $_POST['kanrenTag'] as $value ){
					trRelation($_POST['tagZyoho'][0],$value);
					}
				}
			}
			if ($_POST['tagZyoho'][2] != 0) {
			tjrDelete($_POST['tagZyoho'][0]);
				if(isset($_POST['kanrenJob'])){
					foreach( $_POST['kanrenJob'] as $value ){
					tjrRelation($_POST['tagZyoho'][0],$value);
					}
				}
			}

			echo $_POST['tagZyoho'][1]."タグを更新しました";
			
			dconnect($con); //データベース切断

			?>
	</body>
</html>
