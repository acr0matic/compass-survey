<?php
require 'phpmailer/PHPMailer.php';
require 'phpmailer/SMTP.php';
require 'phpmailer/Exception.php';

// Проверяем отравленность сообщения
function SendMail($mail, &$status)
{
  if ($mail->send())
    $status = "Сообщение успешно отправлено";
  else
    $status =  "Сообщение не было отправлено. Причина ошибки: " . $mail->ErrorInfo;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {


  // Настройки PHPMailer
  $mail = new PHPMailer\PHPMailer\PHPMailer();

  $mail->isSMTP();
  $mail->CharSet = "UTF-8";
  $mail->SMTPAuth   = true;
  $mail->isHTML(true);
  $mail->Debugoutput = function ($str, $level) {
    $GLOBALS['status'][] = $str;
  };

  // Настройки вашей почты
  $mail->Host       = 'smtp.yandex.ru'; // SMTP сервера вашей почты
  $mail->Username   = 'invite@project-kompas999.ru'; // Логин на почте
  $mail->Password   = '973973973sh'; // Пароль на почте
  $mail->SMTPSecure = 'ssl';
  $mail->Port       = 465;
  $mail->setFrom('invite@project-kompas999.ru', 'Проект "Компас"'); // от кого будет уходить письмо?

  // Переменные
  $name      = (isset($_POST['user_name']))      ? $_POST['user_name']   : 'Не указано';
  $email     = (isset($_POST['user_email']))     ? $_POST['user_email']  : 'Не указана';
  $gender    = (isset($_POST['user_gender']))    ? $_POST['user_gender'] : 'Не указан';
  $age       = (isset($_POST['user_age']))       ? $_POST['user_age']    : 'Не указан';
  $subscribe = (isset($_POST['user_subscribe'])) ? 'Да' : 'Нет';
  $data      = json_decode(stripslashes($_POST['result']), true);


  $data = $data['parameters'];
  $params = '';

  foreach ($data as $key => $value) {
    $params .= $key . ' - <b>' . ceil($value) . '%</b> <br>';
  }

  // Формирование содержимого письма
  $title = "Заявка с сайта Fasgrad.ru";
  $body =
    "
    <html>
     <p>
      Контактная информация: <br> <br>
      <b>Имя: </b> $name <br>
      <b>Электронная почта: </b> <a href='mailto:$email'>$email</a><br>
      <b>Пол: </b>$gender<br>
      <b>Возраст: </b>$age <br><br>

      Получать письма с полезной информацией: <b>$subscribe</b><hr><br>
      $params
     </p>
    </html>
   ";

  $filePath = $_FILES['screenshot']['tmp_name'];
  $fileName = $_FILES['screenshot']['name'];
  $mail->AddAttachment($filePath, $fileName);

  // Получатель письма
  $mail->addAddress('main.acr0matic@gmail.com');
  $mail->addAddress($email);

  // Отправка сообщения
  $mail->Subject = $title;
  $mail->Body = $body;

  SendMail($mail, $status);
}

  echo json_encode($status);
