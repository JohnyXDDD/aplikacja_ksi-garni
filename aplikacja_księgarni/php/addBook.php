<?php
$error = false;
$msg = '';
$response = [];
if (isset($_POST['publisher']) && isset($_POST['title']) && isset($_POST['price']) && isset($_POST['date']) && isset($_POST['authors'])) {
    $publisher = $_POST['publisher'];
    $title = $_POST['title'];
    $price = $_POST['price'];
    $date = $_POST['date'];
    $authors = $_POST['authors'];
    $autorzy = explode(",", $authors);
    require_once "connect.php";
    $conn = sqlsrv_connect($serverName, $connectionOptions);
    if (!$conn) {
        $error = true;
        $msg = 'Błąd połączenia z bazą danych';
    } else {
        try {
            sqlsrv_begin_transaction($conn);
            $sql1 = "EXEC dodajKsiazke @id_wydawcy='$publisher', @tytul='$title',@cena='$price',@data='$date'";
            $query1 = sqlsrv_query($conn, $sql1);
            if ($query1) {
                $sql2 = "SELECT @@IDENTITY";
                $query2 = sqlsrv_query($conn, $sql2);
                if ($query2) {
                    $row = sqlsrv_fetch_array($query2);
                    $id = $row[0];
                    foreach ($autorzy as $autor) {
                        $sql = "EXEC dodajAutoraKsiazki @ksiazka='$id',@autor='$autor'";
                        $result = sqlsrv_query($conn, $sql);
                        if (!$result) {
                            $error = true;
                        }
                    }
                } else {
                    $error = true;
                }
            } else {
                $error = true;
            }

            if (!$error) {
                sqlsrv_commit($conn);
                $msg = "Transakcja zakończona sukcesem.";
            } else {
                sqlsrv_rollback($conn);
                $msg = "Błąd podczas operacji w transakcji.";
            }
        } catch (Exception $e) {
            sqlsrv_rollback($conn);
            $msg = "Transakcja zakończona niepowodzeniem";
        }
        sqlsrv_close($conn);
    }
}
$array = [$error, $msg, $response];
echo json_encode($array);
