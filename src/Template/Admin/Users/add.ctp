<?php 
    if($user_auth['role'] == 'Administrador'){ ?>
    <nav class="col-md-2 columns" id="actions-sidebar">
        <ul class="nav nav-pills nav-stacked">
            <li><a class="list-group-item-info active glyphicon glyphicon-th-large"><?= __(' Ações') ?></a></li>
            <?= $this->Html->link(__(' Listar'), ['action' => 'index'],['class' => 'list-group-item glyphicon glyphicon-th-list', 'title' => 'Listar']) ?>

        </ul>
    </nav>
    <div class="users form col-md-10 columns content">
        <?= $this->Form->create($user) ?>
        <fieldset>
            <legend><?= 'Cadastro de usuário' ?></legend>
            <?php
                echo $this->Form->input('username', ['label' => 'Nome']);
                echo $this->Form->input('email', ['label' => 'E-Mail']);
                echo $this->Form->input('password', ['label' => 'Senha']);
                echo $this->Form->input('role', ['label' => 'Perfil',
                    'options' => ['Usuário' => 'Usuário', 'Administrador' => 'Administrador']
                ]);
            ?>
        </fieldset>
        <?= $this->Form->button(__(' Salvar'), ['class' => 'glyphicon glyphicon-floppy-save']) ?>
        <?= $this->Form->end() ?>
    </div>
<?php }  else { ?>
    <div class="alert alert-danger" role="alert">Você não tem acesso de administrador!!!</div>
<?php } ?>