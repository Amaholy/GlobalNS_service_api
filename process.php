<?php

session_start();

if (isset($_SESSION['submitted']) && $_SESSION['submitted'] === true) {
    http_response_code(400);
    echo json_encode(array('error' => 'Данные уже были отправлены.'));
    exit();
}

$name = $_POST['name'];
$phone = $_POST['phone'];

$data = array(
    'stream_code' => 'vv4uf',
    'client' => array(
        'phone' => $phone,
        'name' => $name
    )
);

$ch = curl_init('https://order.drcash.sh/v1/order');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, array(
    'Content-Type: application/json',
    'Authorization: Bearer RLPUUOQAMIKSAB2PSGUECA'
));
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
$response = curl_exec($ch);
$httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
curl_close($ch);

if ($httpcode == 200) {
    $_SESSION['submitted'] = true;
    echo json_encode(array('success' => true));
} else {
    http_response_code($httpcode);
    echo json_encode(array('error' => 'Ошибка при отправке данных.'));
}
