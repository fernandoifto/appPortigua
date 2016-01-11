<?php if($user_auth){ ?>
<ul class="nav navbar-nav">
    <li><?= $this->Html->link('Movimentações', ['prefix' => 'admin', 'controller' => 'movimentacoes', 'action' => 'index']) ?></li>
    <li><?= $this->Html->link('Tipos', ['prefix' => 'admin', 'controller' => 'tipos', 'action' => 'index']) ?></li>
    
    <?php if($user_auth['role'] == 'Administrador'){ ?>
        <li><?= $this->Html->link('Usuários', ['prefix' => 'admin', 'controller' => 'users', 'action' => 'index']) ?></li>
    <?php } ?>
    
</ul>
<?php } ?>
