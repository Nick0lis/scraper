<!DOCTYPE html>
<html>
<head>
  <title>Most Active Stocks</title>
</head>
<body>

<?php
require 'vendor/autoload.php';

$client = new MongoDB\Client("mongodb://localhost:27017/");
$db = $client->stock_db;
$collection = $db->most_active_stocks;

// Get sorting parameters from the URL
$sortField = $_GET['sort'] ?? 'Index';
$currentOrder = $_GET['order'] ?? 'asc';
$sortOrder = ($currentOrder === 'desc') ? -1 : 1;
$nextOrder = ($currentOrder === 'asc') ? 'desc' : 'asc';

// Query with sorting
$result = $collection->find([], ['sort' => [$sortField => $sortOrder]]);

// Generate HTML table
echo "<table border='1'>\n";
echo "<thead>\n";
echo "<tr>\n";
echo "<th onclick=\"window.location='?sort=Index&order=$nextOrder'\">Index</th>";
echo "<th onclick=\"window.location='?sort=Symbol&order=$nextOrder'\">Symbol</th>";
echo "<th onclick=\"window.location='?sort=Name&order=$nextOrder'\">Name</th>";
echo "<th onclick=\"window.location='?sort=Price&order=$nextOrder'\">Price</th>";
echo "<th onclick=\"window.location='?sort=Change&order=$nextOrder'\">Change</th>";
echo "<th onclick=\"window.location='?sort=Volume&order=$nextOrder'\">Volume</th>";
echo "</tr>\n";
echo "</thead>\n";
echo "<tbody>\n";

foreach ($result as $doc) {
    echo "<tr>\n";
    echo "<td>{$doc['Index']}</td>";
    echo "<td>{$doc['Symbol']}</td>";
    echo "<td>{$doc['Name']}</td>";
    echo "<td>{$doc['Price']}</td>";
    echo "<td>{$doc['Change']}</td>";
    echo "<td>{$doc['Volume']}</td>";
    echo "</tr>\n";
}
echo "</tbody>\n";
echo "</table>\n";
?>

</body>
</html>

