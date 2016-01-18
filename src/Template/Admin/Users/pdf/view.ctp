<div class="users view col-lg-12 col-md-12">
    <h3><?= h($user->username) ?></h3>
    <table class="table table-striped table-hover">
        <tr>
            <th>Nome:</th>
            <td><?= h($user->username) ?></td>
        </tr>
        <tr>
            <th>E-Mail:</th>
            <td><?= h($user->email) ?></td>
        </tr>
        <tr>
            <th>Perfil:</th>
            <td><?= h($user->role) ?></td>
        </tr>
    </table>
    <div class="related table-responsive">
        <h4><?= __('{0}', ['Movimentacoes relacionados ']) ?></h4>
        <?php if (!empty($user->movimentacoes)): ?>
        <table class="table table-striped table-hover">
            <tr>
                <th>Ticket</th>
                <th>Valor</th>
                <th>Observação</th>
            </tr>
            <?php foreach ($user->movimentacoes as $movimentacoes): ?>
            <tr>
                <td><?= h($movimentacoes->ticket) ?></td>
                <td>R$ <?= h( number_format($movimentacoes->valor,2,',','.')) ?></td>
                <td><?= h($movimentacoes->observacao) ?></td>
            </tr>
            <?php endforeach; ?>
        </table>
    <?php endif; ?>
    </div>
</div>
<br>