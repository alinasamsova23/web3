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
header('Content-Type: text/html; charset=UTF-8');
if ($_SERVER['REQUEST_METHOD'] == 'GET') {
  if (!empty($_GET['save'])) {
    print('<div class="row justify-content-md-center p-4">Спасибо, результаты сохранены.<br></div>');
  }
  include('form.php');
  exit();
}

$errors = FALSE;
$stringFields = array('name'=>"Имя", 'email'=> "E-mail", 'bio'=>"Биография", 'powers'=>"Суперсилы");
$intFields = array('year'=>array("Год", 1900, 2020), 'gender'=>array("Пол", 0,1), 'bodyparts'=>array("Части тела", 1,4));
$boolFields = array('agreed'=>array("Ознакомлен", true));
$count = 0;
$dbColumns = "";
$dbKeys = "";
$dbValues = array();

?>
<div class="row justify-content-md-center p-4">
<div class="col-12 col-md-6"
<?php
foreach($boolFields as $key=>$value){
    if(!array_key_exists($key, $_POST)){
        print('<a>Поле '.$boolFields[$key][0].' должно быть выбрано</a><br>');
        $errors = TRUE;
    }
}
foreach($intFields as $key=>$value){
    if(!array_key_exists($key, $_POST)){
        print('<a>Поле '.$intFields[$key][0].' должно быть заполнено</a><br>');
        $errors = TRUE;
    }else{
        if(!((int)$_POST[$key]<=$intFields[$key][2] && (int)$_POST[$key]>=$intFields[$key][1])){
            print('<a>Неверно указано поле '.$intFields[$key][0].'</a><br>');
            $errors = TRUE;
        }else{
            $count++;
            $dbKeys.="?,";
            $dbValues[] = (int)$_POST[$key];
            $dbColumns.=$key.",";
        }
    }
}
foreach($stringFields as $key=>$value){
    if(!array_key_exists($key, $_POST)){
        print('<a>Поле '.$stringFields[$key].' должно быть заполнено</a><br>');
        $errors = TRUE;
    }else{
        if(!is_array($_POST[$key])){
            if(!empty(trim($_POST[$key]))){
                $count++;
                $dbKeys.="?,";
                $dbValues[] = $_POST[$key];
                $dbColumns.=$key.",";
            }else{
                print('<a>Заполните поле '.$stringFields[$key].'</a><br>');
                $errors = TRUE;
            }
        }else{
            $val = array();
            foreach($_POST[$key] as $value)
            {
                if(!empty(trim($value))){
                    $val[] = $value;
                }
            }
            if(count($val)>0){
                $count++;
                $dbKeys.="?,";
                $dbValues[] = implode(",",$val);
                $dbColumns.=$key.",";
            }else{
                print('<a>Заполните поле '.$stringFields[$key].'</a><br>');
                $errors = TRUE;
            }
        }
    }
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

$dbColumns = substr($dbColumns, 0, strlen($dbColumns)-1);
$dbKeys = substr($dbKeys, 0, strlen($dbKeys)-1);
$user = 'u20233';
$pass = '1488849';
$db = new PDO('mysql:host=localhost;dbname=u20233', $user, $pass, array(PDO::ATTR_PERSISTENT => true));
try {
  $stmt = $db->prepare("INSERT INTO application (".$dbColumns.") VALUES(".$dbKeys.")");
  $stmt -> execute($dbValues);
}
catch(PDOException $e){
  print('Error : ' . $e->getMessage());
  exit();
}

header('Location: ?save=1');

?>
</body>