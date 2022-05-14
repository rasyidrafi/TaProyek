<?php
if (isset($_POST['id'])) {
    $conn = mysqli_connect("server2.jagoankodecloud.com", "okokmyid_user_dev", "rahasia721", "okokmyid_ta1_dev");

    // cek koneksi database
    if (!$conn) {
?>
        <script>
            alert('<?php echo mysqli_connect_error(); ?>')
        </script>
<?php
    } else {
        $id = $_POST['id'];
        $rawPassword = $_POST['password'];

        $password = password_hash($rawPassword, PASSWORD_DEFAULT);

        $query = "UPDATE users SET password = '$password' WHERE id = '$id'";
        $result = mysqli_query($conn, $query);
        
        http_response_code(200);
        header('Content-Type: application/json');
        echo json_encode(array(
            "message" => "Password berhasil diubah"
        ));
    }
} else {
    http_response_code(400);
    echo json_encode(array(
        "message" => "Password gagal diubah"
    ));
}
?>