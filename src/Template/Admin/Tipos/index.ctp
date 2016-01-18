<div class="row">
<nav class="col-md-2" id="actions-sidebar">
    <ul class="nav nav-pills nav-stacked">
        <li><a class="list-group-item-info active glyphicon glyphicon-th-large"><?= __(' Ações') ?></a></li>
        <?= $this->Html->link(__(' Novo'), ['action' => 'add'],['class' => 'list-group-item glyphicon glyphicon-plus', 'title' => 'Novo']) ?>
    </ul>
</nav>
<div class="tipos index col-md-10 columns content table-responsive">
    <div class="panel panel-info">
        <div class="panel-heading">Lista de Tipos de Movimentação</div>
        <div class="panel-body">
            <?php
                echo $this->Form->create(null, ['type' => 'get', 'class' => 'form-inline']);
                    echo '<label class="radio-inline">
                                <input type="radio" checked="true" name="optionSearch" id="opcaoBuscaDescricao" value="Tipos.descricao"> Descrição
                          </label>
                          <label class="radio-inline">
                                <input type="radio" name="optionSearch" id="opcaoBuscaTipo" value="Tipos.tipo"> Tipo
                          </label>';
                
                echo ' <div class="pull-right">';
                    echo $this->Form->input('search', ['class' => 'form-control input-sm','size' => '30', 'label' => false,
                         'placeholder' => 'Digite aqui sua pesquisa', 'value' => $this->request->query('search')]); 
                echo '</div>';
                                
                echo $this->Form->end();
            ?>
        </div>
    </div>
    <table class="table table-striped table-hover">
        <thead>
            <tr>
                <th><?= $this->Paginator->sort('descricao','Descrição') ?></th>
                <th><?= $this->Paginator->sort('tipo','Tipo') ?></th>
                <th class="actions"><?= __('Ações') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($tipos as $tipo): ?>
            <tr>
                <td><?= h($tipo->descricao) ?></td>
                <td><?= h($tipo->tipo)  ?></td>
                <td class="actions" style="white-space:nowrap">
                    <?= $this->Html->link(__(''), ['action' => 'view', $tipo->id], ['class'=>'btn btn-primary btn-sm glyphicon glyphicon-search', 'title' => 'Ver']) ?>
                    <?= $this->Html->link(__(''), ['action' => 'edit', $tipo->id], ['class'=>'btn btn-success btn-sm glyphicon glyphicon-edit', 'title' => 'Editar']) ?>
                    <?= $this->Form->postLink(__(''), ['action' => 'delete', $tipo->id], ['confirm' => __('Tem certeza que deseja deletar o tipo  {0}?', $tipo->descricao), 'class'=>'btn btn-danger btn-sm glyphicon glyphicon-trash', 'title' => 'Deletar']) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <div class="paginator">
        <center>
            <ul class="pagination">
                <?= $this->Paginator->prev('&laquo; ' . __('anterior'), ['escape'=>false]) ?>
                <?= $this->Paginator->numbers(['escape'=>false]) ?>
                <?= $this->Paginator->next(__('proximo') . ' &raquo;', ['escape'=>false]) ?>
            </ul>
        </div>
    </center>
</div>
</div>