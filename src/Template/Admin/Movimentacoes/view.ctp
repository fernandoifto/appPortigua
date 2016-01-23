<nav class="col-lg-2 col-md-3">
    <ul class="nav nav-pills nav-stacked">
        <li><a class="list-group-item-info active glyphicon glyphicon-th-large"><?= __(' Ações') ?></a></li>
        <?= $this->Html->link(__(' Listar'), ['action' => 'index'],['class' => 'list-group-item glyphicon glyphicon-th-list', 'title' => 'Listar']) ?>
        <?= $this->Html->link(__(' Novo'), ['action' => 'add'],['class' => 'list-group-item glyphicon glyphicon-plus', 'title' => 'Novo']) ?>
        <?= $this->Html->link(__(' Editar'), ['action' => 'edit', $movimentaco->id], ['class' => 'list-group-item glyphicon glyphicon-edit', 'title' => 'Editar']) ?>
        <?= $this->Form->postLink(__(' Deletar'), ['action' => 'delete', $movimentaco->id], ['confirm' => __('Tem certeza que deseja deletar?'),
                                    'class' => 'list-group-item glyphicon glyphicon-trash', 'title' => 'Deletar']) ?>
        <li><?= $this->Html->link(__(' PDF'), ['action' => 'view', $movimentaco->id, '_ext' => 'pdf'], ['class' => 'list-group-item glyphicon glyphicon-print', 'title' => 'Exportar para pdf']); ?> </li>


    </ul>
</nav>
<div class="movimentacoes view col-lg-10 col-md-9">
    <h3></h3>
    <table class="table table-striped table-hover">
        <tr>
            <th>Ticket:</th>
            <td><?= $movimentaco->ticket ?></td>
        </tr>
        <tr>
            <th>Valor:</th>
            <td>R$ <?= number_format($movimentaco->valor,2,',','.') ?></td>
        </tr>
        <tr>
            <th>Tipo:</th>
            <td><?= $movimentaco->has('tipo') ? $this->Html->link($movimentaco->tipo->descricao, ['controller' => 'Tipos', 'action' => 'view', $movimentaco->tipo->id]) : '' ?></td>
        </tr>
        <tr>
            <th>Usuário:</th>
            <td><?= $movimentaco->has('user') ? $this->Html->link($movimentaco->user->username, ['controller' => 'Users', 'action' => 'view', $movimentaco->user->id]) : '' ?></td>
        </tr>
        <tr>
            <th>Lançamento:</th>
            <td><?= h(date_format($movimentaco->created,"d/m/Y H:i:s")) ?></td>
        </tr>
        <tr>
            <th>Observação:</th>
            <td><?= h($movimentaco->observacao) ?></td>
        </tr>
    </table>
</div>
<br>