<html>
	<head>
		<div class="head">
		<title>管理者</title>
			<link href="kanristyle.css" rel="stylesheet" type="text/css">
	</head>
<body>
		<h1>学科情報追加</h1>
	<div align="right">
		<h3><a href='./kanri.php'>管理TOPページへ戻る</a><br></h3>
		<h3><a href='./schoolTop.php'>学校・学科TOPページへ戻る</a><br></h3>
		</div></div>

<script type="text/javascript">
//ポップアップのソース
function disp(){
	// 「OK」時の処理開始 ＋ 確認ダイアログの表示
        var flag = confirm ( "この内容で追加してよろしいですか？");
        /* send_flg が TRUEなら送信、FALSEなら送信しない */
        return flag;
}
</script>

<?php
	session_start(); //session開始

	require_once 'DBmanager.php'; //DB読込
	$con = connect(); //DB接続

	sessionCheck($_SESSION['id'],$_SESSION['pass']);//セッションの確認

		echo "<form action=departmentInsert.php method =POST onsubmit='return disp()'>";
		echo "<center>学科名 : <INPUT TYPE=TEXT NAME='name' style='font-family:Tahoma; ime-mode:disabled;' pattern='^[ぁ-んァ-ヶーa-zA-Z0-9一-龠０-９、。\n\r]+$' title='日本語で入力してください' required><br /><br /></center>";
		
					echo "<div class='left'><H4>この学科の属する学校を選択してください</H4>";
					$SchoolAll = getSchoolAll();
					//１ループでタグ1つがチェックボックス形式で表示され、データが無くなるとループを抜けます。
					$selectedTagFrag ='0';
					foreach($SchoolAll as $data){
if($selectedTagFrag =='0'){ echo "<input type='radio' name='school' value='".$data[0]."' checked='checked'>". $data[1]."<br>"; $selectedTagFrag ='1';}
					else  { echo "<input type='radio' name='school' value='".$data[0]."'>". $data[1]."<br>";}
					}
					echo "<H4>関連する職業を選択してください</H4>";
					$jobAll = jobAll();	//全ての職業を取得
					//１ループでタグ1つがチェックボックス形式で表示され、データが無くなるとループを抜けます。
					foreach($jobAll as $data){
					echo "<input name='RenkeiJob[]' type='checkbox' value='".$data[0]."'>". $data[1]."<br>";
					}
		echo "<br /></div><center><input type =submit value=追加></center>";
		echo "</form>";

	//データベース切断
	dconnect($con);
?>
	
	</body>
</html>