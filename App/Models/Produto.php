<?php

use App\Core\Model;

//Criação de uma classe
class Produto {
    //Atributos da classe Produto
    public $id;
    public $descricao;
    public $peso;
    public $tamanho;
    public $quantidade;
    public $cor;
    public $valor;
    public $desconto;
    public $imagem;

    
    //Método da classe Produto
    public function listarTodos(){
        $sql = " SELECT p.*, c.descricao as categoria FROM tbl_produto p INNER JOIN tbl_categoria c ON p.categoria_id = c.id ORDER BY p.id DESC ";

        //preparamos a consulta 
        $stmt = Model::getConnection()->prepare($sql);
        
        //Executamos a consulta
        $stmt->execute();

        //Verificamos a quantidade de linhas
        if($stmt->rowCount() > 0){
            //pegamos os resultados em forma de lista de objetos 
            $resultado = $stmt->fetchALL(\PDO::FETCH_OBJ);

            //retoramos o resultado
            return $resultado;
        }else {
            return[];
        }
    }
}