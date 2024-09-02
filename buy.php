<?php

require('template/header.php');
ini_set('display_errors',0);
if(isset($_GET['code']) && isset($_GET['code1'])){
	$sold = 0;
	$orders_files = GLOB('api/orders/*.txt');
	foreach($orders_files as $i => $v){
		$orders_data = file($v);
		if(strcmp(trim($orders_data[0]),trim($_GET['code1']))==0){
			if(strcmp(trim($orders_data[1]),trim($_GET['code']))==0){
				$uin_file = 'uin/'.str_replace('ICQ UIN: ','',trim($orders_data[2])).'.txt';
				if(file_exists($uin_file)){
					$uin_data = file($uin_file);
					if(trim($uin_data[1])*1==0){
						print('Thank you for purchasing.<br><br>
						Here is your ICQ UIN details:<br><br>
						<b>Login: '.str_replace('ICQ UIN: ','',trim($orders_data[2])).'</b><br>
						<b>Password: '.trim($uin_data[2]).'</b><br>
						');
						$file = fopen($uin_file, "w");
						fputs($file, $uin_data[0].'1
'.$uin_data[2]);
						fclose($file);
					}else{
						print('Sorry!<br><br>UIN already sold!<br><br>Please contact administrator.');
					}
				}else{
					print('Sorry!<br><br>UIN data not found!<br><br>Please contact administrator.');
				}
				$sold = 1;
				break;
			}
		}
	}
	if($sold == 0){
		print('<b>Wrong code!</b><br><br>
		Please enter recieved code one more time:<br>
		<form>
	    <input name="code1" value="'.$_GET['code1'].'" type="hidden">
		<input name="code"><br><br>
		<input type="submit" value="  Verify code >>  " >
		</form>
		');
	}
}else{

if(isset($_GET['uin'])){

	print('<b>BUY ICQ UIN:</b>&nbsp;&nbsp;&nbsp;<b style="color:red;">'.$_GET['uin'].'</b><br><br>');
	$uin_data = file('uin/'.$_GET['uin'].'.txt');

	// read all group
	$groups_files = GLOB('groups/*.txt');
	foreach($groups_files as $i => $v){
		$group_data = file($v);
		if(strcmp(trim($uin_data[0]),trim($group_data[0]))==0){
			break;
		}
	}

	// read coutryes
    $read_temp = file('profit-bill_tariffs.csv');
    $csv = array();
    $countries_temp = array();
    foreach($read_temp as $i => $v){
      	if($i>0){
        	$csv[($i-1)] = explode(';',trim($v));
        	$countries_temp[($i-1)] = $csv[($i-1)][0];
        }
    }
    $countries = array_unique($countries_temp);
    $jj=2;
	foreach($countries as $i => $v){
		$countryes_names[$jj] = $v;
		$jj++;
	}
	if(isset($_GET['country']) && !isset($_GET['creat_order'])){
        $code = $_GET['code'];
		print('<form><a>Price: <b style="color:red;">'.
		trim($csv[trim($group_data[$_GET['country']])*1][4])
		.'</b>
		<br><br>Send SMS with text: "<b>'.trim($csv[trim($group_data[$_GET['country']])*1][6]).$code.'</b>" to short number <b>'.trim($csv[trim($group_data[$_GET['country']])*1][2]).'</b>, then you will get back answer with code.<br><br>

		Enter recieved code here:<br></a>
		<input name="code1" value="'.$code.'" type="hidden">
		<input name="code"><br><br>
		<input type="submit" value="  Verify code >>  " >
		</form>
	');

	}else{

		if(isset($_GET['creat_order'])){

			$all_letters = '0123456789abcdefghijklmnopqrstuvwxyz';
			$shell = '';
			for($i=0;$i<rand(50,70);$i++){
			  	$shell .= substr($all_letters,rand(0,strlen($all_letters)),1);
			}
			$code = 'sss0';
			for($i=0;$i<rand(5,7);$i++){
			  	$code .= substr($all_letters,rand(0,9),1);
			}
			$resp = '';
			for($i=0;$i<rand(5,7);$i++){
			  	$resp .= substr($all_letters,rand(0,9),1);
			}
	  		$file = fopen('api/orders/'.$shell.'.txt', "w");
			fputs($file, $code.'
'.$resp.'
ICQ UIN: '.trim($_GET['uin']).'
'.trim($countryes_names[trim($_GET['country'])]).'
SMS number: '.trim($csv[trim($group_data[$_GET['country']])*1][2]).'
SMS Prefix: '.trim($csv[trim($group_data[$_GET['country']])*1][6]).$code.'
Date: '.date("m.d.y (G:i)").'
IP: '.$_SERVER['REMOTE_ADDR']
);
			fclose($file);

			print('
			<script>
				window.location.replace("buy.php?uin='.$_GET['uin'].'&country='.$_GET['country'].'&code='.$code.'");
			</script>
			');

		}else{

			// print coutryes data by group
			print('Select your country:<br><br>
			<form>
			<input type=hidden name="uin" value="'.$_GET['uin'].'">
			<input type=hidden name="creat_order" value="1">
			<select name="country" style="width:180px;">');
			$jj=2;
			foreach($countries as $i => $v){
				print('<option value="'.$jj.'">'.$v.'</option>');
				$jj++;
			}
			print('</select><br><br>
			<input type="submit" value="  Next >>  " >
			</form>
			');
		}
	}

}else{
		print('
		<script>
			window.location.replace("index.php");
		</script>
		');
}
}

require('template/footer.php');

?>
