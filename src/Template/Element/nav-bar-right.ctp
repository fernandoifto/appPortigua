
<ul class="nav navbar-nav navbar-right">
  <li class="dropdown">
    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><?= $user_auth['username']; ?><span class="caret"></span></a>
    <ul class="dropdown-menu">
      <li><?= $this->Html->link(' Perfil', ['prefix' => 'admin', 'controller' => 'users', 'action' => 'edit/'.$user_auth['id']], ['class' => 'glyphicon glyphicon-cog']) ?>  </li>
      <li role="separator" class="divider"></li>
       <li> <?= $this->Html->Link(' Sair', ['controller' => 'Users', 'action' => 'logout', 'prefix' => 'admin'], ['class' => 'glyphicon glyphicon-off']); ?></li>
    </ul>
  </li>
</ul>
