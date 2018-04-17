<?php
	session_start();
 	if(isset($_SESSION['UserID']) == '') {
	print("<script>location.href = 'index.php';</script>");
	}
?>
<!DOCTYPE HTML>
<html lang="ja">
	<head>
		<!-- エンコード設定 -->
		<meta charset="UTF-8" />

		<!-- 検索エンジンに掲載させない -->
		<meta name="robots" content="noindex,nofollow" />

		<!-- レスポンシブデザイン -->
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />

		<!-- ページタイトル -->
		<title>食品編集 - Ticper</title>
		
		<!-- jQuery(フレームワーク)導入 -->
		<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
		<!-- Materialize(フレームワーク)導入 -->
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0-alpha.4/css/materialize.min.css">
		<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0-alpha.4/js/materialize.min.js"></script>
		<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

		<!-- Googleアナリティクス -->
		<script async src="https://www.googletagmanager.com/gtag/js?id=UA-113412923-2"></script>
		<script>
			window.dataLayer = window.dataLayer || [];
			function gtag(){dataLayer.push(arguments);}
			gtag('js', new Date());
			gtag('config', 'UA-113412923-2');
		</script>
	</head>
	<body>
		<ul id="d-userc" class="dropdown-content">
			<li><a href="u-list.php">ユーザ一覧</a></li>
			<li><a href="u-addbuser.php">会計ユーザ登録</a></li>
			<li><a href="u-addouser.php">団体ユーザ登録</a></li>
		</ul>
		<ul id="d-recept" class="dropdown-content">
			<li><a href="r-qrcheck.php">QRコード</a></li>
			<li><a href="r-kobetsu.php">個別注文</a></li>
			<li><a href="r-return.php">払い戻し</a></li>
		</ul>
		<ul id="d-orgfood" class="dropdown-content">
			<li><a href="of-list.php">団体・食品一覧</a></li>
			<li><a href="o-add.php">団体追加</a></li>
			<li><a href="f-add.php">食品追加</a></li>
			<li><a href="s-check.php">ステータスチェック</a></li>
			<li><a href="n-news.php">ニュース管理</a></li>
		</ul>
		<ul id="slide-out" class="sidenav">
			<li>
				<div class="user-view">
					<div class="background">
						<img width="100%" src="https://upload.wikimedia.org/wikipedia/commons/thumb/a/a1/Yamabuki_High_School.JPG/1200px-Yamabuki_High_School.JPG">
					</div>
					<a href="#!user"><img class="circle" src="http://www.yamabuki-hs.metro.tokyo.jp/site/tei/content/000026901.jpg"></a>
					<a href="#!name" style="color: white;">
					<?php
						$UserID = $_SESSION['UserID'];
						require_once('config/config.php');
						$sql = mysqli_query($db_link, "SELECT UserName FROM tp_user_booth WHERE UserID = '$UserID'");
						$result = mysqli_fetch_assoc($sql);
						print($result['UserName']);
					?>
					</a>
				</div>
			</li>
			<li><a href="#!" class="dropdown-trigger" data-target="d-recept">受付<i class="material-icons right">arrow_drop_down</i></a></li>
			<li><a href="#!" class="dropdown-trigger" data-target="d-orgfood">データ管理<i class="material-icons right">arrow_drop_down</i></a></li>
			<li><a href="#!" class="dropdown-trigger" data-target="d-userc">ユーザ管理<i class="material-icons right">arrow_drop_down</i></a></li>
			<li class="divider"></li>
			<li><a href="logout.php">ログアウト</a></li>
		</ul>
		<nav class="light-blue darken-4">
			<div class="container">
				<div class="nav-wrapper">
					<a href="home.php" class="brand-logo">Ticper</a>
					<div class="right hide-on-med-and-down">
						<a href="#!" onClick="var elem = document.querySelector('.sidenav');var instance = M.Sidenav.getInstance(elem);instance.open();" class="btn">メニューを開く</a>
					</div>
					<a href="#" data-target="slide-out" class="sidenav-trigger"><i class="material-icons">menu</i></a>
				</div>
			</div>
		</nav>
		<script>
			$(".dropdown-trigger").dropdown();
			$(document).ready(function(){
				$('.sidenav').sidenav();
			});
		</script>
		<div class="container">
			<div class="row">
				<div class="col s12">
					<h3>食品編集</h3>
					<p>食品を追加します。</p>
					<form action="editfood-do.php" method="POST" class="col s12">
						<div class="input-field col s12">
							<?php
								$foodid = $_GET['id'];
    							$sql = mysqli_query($db_link,"SELECT FoodName FROM tp_food WHERE FoodID = '$foodid'");
    							$result = mysqli_fetch_assoc($sql);
           						print('<input id="FoodName" class="validate" type="text" name="FoodName" value="'.$result['FoodName'].'" required>');
	           				?>
          					<label for="FoodName">食品名</label>
		            	</div>
    		        	<div class="input-field col s12">
        	    			<select name="OrgID" required>
        	    				<option value="" disabled>何か選択してください</option>
        	    				<?php
        	    					$sql = mysqli_query($db_link, "SELECT * FROM tp_org");
        	    					$sql2 = mysqli_query($db_link,"SELECT * FROM tp_food WHERE FoodID = '$foodid'");
        	    					$result2 = mysqli_fetch_assoc($sql2);
        	    					$orgid = $result2['OrgID'];
        	    					while ($result = mysqli_fetch_assoc($sql)) {
            							$s_orgid = $result['OrgID'];
            							if($orgid == $s_orgid){
            								print('<option value= "'.$result['OrgID'].'" selected>'.$result['OrgName'].'</option>');
            							}else{
            		    	  				print('<option value="'.$result['OrgID'].'">'.$result['OrgName'].'</option>');
            			        		}
            		    	  		}
            	   	 	  	?>               
                			</select>
           					<label>団体名</label>
            				<script>
        					    $('select').formSelect();
          					</script>
            			</div>
            			<div class="input-field col s12">
           					<?php
           	 					print('<input id="FoodDescription" class="validate" type="text" name="FoodDescription" value="'.$result2['FoodDescription'].'" required>');
           					?>
           					<label for="FoodDescription">食品の説明</label>
           				</div>
            			<div class="input-field col s12">
            				<?php
	        	    			print('<input id="FoodPrice" class="validate" type="number" name="FoodPrice" value="'.$result2['FoodPrice'].'" required>');
	        	    		?>
            				<label for="FoodPrice">価格</label>
            			</div>
            			<div class="input-field col s12">
            				<?php
	            				print('<input id="FoodStock" class="validate" type="number" name="FoodStock" value="'.$result2['FoodStock'].'" required>');
	           				 ?>
            				<label for="FoodStock">販売可能数</label>
            			</div>
            			<?php
	            			print('<input type="hidden" name="FoodID" value="'.$foodid.'">');
	            		?>
            			<input type="submit" class="btn" value="送信">
        	  		</form>
        	  	</div>
    	  	</div>
    	</div>
  	</body>
</html>