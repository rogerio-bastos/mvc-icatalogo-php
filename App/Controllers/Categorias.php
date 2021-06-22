<?php
session_start();
use App\Core\Controller;

class Categorias extends Controller
{

    public function index()
    {

        $categoriaModel = $this->model("Categoria");

        $dados = $categoriaModel->listarTodas();

        $this->view("categorias/index", $dados);
    }

    public function create()
    {
        $this->view("categorias/create");
    }

    public function store(){

        //validar os campos (pegar a função de validação já criada no outro projeto)
        $erros = $this->validaCampos();

        if (count($erros) > 0) {
            $_SESSION["erros"] = $erros;

            header("location: /categorias/create");

            exit();
        }

        //instanciar o model
        $categoriaModel = $this->model("Categoria");

        //atribuir a descricao do $_POST ao model->descricao
        $categoriaModel->descricao= $_POST["descricao"];

        //chamar a função de inserir  - verificar se deu certo, e enviar uma mensagem
        if($categoriaModel->insert()){
            $_SESSION["mensagem"] = "Categoria cadastrada com sucesso.";
        }else{
            $_SESSION["mensagem"] = "Problemas ao cadastrar a categoria.";
        }
         
        header("location: /categorias");
       
    }

    public function edit($id){
        $categoriaModel = $this->model("Categoria");

        $categoriaModel = $categoriaModel->findById($id);

        if($categoriaModel){
            $this->view("categorias/edit", $categoriaModel);
        }else{
            $_SESSION["mensagem"] = "Problemas ao buscar categoria";
            header("location: /categorias");
        }
    }
    //fazer a atualização da categoria
    public function update($id){
        //validando os campos
        $erros = $this->validaCampos();

        if (count($erros) > 0) {
            $_SESSION["erros"] = $erros;

            header("location: /categorias/edit/" . $id);

            exit();
        }

        //criando o model para atualização
        $categoriaModel = $this->model("Categoria");

        $categoriaModel->id = $id;
        $categoriaModel->descricao = $_POST["descricao"];

        if($categoriaModel->update()){
            $_SESSION["mensagem"] = "Categoria editada com sucesso.";
        }else{
            $_SESSION["mensagem"] = "Problemas ao editar a categoria.";
        }

        header ("location: /categorias");
    }

    public function destroy($id){
        $categoriaModel = $this->model("Categoria");

        $categoriaModel->id = $id;

        if($categoriaModel->delete()){
            $_SESSION["mensagem"] = "Categoria excluída com sucesso.";
        }else{
            $_SESSION["mensagem"] = "Problemas ao excluir a categoria.";
        }

        header("location: /categorias");
    }

    private function validaCampos(){
        $erros = [];

        if (!isset($_POST["descricao"]) || $_POST["descricao"] == "") {
            $erros[] = "O campo descrição é obrigatório.";
        }

        return $erros;
    }
}
