<?php

class Database
{
    private static $_instance;
    private $_connection;
    private $DB_host = "localhost";
    private $DB_user_name = "root";
    private $DB_user_password = "root";
    private $DB_driver = "mysql";
    private $DB_database = "globe_bank";
    
    public static function init()
    {
        try {
            if (is_null(self::$_instance) || empty(self::$_instance)) {
                self::$_instance = new self();
                return self::$_instance;
            }else{
                return self::$_instance;
            }
        } catch (Exception $e) {
            return self::class;
        }
    }

    function __construct()
    {
        try {
            
            if (is_null($this->_connection) || empty($this->_connection)) {
                $this->_connection = new \PDO($this->DB_driver.':host='.$this->DB_host.';dbname='.$this->DB_database, $this->DB_user_name, $this->DB_user_password);
                
                $this->_connection->setAttribute('PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION');
            }
        } catch (Exception $e) {
            $this->_connection = $e;
        }
    }

    public function connect()
    {
        return $this->_connection ? $this->_connection : null;

    }
    
    public function fetch() {
        $query = $this->_connection->query('SELECT * FROM subjects');
        
        foreach($query->fetchAll() as $menu_name) {
            echo $menu_name['menu_name'] . '<br>';
        }
    }
    
    public function transaction(array $query) {
        
        try { 
            $this->_connection->beginTransaction();

            foreach($query as $action) {
                $this->_connection->exec($action);
            }

            $this->_connection->commit();
            
            $errInfo = $this->_connection->errorInfo();
            
            //print_r($errInfo);
         } 
        
        catch(PDOException $e) {
            
            $this->_connection->rollBack();
        
            echo 'Transaction failed!';
        }
    }
}

//(new Database)->fetch();

$db = new Database;
$db->transaction(["insert into subjects (menu_name, position, visible) values ('Prices', '5','1')","insert into subjects (menu_name, position, visible) values ('Kalin', '5','1')" ]);