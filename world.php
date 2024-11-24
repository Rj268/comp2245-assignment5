<?php
$host = 'localhost';
$username = 'lab5_user'; 
$password = 'password123'; 
$dbname = 'world';

try {
    // Establish database connection
    $conn = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Get 'country' from GET request
    $country = isset($_GET['country']) ? $_GET['country'] : '';

    // SQL query
    $stmt = $conn->prepare("SELECT * FROM countries WHERE name LIKE :country");
    $stmt->execute([':country' => "%$country%"]);

    // Fetch results
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Display results
    if (count($results) > 0) {
        echo "<ul>";
        foreach ($results as $row) {
            echo "<li>" . $row['name'] . " is ruled by " . $row['head_of_state'] . "</li>";
        }
        echo "</ul>";
    } else {
        echo "No results found.";
    }
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>
