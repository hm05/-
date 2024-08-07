<?php
session_start();
include 'header.php';

if (!isset($_SESSION['loggedin'])) {
    echo "<div class='container'><h2>Access Denied</h2><p>You need to log in to access this page.</p></div>";
    include 'footer.php';
    exit;
}
?>
<div class="container">
    <h2>Restricted Area</h2>
    <p>Welcome to the restricted area!</p>
</div>
<?php include 'footer.php'; ?>
