<div class="users view col-lg-12 col-md-12">
    <h3><?= h($tipo->descricao) ?></h3>
    <table border="1" style="width:100%; padding: 5px">
        <tr>
            <th>Descrição:</th>
            <td><?= h($tipo->descricao) ?></td>
        </tr>
        <tr>
            <th>Tipo:</th>
            <td><?= h($tipo->tipo) ?></td>
        </tr>
    </table>
    <div class="related table-responsive">
        <h4><?= __('{0}', ['Movimentacoes relacionados ']) ?></h4>
        <?php if (!empty($tipo->movimentacoes)): ?>
        <table border="1" style="width:100%; padding: 5px">
            <tr style="background-color: #3A87AD">
                <th>Ticket</th>
                <th>Valor</th>
                <th>Observacao</th>
            </tr>
            <?php foreach ($tipo->movimentacoes as $movimentacoes): ?>
            <tr>
                <td><?= h($movimentacoes->ticket) ?></td>
                <td>R$ <?= number_format($movimentacoes->valor,2,',','.') ?></td>
                <td><?= h($movimentacoes->observacao) ?></td>
            </tr>
            <?php endforeach; ?>
        </table>
    <?php endif; ?>
    </div>
</div>
<br>