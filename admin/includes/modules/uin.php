<?

if(isset($_GET['delete'])){
	if(isset($_GET['uin_id'])){
		if(file_exists('../../uin/'.$_GET['uin_id'].'.txt')){
			unlink('../../uin/'.$_GET['uin_id'].'.txt');
		}
	}
}else{
  		if(isset($_POST['uin_id'])){  			if(isset($_POST['temp_uin'])){  				if(!$_POST['temp_uin']==0){  					unlink('../../uin/'.$_POST['temp_uin'].'.txt');  				}  			}
  			$new_file_name = $_POST['uin_id'];
			// Save new group file
	        $file = fopen('../../uin/'.$new_file_name.'.txt', "w");
	        if(isset($_POST['group'])){   	            $groups_files = GLOB('../../groups/*.txt');
	            $group_data = file($groups_files[$_POST['group']]);
				fputs($file, trim($group_data[0]).'
');
    	    }else{
				fputs($file, '0
');
	        }

			if(isset($_POST['sold'])){
				fputs($file, trim($_POST['sold']).'
');
			}else{
				fputs($file, '0
');
			}
			if(isset($_POST['uin_pas'])){
				fputs($file, trim($_POST['uin_pas']).'
');
			}else{
				fputs($file, '0
');
			}

			fclose($file);
		}
}
		// Return back
		print('
		<script>
			window.location.replace("../index.php?p=1");
		</script>
		');

?>