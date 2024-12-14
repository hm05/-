<?php
session_start();
include 'header.php';
if (!isset($_SESSION['loggedin'])) {
    echo "<div class='container'><h2>Access Denied</h2><p>You need to log in to access this page.</p></div>";
    include 'footer.php';
    exit;
}
$uploadDirectory = __DIR__ . '/uploads/';
$documents = [
    'report.pdf',
    'financials.xlsx',
    'strategy.docx'
];
if (isset($_GET['token'])) {
    $token = $_GET['token'];
    $document = base64_decode($token);

    if (in_array($document, $documents)) {
        $filePath = $uploadDirectory . $document;

        if (file_exists($filePath)) {
            header('Content-Type: application/octet-stream');
            header('Content-Disposition: attachment; filename="' . $document . '"');
            header('Content-Length: ' . filesize($filePath));
            readfile($filePath);
            exit;
        } else {
            echo "<div class='container'><h3>Download Failed</h3><p>The document could not be found on the server.</p></div>";
        }
    } else {
        echo "<div class='container'><h3>Invalid Request</h3><p>The token provided is invalid.</p></div>";
    }
    include 'footer.php';
    exit;
}
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['document'])) {
    $document = $_POST['document'];
    if (in_array($document, $documents)) {
        $token = base64_encode($document);
        echo "<div class='container'><p>Your download link: <a href='crypfail.php?token=$token'>Download $document</a></p></div>";
    } else {
        echo "<div class='container'><p>Invalid document request.</p></div>";
    }
    include 'footer.php';
    exit;
}
?>

<div class="container">
    <h2>Secure Document Download</h2>
    <p>Select a document to generate a download link:</p>
    <form method="POST">
        <select name="document" required>
            <?php foreach ($documents as $doc): ?>
                <option value="<?php echo $doc; ?>"><?php echo $doc; ?></option>
            <?php endforeach; ?>
        </select>
        <button type="submit">Generate Link</button>
    </form>
</div>

<?php include 'footer.php'; ?>
