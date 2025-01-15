<?php
session_start();
include 'header.php';


if (!isset($_SESSION['loggedin'])) {
    echo "<div class='container'><h2>Access Denied</h2><p>You need to log in to access this page.</p></div>";
    include 'footer.php';
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $feedbackInput = $_POST['feedback'];

    try {
        libxml_disable_entity_loader(false);

        $dom = new DOMDocument();
        $dom->loadXML($feedbackInput, LIBXML_NOENT | LIBXML_DTDLOAD);

        $feedback = $dom->getElementsByTagName('feedback')->item(0)->nodeValue;

        echo "<div class='container'><h2>Feedback Received</h2><p>Your feedback: " . htmlspecialchars($feedback) . "</p></div>";
    } catch (Exception $e) {
        echo "<div class='container'><h2>Error</h2><p>There was an error processing your feedback. Please try again.</p></div>";
    }
} else {
    ?>
    <div class="container">
        <h2>Submit Feedback</h2>
        <p>We value your feedback! Please share your thoughts below:</p>
        <form method="POST" action="">
            <label for="feedback">Feedback:</label>
            <textarea name="feedback" id="feedback" required></textarea>
            <button type="submit" class="btn-primary">Submit</button>
        </form>
    </div>
    <?php
}

include 'footer.php';
?>
