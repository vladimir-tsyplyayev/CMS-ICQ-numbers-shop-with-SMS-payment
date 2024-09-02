<?
$groups_files = GLOB('../groups/*.txt');
?>
	<b>
	<? if(isset($_GET['uin_id'])){
			$uin_data = file('../uin/'.$_GET['uin_id'].'.txt');
			$uin_name = trim($_GET['uin_id']);
			$uin_pas = $uin_data[2];
			print('Edit ICQ UIN '.$_GET['uin_id']);

		}else{
			print('Add New ICQ UIN');
			$uin_name = '';
			$uin_pas = '';
		}
       //print_r($uin_data);
	?></b>
	<br><br>
<form action="modules/uin.php" method="POST">
<input type="hidden" name="sold" value="<? if(isset($uin_data[1])){echo trim($uin_data[1]);}else{echo 0;} ?>">
<input type="hidden" name="temp_uin" value="<? if(isset($_GET['uin_id'])){echo trim($_GET['uin_id']);}else{echo 0;} ?>">
    <table border="0" cellspacing="0" cellpadding="0">
 		<tr style="background-color:#9fc795;">
			<td class="table_title">ICQ UIN</td>
			<td class="table_title">ICQ Password</td>
			<td class="table_title">Number Group</td>
		</tr>
 		<tr>
			<td><input name="uin_id" value="<? echo $uin_name ; ?>"></td>
			<td><input name="uin_pas" value="<? echo $uin_pas ; ?>"></td>
			<td><select name="group"><?
			foreach($groups_files as $i => $v){
 			$group_data = file($v);
 			print('<option value="'.$i.'"');
            if(isset($_GET['uin_id'])){
            	if(strcmp(trim($uin_data[0]),trim($group_data[0]))==0){print(' selected ');}
            }
 			print('>'.trim($group_data[0]).'</option>');
 			}
 			?>
 			</select></td>
		</tr>
	</table>
	<br>
	<input type="submit" value="  <? if(isset($_GET['uin_id'])){print('Save');}else{print('Add');} ?>  " >
</form>
