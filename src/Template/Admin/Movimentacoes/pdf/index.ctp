<?php if ($user_auth['role'] == 'Administrador') { ?>
        <div class="users index col-md-12 columns content table-responsive">
            <h3>Lista Movimentações</h3>
            <table border="1" style="width:100%; padding: 5px">
                <thead>
                    <tr style="background-color: #3A87AD">                     
                        <th>Ticket</th>
                        <th>Valor</th>
                        <th>Tipo de Movimentação</th>
                        <th>Usuário</th>
                        <th>Lançamento</th>
                        
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($movimentacoes as $movimentaco): ?>
                        <tr>                           
                            <td><?= h($movimentaco->ticket) ?></td>
                            <td>R$ <?= number_format($movimentaco->valor, 2,',','.') ?></td>
                            <td><?= $movimentaco->has('tipo') ? $movimentaco->tipo->descricao : '' ?></td>
                            <td><?= $movimentaco->has('user') ? $movimentaco->user->username : '' ?></td>
                            <td><?= h(date_format($movimentaco->created,"d/m/Y H:i:s")) ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
<?php } else { ?>
    <div class="alert alert-danger" role="alert">Você não tem acesso de administrador!!!</div>
<?php } ?>
