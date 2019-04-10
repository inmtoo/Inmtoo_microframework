	<?php 
	
	class Frontend extends Inm_Controller {
		

		
		
		public function index() {
			$data['page_title'] = 'Write Your KEY OFFER';
			$data['keywords'] = 'keyword';
			$data['description'] = 'description.';
			parent::loadview('frontend/free', $data);

		}
		
		
		public function privacy() {
			$data['page_title'] = 'Privacy Police';
			$data['keywords'] = 'Privacy Police';
			$data['description'] = 'Privacy Police description.';
			parent::loadview('frontend/privacy', $data);

		}
		
		public function sendrequest() {
		
			$post = (!empty($_POST)) ? true : false;
			
			if($post) {
				$add['utm_source'] = Form::request('utm_source');
				$add['utm_campaign'] = Form::request('utm_campaign');
				$add['utm_medium'] = Form::request('utm_medium');
				$add['utm_term'] = Form::request('utm_term');
				$add['utm_keyword'] = Form::request('utm_keyword');
				
				$add['name'] = Form::request('fn');
				$add['email'] = Form::request('fe');
				$add['phone'] = Form::request('fp');
				$add['message'] = Form::request('fm');
				
				$message = '
				<p>'.$add['utm_source'].'</p>
				<p>'.$add['utm_campaign'].'</p>
				<p>'.$add['utm_medium'].'</p>
				<p>'.$add['utm_term'].'</p>
				<p>'.$add['utm_keyword'].'</p>
				<p>'.$add['name'].'</p>
				<p>'.$add['email'].'</p>
				<p>'.$add['phone'].'</p>
				<p>'.$add['message'].'</p>
				';
				
				$to = 'mail@site.com';
				$headers  = "Content-type: text/html; charset=utf-8 \r\n"; 
				$headers .= "From: Your company <no-reply@site.com>\r\n"; 
				$headers .= "Reply-To: ".$to."\r\n";
				
				mail($to, $subject, $message, $headers);
			
			}
		
		}
		
	}
	
	?>