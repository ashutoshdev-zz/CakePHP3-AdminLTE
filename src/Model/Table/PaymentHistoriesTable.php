<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * PaymentHistories Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Carts
 * @property \Cake\ORM\Association\BelongsTo $Checksums
 * @property \Cake\ORM\Association\BelongsTo $Txns
 *
 * @method \App\Model\Entity\PaymentHistory get($primaryKey, $options = [])
 * @method \App\Model\Entity\PaymentHistory newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\PaymentHistory[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\PaymentHistory|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\PaymentHistory patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\PaymentHistory[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\PaymentHistory findOrCreate($search, callable $callback = null)
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class PaymentHistoriesTable extends Table
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

        $this->table('payment_histories');
        $this->displayField('id');
        $this->primaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Carts', [
            'foreignKey' => 'cart_id',
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
//            ->integer('uid')
//            ->requirePresence('uid', 'create')
//            ->notEmpty('uid');
//
//        $validator
//            ->requirePresence('amt', 'create')
//            ->notEmpty('amt');
//
//        $validator
//            ->integer('status')
//            ->requirePresence('status', 'create')
//            ->notEmpty('status');

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
        $rules->add($rules->existsIn(['cart_id'], 'Carts'));
       // $rules->add($rules->existsIn(['checksum_id'], 'Checksums'));
       // $rules->add($rules->existsIn(['txn_id'], 'Txns'));

        return $rules;
    }
}
