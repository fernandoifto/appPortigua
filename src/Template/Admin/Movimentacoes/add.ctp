<nav class="col-md-2 columns" id="actions-sidebar">
    <ul class="nav nav-pills nav-stacked">
        <li><a class="list-group-item-info active glyphicon glyphicon-th-large"><?= __(' Ações') ?></a></li>
        <?= $this->Html->link(__(' Listar'), ['action' => 'index'],['class' => 'list-group-item glyphicon glyphicon-th-list', 'title' => 'Listar']) ?>
    </ul>
</nav>
<div class="movimentacoes form col-md-10 columns content">
    <?= $this->Form->create($movimentaco) ?>
    <fieldset>
        <legend><?= 'Cadastro de Movimentação' ?></legend>
        <?php
            echo $this->Form->input('ticket');
            echo $this->Form->input('valor', ['step' => '0.01']);
            echo $this->Form->hidden('users_id', ['value' => $user_auth['id']]);
            echo $this->Form->input('tipos_id', ['options' => $tipos]);
            echo $this->Form->input('observacao', ['label' => 'Obeservação', 'type' => 'textarea']);
        ?>
    </fieldset>
    <?= $this->Form->button(__(' Salvar'), ['class' => 'glyphicon glyphicon-floppy-save']) ?>
    <?= $this->Form->end() ?>
</div>
