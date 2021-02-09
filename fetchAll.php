<?php

function connect(){
    $server = 'localhost';
    $dbname= 'presentation';
    $username = 'root';
    $password = ''; 
    $dsn = "mysql:host=$server;dbname=$dbname";
    $options = array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);
    try {
        $link = new PDO($dsn, $username, $password, $options);
        return $link;
    } catch(PDOException $e) {
        exit;      
    }
}

class fetchTest{
    public $id;
    public $firstName;
    public $lastName;
    public $age;
}

        


function runFetch($fetchOPtion){
    $db = connect();
    $result ="";
    switch ($fetchOPtion){
        case 'FETCH_COLUMN':{
            $sql = 'SELECT * FROM fetchTest';
            $stmt = $db->prepare($sql);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_COLUMN, 2); 
            break;
        }
        case 'FETCH_GROUP':{
            $sql = 'SELECT * FROM fetchTest';
            $stmt = $db->prepare($sql);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_COLUMN|PDO::FETCH_GROUP); 
            break;
        }
        case 'FETCH_CLASS':{
            $sql = 'SELECT * FROM fetchTest';
            $stmt = $db->prepare($sql);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_CLASS, "fetchTest"); 
            break;
        }
        case 'FETCH_FUNC':{
            $sql = 'SELECT firstName, age FROM fetchTest';
            $stmt = $db->prepare($sql);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_FUNC, "myphpFunc"); 
            break;
        }


        default:
        $sql = 'SELECT * FROM fetchTest';
        $stmt = $db->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll(); 
    }
    $stmt->closeCursor();
    return $result;
}

$option = filter_input(INPUT_GET, 'option');
print_r(runFetch($option));
    

