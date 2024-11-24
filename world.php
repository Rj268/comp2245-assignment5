<?php
$host = 'localhost';
$username = 'lab5_user';
$password = 'password123';
$dbname = 'world';

try {
    $conn = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Retrieve the 'country' parameter from the GET request
    $country = isset($_GET['country']) ? $_GET['country'] : '';

    // SQL query to search for the country
    $stmt = $conn->prepare("SELECT * FROM countries WHERE name LIKE :country");
    $stmt->execute([':country' => "%$country%"]);

    // Fetch results
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Generate HTML response
    echo "<ul>";
    foreach ($results as $row) {
        echo "<li>" . $row['name'] . " is ruled by " . $row['head_of_state'] . "</li>";
    }
    echo "</ul>";
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>
