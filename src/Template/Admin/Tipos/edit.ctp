<nav class="col-md-2 columns" id="actions-sidebar">
    <ul class="nav nav-pills nav-stacked">
        <li><a class="list-group-item-info active glyphicon glyphicon-th-large"><?= __(' Ações') ?></a></li>
        <?= $this->Html->link(__(' Listar'), ['action' => 'index'],['class' => 'list-group-item glyphicon glyphicon-th-list', 'title' => 'Listar']) ?>
        <?= $this->Form->postLink(
                __(' Deletar'),
                ['action' => 'delete', $tipo->id],
                ['confirm' => __('Tem certeza que deseja deletar o tipo  {0}?', $tipo->descricao),
                    'class' => 'list-group-item glyphicon glyphicon-trash', 'title' => 'Listar']
            )
        ?>
        
    </ul>
</nav>
<div class="tipos form col-md-10 columns content">
    <?= $this->Form->create($tipo) ?>
    <fieldset>
        <legend><?= 'Editar Tipo de Movimentação' ?></legend>
        <?php
            echo $this->Form->input('descricao');
            echo $this->Form->input('tipo', ['label' => 'Tipo',
                    'options' => ['Entrada' => 'Entrada', 'Saída' => 'Saída']
            ]);
        ?>
    </fieldset>
    <?= $this->Form->button(__(' Salvar'), ['class' => 'glyphicon glyphicon-floppy-save']) ?>
    <?= $this->Form->end() ?>
</div>
