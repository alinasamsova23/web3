<?php
header('Content-Type: text/html; charset=UTF-8');
?>
<!DOCTYPE html>
<html lang="ru">

<head>
    <title>Форма</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.11.2/css/all.css"
        integrity="sha384-KA6wR/X5RY4zFAHpv/CnoG2UW1uogYfdnP67Uv7eULvTveboZJg0qUpmJZb5VqzN" crossorigin="anonymous">
</head>
<body class="container">

<?php
$ability_labels = [1 => 'Бессмертие', 3=> 'Левитация', 2 => 'Прохождение сквозь стены'];
if ($_SERVER['REQUEST_METHOD'] == 'GET') {
  if (!empty($_GET['save'])) {
    print('<div class="row justify-content-md-center p-4">Спасибо, результаты сохранены.<br></div>');
  }
  include('form.php');
  exit();
}

$errors = FALSE;

?>
<div class="row justify-content-md-center p-4">
<div class="col-12 col-md-6 jumbotron">
<?php
if (empty($_POST['name'])) {
  print('Заполните имя.<br/>');
  $errors = TRUE;
}
else if (!preg_match('/^[а-яА-Я ]+$/u', $_POST['name'])) {
  print('Недопустимые символы в имени.<br/>');
  $errors = TRUE;
}
if (empty($_POST['bio'])){
    print('Заполните биографию<br>');
    $errors = TRUE;
}
if (empty($_POST['year'])) {
    print('Заполните год.<br/>');
    $errors = TRUE;
}
else {
  $year = $_POST['year'];
  if (!(is_numeric($year) && intval($year) >= 1900 && intval($year) <= 2020)) {
    print('Укажите корректный год.<br/>');
    $errors = TRUE;
  }
}

$ability_data = array_keys($ability_labels);
if (empty($_POST['powers'])) {
    print('Выберите способность.<br/>');
    $errors = TRUE;
}
else{
  $abilities = $_POST['powers'];
  foreach ($abilities as $ability) {
    if (!in_array($ability, $ability_data)) {
      print('Плохая способность!<br/>');
      $errors = TRUE;
    }
  }
}
if(!isset($_POST['gender']))
{
    print('Выберите пол<br>');
    $errors = TRUE;
}
else if(intval($_POST['gender'])<0 || intval($_POST['gender'])>1)
{
    print('Неверно указан пол<br>');
    $errors = TRUE;
}

if(empty($_POST['bodyparts']))
{
    print('Выберите количество конечностей<br>');
    $errors = TRUE;
}
else if($_POST['bodyparts']<1 || $_POST['bodyparts']>4)
{
    print('Неверное количество конечностей<br>');
    $erros = TRUE;
}
if(empty($_POST['email'])){
    print('Укажите email<br>');
    $errors = TRUE;
}else if(!preg_match('/^.*\@.*\..+$/u', $_POST['email'])){
    print('Неверно указан email<br>');
    $errors = TRUE;
}
if(empty($_POST['agreed']))
{
    print('Вы не ознакомились с контрактом<br>');
    $errors = TRUE;
}else if($_POST['agreed']!=="on"){
    print('Вы не ознакомились с контрактом<br>');
    $errors = TRUE;
}
if ($errors) {
    print('<a href="index.php">Назад</a><br>');
}
?>
</div>
</div>
<?php
if ($errors) {
    exit();
}

$user = 'u20233';
$pass = '1488849';
$db = new PDO('mysql:host=localhost;dbname=u20233', $user, $pass, array(PDO::ATTR_PERSISTENT => true));
try {
$stmt = $db->prepare("INSERT INTO application (name, year, powers, bio, gender, email, bodyparts) VALUES (?, ?, ?, ?, ?, ?, ?)");
$stmt->execute(array($_POST['name'], intval($year), implode(',',$_POST['powers']), $_POST['bio'], intval($_POST['gender']), $_POST['email'], intval($_POST['bodyparts'])));
}
catch(PDOException $e){
  print('Error : ' . $e->getMessage());
  exit();
}

header('Location: ?save=1');

?>
</body>