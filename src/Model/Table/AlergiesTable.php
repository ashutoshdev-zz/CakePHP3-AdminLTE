<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Alergies Model
 *
 * @property \Cake\ORM\Association\HasMany $Products
 *
 * @method \App\Model\Entity\Alergy get($primaryKey, $options = [])
 * @method \App\Model\Entity\Alergy newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Alergy[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Alergy|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Alergy patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Alergy[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Alergy findOrCreate($search, callable $callback = null)
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class AlergiesTable extends Table
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

        $this->table('alergies');
        $this->displayField('name');
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
            ->requirePresence('name', 'create')
            ->notEmpty('name');

        $validator
            ->requirePresence('about', 'create')
            ->notEmpty('about');

        return $validator;
    }
}
