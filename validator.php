<?php
class Validator{

	private $data;
	private $errors = []; //создали массив для "собирания" ошибок
	private static $fields = ['username', 'email'];

	public function __construct($post_data){     //сюда будем передавать массив POST
		$this->data = $post_data;
	}

	public function validateForm(){
		foreach(self::$fields as $field){         //перебираем поля, существует ли в массиве username и email
			if(!array_key_exists($field, $this->data)){
				trigger_error("$field не заполнено");
				return;
			}
		}
		$this->validateUsername();   //если есть, то применяем функции
		$this->validateEmail();
		return $this->errors; //после возвращаем ошибки
	}

	private function validateUsername(){  //проверяем отдельно юзера

		$val = trim($this->data['username']);

		if(empty($val)){
			$this->AddError('username', 'Поле не может быть пустым');}
		else{
			if(!preg_match('/^[a-zA-Z0-9]{6,12}$/', $val)){  //проверяем на регулярное выражение, внутри требования к имени юзера
				$this->AddError('username', 'Имя должно быть не короче 6 и не длиннее 12 символов, содержать цифры и буквы');
			}
		}

	}

	private function validateEmail(){ // и проверяем отдельно email

		$val = trim($this->data['email']);

		if(empty($val)){
			$this->AddError('email', 'Поле email не может быть пустым');
		} else{
			if(!filter_var($val, FILTER_VALIDATE_EMAIL)){ //встроенная ф-ция проверяет, что email в корректной форме, 
				$this->AddError('email', 'email заполнен не корректно'); // если не в корректной, записываем ошибку
			}

	}
}

	private function AddError($key, $val){ //добавляем ошибки ключ-значение
		$this->errors[$key] = $val;

	}

}	
?>
