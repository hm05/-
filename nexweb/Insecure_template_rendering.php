<?php
session_start();
include 'header.php';

if (!isset($_SESSION['loggedin'])) {
    echo "<div class='container'><h2>Access Denied</h2><p>You need to log in to access this page.</p></div>";
    include 'footer.php';
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'] ?? '';
    $message = $_POST['message'] ?? '';

    $template = "<div class='container'><h2>Thank You, {{ name }}</h2><p>Your message: {{ message }}</p></div>";

    $output = str_replace(['{{ name }}', '{{ message }}'], [$name, $message], $template);
    echo $output;
} else {
    ?>

    <div class="container">
        <h2>Contact Us</h2>
        <form method="POST" action="">
            <label for="name">Your Name:</label>
            <input type="text" name="name" id="name" required>

            <label for="message">Your Message:</label>
			</br>
            <textarea name="message" id="message" required></textarea>

            <button type="submit">Submit</button>
        </form>
    </div>

    <?php
}

include 'footer.php';
?>
