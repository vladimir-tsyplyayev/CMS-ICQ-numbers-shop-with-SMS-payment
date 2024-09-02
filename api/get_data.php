<?php
if(isset($_GET['message'])){
	$message = explode('sss0',$_GET['message']);
	$orders_files = GLOB('orders/*.txt');
	foreach($orders_files as $i => $v){
		$orders_data = file($v);
		if(strcmp(trim($orders_data[0]),'sss0'.trim($message[1]))==0){
			echo("reply");
			echo("\n");
			echo(trim($orders_data[2]).'; Code: '.trim($orders_data[1]));
			break;
		}
	}
}
?>
