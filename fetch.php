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
    
function runFetch($fetchOPtion){
    $db = connect();
        
    $result ="";
    switch ($fetchOPtion){
        // returns an array indexed by column name as returned in your result set
        case 'FETCH_ASSOC':{ 
            $sql = 'SELECT * FROM fetchTest';
            $stmt = $db->prepare($sql);
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC); 
            break;
        }
        // (default): returns an array indexed by both column name and 0-indexed column number as returned in your result set
        case 'FETCH_BOTH':{
            $sql = 'SELECT * FROM fetchTest';
            $stmt = $db->prepare($sql);
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_BOTH); 
            break;
        }
        // returns an anonymous object with property names that correspond to the column names returned in your result set
        case 'FETCH_OBJ':{
            $sql = 'SELECT * FROM fetchTest';
            $stmt = $db->prepare($sql);
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_OBJ); 
            break;
        }
        // combines PDO::FETCH_BOTH and PDO::FETCH_OBJ, creating the object variable names as they are accessed
        case 'FETCH_LAZY':{
            $sql = 'SELECT * FROM fetchTest';
            $stmt = $db->prepare($sql);
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_LAZY); 
            break;
        }
        // returns an array with the same form as PDO::FETCH_ASSOC, except that if there are multiple columns with the same name, 
        // the value referred to by that key will be an array of all the values in the row that had that column name
        case 'FETCH_NAMED':{
            $sql = "SELECT * FROM fetchTest,fetchTest2 where fetchTest.firstName='First Name5'";
            $stmt = $db->prepare($sql);
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_NAMED); 
            // $result = $stmt->fetch(); 
            
            break;
        }
        // Default same as FETCH_BOTH
        default:
        $sql = 'SELECT * FROM fetchTest';
        $stmt = $db->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetch(); 
    }
    $stmt->closeCursor();
    return $result;
}

$option = filter_input(INPUT_GET, 'option');
print_r(runFetch($option));
    

