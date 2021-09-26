<?php
//Insert comment
include_once 'updates.php';
if (isset($_POST['user_id']) && isset($_POST['id_yombuzo']) && isset($_POST['impendulo'])) {
    $user_id = mysqli_real_escape_string($conn, $_POST['user_id']);
    $id_yombuzo = mysqli_real_escape_string($conn, $_POST['id_yombuzo']);
    $impendulo = mysqli_real_escape_string($conn, $_POST['impendulo']);
    $sql = "INSERT INTO imibuzo_comments ( user_id, id_yombuzo, impendulo ) VALUES ( '$user_id', '$id_yombuzo', '$impendulo' )";
    $result = mysqli_query($conn, $sql);
}

// Update umbuzo
if (isset($_POST['umbuzo']) && isset($_POST['umbuzo_id'])) {
    $umbuzo = mysqli_real_escape_string($conn, $_POST['umbuzo']);
    $umbuzo_id = mysqli_real_escape_string($conn, $_POST['umbuzo_id']);
    $sql = "UPDATE imibuzo SET umbuzo = '$umbuzo' WHERE id = '$umbuzo_id'";
    $result = mysqli_query($conn, $sql);
}
?>