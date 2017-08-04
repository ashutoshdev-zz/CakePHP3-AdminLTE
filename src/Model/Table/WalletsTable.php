<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Wallets Model
 *
 * @method \App\Model\Entity\Wallet get($primaryKey, $options = [])
 * @method \App\Model\Entity\Wallet newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Wallet[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Wallet|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Wallet patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Wallet[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Wallet findOrCreate($search, callable $callback = null)
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class WalletsTable extends Table
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

        $this->table('wallets');
        $this->displayField('id');
        $this->primaryKey('id');

        $this->addBehavior('Timestamp');
        
         $this->belongsTo('Users', [
            'foreignKey' => 'uid',
            'joinType' => 'INNER'
        ]);
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
            ->integer('id')
            ->allowEmpty('id', 'create');

        $validator
            ->integer('uid')
            ->requirePresence('uid', 'create')
            ->notEmpty('uid');

        $validator
            ->requirePresence('points', 'create')
            ->notEmpty('points');

        return $validator;
    }
}
