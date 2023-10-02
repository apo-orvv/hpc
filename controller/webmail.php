<?php
class Zmail{
		   public $username = "hpcadm"; 
		   public $password = "adminweb123$"; 
		   public $smtpServer = "10.1.1.2"; 			
		   			public function sendmail($from, $namefrom, $to, $nameto, $subject, $message){			
			
					//Connect to the host on the specified port
					$smtpServer = $this->smtpServer;
					$username = $this->username;
					$password = $this->password; 
					$port = "25";  
					$timeout = "30"; 
					$localhost = "";  
					$newLine = "\r\n";  
					$smtpConnect = fsockopen($smtpServer, $port, $errno, $errstr, $timeout);  
					$smtpResponse = fgets($smtpConnect, 515);  
					if(empty($smtpConnect))   
					{  
					$output = "Failed to connect: $smtpResponse";  
					return $output;  
					}  
					else 
					{  
					$logArray['connection'] = "Connected: $smtpResponse";  
					}  
					 
					//Request Auth Login  
					fputs($smtpConnect,"AUTH LOGIN" . $newLine);  
					$smtpResponse = fgets($smtpConnect, 515);  
					$logArray['authrequest'] = "$smtpResponse";  
					 
					//Send username  
					fputs($smtpConnect, base64_encode($username) . $newLine);  
					$smtpResponse = fgets($smtpConnect, 515);  
					$logArray['authusername'] = "$smtpResponse";  
					 
					//Send password  
					fputs($smtpConnect, base64_encode($password) . $newLine);  
					$smtpResponse = fgets($smtpConnect, 515);  
					$logArray['authpassword'] = "$smtpResponse";  
					 
					//Say Hello to SMTP  
					fputs($smtpConnect, "HELO $localhost" . $newLine);  
					$smtpResponse = fgets($smtpConnect, 515);  
					$logArray['heloresponse'] = "$smtpResponse";  
					 
					//Email From  
					fputs($smtpConnect, "MAIL FROM: $from" . $newLine);  
					$smtpResponse = fgets($smtpConnect, 515);  
					$logArray['mailfromresponse'] = "$smtpResponse";  
					 
					//Email To  
					fputs($smtpConnect, "RCPT TO: $to" . $newLine);  
					$smtpResponse = fgets($smtpConnect, 515);  
					$logArray['mailtoresponse'] = "$smtpResponse";  
					 
					//The Email  
					fputs($smtpConnect, "DATA" . $newLine);  
					$smtpResponse = fgets($smtpConnect, 515);  
					$logArray['data1response'] = "$smtpResponse";  
					 
					//Construct Headers  
					$headers = "MIME-Version: 1.0" . $newLine;  
					$headers .= "Content-type: text/html; charset=iso-8859-1" . $newLine;  
					$headers .= "To: $nameto <$to>" . $newLine;  
					$headers .= "From: $namefrom <$from>" . $newLine;  
					 
					fputs($smtpConnect, "To: $to\nFrom: $from\nSubject: $subject\n$headers\n\n$message\n.\n");  
					$smtpResponse = fgets($smtpConnect, 515);  
					$logArray['data2response'] = "$smtpResponse";  
					 
					// Say Bye to SMTP  
					fputs($smtpConnect,"QUIT" . $newLine);   
					$smtpResponse = fgets($smtpConnect, 515);  
					$logArray['quitresponse'] = "$smtpResponse";   
					var_dump($logArray);		
			}

}



?>
