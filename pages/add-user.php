<?php
if (isset($_POST['email'])) {
    $conn = mysqli_connect("server2.jagoankodecloud.com", "okokmyid_user_dev", "rahasia721", "okokmyid_ta1_dev");

    // cek koneksi database
    if (!$conn) {
?>
        <script>
            alert('<?php echo mysqli_connect_error(); ?>')
        </script>
<?php
    } else {
        $email = $_POST['email'];
        $username = $_POST['username'];
        $rawPassword = $_POST['password'];

        $password = password_hash($rawPassword, PASSWORD_DEFAULT);

        $query = "INSERT INTO users (email, username, password) VALUES ('$email', '$username', '$password')";
        $result = mysqli_query($conn, $query);

        if ($result) {
            http_response_code(200);
            header('Content-Type: application/json');
            echo json_encode(array(
                "message" => "Berhasil menambahkan user"
            ));
        } else {
            // return error msg
            http_response_code(400);
            $reason = mysqli_error($conn);
            header('Content-Type: application/json');
            echo json_encode(array(
                "message" => "Gagal menambahkan user",
                "reason" => $reason
            ));
        }
        
    }
} else {
    http_response_code(400);
    echo json_encode(array(
        "message" => "Password gagal diubah"
    ));
}
?>