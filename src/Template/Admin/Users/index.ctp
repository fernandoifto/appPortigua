<?php if ($user_auth['role'] == 'Administrador') { ?>
    <div class="row">
        <nav class="col-md-2" id="actions-sidebar">
            <ul class="nav nav-pills nav-stacked">
                <li><a class="list-group-item-info active glyphicon glyphicon-th-large"><?= __(' Ações') ?></a></li>
                <?= $this->Html->link(__(' Novo'), ['action' => 'add'], ['class' => 'list-group-item glyphicon glyphicon-plus', 'title' => 'Novo']) ?>
                
            </ul>
        </nav>
        <div class="users index col-md-10 columns content table-responsive">
            <div class="panel panel-info">
                <div class="panel-heading">
                    <?php 
                    
                    echo $this->Form->create(null, ['type' => 'get', 'class' => 'form-inline']);
                    echo '<b>Buscar por:</b>
                        <label class="radio-inline">
                            <input type="radio" checked="true" name="optionSearch" id="opcaoBuscaNome" value="Users.username"> Nome
                        </label>
                        <label class="radio-inline">
                            <input type="radio" name="optionSearch" id="opcaoBuscaEmail" value="Users.email"> E-Mail
                        </label>
                        <label class="radio-inline ">
                            <input type="radio" name="optionSearch" id="opcaoBuscaPerfil" value="Users.role"> Perfil
                        </label>

                    </div>
                    <div class="panel-body">';
                        
                            echo ' <div class="pull-left">';
                                echo $this->Form->input('search', ['class' => 'form-control input-sm','size' => '30', 'label' => false,
                                     'placeholder' => 'Digite aqui sua pesquisa', 'value' => $this->request->query('search')]); 
                            echo '</div>';
                            echo $this->Form->button('',['class' => 'btn btn-sm glyphicon glyphicon-search', 'title' => 'Buscar']);
                            echo ' ';
                            echo $this->Html->link(__(' PDF'), ['action' => 'index', '_ext' => 'pdf', '?' => ['optionSearch' => $this->request->query('optionSearch'), 
                                                'search' => $this->request->query('search')]], ['class' => 'btn btn-sm btn-warning glyphicon glyphicon-print', 'title' => 'Gerar Pdf']);

                            echo $this->Form->end();
                        ?>
                    </div>
            </div>
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th><?= $this->Paginator->sort('username', 'Nome') ?></th>
                        <th><?= $this->Paginator->sort('email', 'E-Mail') ?></th>
                        <th><?= $this->Paginator->sort('role', 'Perfil do usuário') ?></th>
                        <th class="actions"><?= __('Ações') ?></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($users as $user): ?>
                        <tr>
                            <td><?= h($user->username) ?></td>
                            <td><?= h($user->email) ?></td>
                            <td><?= h($user->role) ?></td>
                            <td class="actions" style="white-space:nowrap">
                                <?= $this->Html->link(__(''), ['action' => 'view', $user->id], ['class' => 'btn btn-primary btn-sm glyphicon glyphicon-search', 'title' => 'Ver']) ?>
                                <?= $this->Html->link(__(''), ['action' => 'edit', $user->id], ['class' => 'btn btn-success btn-sm glyphicon glyphicon-edit', 'title' => 'Editar']) ?>
                                <?= $this->Form->postLink(__(''), ['action' => 'delete', $user->id], ['confirm' => __('Tem certeza que deseja deletar o usuário {0}?', $user->username), 'class' => 'btn btn-danger btn-sm glyphicon glyphicon-trash', 'title' => 'Deletar']) ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <div class="paginator">
                    <ul class="pagination">
                        <?= $this->Paginator->prev('&laquo; ' . __('anterior'), ['escape' => false]) ?>
                        <?= $this->Paginator->numbers(['escape' => false]) ?>
                        <?= $this->Paginator->next(__('proximo') . ' &raquo;', ['escape' => false]) ?>
                    </ul>
            </div> 
        </div>
    </div>
<?php } else { ?>
    <div class="alert alert-danger" role="alert">Você não tem acesso de administrador!!!</div>
<?php } ?>
