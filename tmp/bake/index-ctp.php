<?php
/**
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @since         0.1.0
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */
use Cake\Utility\Inflector;

$fields = collection($fields)
    ->filter(function($field) use ($schema) {
        return !in_array($schema->columnType($field), ['binary', 'text']);
    })
    ->take(7);
?>
<div class="row">
<nav class="col-md-2" id="actions-sidebar">
    <ul class="nav nav-pills nav-stacked">
        <li><a class="list-group-item-info active glyphicon glyphicon-th-large"><CakePHPBakeOpenTag= __(' Ações') CakePHPBakeCloseTag></a></li>
        <CakePHPBakeOpenTag= $this->Html->link(__(' Novo'), ['action' => 'add'],['class' => 'list-group-item glyphicon glyphicon-plus', 'title' => 'Novo']) CakePHPBakeCloseTag>
<?php
    $done = [];
    foreach ($associations as $type => $data):
        foreach ($data as $alias => $details):
            if (!empty($details['navLink']) && $details['controller'] !== $this->name && !in_array($details['controller'], $done)):
?>

<?php
                $done[] = $details['controller'];
            endif;
        endforeach;
    endforeach;
?>
    </ul>
</nav>
<div class="<?= $pluralVar ?> index col-md-10 columns content table-responsive">
    <h3><?= $pluralHumanName ?></h3>
    <table class="table table-striped table-hover">
        <thead>
            <tr>
<?php foreach ($fields as $field): ?>
                <th><CakePHPBakeOpenTag= $this->Paginator->sort('<?= $field ?>') CakePHPBakeCloseTag></th>
<?php endforeach; ?>
                <th class="actions"><CakePHPBakeOpenTag= __('Ações') CakePHPBakeCloseTag></th>
            </tr>
        </thead>
        <tbody>
            <CakePHPBakeOpenTagphp foreach ($<?= $pluralVar ?> as $<?= $singularVar ?>): CakePHPBakeCloseTag>
            <tr>
<?php        foreach ($fields as $field) {
            $isKey = false;
            if (!empty($associations['BelongsTo'])) {
                foreach ($associations['BelongsTo'] as $alias => $details) {
                    if ($field === $details['foreignKey']) {
                        $isKey = true;
?>
                <td><CakePHPBakeOpenTag= $<?= $singularVar ?>->has('<?= $details['property'] ?>') ? $this->Html->link($<?= $singularVar ?>-><?= $details['property'] ?>-><?= $details['displayField'] ?>, ['controller' => '<?= $details['controller'] ?>', 'action' => 'view', $<?= $singularVar ?>-><?= $details['property'] ?>-><?= $details['primaryKey'][0] ?>]) : '' CakePHPBakeCloseTag></td>
<?php
                        break;
                    }
                }
            }
            if ($isKey !== true) {
                if (!in_array($schema->columnType($field), ['integer', 'biginteger', 'decimal', 'float'])) {
?>
                <td><CakePHPBakeOpenTag= h($<?= $singularVar ?>-><?= $field ?>) CakePHPBakeCloseTag></td>
<?php
                } else {
?>
                <td><CakePHPBakeOpenTag= $this->Number->format($<?= $singularVar ?>-><?= $field ?>) CakePHPBakeCloseTag></td>
<?php
                }
            }
        }

        $pk = '$' . $singularVar . '->' . $primaryKey[0];
?>
                <td class="actions" style="white-space:nowrap">
                    <CakePHPBakeOpenTag= $this->Html->link(__(''), ['action' => 'view', <?= $pk ?>], ['class'=>'btn btn-primary btn-sm glyphicon glyphicon-search', 'title' => 'Ver']) CakePHPBakeCloseTag>
                    <CakePHPBakeOpenTag= $this->Html->link(__(''), ['action' => 'edit', <?= $pk ?>], ['class'=>'btn btn-success btn-sm glyphicon glyphicon-edit', 'title' => 'Editar']) CakePHPBakeCloseTag>
                    <CakePHPBakeOpenTag= $this->Form->postLink(__(''), ['action' => 'delete', <?= $pk ?>], ['confirm' => __('Tem certeza que deseja deletar # {0}?', <?= $pk ?>), 'class'=>'btn btn-danger btn-sm glyphicon glyphicon-trash', 'title' => 'Deletar']) CakePHPBakeCloseTag>
                </td>
            </tr>
            <CakePHPBakeOpenTagphp endforeach; CakePHPBakeCloseTag>
        </tbody>
    </table>
    <div class="paginator">
        <center>
            <ul class="pagination">
                <CakePHPBakeOpenTag= $this->Paginator->prev('&laquo; ' . __('anterior'), ['escape'=>false]) CakePHPBakeCloseTag>
                <CakePHPBakeOpenTag= $this->Paginator->numbers(['escape'=>false]) CakePHPBakeCloseTag>
                <CakePHPBakeOpenTag= $this->Paginator->next(__('proximo') . ' &raquo;', ['escape'=>false]) CakePHPBakeCloseTag>
            </ul>
        </div>
    </center>
</div>
</div>