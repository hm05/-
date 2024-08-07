<?php
session_start();
include 'header.php';
?>
<div class="container">
    <h2>Broken Access Control</h2>
    <?php
    if (!isset($_SESSION['loggedin'])) {
        echo "You need to log in to access this page.";
        exit;
    }
    echo "Welcome to the admin page!";
    ?>
</div>
<?php include 'footer.php'; ?>
