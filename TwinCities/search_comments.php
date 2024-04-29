<?php
header('Content-Type: application/json');

function xmlElementToArray($xmlElement) {
    $array = [];
    foreach ($xmlElement->attributes() as $attr) {
        $array[$attr->getName()] = (string)$attr;
    }
    foreach ($xmlElement->children() as $child) {
        $array[$child->getName()] = (string)$child;
    }
    return $array;
}

function analyzeCommentFrequency($comments) {
    $wordCounts = [];
    foreach ($comments as $comment) {
        $words = explode(' ', strtolower($comment['commentText']));
        foreach ($words as $word) {
            $word = preg_replace('/[^a-z0-9]+/', '', $word); // Remove non-alphanumeric chars
            if (!empty($word)) {
                if (!isset($wordCounts[$word])) {
                    $wordCounts[$word] = 0;
                }
                $wordCounts[$word]++;
            }
        }
    }
    arsort($wordCounts); // Sort by frequency
    return $wordCounts;
}

$searchTerm = $_GET['search'] ?? '';
$cacheFile = 'cache/' . md5($searchTerm) . '.json';

if (file_exists($cacheFile) && (filemtime($cacheFile) > time() - 300)) {
    echo file_get_contents($cacheFile);
    exit;
}

$xml = simplexml_load_file('twincities.xml');
$results = [];

foreach ($xml->xpath('//comment') as $comment) {
    $commentText = (string)$comment->commentText;
    $username = (string)$comment->username;
    $cityId = (string)$comment->cityId;

    if (stripos($commentText, $searchTerm) !== false) {
        $results[] = [
            'commentText' => $commentText,
            'username' => $username,
            'cityId' => $cityId,
            'postedAt' => (string)$comment->postedAt
        ];
    }
}

// Performs content analysis on the results
$wordCounts = analyzeCommentFrequency($results);

// Save word counts to a file named based on the search term for easy reference
$analysisFile = 'analysis/' . md5($searchTerm) . '_analysis.log';
file_put_contents($analysisFile, print_r($wordCounts, true));

if (!file_put_contents($cacheFile, json_encode($results))) {
    error_log("Failed to write to cache file '$cacheFile'. Check permissions.");
}

echo json_encode($results);
?>
