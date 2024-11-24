<?php
$host = 'localhost';
$username = 'lab5_user'; // Update as needed
$password = 'password123'; // Update as needed
$dbname = 'world';

try {
    $conn = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $country = isset($_GET['country']) ? $_GET['country'] : '';
    $lookup = isset($_GET['lookup']) ? $_GET['lookup'] : '';

    if ($lookup === 'cities') {
        // SQL query to fetch city data
        $stmt = $conn->prepare("
            SELECT cities.name AS city_name, cities.district, cities.population
            FROM cities
            JOIN countries ON cities.country_code = countries.code
            WHERE countries.name LIKE :country
        ");
        $stmt->execute([':country' => "%$country%"]);
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if (count($results) > 0) {
            echo "<table border='1'>";
            echo "<tr><th>City Name</th><th>District</th><th>Population</th></tr>";
            foreach ($results as $row) {
                echo "<tr>";
                echo "<td>" . $row['city_name'] . "</td>";
                echo "<td>" . $row['district'] . "</td>";
                echo "<td>" . number_format($row['population']) . "</td>";
                echo "</tr>";
            }
            echo "</table>";
        } else {
            echo "No cities found.";
        }
    } else {
        // Default behavior: Fetch country information (from Exercise 4)
        $stmt = $conn->prepare("SELECT name, continent, independence_year, head_of_state FROM countries WHERE name LIKE :country");
        $stmt->execute([':country' => "%$country%"]);
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if (count($results) > 0) {
            echo "<table border='1'>";
            echo "<tr><th>Country Name</th><th>Continent</th><th>Independence Year</th><th>Head of State</th></tr>";
            foreach ($results as $row) {
                echo "<tr>";
                echo "<td>" . $row['name'] . "</td>";
                echo "<td>" . $row['continent'] . "</td>";
                echo "<td>" . ($row['independence_year'] ? $row['independence_year'] : "N/A") . "</td>";
                echo "<td>" . ($row['head_of_state'] ? $row['head_of_state'] : "N/A") . "</td>";
                echo "</tr>";
            }
            echo "</table>";
        } else {
            echo "No results found.";
        }
    }
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>

