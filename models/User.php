<?php

class User
{
    protected $db;
    protected $table = 'users';

    public function __construct(PDO $db)
    {
        $this->db = $db;
    }

    public function authenticate(string $email, string $password)
    {
        $handle = $this->db->prepare("SELECT id FROM {$this->table} WHERE email=:email AND password=:password");
        $handle->bindParam("email", $email, PDO::PARAM_STR);
        $encrypted = hash('sha256', $password);
        $handle->bindParam("password", $encrypted, PDO::PARAM_STR);
        $handle->execute();

        if ($handle->rowCount() > 0) {
            $result = $handle->fetch(PDO::FETCH_OBJ);
            return $result->id;
        }

        return false;
    }

    public function register(string $name, string $email, string $password)
    {
        $query = "INSERT INTO {$this->table} (id, name, email, password)";
        $values = "values (default, :name, :email, :password)";

        $handle = $this->db->prepare("{$query} {$values}");
        $handle->bindParam(':name', $name, PDO::PARAM_STR);
        $handle->bindParam(':email', $email, PDO::PARAM_STR);
        $encrypt = hash('sha256', $password);
        $handle->bindParam(':password', $encrypt, PDO::PARAM_STR);
        $handle->execute();
    }

    public function emailExist(string $email): bool
    {
        $query = $this->db->prepare("SELECT id FROM users WHERE email=:email");
        $query->bindParam("email", $email, PDO::PARAM_STR);
        $query->execute();

        if ($query->rowCount() > 0) {
            return true;
        }

        return false;
    }
}
