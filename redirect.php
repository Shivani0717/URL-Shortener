<?php
include 'db.php'; // Ensure database connection is correct

if (!isset($_GET["code"])) {
    die("No short code provided.");
}

$short_code = $_GET["code"]; // Get short code from URL

// Check if the short code exists in the database
$stmt = $conn->prepare("SELECT long_url FROM short_urls WHERE short_code = ?");
$stmt->bind_param("s", $short_code);
$stmt->execute();
$stmt->bind_result($long_url);
$stmt->fetch();
$stmt->close();

if ($long_url) {
    header("Location: " . $long_url);
    exit();
} else {
    echo "Short URL not found!";
}
?>
