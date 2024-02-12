<?php
$error = false;
$msg = '';
$response = [];
if (!isset($_POST['id'])) {
    $error = true;
    $msg = "Błąd serwera";
} else {
    $id = $_POST['id'];
    require_once "connect.php";
    $conn = sqlsrv_connect($serverName, $connectionOptions);
    if (!$conn) {
        $error = true;
        $msg = 'Błąd połączenia z bazą danych';
    } else {
        $query = "SELECT * FROM szczegolyKsiazek WHERE [ID książki]='$id'";
        $result = sqlsrv_query($conn, $query);
        while ($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)) {
            $response[] = $row;
        }
        sqlsrv_close($conn);
    }
}
$array = [$error, $msg, $response];
echo json_encode($array);
