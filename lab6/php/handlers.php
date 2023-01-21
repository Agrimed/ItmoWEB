<?php
include_once "appcontent.php";

    function getAllJson() {
        global $repo;
        
        $arr = array(); 
        $flowers = $repo->getAll();
        foreach($flowers as $flower) {
            $arr[] = array(
                'id' => $flower->id,
                'name' => $flower->name,
                'price' => $flower->price,
                'desc' => $flower->desc
            );
        }
        return json_encode($arr);
    }

    function getRecordJson($id) {
        global $repo;
        
        $flower = $repo->getRecordById($id);
        $arr = array(
            'id' => $flower->id,
            'name' => $flower->name,
            'price' => $flower->price,
            'desc' => $flower->desc
        );

        return json_encode($arr);
    }

    $command = $_POST['command'];
    $id = $_POST['id'];

    switch($command) {
        case 'LIST': {
            echo getAllJson();
            break;
        }

        case 'RECORD': {
            echo getRecordJson($id);
            break;
        }

        case 'DELETE': {
            $repo->delete($id);
            echo getAllJson();
            break;
        }

        case 'CREATE': {
            $repo->insert(
                new Flower(
                    0,
                    $_POST['name'],
                    $_POST['price'],
                    $_POST['desc']
                )
            );
            echo getAllJson();
            break;
        }

        case 'UPDATE': {
            $repo->update(
                new Flower(
                    $id,
                    $_POST['name'],
                    $_POST['price'],
                    $_POST['desc']
                )
            );
            echo getAllJson();
            break;
        }
    } 
?>