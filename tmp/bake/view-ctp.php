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

$associations += ['BelongsTo' => [], 'HasOne' => [], 'HasMany' => [], 'BelongsToMany' => []];
$immediateAssociations = $associations['BelongsTo'] + $associations['HasOne'];
$associationFields = collection($fields)
    ->map(function($field) use ($immediateAssociations) {
        foreach ($immediateAssociations as $alias => $details) {
            if ($field === $details['foreignKey']) {
                return [$field => $details];
            }
        }
    })
    ->filter()
    ->reduce(function($fields, $value) {
        return $fields + $value;
    }, []);

$groupedFields = collection($fields)
    ->filter(function($field) use ($schema) {
        return $schema->columnType($field) !== 'binary';
    })
    ->groupBy(function($field) use ($schema, $associationFields) {
        $type = $schema->columnType($field);
        if (isset($associationFields[$field])) {
            return 'string';
        }
        if (in_array($type, ['integer', 'float', 'decimal', 'biginteger'])) {
            return 'number';
        }
        if (in_array($type, ['date', 'time', 'datetime', 'timestamp'])) {
            return 'date';
        }
        return in_array($type, ['text', 'boolean']) ? $type : 'string';
    })
    ->toArray();

$groupedFields += ['number' => [], 'string' => [], 'boolean' => [], 'date' => [], 'text' => []];
$pk = "\$$singularVar->{$primaryKey[0]}";
?>
<nav class="col-lg-2 col-md-3">
    <ul class="nav nav-pills nav-stacked">
        <li><a class="list-group-item-info active glyphicon glyphicon-th-large"><CakePHPBakeOpenTag= __(' Ações') CakePHPBakeCloseTag></a></li>
        <CakePHPBakeOpenTag= $this->Html->link(__(' Listar'), ['action' => 'index'],['class' => 'list-group-item glyphicon glyphicon-th-list', 'title' => 'Listar']) CakePHPBakeCloseTag>
        <CakePHPBakeOpenTag= $this->Html->link(__(' Novo'), ['action' => 'add'],['class' => 'list-group-item glyphicon glyphicon-plus', 'title' => 'Novo']) CakePHPBakeCloseTag>
        <CakePHPBakeOpenTag= $this->Html->link(__(' Editar'), ['action' => 'edit', <?= $pk ?>], ['class' => 'list-group-item glyphicon glyphicon-edit', 'title' => 'Editar']) CakePHPBakeCloseTag>
        <CakePHPBakeOpenTag= $this->Form->postLink(__(' Deletar'), ['action' => 'delete', <?= $pk ?>], ['confirm' => __('Tem certeza que deseja deletar # {0}?', <?= $pk ?>),
                                    'class' => 'list-group-item glyphicon glyphicon-trash', 'title' => 'Deletar']) CakePHPBakeCloseTag>
<?php
    $done = [];
    foreach ($associations as $type => $data) {
        foreach ($data as $alias => $details) {
            if ($details['controller'] !== $this->name && !in_array($details['controller'], $done)) {
?>

<?php
                $done[] = $details['controller'];
            }
        }
    }
?>
    </ul>
</nav>
<div class="<?= $pluralVar ?> view col-lg-10 col-md-9">
    <h3><CakePHPBakeOpenTag= h($<?= $singularVar ?>-><?= $displayField ?>) CakePHPBakeCloseTag></h3>
    <table class="table table-striped table-hover">
<?php if ($groupedFields['string']) : ?>
<?php foreach ($groupedFields['string'] as $field) : ?>
<?php if (isset($associationFields[$field])) :
            $details = $associationFields[$field];
?>
        <tr>
            <th><?= Inflector::humanize($details['property']) ?></th>
            <td><CakePHPBakeOpenTag= $<?= $singularVar ?>->has('<?= $details['property'] ?>') ? $this->Html->link($<?= $singularVar ?>-><?= $details['property'] ?>-><?= $details['displayField'] ?>, ['controller' => '<?= $details['controller'] ?>', 'action' => 'view', $<?= $singularVar ?>-><?= $details['property'] ?>-><?= $details['primaryKey'][0] ?>]) : '' CakePHPBakeCloseTag></td>
        </tr>
<?php else : ?>
        <tr>
            <th><?= Inflector::humanize($field) ?></th>
            <td><CakePHPBakeOpenTag= h($<?= $singularVar ?>-><?= $field ?>) CakePHPBakeCloseTag></td>
        </tr>
<?php endif; ?>
<?php endforeach; ?>
<?php endif; ?>
<?php if ($groupedFields['number']) : ?>
<?php foreach ($groupedFields['number'] as $field) : ?>
        <tr>
            <th>'<?= Inflector::humanize($field) ?></th>
            <td><CakePHPBakeOpenTag= $this->Number->format($<?= $singularVar ?>-><?= $field ?>) CakePHPBakeCloseTag></td>
        </tr>
<?php endforeach; ?>
<?php endif; ?>
<?php if ($groupedFields['date']) : ?>
<?php foreach ($groupedFields['date'] as $field) : ?>
        <tr>
            <th><?= Inflector::humanize($field) ?></th>
            <td><CakePHPBakeOpenTag= h($<?= $singularVar ?>-><?= $field ?>) CakePHPBakeCloseTag></tr>
        </tr>
<?php endforeach; ?>
<?php endif; ?>
<?php if ($groupedFields['boolean']) : ?>
<?php foreach ($groupedFields['boolean'] as $field) : ?>
        <tr>
            <th><?= Inflector::humanize($field) ?></th>
            <td><CakePHPBakeOpenTag= $<?= $singularVar ?>-><?= $field ?> ? __('Yes') : __('No'); CakePHPBakeCloseTag></td>
         </tr>
<?php endforeach; ?>
<?php endif; ?>
    </table>
<?php if ($groupedFields['text']) : ?>
<?php foreach ($groupedFields['text'] as $field) : ?>
    <div class="row">
        <h4><?= Inflector::humanize($field) ?></h4>
        <CakePHPBakeOpenTag= $this->Text->autoParagraph(h($<?= $singularVar ?>-><?= $field ?>)); CakePHPBakeCloseTag>
    </div>
<?php endforeach; ?>
<?php endif; ?>
<?php
$relations = $associations['HasMany'] + $associations['BelongsToMany'];
foreach ($relations as $alias => $details):
    $otherSingularVar = Inflector::variable($alias);
    $otherPluralHumanName = Inflector::humanize(Inflector::underscore($details['controller']));
    ?>
    <div class="related table-responsive">
        <h4><CakePHPBakeOpenTag= __('{0}', ['<?= $otherPluralHumanName ?> relacionados ']) CakePHPBakeCloseTag></h4>
        <CakePHPBakeOpenTagphp if (!empty($<?= $singularVar ?>-><?= $details['property'] ?>)): CakePHPBakeCloseTag>
        <table class="table table-striped table-hover">
            <tr>
<?php foreach ($details['fields'] as $field): ?>
                <th><?= Inflector::humanize($field) ?></th>
<?php endforeach; ?>
                <th class="actions"><CakePHPBakeOpenTag= __('Ações') CakePHPBakeCloseTag></th>
            </tr>
            <CakePHPBakeOpenTagphp foreach ($<?= $singularVar ?>-><?= $details['property'] ?> as $<?= $otherSingularVar ?>): CakePHPBakeCloseTag>
            <tr>
<?php foreach ($details['fields'] as $field): ?>
                <td><CakePHPBakeOpenTag= h($<?= $otherSingularVar ?>-><?= $field ?>) CakePHPBakeCloseTag></td>
<?php endforeach; ?>
<?php $otherPk = "\${$otherSingularVar}->{$details['primaryKey'][0]}"; ?>
                <td class="actions">
                    <CakePHPBakeOpenTag= $this->Html->link(__(''), ['controller' => '<?= $details['controller'] ?>', 'action' => 'view', <?= $otherPk ?>], ['class'=>'btn btn-primary btn-sm glyphicon glyphicon-search', 'title' => 'Ver']) ?>

                    <CakePHPBakeOpenTag= $this->Html->link(__(''), ['controller' => '<?= $details['controller'] ?>', 'action' => 'edit', <?= $otherPk ?>], ['class'=>'btn btn-success btn-sm glyphicon glyphicon-edit', 'title' => 'Editar']) ?>

                    <CakePHPBakeOpenTag= $this->Form->postLink(__(''), ['controller' => '<?= $details['controller'] ?>', 'action' => 'delete', <?= $otherPk ?>], ['confirm' => __('Tem certeza que deseja Deletar # {0}?', <?= $otherPk ?>), 'class'=>'btn btn-danger btn-sm glyphicon glyphicon-trash', 'title' => 'Deletar']) ?>

                </td>
            </tr>
            <CakePHPBakeOpenTagphp endforeach; CakePHPBakeCloseTag>
        </table>
    <CakePHPBakeOpenTagphp endif; CakePHPBakeCloseTag>
    </div>
<?php endforeach; ?>
</div>
<br>