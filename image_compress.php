#!/usr/bin/php5
// this is python? holy crap this code really maked in 2013 dam this kid until zolpidem was smart
<?php 

	ini_set("default_charset", "utf-8");

	define("__Autor__", "Daniel Victor Freire");
	define("__Version__", "1.0.1");
	define("__Name__", "Image Compress");

	//verifica os argumentos
	if($argc < 2):
	
		// mostra o banner de uso
		print "\r\n";
		print __Name__ ." v". __Version__ . "\r\n\r\n";
		print "[#] Usage : php image_compress.php image_to_compress.jpg\r\n\r\n";
		print "[#] Seend feedbacks to mail below pls, don't try PR this repo\r\n\r\n";
		print "<ondproxy@gmail.com>\r\n";
		exit;
	
	else:

		$file = $argv[1]; // imagem para compressao
		
		// verifica se existe um arquivo com este nome e se e realmente uma arquivo		
		if(is_file($file) && file_exists($file)):
			
			$init_size = filesize($file) / 1000; // tamanho em Kbytes da imagem original
			
			$width = getimagesize($file)[0]; // pega a largura
			$height = getimagesize($file)[1]; // pega a altura
			
			$x = $y = 0;
			
			if(isset($argv[2])):
				$jpeg_quality = (int) $argv[2]; // qualidade da imagem pos compressao ajustavel
			else:
				$jpeg_quality = (int) 50; // qualidade da imagem pos compressao padrao
			endif;
			
			$rate = 100 - $jpeg_quality; // formula para mostrar a taxa de compressao
			
			$img_r = imagecreatefromjpeg($file); // seta a criacao da imagem 
			$dst_r = imagecreatetruecolor($width, $height); // seta os tamanhos pos compressao
			
			imagecopyresampled($dst_r, $img_r, 0, 0, $x, $y, $width, $height, $width, $height); // seta a compressao da imagem
			
			$name = md5(uniqid(time())) . ".compressed.jpg"; // seta novo nome para imagem pos compressao
			
			imagejpeg($dst_r, $name, $jpeg_quality); // comprimi a imagem
			
			if(file_exists($name)):
			
				$compress_size = filesize($name) / 1000; // tamanho em Kbytes pos compressao
				$economy =  $init_size - $compress_size; // formula para pegar economia de bytes da compressao
				
				print "[+] Compression was suscessfully !\r\n";
				print "========================================================\r\n";
				print "[!] Stats below\r\n\r\n";
				print "[#] New image name : " . $name . "\r\n";
				print "[#] Original image size : " . $init_size . " Kbytes\r\n";
				print "[#] Image size compressed : " . $compress_size . " Kbytes\r\n";
				print "[-] Bytes compressed : " . $economy . " Kbytes\r\n";
				print "[+] Compression rate : " . $rate . "%\r\n";
				exit;
			
			else:
			
				print "\r\n[X] Compression failed...";
				exit;
			
			endif;
			
		else:
		
			print "\r\n[X] Invalid type of archive...";
			exit;
			
		endif;
		
	endif;
?>
