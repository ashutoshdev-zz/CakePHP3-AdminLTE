<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Products Model
 *
 * @property \Cake\ORM\Association\BelongsTo $SubscriptionPlans
 * @property \Cake\ORM\Association\BelongsTo $Users
 * @property \Cake\ORM\Association\BelongsTo $Alergies
 * @property \Cake\ORM\Association\BelongsTo $Days
 * @property \Cake\ORM\Association\BelongsTo $Categories
 * @property \Cake\ORM\Association\BelongsTo $Subcategories
 * @property \Cake\ORM\Association\HasMany $OrderItems
 *
 * @method \App\Model\Entity\Product get($primaryKey, $options = [])
 * @method \App\Model\Entity\Product newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Product[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Product|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Product patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Product[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Product findOrCreate($search, callable $callback = null)
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class ProductsTable extends Table
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

        $this->table('products');
        $this->displayField('name');
        $this->primaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('SubscriptionPlans', [
            'foreignKey' => 'subscription_plan_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('Users', [
            'foreignKey' => 'user_id',
            'conditions' => ['Users.role' =>'vendor'],
            'joinType' => 'INNER'
            
        ]);
        $this->belongsTo('Alergies', [
            'foreignKey' => 'alergy_id',
            'joinType' => 'INNER'
        ]);
        
        $this->belongsTo('Days', [
            'foreignKey' => 'day_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('Categories', [
            'foreignKey' => 'category_id',
            'joinType' => 'INNER'
        ]);
//        $this->belongsTo('Subcategories', [
//            'foreignKey' => 'subcategory_id',
//            'joinType' => 'INNER'
//        ]);
   
        $this->belongsTo('AssoProducts', [
            'foreignKey' => 'assopro_id',
            'joinType' => 'INNER'
        ]);
             $this->hasMany('OrderItems', [
            'foreignKey' => 'product_id'
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
//            ->requirePresence('name', 'create')
//            ->notEmpty('name');
//
//        $validator
//            ->requirePresence('description', 'create')
//            ->notEmpty('description');
//
//        $validator
//            ->requirePresence('image', 'create')
//            ->notEmpty('image');
//
//        $validator
//            ->requirePresence('available_quantity', 'create')
//            ->notEmpty('available_quantity');

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
        $rules->add($rules->existsIn(['subscription_plan_id'], 'SubscriptionPlans'));
        $rules->add($rules->existsIn(['user_id'], 'Users'));
        //$rules->add($rules->existsIn(['alergy_id'], 'Alergies'));
        $rules->add($rules->existsIn(['day_id'], 'Days'));
        $rules->add($rules->existsIn(['category_id'], 'Categories'));
       // $rules->add($rules->existsIn(['subcategory_id'], 'Subcategories'));
        return $rules;
    }
}
