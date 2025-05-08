<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Получаем данные из формы
    $name = strip_tags($_POST['name']);
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $message = htmlspecialchars($_POST['message']);

    // Проверяем email
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        die("Некорректный email.");
    }

    // Куда отправляем письмо
    $to = "alexei.solovyev@example.com"; // ← замените на ваш email

    // Тема письма
    $subject = "Сообщение с сайта от $name";

    // Тело письма
    $body = "Имя: $name\n";
    $body .= "Email: $email\n\n";
    $body .= "Сообщение:\n$message";

    // Заголовки
    $headers = "From: $name <$email>\r\n";
    $headers .= "Reply-To: $email\r\n";

    // Отправка письма
    if (mail($to, $subject, $body, $headers)) {
        echo "Спасибо! Ваше сообщение отправлено.";
    } else {
        echo "Ошибка: Не удалось отправить сообщение.";
    }
} else {
    // Защита от прямого доступа к файлу
    echo "Доступ запрещён.";
}
?>