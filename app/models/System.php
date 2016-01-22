<?php

include_once('Model.php');

class System extends Model {

    protected $id;
    protected $description;
    protected $email;
    protected $initial;
    protected $url;
    protected $status;
    
    //paginacao
    protected $apartir = 0;
    protected $pagina_atual = 0;
    protected $limite = 2;

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

        $sql = 'SELECT  id, 
                        description, 
                        email, 
                        initial, 
                        url, 
                        IF(status = 1, "ATIVO", "CANCELADO") "status" 
                FROM keepsystem 
                LIMIT '.$this->limite.' OFFSET '.$this->apartir;

        $stmt = $this->conn->prepare($sql);
        $stmt->execute();

        return $stmt->fetchAll();
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
                    WHERE (description LIKE '%".$this->description."%') OR (email LIKE '%".$this->email."%') OR (initial LIKE '%".$this->initial."%')
                    LIMIT ".$this->limite." OFFSET ".$this->apartir;

            $stmt = $this->conn->prepare($sql);

            $stmt->execute();


            return $stmt->fetchAll();
        } catch(PDOException $e) {
                throw new Exception('Erro: '. $e->getMessage());
        }
    }

    private function countSystem()
    {

        $sql = 'SELECT count(*) cont FROM keepsystem';

        $stmt = $this->conn->prepare($sql);
        $stmt->execute();

        return $stmt->fetch();
    }    
    
    public function pagination() {
        $paginacao = "";
        $total = $this->countSystem();
        $num_paginas = floor($total->cont/$this->limite);
        
        //monta a paginação
        if($num_paginas > 1) {
            $paginacao .= '<nav><ul class="pagination"> <li><a href="javascript:pesquisaComPaginacao(0, 1);">Inicio</a></li>';
                $ultima_pagina = 0;
            
                for ($i = 1 ; $i <= $num_paginas ; $i++) { 	
                    
                    $ultima_pagina = $i*$this->limite;
                    
                    if($i == $this->pagina_atual) {
                        $paginacao .="<li class='active' ><a href='javascript:;' >".$i."</a></li>";
                    } else {
                        $paginacao .="<li ><a href='javascript:pesquisaComPaginacao(".$i * $this->limite.",".$i.");'>".$i."</a></li>";
                    }
                }
            
            if($num_paginas <= 3) {
                $paginacao .='</lu></nav>';
            } else {
                $paginacao .= '<li><a href="javascript:pesquisaComPaginacao('.$ultima_pagina.', '.$num_paginas.');">Última</a> </li></lu></nav';
            }
        }
        
        return $paginacao;

    }    
    
}
