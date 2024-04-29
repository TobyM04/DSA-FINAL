<?php
header('Content-Type: application/json');

if (isset($_GET['cityId'])) {
    $cityId = $_GET['cityId'];
    // Captures sort order from query parameters, default to 'newest'
    $sortOrder = isset($_GET['sortOrder']) && $_GET['sortOrder'] === 'oldest' ? 'oldest' : 'newest';

    // Load the XML file
    $xml = simplexml_load_file('twincities.xml');
    $comments = [];


    foreach ($xml->comments_data->comment as $commentElement) {
        $commentCityId = (string) $commentElement->cityId;
        $username = (string) $commentElement->username;
        $commentText = (string) $commentElement->commentText;
        $postedAt = (string) $commentElement->postedAt;

        if ($commentCityId === $cityId) {
            $comments[] = [
                'cityId' => $commentCityId,
                'username' => $username,
                'comment' => $commentText,
                'posted_at' => $postedAt,
            ];
        }
    }

    // Sort comments based on 'posted_at' date
    usort($comments, function($a, $b) use ($sortOrder) {
        if ($sortOrder === 'newest') {
            return strtotime($b['posted_at']) - strtotime($a['posted_at']);
        } else { // 'oldest'
            return strtotime($a['posted_at']) - strtotime($b['posted_at']);
        }
    });

    // Return the sorted comments as JSON
    echo json_encode($comments);
} else {
    echo json_encode(['error' => 'City ID is required.']);
}
?>

