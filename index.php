<?php
// Verbindung zur Datenbank herstellen
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "bkurs-girls";

$conn = new mysqli($servername, $username, $password, $dbname);

// Überprüfen, ob die Verbindung erfolgreich war
if ($conn->connect_error) {
    die("Verbindung zur Datenbank fehlgeschlagen: ". $conn->connect_error);
}

// SQL-Abfrage, um die Kategorien aus der Datenbank abzurufen
$sql_categories = "SELECT DISTINCT kategorie FROM links";
$result_categories = $conn->query($sql_categories);

// Überprüfen, ob die Abfrage erfolgreich war
if (!$result_categories) {
    die("Fehler bei der Abfrage: ". $conn->error);
}

// Kategorien aus der Datenbank ausgeben
$categories = array();
while ($category_row = $result_categories->fetch_assoc()) {
    $categories[] = $category_row["kategorie"];
}

// Verbindung zur Datenbank schließen
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Links</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="container">
    <?php foreach ($categories as $kategorie): ?>
        <h2><?php echo $kategorie; ?></h2>
        <?php
        // Verbindung zur Datenbank herstellen
        $conn = new mysqli($servername, $username, $password, $dbname);

        // SQL-Abfrage, um die Links einer Kategorie aus der Datenbank abzurufen
        $sql_links = "SELECT link, beschreibung, titel FROM links WHERE kategorie = '$kategorie'";
        $result_links = $conn->query($sql_links);

        // Überprüfen, ob die Abfrage erfolgreich war
        if (!$result_links) {
            die("Fehler bei der Abfrage: ". $conn->error);
        }

        // Links einer Kategorie aus der Datenbank ausgeben
        while ($row = $result_links->fetch_assoc()) {
            echo "<a href='". $row["link"]. "' title='". $row["titel"]. "'>". $row["beschreibung"]. "</a>";
        }

        // Verbindung zur Datenbank schließen
        $conn->close();
        ?>
    <?php endforeach; ?>
</div>

<script src="script.js"></script>
</body>
</html>