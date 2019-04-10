<?php

	class Authorization {
	
		function generateSalt()
		{
			$salt = '';
			$saltLength = 8; //длина соли
			for($i=0; $i<$saltLength; $i++)
				{
					$salt .= chr(mt_rand(33,126)); //символ из ASCII-table
				}
			return $salt;
		}
	
	
		function registration( $add ) {
			
			$checkLogin = Database::getrows($table='birzha_users', $fields='id', $parametr='login', $value = $add['login']);
			$checkEmail = Database::getrows($table='birzha_users', $fields='id', $parametr='email', $value = $add['email']);
			
			if(count($checkLogin)==0 && count($checkEmail)==0) {
			
				$reg['salt'] = Authorization::generateSalt();
				$reg['login'] = $add['login'];
				$reg['password'] = md5(md5($reg['salt']).md5($add['password'])); 
				$reg['email'] = $add['email'];
				$reg['ip'] = $add['ip'];
				$reg['date'] = $add['date'];
				$reg['time'] = $add['time'];
				$reg['type'] = $add['type'];
				//Продумать подтверждение на email. После регистрации отправляется токен на почту и активируется аккаунт
				Database::insert($table = 'birzha_users', $add = $reg);
				
				return 'Вы успешно зарегистрировались';
			
			} else {
				return 'Такой логин или email уже заняты';
			}
			
		}
		
		function remember( $add ) {
			$user = Database::getrow($table='birzha_users', $fields='*', $parametr='email', $value=$add['email'], $rownum=0);
			//return $user;
			
			if (count($user)==0) {
				return 'пользователя с email <i>'.$value=$add['email'].'</i> не существует';
			} else {
			
				$defaultpass = 'polzovatelpomenialparol';
				$token['token'] = md5(md5($user['salt']).md5($defaultpass));
				$token['user_id'] = $user['id'];
				$token['date_creation'] = date('Y-m-d H:i:s');
				//сюда функция отправки на почту письма с токеном
				
				$subject = 'Восстановление пароля на сайте MyZapros.ru';
				
				$headers  = 'MIME-Version: 1.0' . "\r\n";
				$headers .= 'Content-type: text/html; charset=utf-8' . "\r\n";
				
				$message = '
				<h2>Ссылка для восстановления пароля на MyZapros.ru</h2>
				<p>Для восстановления пароля к логину '.$user['login'].' пройдите по ссылке:</p>
				<p><a href="http://myzapros.ru/index.php/repass/tokenverification/?tokenkey='.$token['token'].'">http://myzapros.ru/index.php/repass/tokenverification/?tokenkey='.$token['token'].'</a></p>
				';
				
				$message = wordwrap($message, 70, "\r\n");
				
				Database::insert($table = 'birzha_tokens', $add = $token);
				
				mail($to = $user['email'], $subject, $message, $headers);
				
				return 'Ссылка для восстановления пароля выслана на Вашу электронную почту';
				//return $token;
			
			}
		}
		
		function tokenver($token) { //выбираем данные о пользователе по токену
			$token = Database::getrow($table='birzha_tokens', $fields='*', $parametr='token', $value=$token, $rownum=0);

			if(count($token) > 0) {
				$user = Database::getrow($table='birzha_users', $fields='*', $parametr='id', $value=$token['user_id'], $rownum=0);
				$msg['login'] = $user['login'];
				$msg['user_id'] = $token['user_id'];
				$msg['status'] = 'success';
				//Database::deletrow_where_param( $table = 'birzha_tokens', $parametr = 'token', $value = $token );
				return $msg;
			
			} else {
				$msg['status'] = 'error';
				return $msg;
			} 
		}
		
		function changepassowrdtoken($postdata) {
		
			$token = Database::getrow($table='birzha_tokens', $fields='*', $parametr='token', $value=$postdata['token'], $rownum=0);
			
			$user = Database::getrow($table='birzha_users', $fields='*', $parametr='id', $value=$postdata['user_id'], $rownum=0);
			
			//return $token['login'];
			/**/
			//выполняем двойную проверку. чтобы у злоуышленников было меньше шансов получить несанкционированный доступ
			if($token['user_id']==$postdata['user_id'] and $postdata['login'] == $user['login']) {
				$add['id'] = $postdata['user_id'];
				$add['password'] = md5(md5($user['salt']).md5($postdata['password']));
				Database::update( $table = 'birzha_users', $add, $parametr = 'id', $value = $add['id'] );
				return 'sucess';
			}
			else {
				return 'error';
			}/**/
			
		}
		
		function auth( $add ) {
		
			
			$users = Database::getrows($table = 'birzha_users', $fields = '*', $parametr = 'login', $value = $add['login']);
			$user = $users[0];
			//$salt = $user['salt'];
			$unsaltedpswrd = md5(md5($user['salt']).md5($add['password']));
			
			if ( $user['password'] == $unsaltedpswrd ) {
				session_start();
				$_SESSION['id'] = $user['id']; 
				$_SESSION['login'] = $user['login'];
				$_SESSION['auth'] = true;
				
				//return $_SESSION;
				return $user['login'];
			} else {
				return 'Неправильный логин или пароль';
			}
			
		
		}
		
		function change_password($add) {
			$users = Database::getrows($table = 'birzha_users', $fields = '*', $parametr = 'id', $value = $add['id']);
			$user = $users[0];
			//$salt = $user['salt'];
			$unsaltedpswrd = md5(md5($user['salt']).md5($add['password']));
			
			if ( $user['password'] == $unsaltedpswrd ) {
				 //меняем пароль
				$newdata['id'] = $add['id'];
				$newdata['login'] = $user['login'];
				$newdata['email'] = $user['email'];
				$newdata['password'] = md5(md5($user['salt']).md5($add['password_new']));
				Database::update( $table = 'birzha_users', $add = $newdata, $parametr = 'id', $value = $add['id'] );
				//return 'true';
				return $newdata;
			} else {
				return 'false';
			}
		}
		
		function test() {
			echo 'Auth loaded<br/>';
		}
	
	
	}

?>