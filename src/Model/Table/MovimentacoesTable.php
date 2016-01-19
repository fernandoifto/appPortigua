<?php
namespace App\Model\Table;

use App\Model\Entity\Movimentaco;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Movimentacoes Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Tipos
 * @property \Cake\ORM\Association\BelongsTo $Users
 */
class MovimentacoesTable extends Table
{
    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config)
    {
        parent::initialize($config);

        $this->table('movimentacoes');
        $this->displayField('id');
        $this->primaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Tipos', [
            'foreignKey' => 'tipos_id',
            'propertyName' => 'tipo',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('Users', [
            'foreignKey' => 'users_id',
            'propertyName' => 'user',
            'joinType' => 'INNER'
        ]);
        
        /*
         * 
         $this->belongsTo('Authors', [
            'className' => 'Publishing.Authors',
            'foreignKey' => 'authorid',
            'propertyName' => 'person'
        ]);
         * 
        $this->belongsTo('Tipos', [
            'foreignKey' => 'tipos_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('Users', [
            'foreignKey' => 'users_id',
            'joinType' => 'INNER'
        ]);
         */
    }
    

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator)
    {
        $validator
            ->add('id', 'valid', ['rule' => 'numeric'])
            ->allowEmpty('id', 'create');

        $validator
            ->add('ticket', 'valid', ['rule' => 'numeric'])
            ->requirePresence('ticket', 'create')
            ->notEmpty('ticket')
            ->add('ticket', 'unique', ['rule' => 'validateUnique', 'provider' => 'table']);

        $validator
            ->add('valor', 'valid', ['rule' => 'decimal'])
            ->requirePresence('valor', 'create')
            ->notEmpty('valor');

        $validator
            ->allowEmpty('observacao');

        return $validator;
    }

    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    public function buildRules(RulesChecker $rules)
    {
        $rules->add($rules->existsIn(['tipos_id'], 'Tipos'));
        $rules->add($rules->existsIn(['users_id'], 'Users'));
        return $rules;
    }
    
}
