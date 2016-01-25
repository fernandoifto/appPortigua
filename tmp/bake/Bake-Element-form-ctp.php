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
        return $schema->columnType($field) !== 'binary';
    });
?>
<nav class="col-md-2 columns" id="actions-sidebar">
    <ul class="nav nav-pills nav-stacked">
        <li><a class="list-group-item-info active glyphicon glyphicon-th-large"><CakePHPBakeOpenTag= __(' Ações') CakePHPBakeCloseTag></a></li>
        <CakePHPBakeOpenTag= $this->Html->link(__(' Listar'), ['action' => 'index'],['class' => 'list-group-item glyphicon glyphicon-th-list', 'title' => 'Listar']) CakePHPBakeCloseTag>
<?php if (strpos($action, 'add') === false): ?>
        <CakePHPBakeOpenTag= $this->Form->postLink(
                __(' Deletar'),
                ['action' => 'delete', $<?= $singularVar ?>-><?= $primaryKey[0] ?>],
                ['confirm' => __('Tem certeza que deseja deletar # {0}?', $<?= $singularVar ?>-><?= $primaryKey[0] ?>),
                    'class' => 'list-group-item glyphicon glyphicon-trash', 'title' => 'Listar']
            )
        CakePHPBakeCloseTag>
<?php endif; ?>
        
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
<div class="<?= $pluralVar ?> form col-md-10 columns content">
    <CakePHPBakeOpenTag= $this->Form->create($<?= $singularVar ?>) CakePHPBakeCloseTag>
    <fieldset>
        <legend><CakePHPBakeOpenTag= '<?= Inflector::humanize($action) ?> <?= $singularHumanName ?>' CakePHPBakeCloseTag></legend>
        <CakePHPBakeOpenTagphp
<?php
        foreach ($fields as $field) {
            if (in_array($field, $primaryKey)) {
                continue;
            }
            if (isset($keyFields[$field])) {
                $fieldData = $schema->column($field);
                if (!empty($fieldData['null'])) {
?>
            echo $this->Form->input('<?= $field ?>', ['options' => $<?= $keyFields[$field] ?>, 'empty' => true]);
<?php
                } else {
?>
            echo $this->Form->input('<?= $field ?>', ['options' => $<?= $keyFields[$field] ?>]);
<?php
                }
                continue;
            }
            if (!in_array($field, ['created', 'modified', 'updated'])) {
                $fieldData = $schema->column($field);
                if (($fieldData['type'] === 'date') && (!empty($fieldData['null']))) {
?>
            echo $this->Form->input('<?= $field ?>', ['empty' => true, 'default' => '']);
<?php
                } else {
?>
            echo $this->Form->input('<?= $field ?>');
<?php
                }
            }
        }
        if (!empty($associations['BelongsToMany'])) {
            foreach ($associations['BelongsToMany'] as $assocName => $assocData) {
?>
            echo $this->Form->input('<?= $assocData['property'] ?>._ids', ['options' => $<?= $assocData['variable'] ?>]);
<?php
            }
        }
?>
        CakePHPBakeCloseTag>
    </fieldset>
    <CakePHPBakeOpenTag= $this->Form->button(__(' Salvar'), ['class' => 'glyphicon glyphicon-floppy-save']) CakePHPBakeCloseTag>
    <CakePHPBakeOpenTag= $this->Form->end() CakePHPBakeCloseTag>
</div>
