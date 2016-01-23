<div class="row">
<nav class="col-md-2" id="actions-sidebar">
    <ul class="nav nav-pills nav-stacked">
        <li><a class="list-group-item-info active glyphicon glyphicon-th-large"><?= __(' Ações') ?></a></li>
        <?= $this->Html->link(__(' Novo'), ['action' => 'add'],['class' => 'list-group-item glyphicon glyphicon-plus', 'title' => 'Novo']) ?>
    </ul>
</nav>
<div class="movimentacoes index col-md-10 columns content table-responsive">
    <div class="panel panel-info">
        <div class="panel-heading">
            <?php 
                    
                echo $this->Form->create(null, ['type' => 'get', 'class' => 'form-inline']);
                echo '<b>Buscar por:</b>
                        <label class="radio-inline">
                            <input type="radio" checked="true" name="optionSearch" value="Movimentacoes.ticket"> Ticket	
                        </label>
                        <label class="radio-inline">
                            <input type="radio" name="optionSearch" value="Movimentacoes.valor"> Valor
                        </label>
                        <label class="radio-inline">
                            <input type="radio" name="optionSearch" value="tipos.descricao"> Tipo
                        </label>
                        <label class="radio-inline">
                            <input type="radio" name="optionSearch" value="users.username"> Usuário
                        </label>
                         <label class="radio-inline">
                            <input type="radio" name="optionSearch"value="Movimentacoes.created"> Lançamento
                        </label>

                    </div>
                    <div class="panel-body">';


                echo ' <div class="pull-left">';
                echo $this->Form->input('search', ['class' => 'form-control input-sm', 'size' => '30', 'label' => false,
                    'placeholder' => 'Digite aqui sua pesquisa', 'value' => $this->request->query('search')]);
                echo '</div>';
                echo $this->Form->button('', ['class' => 'btn btn-sm glyphicon glyphicon-search', 'title' => 'Buscar']);
                echo ' ';
                echo $this->Html->link(__(' PDF'), ['action' => 'index', '_ext' => 'pdf', '?' => ['optionSearch' => $this->request->query('optionSearch'),
                        'search' => $this->request->query('search')]], ['class' => 'btn btn-sm btn-default glyphicon glyphicon-print', 'title' => 'Gerar Pdf']);
                echo ' ';
                echo $this->Html->link(__(' Lançamentos'), ['action' => 'report_lancamentos_diarios', '_ext' => 'pdf'], 
                            ['class' => 'btn btn-sm btn-warning glyphicon glyphicon-print', 'title' => 'Lançamentos do dia']);

                echo $this->Form->end();
            ?>            
        </div>
    </div>
    <table class="table table-striped table-hover">
        <thead>
            <tr>
                <th><?= $this->Paginator->sort('ticket') ?></th>
                <th><?= $this->Paginator->sort('valor') ?></th>
                <th><?= $this->Paginator->sort('tipos_id','Tipo de Movimentação') ?></th>
                <th><?= $this->Paginator->sort('users_id','Usuário') ?></th>
                <th><?= $this->Paginator->sort('created','Lançamento') ?></th>
                <th class="actions"><?= __('Ações') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($movimentacoes as $movimentaco): ?>
            <tr>
                <td><?= h($movimentaco->ticket) ?></td>
                <td>R$ <?= number_format($movimentaco->valor, 2,',','.') ?></td>
                <td><?= $movimentaco->has('tipo') ? $this->Html->link($movimentaco->tipo->descricao, ['controller' => 'Tipos', 'action' => 'view', $movimentaco->tipo->id]) : '' ?></td>
                <td><?= $movimentaco->has('user') ? $this->Html->link($movimentaco->user->username, ['controller' => 'Users', 'action' => 'view', $movimentaco->user->id]) : '' ?></td>
                <td><?= h(date_format($movimentaco->created,"d/m/Y H:i:s")) ?></td>
                <td class="actions" style="white-space:nowrap">
                    <?= $this->Html->link(__(''), ['action' => 'view', $movimentaco->id], ['class'=>'btn btn-primary btn-sm glyphicon glyphicon-search', 'title' => 'Ver']) ?>
                    <?= $this->Html->link(__(''), ['action' => 'edit', $movimentaco->id], ['class'=>'btn btn-success btn-sm glyphicon glyphicon-edit', 'title' => 'Editar']) ?>
                    <?= $this->Form->postLink(__(''), ['action' => 'delete', $movimentaco->id], ['confirm' => __('Tem certeza que deseja deletar?'), 'class'=>'btn btn-danger btn-sm glyphicon glyphicon-trash', 'title' => 'Deletar']) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <div class="paginator">
            <ul class="pagination">
                <?= $this->Paginator->prev('&laquo; ' . __('anterior'), ['escape'=>false]) ?>
                <?= $this->Paginator->numbers(['escape'=>false]) ?>
                <?= $this->Paginator->next(__('proximo') . ' &raquo;', ['escape'=>false]) ?>
            </ul>
        </div>
</div>
</div>