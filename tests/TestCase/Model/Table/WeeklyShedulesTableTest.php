<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\WeeklyShedulesTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\WeeklyShedulesTable Test Case
 */
class WeeklyShedulesTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\WeeklyShedulesTable
     */
    public $WeeklyShedules;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.weekly_shedules',
        'app.orders',
        'app.order_items',
        'app.products',
        'app.subscription_plans',
        'app.subscription_types',
        'app.users',
        'app.staticpages',
        'app.alergies',
        'app.days',
        'app.categories',
        'app.subcategories',
        'app.asso_products',
        'app.asso_categories',
        'app.cfoods'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('WeeklyShedules') ? [] : ['className' => 'App\Model\Table\WeeklyShedulesTable'];
        $this->WeeklyShedules = TableRegistry::get('WeeklyShedules', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->WeeklyShedules);

        parent::tearDown();
    }

    /**
     * Test initialize method
     *
     * @return void
     */
    public function testInitialize()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test validationDefault method
     *
     * @return void
     */
    public function testValidationDefault()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test buildRules method
     *
     * @return void
     */
    public function testBuildRules()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
