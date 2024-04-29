<?php
require_once 'config.php'; 

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $cityId = isset($_POST['cityId']) ? (int)$_POST['cityId'] : 0;
    $userName = strip_tags($_POST['userName']);
    $commentText = strip_tags($_POST['comment']);

    if ($cityId && !empty($userName) && !empty($commentText)) {
        $xml = simplexml_load_file(XML_FILE_PATH);

        // Navigate to the <comments_data> node, or create it if it doesn't exist
        if (!isset($xml->comments_data)) {
            $commentsData = $xml->addChild('comments_data');
        } else {    
            $commentsData = $xml->comments_data;
        }

        // Create a new <comment> element within <comments_data>
        $newComment = $commentsData->addChild('comment');
        $newComment->addChild('cityId', $cityId);
        $newComment->addChild('username', $userName);
        $newComment->addChild('commentText', $commentText);
        $newComment->addChild('postedAt', date('Y-m-d H:i:s')); // Add current time as posting time

        // Save the updated XML back to the file
        $xml->asXML(XML_FILE_PATH);

        echo json_encode(['status' => 'success', 'message' => 'Comment added successfully.']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Invalid input.']);
    }
} else {
    echo json_encode(['status' => 'error', 'message' => 'Invalid request method.']);
}
?>

