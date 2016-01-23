<div class="users view col-lg-12 col-md-12">
    <h3>Ticket: <?= h($movimentaco->ticket) ?></h3>
    <table border="1" style="width:100%; padding: 5px">      
        <tr>
            <th>Ticket:</th>
            <td><?= $movimentaco->ticket ?></td>
        </tr>
        <tr>
            <th>Valor:</th>
            <td>R$ <?= number_format($movimentaco->valor,2,',','.') ?></td>
        </tr>
        <tr>
            <th>Tipo:</th>
            <td><?= $movimentaco->has('tipo') ? $movimentaco->tipo->descricao : '' ?></td>
        </tr>
        <tr>
            <th>Usuário:</th>
            <td><?= $movimentaco->has('user') ? $movimentaco->user->username : '' ?></td>
        </tr>
        <tr>
            <th>Lançamento:</th>
            <td><?= h(date_format($movimentaco->created,"d/m/Y H:i:s")) ?></td>
        </tr>
        <tr>
            <th>Observação:</th>
            <td><?= h($movimentaco->observacao) ?></td>
        </tr>
 
    </table>
</div>
<br>