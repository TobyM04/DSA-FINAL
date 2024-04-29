<?php
require_once 'config.php'; 

function fetchDetailsOfInterest($poi_id) {
    $xml = simplexml_load_file(XML_FILE_PATH);
    if ($xml === false) {
        error_log("Failed to load XML file from " . XML_FILE_PATH);
        return false; // Early return if XML couldn't be loaded
    }

    foreach ($xml->database->table as $table) {
        if ($table['name'] == 'placeofinterest') {
            foreach ($table->column as $column) {
                if ((string)$column['name'] == 'PlaceID' && (int)$column == $poi_id) {
                    // Finding the PlaceID to prepare for the array
                    $details = array();
                    foreach ($table->column as $detailColumn) {
                        $details[(string)$detailColumn['name']] = (string)$detailColumn;
                    }
                    return $details; // Return the found details
                }
            }
        }
    }
    return false; // No matching PlaceID found
}

if (isset($_GET['id'])) {
    $poi_id = (int)$_GET['id'];
    $details = fetchDetailsOfInterest($poi_id);

    if ($details) {
        $name = htmlspecialchars($details['Name']);
        $description = htmlspecialchars($details['Description']);
        // Use the existing photo filename
        $photoFilename = htmlspecialchars($details['Photos']);
        $photoPath = isset($details['Photos']) ? $details['Photos'] : 'default.jpg';
    } else {
        $error_message = "Details not found for the selected point of interest.";
    }
} else {
    $error_message = "No point of interest ID provided.";
}
// Array of colors for the table rows
$rowColors = ['#007bff', '#28a745', '#dc3545', '#17a2b8', '#ffc107', '#f8f9fa', '#6c757d', '#fd7e14', '#343a40'];

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Details of Interest</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="details.css">
</head>
<body>
    <!-- Full-page background image with darker overlay -->
    <div class="full-background" style="background-image: url('<?= $photoPath ?>');">
        <div class="overlay"></div>
    </div>

    <div class="container-fluid my-4">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <!-- Background image container with dark overlay -->
                <div class="background-image" style="background-image: url('<?= $photoPath ?>');">
                    <div class="dark-overlay"></div>
                </div>

                <!-- Existing content and image display -->
                <?php if (isset($details) && $details): ?>
                    <div class='text-center'>
                        <h1 class='display-4 text-white' id="place-name"><?= $name ?></h1>
                    </div>
                    <div class='card mb-4 bg-dark text-white'>
                        <?php if ($photoPath): ?>
                            <img src="<?= $photoPath ?>" alt="<?= $name ?>" class="card-img-top">
                        <?php endif; ?>
                        <div class='card-body'>
                            <table class="table table-dark table-hover">
                                <tbody>
                                    <tr>
                                        <th scope="row">Description</th>
                                        <td><?= $description ?></td>
                                    </tr>
                                    <?php $count = 0; ?>
                                    <?php foreach ($details as $key => $value): ?>
                                        <?php if (!in_array($key, ['Name', 'Description', 'Photos', 'PlaceID', 'CityID'])): ?>
                                            <tr style="background-color: <?= $rowColors[$count % count($rowColors)]; ?>">
                                                <th scope="row"><?= htmlspecialchars($key) ?></th>
                                                <td><?= htmlspecialchars($value) ?></td>
                                            </tr>
                                            <?php $count++; ?>
                                        <?php endif; ?>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                <?php elseif (isset($error_message)): ?>
                    <p class="alert alert-danger text-white"><?= $error_message ?></p>
                <?php else: ?>
                    <p class="text-white">No point of interest selected.</p>
                <?php endif; ?>
            </div>
        </div>
    </div>
    <script src="script.js"></script>
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.9.14/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <a href="index.php" class="btn btn-danger home-button">Canterbury and Reims Page</a>
</body>
</html>












