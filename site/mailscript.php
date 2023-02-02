<?php
// mailscript.php
// Версия скрипта: PHPMailer 5.2.28 (модифицирован)

// Получатель
// Сообщение будет отправлено на этот адрес электронной почты. Пожалуйста, введите имя и адрес электронной почты:
$empfaengerName = "Имя_получателя_почты"; // Имя получателя
$empfaengerEmail = "sydorova@yahoo.fr"; // Электронная почта получателя 
$dankeSeite = "bien.html"; // Страница перенаправления, с сообщением об успешной отправке сообщения.
$fehlerSeite = "pasbien.html"; // Страница ошибки, если письмо не может быть отправлено. 

// Тема сообщения
// Каждому электронному письму нужна тема, но в форме нет темы.
// Если соответствующее поле было установлено, добавляется фиксированная тема. 
$betreffEmail = "Укажите_свою_тему_письма";


// Были ли отправлены данные POST?
if ($_SERVER["REQUEST_METHOD"] == "POST") {

  // Установите часовой пояс и текущую дату
  date_default_timezone_set("Europe/Kiev");
  $datum = date("d.m.Y H:i");

  // Удалить HTML-теги
  $_POST = array_map('strip_tags', $_POST);

  // Установите содержание электронного письма
  $inhaltEmail = "Опубликовано: $datum Время
   E-Mail: " . $_POST["email"] . "
   
  ";

  // Включить PHPMailer
  // Скрипты доступны для скачивания. Данный скрипт на основе PHPMailer 5.2.28
  // Скачать: https://github.com/PHPMailer/PHPMailer/tree/5.2-stable
  // затем удалите каталог "examples" перед загрузкой.
  require "PHPMailer-5.2-stable/PHPMailerAutoload.php";

  // Установить экземпляр и кодировку символов
  $mail = new PHPMailer();
  $mail->CharSet = "UTF-8";

  // Установите отправителя и получателя
  $mail->setFrom($_POST["email"], $_POST["name"]);
  $mail->addAddress($empfaengerEmail, $empfaengerName);

  // Задайте тему и тело сообщения
  $mail->Subject = $betreffEmail;
  $mail->Body = $inhaltEmail;

 // Отправленные E-Mail
 if ($mail->Send()) {
  header("Location: " . $dankeSeite);
 }
 else {
  header("Location: " . $fehlerSeite);
 }
}
?>