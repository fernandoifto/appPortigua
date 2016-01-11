<?php
    $objUser = new App\Controller\Admin\UsersController;
    $autoUser = $objUser->isAuthorized($user_auth);

    if ($autoUser) { ?>
    <nav class="col-md-2 columns" id="actions-sidebar">
        <ul class="nav nav-pills nav-stacked">
            <li><a class="list-group-item-info active glyphicon glyphicon-th-large"><?= __(' Ações') ?></a></li>
            <?= $this->Html->link(__(' Listar'), ['action' => 'index'], ['class' => 'list-group-item glyphicon glyphicon-th-list', 'title' => 'Listar']) ?>
            <?=
            $this->Form->postLink(
                    __(' Deletar'), ['action' => 'delete', $user->id], ['confirm' => __('Tem certeza que deseja deletar o usuário {0}?', $user->username),
                'class' => 'list-group-item glyphicon glyphicon-trash', 'title' => 'Listar']
            )
            ?>

        </ul>
    </nav>
<?php } ?>
<?php if ($autoUser || $user['id'] == $user_auth['id']) { ?>
    <div class="users form col-md-10 columns content">
        <?= $this->Form->create($user) ?>
        <fieldset>
            <legend><?= 'Editar Usuário' ?></legend>
            <?php
            echo $this->Form->input('username', ['label' => 'Nome']);
            echo $this->Form->input('email', ['label' => 'E-Mail']);
            echo $this->Form->input('password', ['label' => 'Senha']);
            if($autoUser){
                echo $this->Form->input('role', ['label' => 'Perfil',
                    'options' => ['Usuário' => 'Usuário', 'Administrador' => 'Administrador']
                ]);
            }
            ?>
        </fieldset>
        <?= $this->Form->button(__(' Salvar'), ['class' => 'glyphicon glyphicon-floppy-save']) ?>
        <?= $this->Form->end() ?>
    </div>
<?php } else { ?>
    <div class="alert alert-danger" role="alert">Você não tem acesso de administrador!!!</div>
<?php } ?>