<div class="categorias-container">
    <form class="form-categoria" method="POST" action="/categorias/update/<?= $data->id ?>">
        <h1 class="span2">Editar Categoria</h1>
        <ul>
            <?php
            if (isset($_SESSION["erros"])) {
                foreach ($_SESSION["erros"] as $erro) {
            ?>
                    <li><?= $erro ?></li>
            <?php
                }
                unset($_SESSION["erros"]);
            }
            ?>
        </ul>
        <div class="input-group span2">
            <label for="descricao">Descrição</label>
            <input type="text" name="descricao" id="descricao" value="<?= $data->descricao ?>" requrired />
        </div>
        <button type="button" onclick="javascript:window.location.href = '/categorias'">Cancelar</button>
        <button>Salvar</button>
    </form>
</div>