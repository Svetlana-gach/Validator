<?php

require('validator.php');

if(isset($_POST['submit'])){  //если "нажата" кнопка, то создаём экземпляр класса
	$validation = new Validator($_POST);
	$errors = $validation->validateForm();
}
?>

<html lang='en'>
<head>
	<title>Проверяем мой Валидатор</title>
	<link rel='stylesheet' type='text/css' href='styles.css'>
</head>
<body>
	
	<div class="new user">
		<h2>Создайте нового пользователя</h2>
		<form action="ValidatorCheck.php" method='POST'>

			<label>Username</label>
			<input type="text" name="username" value="<?php echo htmlspecialchars($_POST['username']) ?? '' ?>">
			<div class='error'>
				<?php echo $errors['username'] ?? '' ?>
			</div>

			<label>Email</label>
			<input type="text" name="email" value="<?php echo htmlspecialchars($_POST['email']) ?? '' ?>">
			<div class='error'>
				<?php echo $errors['email'] ?? '' ?>
			</div>


			<input type="submit" value="Создать" name="submit">
		</form>
	</div>
</body>