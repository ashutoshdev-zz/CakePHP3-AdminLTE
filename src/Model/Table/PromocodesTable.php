<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Promocodes Model
 *
 * @method \App\Model\Entity\Promocode get($primaryKey, $options = [])
 * @method \App\Model\Entity\Promocode newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Promocode[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Promocode|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Promocode patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Promocode[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Promocode findOrCreate($search, callable $callback = null)
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class PromocodesTable extends Table
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

        $this->table('promocodes');
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
            ->requirePresence('pcode', 'create')
            ->notEmpty('pcode');

        $validator
            ->requirePresence('peruser', 'create')
            ->notEmpty('peruser');

        $validator
            ->requirePresence('totalusage', 'create')
            ->notEmpty('totalusage');

        $validator
            ->integer('percent')
            ->requirePresence('percent', 'create')
            ->notEmpty('percent');

        $validator
            ->integer('status')
            ->requirePresence('status', 'create')
            ->notEmpty('status');

        return $validator;
    }
}
