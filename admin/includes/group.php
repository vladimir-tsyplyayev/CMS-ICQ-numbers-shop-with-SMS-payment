	<? $alert = 0; if(file_exists('../profit-bill_tariffs.csv')){ ?>
	<b>
	<? if(isset($_GET['group_id'])){
			$group_data = file('../groups/'.$_GET['group_id'].'.txt');
			$group_name = trim($group_data[0]);
			print('Edit Group "'.$group_name.'"');

		}else{
			print('Add New Group');
			$group_name = '? руб';
		}

	    $read_temp = file('../profit-bill_tariffs.csv');
	    $csv = array();
	    $countries_temp = array();
        foreach($read_temp as $i => $v){
        	if($i>0){
	        	$csv[($i-1)] = explode(';',trim($v));
	        	$countries_temp[($i-1)] = $csv[($i-1)][0];
	        }
        }
        $countries = array_unique($countries_temp);
    if(!count($countries)==0){
    ?>
	</b>
	<br><br>
    <form><input type=hidden name="p" value="2">
    <? if(isset($_GET['group_id'])){print('<input type=hidden name="group_id" value="'.trim($_GET['group_id']).'">');} ?>
    <table border="0" cellspacing="0" cellpadding="0">
 		<tr>
			<td class="table_title" style="background-color:#9fc795; vertical-align:middle;">Select price, RUR</td>
			<td><input name="price" value="<? if(isset($_GET['price'])){print($_GET['price']);} ?>" > <input type=submit value=" Sort "></td>
		</tr>
	</table>
	</form>

    <form action="modules/group.php" method="POST">
    <? if(isset($_GET['group_id'])){print('<input type=hidden name="group_id" value="'.trim($_GET['group_id']).'">');} ?>
    <table border="0" cellspacing="0" cellpadding="0">
 		<tr>
			<td class="table_title" style="background-color:#9fc795; vertical-align:middle;">New Group Name</td>
			<td><input name="name" value="<? echo $group_name; ?>" > <input type="submit" value="  <? if(isset($_GET['group_id'])){print('Save');}else{print('Add');} ?>  " ></td>
		</tr>
	</table>
    <table width="100" border="0" cellspacing="0" cellpadding="0">
 		<tr>
			<td style="font-weight:bold;">Country</td>
			<td style="font-weight:bold;">Number/Price</td>
		</tr>
		<?
        $price = 0;
        $ji = 1;
		if(isset($_GET['price'])){ $price = $_GET['price']; }
        if(!is_numeric($price)){$price=0;};
		foreach($countries as $i => $v){
			$ji++;
			print('<tr>
			<td>'.$v.'</td>
			<td><select name="c'.$i.'" style="width:180px;">');
			$d_price = 1000;
			$number_selected = 0;
			foreach($csv as $j => $w){
				if(strcmp(trim($v),trim($w[0]))==0){
					if($price>0){
						$currnet_d_price = abs($price-$w[5]*1);
						if($d_price>$currnet_d_price && $price <= $w[5]*1){
							$d_price = $currnet_d_price;
							$number_selected = $j;
						}
					}
				}
            }
			foreach($csv as $j => $w){
				if(strcmp(trim($v),trim($w[0]))==0){
					print('<option value="'.$j.'" ');
					if(isset($_GET['group_id']) && !isset($_GET['price'])){
						if($group_data[$ji]*1 == $j){print('selected');}
					}else{
						if($number_selected == $j){print('selected');}
					}
					print('>'.$w[5].' руб => '.$w[2].'</option>');
				}
            }
			print('</select></td>
		</tr>');
		}
		?>
	</table>
	<br>

	<input type="submit" value="  <? if(isset($_GET['group_id'])){print('Save');}else{print('Add');} ?>  " >
</form>
<?
}else{
	$alert = 1;
}
}else{
	$alert = 1;
}

if($alert == 1){
print('<br>
<a href="#" class="tooltip"><span class="title">[ Why list is empty? ? ]</span>
<span class="content">
1. Open your projects list in profit-bill.com admin panel;<br>
2. Edit your project;<br>
3. Add new numbers and choose your prefixes for each coutry you need (see screenshot);<br>
<br>
<img src="images/help/add_prefix.jpg" boder="0" width="300" >
<br>
4. Then click "Refresh" list here.
</span></a>
<br><br>');
}

?>
