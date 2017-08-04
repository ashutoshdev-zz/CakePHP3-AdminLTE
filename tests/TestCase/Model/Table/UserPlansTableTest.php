<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\UserPlansTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\UserPlansTable Test Case
 */
class UserPlansTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\UserPlansTable
     */
    public $UserPlans;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.user_plans'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('UserPlans') ? [] : ['className' => 'App\Model\Table\UserPlansTable'];
        $this->UserPlans = TableRegistry::get('UserPlans', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->UserPlans);

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
}
