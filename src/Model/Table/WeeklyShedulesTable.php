<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * WeeklyShedules Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Orders
 * @property \Cake\ORM\Association\BelongsTo $Products
 * @property \Cake\ORM\Association\BelongsTo $Alergies
 * @property \Cake\ORM\Association\BelongsTo $Cfoods
 *
 * @method \App\Model\Entity\WeeklyShedule get($primaryKey, $options = [])
 * @method \App\Model\Entity\WeeklyShedule newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\WeeklyShedule[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\WeeklyShedule|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\WeeklyShedule patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\WeeklyShedule[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\WeeklyShedule findOrCreate($search, callable $callback = null)
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class WeeklyShedulesTable extends Table
{
    
      public function initialize(array $config)
    {
        parent::initialize($config);
        $this->table('weekly_shedules');
        $this->addBehavior('Timestamp');
          $this->belongsTo('Products', [
            'foreignKey' => 'product_id'
        ]);
    }

}
