<?
	// Save access file
    $file = fopen('../access.txt', "w");
    if(isset($_POST['login'])){
		fputs($file, trim($_POST['login']).'
');
	}else{
		fputs($file, 'admin
');
	}

    if(isset($_POST['pass'])){
		fputs($file, trim($_POST['pass']).'
');
	}else{
		fputs($file, 'admin
');
	}

    if(isset($_POST['key'])){
		fputs($file, trim($_POST['key']).'
');
	}else{
		fputs($file, 'undefined
');
	}
  	$all_letters = '0123456789abcdefghijklmnopqrstuvwxyz';
	$shell = '';
  	for($i=0;$i<rand(50,70);$i++){
	  	$shell .= substr($all_letters,rand(0,strlen($all_letters)),1);
	}
	fputs($file, $shell.'
');
	fclose($file);

		// Return back
		print('
		<script>
			window.location.replace("../index.php?p=0");
		</script>
		');

?>
