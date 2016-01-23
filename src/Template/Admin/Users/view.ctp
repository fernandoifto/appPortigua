<nav class="col-lg-2 col-md-3">
    <ul class="nav nav-pills nav-stacked">
        <li><a class="list-group-item-info active glyphicon glyphicon-th-large"><?= __(' Ações') ?></a></li>
        <?= $this->Html->link(__(' Listar'), ['action' => 'index'],['class' => 'list-group-item glyphicon glyphicon-th-list', 'title' => 'Listar']) ?>
        <?= $this->Html->link(__(' Novo'), ['action' => 'add'],['class' => 'list-group-item glyphicon glyphicon-plus', 'title' => 'Novo']) ?>
        <?= $this->Html->link(__(' Editar'), ['action' => 'edit', $user->id], ['class' => 'list-group-item glyphicon glyphicon-edit', 'title' => 'Editar']) ?>
        <?= $this->Form->postLink(__(' Deletar'), ['action' => 'delete', $user->id], ['confirm' => __('Tem certeza que deseja deletar # {0}?', $user->id),
                                    'class' => 'list-group-item glyphicon glyphicon-trash', 'title' => 'Deletar']) ?>
        <li><?= $this->Html->link(__(' PDF'), ['action' => 'view', $user->id, '_ext' => 'pdf'], ['class' => 'list-group-item glyphicon glyphicon-print', 'title' => 'Exportar para pdf']); ?> </li>

    </ul>
</nav>
<div class="users view col-lg-10 col-md-9">
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
                <th class="actions"><?= __('Ações') ?></th>
            </tr>
            <?php foreach ($user->movimentacoes as $movimentacoes): ?>
            <tr>
                <td><?= h($movimentacoes->ticket) ?></td>
                <td>R$ <?= h( number_format($movimentacoes->valor,2,',','.')) ?></td>
                <td><?= h($movimentacoes->observacao) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__(''), ['controller' => 'Movimentacoes', 'action' => 'view', $movimentacoes->id], ['class'=>'btn btn-primary btn-sm glyphicon glyphicon-search', 'title' => 'Ver']) ?>

                    <?= $this->Html->link(__(''), ['controller' => 'Movimentacoes', 'action' => 'edit', $movimentacoes->id], ['class'=>'btn btn-success btn-sm glyphicon glyphicon-edit', 'title' => 'Editar']) ?>

                    <?= $this->Form->postLink(__(''), ['controller' => 'Movimentacoes', 'action' => 'delete', $movimentacoes->id], ['confirm' => __('Tem certeza que deseja Deletar?'), 'class'=>'btn btn-danger btn-sm glyphicon glyphicon-trash', 'title' => 'Deletar']) ?>

                </td>
            </tr>
            <?php endforeach; ?>
        </table>
    <?php endif; ?>
    </div>
</div>
<br>