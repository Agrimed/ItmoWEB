<?php
include_once "model.php";
include_once "daointerface.php";

    class XMLFile {
        public ?DOMDocument $doc = null;
        private $fileName;

        function __construct($fileName) {
            $this->doc = new DOMDocument();
            $rc = $this->doc->load($fileName);

            if (!$rc) {
                echo 'Can not open file';
                exit();
            }

            $this->fileName = $fileName;
        }

        function save() {
            $this->doc->save($this->fileName);
        }
    }

    //////////////////////////////////////////////////
    class XMLFileDao implements InterfaceDao {
        private ?XMLFile $xmlFile = null;
        private ?DOMDocument $xmlDoc = null;
        private $rootNode;

        function __construct($xmlFile) {
            $this->xmlFile = $xmlFile;
            $this->xmlDoc = $xmlFile->doc;
            $this->rootNode = $this->xmlDoc->getElementsByTagName('bundle')->item(0);
            $this->xmlFile->formatOutput = true;
        }

        public function getAll() {
            $arr = array();

            $flowers = $this->xmlDoc->getElementsByTagName('flower');
            foreach ($flowers as $flower) {
                 $arr[] = new Flower(
                    $flower->getAttribute('id'),
                    $flower->getAttribute('name'),
                    $flower->getAttribute('price'),
                    $flower->getAttribute('desc')
                 );
            }
            return $arr;
        }

        function getRecordById($id) {
            $element = $this->getElementById($id);
            if ($element) {
                return new Flower(
                    $element->getAttribute('id'),
                    $element->getAttribute('name'),
                    $element->getAttribute('price'),
                    $element->getAttribute('desc')
                );
            }
            return null;
        }

        function insert($record) {
            $element = $this->createElement(
                $record->name,
                $record->price,
                $record->desc,
            );

            $this->rootNode->appendChild($element);
            $this->xmlFile->save();
        }

        function update($record) {
            $oldElement = $this->getElementById($record->id);
            $newElement = $this->createElement($record->name, $record->price, $record->desc);

            $this->rootNode->replaceChild($newElement, $oldElement);
            $this->xmlFile->save();
        }

        function delete($id) {
            $element = $this->getElementById($id);
            $this->rootNode->removeChild($element);
            $this->xmlFile->save();
        }

        //////////////////////////////////////////////////////////////////////////
        private function createElement($name, $price, $desc) {
            $flowers = $this->xmlDoc->getElementsByTagName('flower');
            $element = $this->xmlDoc->createElement('flower');

            $idAttr = $this->xmlDoc->createAttribute('id');
            $lastIdx = 0;
            if ($flowers->count()) {
             $lastIdx = $flowers->item($flowers->count() - 1)->getAttribute('id');
            }
            $idAttr->value = $lastIdx + 1;

            $nameAttr = $this->xmlDoc->createAttribute('name');
            $nameAttr->value = $name;

            $priceAttr = $this->xmlDoc->createAttribute('price');
            $priceAttr->value = $price;

            $descAttr = $this->xmlDoc->createAttribute('desc');
            $descAttr->value = $desc;

            $element->appendChild($idAttr);
            $element->appendChild($nameAttr);
            $element->appendChild($priceAttr);
            $element->appendChild($descAttr);

            $element->setIdAttribute('id', true);
            return $element;
         }

         private function getElementById($id) {
             $root = $this->xmlFile->doc->getElementsByTagName('bundle');
             $flowers = $this->xmlFile->doc->getElementsByTagName('flower');

             $retRecord = null;
             foreach ($flowers as $flower) {
                 if($flower->getAttribute('id') == $id) {
                     $retRecord = $flower;
                     break;
                 }
             }
             return $retRecord;
         }
    }
?>