<?php

class Todo
{
    protected $db;
    protected $table = 'todos';

    public function __construct(PDO $db)
    {
        $this->db = $db;
    }

    public function index(int $user_id)
    {
        $handle = $this->db->prepare("SELECT * FROM {$this->table} where user_id = :user_id");
        $handle->bindParam(':user_id', $user_id, PDO::PARAM_INT);
        $handle->execute();

        $result = $handle->fetchAll(PDO::FETCH_ASSOC);

        return $result;
    }

    public function store(array $data): void
    {
        $query = "INSERT INTO {$this->table} (id, todo, user_id, when_date) values (default, :todo, :user_id, :when_date)";

        $handle = $this->db->prepare("$query");
        $handle->bindParam(':todo', $data['todo'], PDO::PARAM_STR);
        $handle->bindParam(':user_id', $data['user_id'], PDO::PARAM_STR);
        $handle->bindParam(':when_date', $data['when_date'], PDO::PARAM_STR);
        $handle->execute();
    }

    public function show(int $id)
    {
        $handle = $this->db->prepare("SELECT * FROM {$this->table} where id = :id");
        $handle->bindParam(':id', $id, PDO::PARAM_INT);
        $handle->execute();

        $result = $handle->fetch(PDO::FETCH_ASSOC);

        return $result;
    }

    public function update(int $id, array $todo): void
    {
        $query = "UPDATE {$this->table} SET todo = :todo, when_date = :when_date WHERE id = :id";

        $handle = $this->db->prepare($query);
        $handle->bindParam(':todo', $todo['todo'], PDO::PARAM_STR);
        $handle->bindParam(':when_date', $todo['when_date'], PDO::PARAM_STR);
        $handle->bindParam(':id', $id, PDO::PARAM_INT);
        $handle->execute();
    }

    public function destroy(int $id): void
    {
        $query = "DELETE FROM {$this->table} WHERE id = :id";

        $handle = $this->db->prepare($query);
        $handle->bindParam(':id', $id, PDO::PARAM_INT);
        $handle->execute();
    }
}
