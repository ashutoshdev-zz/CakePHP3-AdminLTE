<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\SubscriptionPlansTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\SubscriptionPlansTable Test Case
 */
class SubscriptionPlansTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\SubscriptionPlansTable
     */
    public $SubscriptionPlans;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.subscription_plans',
        'app.subscription_types'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('SubscriptionPlans') ? [] : ['className' => 'App\Model\Table\SubscriptionPlansTable'];
        $this->SubscriptionPlans = TableRegistry::get('SubscriptionPlans', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->SubscriptionPlans);

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
