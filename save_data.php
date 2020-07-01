<?php

require 'vendor/autoload.php';

use Core\Database;
use DAO\MessageDAO;
use Helpers\Validation;

$temp = json_decode($_POST['user']);

$message = [
    'username' => $temp->username,
    'email' => $temp->email,
    'phone' => $temp->phone,
    'message' => $temp->message
];

$error = Validation::validate($message); // валидация

if (!empty($error)) { //если есть ошибки валидации, то вернуть их
    echo json_encode($error);
    die();
}

$mysql = new Database(); // подключение к базе данных
$messageDAO = new MessageDAO(); // создание обьекта для записи в базу данных и файл

$messageDAO->insertIntoDB($message, $mysql); //запись в бд
$messageDAO->insertIntoFile($message); // запись в файл

echo 'SUCCESS';
