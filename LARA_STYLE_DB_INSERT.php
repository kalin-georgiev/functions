<?php
error_reporting(E_ALL);
ini_set('display_errors',1);

class DB {
    
    protected static $table = '';
    protected $fields = [];
    
    public static function table($table) {
      
       self::$table = $table;
        
        return new class() {
            
            public function insert(array $fields) {
                
                $this->fields = $fields;
                
                $query = function() {
                    
                $keys = array_keys($this->fields);
                $values = array_values($this->fields);
                    
                echo 'INSERT INTO (';
                
                foreach($keys as $key) {
                    echo "$key,";
                }
                
                echo ')';
                
                echo ' VALUES (';
                
                foreach($values as $value) {
                    echo "'$value',";
                }
                
                echo ');';
                    
                };
                
                mysqli_query($db,$query());
            }
        };
    }
}

DB::table('rooms')->insert(['type'=>'single_bed','id'=>'15']);