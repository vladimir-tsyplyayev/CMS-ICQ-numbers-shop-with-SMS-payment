<?
	$access_data = file('access.txt');
	$user_founded=0;
	if(isset($_POST["user"]) && isset($_POST["pass"])){		if(strcmp(trim($access_data[0]),trim($_POST["user"]))==0 && strcmp(trim($access_data[1]),trim($_POST["pass"]))==0){			$user_founded=1;
			setcookie("user_id",trim($access_data[3]));		}
	}else{		if(isset($_COOKIE["user_id"])){			if(strcmp(trim($access_data[3]),trim($_COOKIE["user_id"]))==0){				$user_founded=1;			}		}	}

	if(isset($_GET["logout"])){  		setcookie("user_id",'');
  		$user_founded=0;
  		print('
		<script>
			window.location.replace("index.php");
		</script>
		');	}


?>