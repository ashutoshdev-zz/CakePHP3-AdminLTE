<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Orders Model
 *
 * @property \Cake\ORM\Association\HasMany $OrderItems
 *
 * @method \App\Model\Entity\Order get($primaryKey, $options = [])
 * @method \App\Model\Entity\Order newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Order[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Order|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Order patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Order[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Order findOrCreate($search, callable $callback = null)
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class OrdersTable extends Table
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
        $this->table('orders');
        $this->displayField('id');
        $this->primaryKey('id');
        $this->addBehavior('Timestamp');
        $this->hasMany('OrderItems', [
            'foreignKey' => 'order_id'
        ]);
        $this->hasMany('WeeklyShedules', [
            'foreignKey' => 'order_id'
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
//
//        $validator
//            ->integer('order_item_count')
//            ->allowEmpty('order_item_count');
//
//        $validator
//            ->integer('subscription_plan_type')
//            ->allowEmpty('subscription_plan_type');
//
//        $validator
//            ->integer('status')
//            ->allowEmpty('status');
//
//        $validator
//            ->allowEmpty('ip_address');
//
//        $validator
//            ->requirePresence('notes', 'create')
//            ->notEmpty('notes');

        $validator
            ->integer('delivery_status')
            ->requirePresence('delivery_status', 'create')
            ->notEmpty('delivery_status');

        return $validator;
    }
}
