<?php

use App\Core\Controller;

class Produtos extends Controller{

    //Lista todos os produtos
    public function index(){

        $produtoModel = $this->model("Produto");

        $dados = $produtoModel->listarTodos();

        $this->view("produtos/index", $dados);
    }
}