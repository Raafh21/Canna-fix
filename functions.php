<?php
// koneksi ke database
$conn = mysqli_connect("localhost", "root", "", "db_canna");

// Hapus Data Posko
function hapus_posko($id)
{
    global $conn;
    mysqli_query($conn, "DELETE FROM posko_pengungsian WHERE id = '$id'");
    return mysqli_affected_rows($conn);
}

// Hapus Data Node
function hapus_node($id)
{
    global $conn;
    mysqli_query($conn, "DELETE FROM tb_node WHERE id = '$id'");
    return mysqli_affected_rows($conn);
}

// Hapus Data Product
function hapus_product($id)
{
    global $conn;
    mysqli_query($conn, "DELETE FROM tb_product WHERE id = '$id'");
    return mysqli_affected_rows($conn);
}
// Upload Gambar Product
function image_product()
{
    $namaFile = $_FILES['img_product']['name'];
    $tmpName = $_FILES['img_product']['tmp_name'];

    move_uploaded_file($tmpName, '../assets/img/product/' . $namaFile);

    return $namaFile;
}