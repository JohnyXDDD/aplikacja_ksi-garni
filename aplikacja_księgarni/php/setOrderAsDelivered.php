<?php
$error = false;
$msg = '';
$response = [];
require_once "connect.php";
if (isset($_POST['order'])) {
    $zamowienie = $_POST['order'];
    if ($zamowienie > 0) {
        $conn = sqlsrv_connect($serverName, $connectionOptions);
        if (!$conn) {
            $error = true;
            $msg = 'Błąd połączenia z bazą danych';
        } else {
            $query = "EXEC oznaczJakoDostarczone @zamowienie='$zamowienie'";
            $result = sqlsrv_query($conn, $query);
            if ($result) {
                $msg = 'Zaaktualizowano';
            } else {
                $msg = 'Błąd, nie zaktualizowano';
            }
            sqlsrv_close($conn);
        }
    }
}
$array = [$error, $msg, $response];
echo json_encode($array);
