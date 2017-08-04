<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Referrals Model
 *
 * @method \App\Model\Entity\Referral get($primaryKey, $options = [])
 * @method \App\Model\Entity\Referral newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Referral[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Referral|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Referral patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Referral[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Referral findOrCreate($search, callable $callback = null)
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class ReferralsTable extends Table
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

        $this->table('referrals');
        $this->displayField('id');
        $this->primaryKey('id');

        $this->addBehavior('Timestamp');
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
            ->requirePresence('refferby', 'create')
            ->notEmpty('refferby');

        $validator
            ->requirePresence('refferto', 'create')
            ->notEmpty('refferto');

        return $validator;
    }
}
