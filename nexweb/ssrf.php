<?php include 'header.php'; ?>
<div class="container">
    <h2>Fetch Content</h2>
    <?php
    if (isset($_GET['url'])) {
        $url = $_GET['url'];
        if (filter_var($url, FILTER_VALIDATE_URL)) {
            $response = file_get_contents($url); // Vulnerable to SSRF
            echo "Response from $url: <br><pre>$response</pre>";
        } else {
            echo "Invalid URL.";
        }
    }
    ?>
    <form method="GET">
        <input type="text" name="url" placeholder="Enter URL" required>
        <button type="submit">Fetch</button>
    </form>
</div>
<?php include 'footer.php'; ?>
