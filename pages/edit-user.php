<?php
if (isset($_POST['id']) && isset($_POST['username'])) {
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
        $username = $_POST['username'];
        $role = $_POST['role'];

        $query = "UPDATE users SET username = '$username', role = '$role' WHERE id = '$id'";


        $result = mysqli_query($conn, $query);

        header("Location: ../admin/data-pegawai.php");
    }
} else echo "
<script>window.history.back();</script>
";
?>