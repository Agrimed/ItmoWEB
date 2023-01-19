<?php

$xmlFile = new DOMDocument();
$rc = $xmlFile->load('bundle.xml');
if (!$rc) {
    echo '<h1>Can not open file';
    exit();
}

$bundle = $xmlFile->getElementsByTagName('flower');

function createElement($name, $price, $desc) {
    global $xmlFile, $bundle;

    $element = $xmlFile->createElement('flower');

    $idAttr = $xmlFile->createAttribute('id');
    $lastIdx = 0;
    if ($bundle->count()) {
        $lastIdx = $bundle->item($bundle->count() - 1)->getAttribute('id');
    }
    $idAttr->value = $lastIdx + 1;

    $nameAttr = $xmlFile->createAttribute('name');
    $nameAttr->value = $name;

    $priceAttr = $xmlFile->createAttribute('price');
    $priceAttr->value = $price;

    $descAttr = $xmlFile->createAttribute('desc');
    $descAttr->value = $desc;

    $element->appendChild($idAttr);
    $element->appendChild($nameAttr);
    $element->appendChild($priceAttr);
    $element->appendChild($descAttr);

    $element->setIdAttribute('id', true);
    return $element;
}

function addRecordToXML($name, $price, $desc) {
    global $xmlFile;

    $xmlFile->formatOutput = true;
    $root = $xmlFile->getElementsByTagName('bundle')->item(0);

    $element = createElement($name, $price, $desc);

    $root->appendChild($element);
    $xmlFile->save('bundle.xml');

    return true;
}

function updateRecordToXML($oldNode, $name, $price, $desc) {
    global $xmlFile;

    $xmlFile->formatOutput = true;
    $root = $xmlFile->getElementsByTagName('bundle')->item(0);

    $element = createElement($name, $price, $desc);

    $root->replaceChild($element, $oldNode);
    $xmlFile->save('bundle.xml');

    return true;
}
?>