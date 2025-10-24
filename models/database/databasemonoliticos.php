<?php

namespace App\Models\Databases;

use mysqli;

class Databasemonoliticos
{
    private $hostDb = "localhost";
    private $nameDb = "databasemonoliticos";
    private $userDb = "root";
    private $pwdDb = "";
    private $conexDb = null;

    private $isSqlSelect = false;

    public function __construct()
    {
        $this->conexDb = new mysqli(
            $this->hostDb,
            $this->userDb,
            $this->pwdDb,
            $this->nameDb
        );
        if ($this->conexDb->connect_error) {
            die("" . $this->conexDb->connect_error);
            
        } 
        // echo 'la conexion a la base de datos ha sido establecida';      
    }
    
     

    public function setIsSqlSelect($bool)
    {
        $this->isSqlSelect = $bool;
    }

    public function execSQL($sql, ...$bindParam)
    {
        //return $this->conexDb->query($sql);
        $prp = $this->conexDb->prepare($sql);
        if (!empty($bindParam)) {
            $prp->bind_param(...$bindParam);
        }
        if (!$this->isSqlSelect) {
            return $prp->execute();
        }
        $prp->execute();
        return $prp->get_result();
    }

    public function closeDB()
    {
        $this->conexDb->close();
    }
}
         
