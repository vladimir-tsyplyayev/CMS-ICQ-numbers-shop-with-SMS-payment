<? require ('modules/access.php'); ini_set('display_errors',0);?>
<html>
<head>
	<title>Admin | ICQ Numbers Shop | ProfitBill.com</title>
	<meta name="description" content="Admin | ICQ Numbers Shop"/>
	<link rel="shortcut icon" href="images/favicon.ico" type="image/x-icon"/>
	<link rel="stylesheet" type="text/css" href="style.css" />
</head>
    <style type="text/css">
.fRow {
    display:block;
    float:left;
    padding:0 0 .2em 0;
}

a.tooltip {text-decoration: none;}
a.tooltip:hover { visibility:visible; }
.tooltip span.title {border-bottom:1px dashed #ddd; cursor:help; color:#7ad27c; font-weight:bold; font-size:9px;}
.tooltip { position:relative; z-index:24; }
.tooltip span.content { display:none;}
.tooltip:hover {z-index:25;}
.tooltip:hover span.content {
	display:block;
	position:absolute;
	width:300px;
	top:25px;
	left:-20px;
	background: #f8f8f8;
	line-height: 20px;
    color:#5F6370;
	padding: 5px;
	border: solid 1px #C1C4CB;
	text-decoration:none;
}
</style>
<body>
	<center>
	<div class="header">
    <span class="title">Admin - ICQ Numbers Shop</span><br>Profit-Bill.com
	</div>

	    <?
if($user_founded==1){
    	print('
	<table width="100" border="0" cellspacing="0" cellpadding="0" class="main_table">
  <tr>
    <td height="20"><a href="?p=0" class="menu">Administration</a></td>
    <td rowspan="5" style="padding:20px;">
         ');
    if(isset($_GET['p'])){


	    if($_GET['p']==0){	    	$access_data = file('access.txt');

    	?>
    <b>Administration</b><br><br>
    <form action="modules/admin.php" method="POST">
    <table width="400" border="0" cellspacing="0" cellpadding="0">
 		<tr>
			<td>Login</td>
			<td><input name="login" value="<? echo trim($access_data[0]); ?>" ></td>
		</tr>
 		<tr>
			<td>Password</td>
			<td><input name="pass" value="<? echo trim($access_data[1]); ?>" ></td>
		</tr>
 		<tr>
			<td <? if(!strlen(trim($access_data[2]))>0){print('style="color:red; font-weight:bold;"');} ?> >SMS API ID</td>
			<td><input name="key" value="<? echo trim($access_data[2]); ?>" >

			<a href="#" class="tooltip"><span class="title">[ What is this ? ]</span>
<span class="content">
Open your projects list in profit-bill.com admin panel, there you can see <b>SMS API</b> table.<br><br>
<img src="images/help/api_id.jpg" boder="0" >
<br><br> Copy and paste your project ID here.
</span></a>


			</td>
		</tr>
 		<tr>
			<td>&nbsp;</td>
			<td><input type="submit" value="  Сохранить изменения  " ></td>
		</tr>
	</table>
	</form>
	    <?
    	}




	    if($_GET['p']==1){	    	$uin_files = GLOB('../uin/*.txt');
            if(!isset($_GET['uin_id'])){
    	?>
    <b>ICQ UIN base</b><br><br>
    <table border="0" cellspacing="0" cellpadding="0">
 		<tr style="background-color:#9fc795;">
			<td class="table_title">UIN</td>
			<td class="table_title">Number/Price Group</td>
			<td class="table_title">Sold</td>
			<td class="table_title" colspan="2">Action</td>
		</tr>
		<?
 		foreach($uin_files as $v){
 			$uin_data = file($v);
 			$link = explode('/',$v);
 			$uin_id = str_replace('.txt','',$link[(count($link)-1)]);
 			print(' 		<tr');
			if($uin_data[1]*1==1){
				print(' style="background-color:#eeeeee;"');
			}
			print('>
			<td style="font-weight:bold;">'.$uin_id.'</td>
			<td>'.trim($uin_data[0]).'</td>
			<td');
			if($uin_data[1]*1==0){				print('>no');
			}else{				print(' style="font-weight:bold;">yes');			}
			print('</td>
			<td style="font-weight:bold;" width="10"><a href="?p=1&uin_id='.$uin_id.'"><img src="images/edit.jpg" alt="Edit" title="Edit" width="15" border="0"></a>
			</td><td>
			<a href="modules/uin.php?delete=1&uin_id='.$uin_id.'"><img src="images/delete.jpg" alt="Delete" title="Delete" width="15" border="0"></a></td>
		</tr>');
		}
		?>
	</table>
	<br>
	<br><br>

	<? }
		include('includes/uin.php');

    	}




	    if($_GET['p']==2){	    if(!isset($_GET['group_id'])){	    $groups_files = GLOB('../groups/*.txt');
    	?>
    <b>SMS Numbers Groups</b><br><br>
    <table border="0" cellspacing="0" cellpadding="0">
 		<tr style="background-color:#9fc795;">
			<td class="table_title">Group Name</td>
			<td class="table_title" colspan="2">Action</td>
		</tr><?
 		foreach($groups_files as $v){
 			$group_data = file($v);
 			$link = explode('/',$v); 			print(' 		<tr>
			<td style="font-weight:bold;">'.trim($group_data[0]).'</td>
			<td style="font-weight:bold;" width="10"><a href="?p=2&group_id='.str_replace('.txt','',$link[(count($link)-1)]).'"><img src="images/edit.jpg" alt="Edit" title="Edit" width="15" border="0"></a>
			</td><td>
			<a href="modules/group.php?delete=1&group_id='.str_replace('.txt','',$link[(count($link)-1)]).'"><img src="images/delete.jpg" alt="Delete" title="Delete" width="15" border="0"></a></td>
		</tr>');
 		}

		?>
	</table>
	<br>
    <?
     	$access_data = file('access.txt');
 		if(strlen(trim($access_data[2]))>0){

	print('
	<a href="modules/refresh_csv.php"><img src="images/refresh.jpg" border="0"> Refresh numbers and price list (.CSV) from Profit-Bill.com server >></a>
	');
	}else{	print('<span style="color:red">To import numbers and price list (.CSV) from Profit-Bill.com server you must enter SMS API ID <a href="?p=0">here >></a></span>');
	} ?>
	<br><br><br><br><br>

	<?
		}
		include('includes/group.php');
    	}

}
     print('
    </td>
  </tr>
  <tr>
    <td height="20"><a href="?p=1" class="menu">ICQ UIN base</a></td>
  </tr>
  <tr>
    <td height="20"><a href="?p=2" class="menu">SMS Numbers Groups</a></td>
  </tr>
  <tr>
    <td height="20"><a href="?logout=1" class="menu">Logout</a></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
</table>');



}else{

    print('
    <table width="100" border="0" cellspacing="0" cellpadding="0" class="main_table">
  <tr>
    <td width="120">&nbsp;</td>
    <td style="padding:20px;">
    <form method="post">
	<a style="color:#4D6777; font-size:12px;">Admin Zone</a><br><br>
	  <table width="100%"  border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td width="15%">Login:</td>
          <td><input type="text" id="user" name="user"></td>
        </tr>
        <tr>
          <td width="15%">Password:</td>
          <td><input type="password" name="pass" id="pass"></td>
        </tr>
        <tr>
          <td>&nbsp;</td>
          <td><input type="submit" value="Log In"></td>
        </tr>
      </table>
	  </form>
      </td>
  </tr>
</table>
	  ');

    }

    ?>

© 2011 ICQ Numbers Shop | Profit-Bill.com<br><br><br>
	</center>
</body>

</html>