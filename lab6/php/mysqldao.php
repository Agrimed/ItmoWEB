<?php

include_once "daointerface.php";

    class Flowerdb{

        public $connection = null;

        function __construct($userName = 'Leo', $password = '123', $dataBase = 'flowers'){

            $this->connection = mysqli_connect('127.0.0.1', $userName, $password, $dataBase);

            if(!$this->connection){
                echo 'Не удалось подключиться к базе данных! <br>';
                echo mysqli_connect_error();
                exit();
            }
        }
    }


    class MySqlDao implements InterfaceDao {

        public $database = null;

        function __construct(Flowerdb $dataBase){
            $this->dataBase = $dataBase->connection;
        }

        function getAll(){
            $arr = array();
            $sql = "SELECT * FROM `bundles`";
            $cursor = mysqli_query($this->dataBase, $sql);
            while(($record = mysqli_fetch_assoc($cursor))) {
                $arr[] = new Flower( $record['id'], $record['name'], $record['price'], $record['description'] );
            }
            return $arr;
        }

        function getRecordById($id){
            $sql = "SELECT * FROM `bundles` WHERE id = $id";
            $cursor = mysqli_query($this->dataBase, $sql);
            if(mysqli_num_rows($cursor) == 0){
                echo "Not found record with id = $id";
                return null;
            }
            $record = mysqli_fetch_assoc($cursor);
            return new Flower( $record['id'], $record['name'], $record['price'], $record['description'] );
        }

        function insert($record){
            $sql = "INSERT INTO `bundles`(`name`, `price`, `description`) VALUES ('$record->name','$record->price','$record->desc')";
            $cursor = mysqli_query($this->dataBase, $sql);
        }

        function update($record){
            $sql = "UPDATE `bundles` SET `name`='$record->name',`price`='$record->price',`description`='$record->desc' WHERE id = $record->id";
            $cursor = mysqli_query($this->dataBase, $sql);
        }

        function delete($id){
            $sql = "DELETE FROM `bundles` WHERE id = $id";
            $cursor = mysqli_query($this->dataBase, $sql);
        }
    }
?>