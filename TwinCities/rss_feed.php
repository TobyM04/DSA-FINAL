<?php
require_once 'Config.php'; 

header('Content-Type: application/rss+xml; charset=utf-8');

// Load the XML source
$xml = new DOMDocument;
$xml->load(XML_FILE_PATH);

// Load the XSLT script
$xsl = new DOMDocument;
if ($xsl->load('twincities_rss.xsl')) { 
    echo "XSLT loaded successfully.\n";
} else {
    echo "Failed to load XSLT.\n";
    exit; // Exit if the XSLT file cannot be loaded
}

// Configures
$proc = new XSLTProcessor;
$proc->importStyleSheet($xsl);

// Set the current date/time as a parameter for use in the XSLT
$proc->setParameter('', 'currentDateTime', date('c'));


$proc->setParameter('', 'base_url', 'http://' . $_SERVER['HTTP_HOST'] . '/');

// Transform the XML to RSS
$rss = $proc->transformToXML($xml);

// Output the transformed RSS
echo $rss;
?>


