<link rel="stylesheet" href="/css/produtos.css" />
<?php
foreach ($data as $produto) {
    $desconto = $produto->desconto;
    $valor = $produto->valor;

    if ($desconto > 0) {
        $valorProdutoComDesconto = $valor - ($valor * ($desconto / 100));
        $valor = $valorProdutoComDesconto;
    }

    $qtdParcelas = $valor > 1000 ? 12 : 6;

    $valorParcela = $valor / $qtdParcelas;
?>
    <article class="card-produto">
        <figure>
            <img src="/fotos/<?= $produto->imagem ?>" />
        </figure>
        <section>
            <span class="preco">
                R$<?= number_format($valor, 2, ",", ".") ?>
                <?php
                if ($desconto != 0) {
                ?>
                    <em><?= $desconto ?>% off</em>
                <?php
                }
                ?>
            </span>
            <span class="parcelamento">ou em <em><?= $qtdParcelas ?>x R$<?= number_format($valorParcela, 2, ",", ".") ?> sem juros</em></span>

            <span class="descricao"><?= $produto->descricao ?></span>
            <span class="categoria">
                <em><?= $produto->categoria ?></em>
            </span>
            <?php
            // if (isset($_SESSION["usuarioId"])) {
            ?>
                <span class="actions">
                    <form method="GET" action="./editar">
                        <input type="hidden" name="acao" value="editar" />
                        <input type="hidden" name="produtoId" value="<?= $produto->descricao ?>" />
                        <button><img src="/imgs/edit.svg"></button>
                    </form>

                    <form method="POST" action="./acoes.php">
                        <input type="hidden" name="acao" value="deletar" />
                        <input type="hidden" name="produtoId" value="<?= $produto->id ?>" />
                        <input type="hidden" name="produtoImagem" value="<?= $produto->imagem ?>" />
                        <button id="cancelButton"><img src="/imgs/cancel.svg"></button>
                    </form>
                </span>

            <?php
            //}
            ?>
        </section>
        <footer>

        </footer>
    </article>
<?php
}
?>