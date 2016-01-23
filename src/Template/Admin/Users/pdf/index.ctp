<?php if ($user_auth['role'] == 'Administrador') { ?>
        <div class="users index col-md-12 columns content table-responsive">
            <h3>Lista de Usuários</h3>
            <table border="1" style="width:100%; padding: 5px">
                <thead>
                    <tr style="background-color: #3A87AD">
                        <th><b>Nome:</b></th>
                        <th><b>E-Mail:</b></th>
                        <th><b>Perfil do usuário:</b></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($users as $user): ?>
                        <tr>
                            <td><?= h($user->username) ?></td>
                            <td><?= h($user->email) ?></td>
                            <td><?= h($user->role) ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
<?php } else { ?>
    <div class="alert alert-danger" role="alert">Você não tem acesso de administrador!!!</div>
<?php } ?>
