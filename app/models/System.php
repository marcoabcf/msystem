<?php

include_once('Model.php');

class System extends Model {

    protected $id;
    protected $description;
    protected $email;
    protected $initial;
    protected $url;
    protected $status;

    public function __construct()
    {
        $this->open();
    }

    public function newer()
    {

        $sql = 'INSERT INTO keepsystem(description, email, initial, url) VALUES (:description, :email, :initial, :url)';

        $stmt = $this->conn->prepare($sql);

        $stmt->bindParam(':description', $this->description, PDO::PARAM_STR);
        $stmt->bindParam(':email', $this->email, PDO::PARAM_STR);
        $stmt->bindparam(':initial', $this->initial, PDO::PARAM_STR);
        $stmt->bindparam(':url', $this->url, PDO::PARAM_STR);

        $result = $stmt->execute();

        if($result) {
            return true;

        } else {
            return false;
        }
    }

    public function alter()
    {

        $sql = 'UPDATE keepsystem SET description = :description, email = :email, initial = :initial, url = :url, status = :status WHERE id = :id';

        $stmt = $this->conn->prepare($sql);

        $stmt->bindParam(':id', $this->id, PDO::PARAM_INT);
        $stmt->bindParam(':description', $this->description, PDO::PARAM_STR);
        $stmt->bindparam(':email', $this->email, PDO::PARAM_STR);
        $stmt->bindparam(':initial', $this->initial, PDO::PARAM_STR);
        $stmt->bindparam(':url', $this->url, PDO::PARAM_STR);
        $stmt->bindparam(':status', $this->status, PDO::PARAM_INT);

        $result = $stmt->execute();

        if($result) {
            return true;

        } else {
            return false;
        }
    }

    public function getData()
    {
        $sql = 'SELECT * FROM keepsystem WHERE id = :id';

        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':id', $this->id, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetch();
    }

    public function toList()
    {

        $sql = 'SELECT id, description, email, initial, url, IF(status = 1, "ATIVO", "CANCELADO") "status" FROM keepsystem ORDER BY status ASC';

        $stmt = $this->conn->prepare($sql);
        $stmt->execute();

        return $stmt->fetchAll();
    }

    public function search()
    {

        $sql = 'SELECT id, description, email, initial, url, IF(status = 1, "ATIVO", "CANCELADO") "status" FROM keepsystem WHERE description LIKE :description AND email LIKE :email AND initial LIKE :initial';

        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':description', $this->description, PDO::PARAM_STR);
        $stmt->bindParam(':email', $this->email, PDO::PARAM_STR);
        $stmt->bindParam(':initial', $this->initial, PDO::PARAM_STR);
        $stmt->execute();

        return $stmt->fetchAll();
    }
}
