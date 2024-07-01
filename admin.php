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

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $link = $_POST['link'];
    $beschreibung = $_POST['beschreibung'];
    $titel = $_POST['titel'];
    $kategorie = $_POST['kategorie'];

    $sql_insert = "INSERT INTO links (link, beschreibung, titel, kategorie) VALUES ('$link', '$beschreibung', '$titel', '$kategorie')";

    if ($conn->query($sql_insert) === TRUE) {
        echo "Neuer Link erfolgreich hinzugefügt.";
    } else {
        echo "Fehler: " . $sql_insert . "<br>" . $conn->error;
    }
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
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Links hinzufügen</title>
    <link rel="stylesheet" href="style_desktop.css">
    <link rel="stylesheet" href="style_mobile.css" media="only screen and (max-width: 768px)">
</head>
<body>
<div class="container">
    <div class="header">
        <h1>B-Kurs Girls - Admin</h1>
    </div>
    <div class="admin-form">
        <h2>Neuen Link hinzufügen</h2>
        <form method="post" action="admin.php">
            <label for="link">Link:</label>
            <input type="text" id="link" name="link" required>
            <br>
            <label for="beschreibung">Beschreibung:</label>
            <input type="text" id="beschreibung" name="beschreibung" required>
            <br>
            <label for="titel">Titel:</label>
            <input type="text" id="titel" name="titel" required>
            <br>
            <label for="kategorie">Kategorie:</label>
            <input type="text" id="kategorie" name="kategorie" list="kategorie-liste" required>
            <datalist id="kategorie-liste">
                <?php foreach ($categories as $kategorie): ?>
                <option value="<?php echo $kategorie; ?>">
                    <?php endforeach; ?>
            </datalist>
            <br>
            <button type="submit">Hinzufügen</button>
        </form>
    </div>
</div>
</body>
</html>
