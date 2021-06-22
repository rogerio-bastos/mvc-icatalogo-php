
<div class="categorias-container">
    <div style="display: flex; align-items: center; justify-content: center; margin-bottom: 20px;">
        <h1 style="margin: 0">Lista de Categorias</h1>
        <button id="addCategoria" style= "width: fit-content; align-self: center; border-radius: 50%; margin-left: 10px;">+</button> 
    </div>
    <?php
    if (count($data) == 0) {
        echo "<p style='text-align: center'>Nenhuma categoria cadastrada.</p>";
    }
    foreach ($data as $categoria) {
    ?>
        <div class="card-categorias">
            <?= $categoria->descricao ?>
            <div>
                <img onclick="editCategoria(<?= $categoria->id ?>)" src="/imgs/edit.svg"/>
                <img onclick="deleteCategoria(<?= $categoria->id ?>)" src="https://freesvg.org/img/trash.png"/>
            </div>
        </div>
    <?php
    }
    ?>
</div>
<script>
    function editCategoria(categoriaId){
        window.location = `/categorias/edit/${categoriaId}`;
    }

    function deleteCategoria(categoriaId){
        if(confirm("Deseja realmente deletar essa categoria?")){
            window.location = `/categorias/destroy/${categoriaId}`;
        }
    }

    document.querySelector("#addCategoria").addEventListener("click", () => {
        window.location = "categorias/create"
    })
</script>