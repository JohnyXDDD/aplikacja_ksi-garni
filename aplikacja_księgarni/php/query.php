<?php
$error = false;
$msg = '';
$response = [];
require_once "connect.php";
$query = $_POST['query'];
require_once 'sampleQueries/' . $query . '.php';
$conn = sqlsrv_connect($serverName, $connectionOptions);
if (!$conn) {
    $error = true;
    $msg = 'Błąd połączenia z bazą danych';
} else {
    $result = sqlsrv_query($conn, $sql);
    while ($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)) {
        $response[] = $row;
    }
    sqlsrv_close($conn);
}
$array = [$error, $msg, $response];
echo json_encode($array);
