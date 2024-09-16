<?php
if ($_SESSION['role']=="owner") {
        $page = $_GET['page'];
        $addbtn = "";
}
else if ($_SESSION['role']=="admin") {
        $page = $_GET['page'];
        $addbtn = "<div class='addbtn tidak_print'><a href='dashboard.php?page=add$page'><i class='fa-solid fa-circle-plus'></i></a></div>";
} else {
        $page = $_GET['page'];
        $addbtn = "";
}
?>