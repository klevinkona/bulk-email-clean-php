<?php 
$handle = fopen("/home/klevin/zlatan/emails.txt", "r");

$dead = "Request timed out.";


if ($handle) {

	while (($line = fgets($handle)) !== false) {



		$domain =  substr(strrchr($line, "@"), 1);

		$output = shell_exec('ping -c1 ' . $domain );

//$string = str_replace(' ', '', $output);
		$string = preg_replace('/\s+/', '', $output);


		if(preg_match("/1received/",$string)) { 

	//echo "ky domain eshte ok " . $domain;
			$file = fopen("/home/klevin/zlatan/valid_emails.txt","a");
			echo $domain . "---ok// "	;
			fwrite($file,$line);
			fclose($file);
		}else {
 		//echo "ky domain eshte ok " . $domain;
			$file = fopen("/home/klevin/zlatan/bad_emails.txt","a");
			echo $domain . "---not ok// "	;
			fwrite($file,$line);
			fclose($file);


		}

	}

	$empty ="";
//	$output = shell_exec('sed -i "${line},${empty}d"  /home/klevin/zlatan/emails.txt ');
	$output = shell_exec('sed -i "s/$line/$empty/g" /home/klevin/zlatan/emails.txt');
	//echo $output = shell_exec('sed -i \'/$line/d\' /home/klevin/zlatan/emails_test.txt');


	fclose($handle);

	
} else {
	echo "error opening the file.";
} 


?>
