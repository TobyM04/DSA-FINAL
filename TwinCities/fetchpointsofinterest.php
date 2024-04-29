<?php
// Load XML file
$xml = simplexml_load_file('twincities.xml');

// Get Data by City function to extract data from any table by City ID
function getDataByCity($xml, $cityId, $tableName) {
    $data = [];
    foreach ($xml->database->table as $table) {
        if ((string)$table['name'] == $tableName) {
            $entry = [];
            $hasCityId = false;
            foreach ($table->column as $column) {
                // Check if the column is CityID and matches the requested cityId
                if ((string)$column['name'] == 'CityID' && (int)$column == $cityId) {
                    $hasCityId = true;
                }
                $entry[(string)$column['name']] = (string)$column;
            }
            if ($hasCityId) {
                $data[] = $entry;
            }
        }
    }
    return $data;
}

// Get City ID from query 
$cityId = isset($_GET['cityId']) ? (int)$_GET['cityId'] : 0;

// Aggregate data from multiple tables for the given City ID
$aggregateData = [
    'city' => getDataByCity($xml, $cityId, 'city'),
    'economy' => getDataByCity($xml, $cityId, 'economy'),
    'transportation' => getDataByCity($xml, $cityId, 'transportation'),
    'culturalevent' => getDataByCity($xml, $cityId, 'culturalevent')
];

// Return data as JSON
header('Content-Type: application/json');
echo json_encode($aggregateData);
?>
