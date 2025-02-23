<?php
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $long_url = trim($_POST["long_url"]);

    if (!filter_var($long_url, FILTER_VALIDATE_URL)) {
        die(json_encode(["error" => "Invalid URL"]));
    }

    $short_code = substr(md5(uniqid()), 0, 6);

    $stmt = $conn->prepare("INSERT INTO short_urls (long_url, short_code) VALUES (?, ?)");
    $stmt->bind_param("ss", $long_url, $short_code);
    $stmt->execute();
    $stmt->close();

    echo json_encode(["short_url" => "http://localhost/url_shortener/" . $short_code]);
}
?>
