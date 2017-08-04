<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Addresses Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Users
 *
 * @method \App\Model\Entity\Address get($primaryKey, $options = [])
 * @method \App\Model\Entity\Address newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Address[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Address|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Address patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Address[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Address findOrCreate($search, callable $callback = null)
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class AddressesTable extends Table
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

        $this->table('addresses');
        $this->displayField('id');
        $this->primaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Users', [
            'foreignKey' => 'user_id',
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

//        $validator
//            ->requirePresence('addresstype', 'create')
//            ->notEmpty('addresstype');
//
//        $validator
//            ->requirePresence('first_name', 'create')
//            ->notEmpty('first_name');
//
//        $validator
//            ->requirePresence('last_name', 'create')
//            ->notEmpty('last_name');
//
//        $validator
//            ->email('email')
//            ->requirePresence('email', 'create')
//            ->notEmpty('email');
//
//        $validator
//            ->requirePresence('phone', 'create')
//            ->notEmpty('phone');
//
//        $validator
//            ->requirePresence('address1', 'create')
//            ->notEmpty('address1');
//
//        $validator
//            ->requirePresence('address2', 'create')
//            ->notEmpty('address2');
//
//        $validator
//            ->requirePresence('city', 'create')
//            ->notEmpty('city');
//
//        $validator
//            ->requirePresence('state', 'create')
//            ->notEmpty('state');
//
//        $validator
//            ->requirePresence('zip', 'create')
//            ->notEmpty('zip');
//
//        $validator
//            ->requirePresence('country', 'create')
//            ->notEmpty('country');

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
//       / $rules->add($rules->isUnique(['addresstype']));
        $rules->add($rules->existsIn(['user_id'], 'Users'));
        return $rules;
    }
}
