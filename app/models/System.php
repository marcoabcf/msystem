<?php

include_once('Model.php');

class System extends Model {

    // Atributos System
    protected $id;
    protected $description;
    protected $email;
    protected $initial;
    protected $url;
    protected $status;

    // Paginação
    protected $apartir = 0;
    protected $pagina_atual = 0;
    protected $limite = 1;

    public function __construct()
    {
        $this->open();
    }

    public function newer()
    {
        try {

            $sql = 'INSERT INTO keepsystem(description, email, initial, url)
                                VALUES (:description, :email, :initial, :url)';

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

        } catch(PDOException $e) {
                throw new Exception('Erro: '. $e->getMessage());
        }
    }

    public function alter()
    {
        try {

            $sql = 'UPDATE keepsystem SET
                           description = :description,
                           email = :email,
                           initial = :initial,
                           url = :url,
                           status = :status
                    WHERE id = :id';

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

        } catch(PDOException $e) {
                throw new Exception('Erro: '. $e->getMessage());
        }
    }

    public function getData()
    {
        try {
            $sql = 'SELECT * FROM keepsystem WHERE id = :id';

            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':id', $this->id, PDO::PARAM_INT);
            $stmt->execute();

            return $stmt->fetch();

        } catch(PDOException $e) {
                throw new Exception('Erro: '. $e->getMessage());
        }
    }

    public function toList()
    {
        try {

            $sql = 'SELECT  id,
                            description,
                            email,
                            initial,
                            url,
                            IF(status = 1, "ATIVO", "CANCELADO") "status"
                    FROM keepsystem
                    LIMIT :limts OFFSET :apartir';

            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':limts', $this->limite, PDO::PARAM_INT);
            $stmt->bindParam(':apartir', $this->apartir, PDO::PARAM_INT);
            $stmt->execute();

            return $stmt->fetchAll();

        } catch(PDOException $e) {
                throw new Exception('Erro: '. $e->getMessage());
        }
    }

    public function search()
    {
        try {

            $sql = "SELECT id,
                           description,
                           email,
                           initial,
                           url,
                           IF(status = 1, 'ATIVO', 'CANCELADO') 'status'
                    FROM keepsystem
                    WHERE (description LIKE :description)
                      AND (email LIKE :email)
                      AND (initial LIKE :initial)
                    LIMIT :limts OFFSET :apartir";

            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':description', $this->description, PDO::PARAM_STR);
            $stmt->bindParam(':email', $this->email, PDO::PARAM_STR);
            $stmt->bindParam(':initial', $this->initial, PDO::PARAM_STR);
            $stmt->bindParam(':limts', $this->limite, PDO::PARAM_INT);
            $stmt->bindParam(':apartir', $this->apartir, PDO::PARAM_INT);
            $stmt->execute();

            return $stmt->fetchAll();

        } catch(PDOException $e) {
                throw new Exception('Erro: '. $e->getMessage());
        }
    }

    private function countSystem()
    {
        try {

            $sql = 'SELECT count(*) cont FROM keepsystem';

            $stmt = $this->conn->prepare($sql);
            $stmt->execute();

            return $stmt->fetch();

        } catch(PDOException $e) {
                throw new Exception('Erro: '. $e->getMessage());
        }
    }

    public function pagination()
    {
        $pagination = "";
        $total = $this->countSystem();
        $num_paginas = floor($total->cont/$this->limite);

        // Monta a paginação
        if($num_paginas > 1) {
            $pagination .= '<nav><ul class="pagination"><li><a href="javascript:NavegarPaginacao(0, 1);">Inicio</a></li>';

                for ($i = 1 ; $i <= $num_paginas ; $i++) {

                    // Recebendo valor da última página
                    $ultima_pagina = $i * $this->limite;

                    if($i == $this->pagina_atual) {
                        $pagination .= "<li class='active'><a href='javascript:;' >".$i."</a></li>";

                    } else {
                        $pagination .= "<li><a href='javascript:NavegarPaginacao(". $i .", ". ($i-1) * $this->limite .");'>". $i ."</a></li>";
                    }
                }

            if($num_paginas <= 3) {
                $pagination .= '</ul></nav>';
            } else {
                $pagination .= '<li><a href="javascript:NavegarPaginacao('. $ultima_pagina .', '. $num_paginas .');">Última</a> </li></ul></nav';
            }
        }

        return $pagination;
    }

}
