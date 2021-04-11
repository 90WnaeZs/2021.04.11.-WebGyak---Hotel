<?php

class DBcon
{
    protected $db_host;
    protected $db_username;
    protected $db_pw;
    protected $db_con;

    function __construct()
    {
        $this->db_host="localhost";
        $this->db_username="root";
        $this->db_pw="";
    }

    function __destruct()
    {

    }

    function Connection($dbname)
    {
        try
        {
            $this->db_con=new PDO("mysql:host=$this->db_host;dbname=$dbname", $this->db_username, $this->db_pw);
            $this->db_con->exec("set names 'utf-8'");
        }
        catch(PDOException $e)
        {
            die("Adatbázis hiba!");
        }
    
    }

    public function Login($username,$pw)
    {
        $success=false;
        $res=$this->db_con->prepare("SELECT * FROM users WHERE Nev= :pNev AND Jelszo= :pJelszo");
        $res->bindparam("pNev",$username);
        $res->bindparam("pJelszo",$pw);

        $row=$res->execute();
        $row=$res->fetch();
        if($row)
        {
            $success=true;
            session_start();
            $_SESSION['uid']=$row['ID_user'];
        }
        return $success;
        
        //echo "<script>alert($row['ID_user'])</script>";
    }

    function Reg($reguser,$regpw)
    {
        $success=false;
        $insert=$this->db_con->prepare("insert into users(nev,jelszo) values(?,?)");

           $insert->bindparam(1,$reguser);
           $insert->bindparam(2,$regpw);

           $insert_row=$insert->execute();

           if($insert_row>0)
           {
               $success=true;
               echo "<script>alert('Sikeres regisztráció!')</script>";
           }   
           else
           {
               $success=false;
               echo "<script>alert('Sikertelen regisztráció!')</script>";
           }
        return $success;
    }

    function length_check($username,$pw)
    {
        $ok=false;
        if(strlen($username)>=3 && strlen($pw)>=6)
        {
            $ok=true;
        }
        else
        {
            $ok=false;
            echo "<script>alert('A felhasználónévnek 3, a jelszónak 6 karakter hosszúnak kell lenni minimum!')</script>";
        }
        return $ok;
    }
}


?>