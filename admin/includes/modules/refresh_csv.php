<?
		$access_data = file('../access.txt');

		$a = file_get_contents('http://profit-bill.com/tariffs/project_csv/'.trim($access_data[2]).'.html');

		$file = fopen('../../profit-bill_tariffs.csv', "w");
		fputs($file, $a);
		fclose($file);

		// Return back
		print('
		<script>
			window.location.replace("../index.php?p=2");
		</script>
		');

?>