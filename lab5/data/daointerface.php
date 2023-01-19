<?php
    interface InterfaceDao {
        function getAll();
        function getRecordById($id);
        function insert($record);
        function update($record);
        function delete($id);
    }
?>