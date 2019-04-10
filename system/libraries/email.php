<?php
	class Email {
	
		function send_( $to, $subject, $message, $headers ) {
		
			$message = wordwrap($message, 70, "\r\n");
			mail($to, $subject, $message, $headers);
		
		}
	
	}
?>