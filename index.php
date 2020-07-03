<?php

require_once 'DB.php';


class User{
    public static function find(array $args){
        $db = new DB();
        $stmt = $db->conn->prepare("SELECT * FROM users WHERE {$args['field']} = '{$args['value']}'");
        $stmt->execute();
        $res = $stmt->setFetchMode(PDO::FETCH_ASSOC);

        echo "<pre>";
        print_r($stmt->fetchAll());
        echo "</pre>";
    }

    public static function __callStatic($method, $arguments)
    {
        if(preg_match('/^findBy(.+)$/', $method, $matches)){
            return self::find([
                'field'     => strtolower($matches[1]),
                'value'     => $arguments[0]
            ]);
        }
    }


}

User::findByPhone(989898989);