<?php
session_start();

$conn = mysqli_connect("server2.jagoankodecloud.com", "okokmyid_user_dev", "rahasia721", "okokmyid_ta1_dev");

$data_menu = [];
$result = mysqli_query($conn, "SELECT * FROM menu");
if ($result && mysqli_num_rows($result)) {
    while ($row = mysqli_fetch_assoc($result)) {
        $data_menu[] = $row;
    }
}

// jika ada user yang berusaha masuk tanpa melalui login
if (!isset($_SESSION["role"])) {
    header("Location: ../login.php"); // alihkan ke halaman login
    exit;
}

?>

<!--  BEGIN CONTENT AREA  -->
<div id="content" class="main-content">
    <span id="all-menu" class="d-none"><?= json_encode($data_menu); ?></span>
    <div class="layout-px-spacing" id="root">

        
    </div>

</div>
<!--  END CONTENT AREA  -->

<script src="../react/add-transaksi.js"></script>