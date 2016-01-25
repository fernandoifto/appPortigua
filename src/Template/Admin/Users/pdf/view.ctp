<div class="users view col-lg-12 col-md-12">
    <h3><?= h($user->username) ?></h3>
    <table border="1" style="width:100%; padding: 5px">
        <tr>
            <th><b>Nome:</b></th>
            <td><?= h($user->username) ?></td>
        </tr>
        <tr>
            <th><b>E-Mail:</b></th>
            <td><?= h($user->email) ?></td>
        </tr>
        <tr>
            <th><b>Perfil:</b></th>
            <td><?= h($user->role) ?></td>
        </tr>
    </table>
        <h4><?= __('{0}', ['Movimentacoes relacionados ']) ?></h4>
        <?php if (!empty($user->movimentacoes)): ?>
        <table border="1" style="width:100%; padding: 5px;">
            <tr style="background-color: #3A87AD">
                <th><b>Ticket</b></th>
                <th><b>Valor</b></th>
                <th><b>Observação</b></th>
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
