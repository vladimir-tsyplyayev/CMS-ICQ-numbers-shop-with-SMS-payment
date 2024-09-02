<?php

require('template/header.php');
ini_set('display_errors',0);

if(isset($_GET['p'])){

if($_GET['p']==1){require('template/payment.php');}
if($_GET['p']==2){require('template/about.php');}
if($_GET['p']==3){require('template/contact.php');}

}else{

$uin_files = GLOB('uin/*.txt');
 	$uins = array();
 	$uins_count = array();
 	for($i=0;$i<=10;$i++){
 		$uins_count[$i] = 0;
 		$uins[$i] = array();
 	}
 	foreach($uin_files as $v){
 		$uin_data = file($v);
 		$link = explode('/',$v);
 		$uin_id = trim(str_replace('.txt','',$link[(count($link)-1)]));
 		$uins_count[strlen($uin_id)] ++;
 		$uins[strlen($uin_id)][$uins_count[strlen($uin_id)]] = $uin_id;
 	}

print('<b>ICQ UIN Catalog</b><br><br>');
for($i=0;$i<=10;$i++){
	if($uins_count[$i]>0){
print('<br><br><b style="color:red;">'.$i.' digits</b><br><br>
    <table border="0" cellspacing="0" cellpadding="0">
 		<tr style="background-color:#9fc795;">
			<td class="table_title">UIN</td>
			<td class="table_title">Price</td>
			<td class="table_title" colspan="2">Buy</td>
		</tr>');

 		foreach($uins[$i] as $v){
 			$uin_data = file('uin/'.$v.'.txt');
 			$uin_id = $v;
 			if(trim($uin_data[1])*1==0){
	 			print(' 		<tr>
				<td style="font-weight:bold;">'.$uin_id.'</td>
				<td>'.trim($uin_data[0]).'</td>
				<td><a href="buy.php?uin='.$uin_id.'"><img src="template/images/buy.jpg" border="0" ></a></td>
				</tr>');
			}
		}

	print('</table>');
	}
}

}

require('template/footer.php');

?>
