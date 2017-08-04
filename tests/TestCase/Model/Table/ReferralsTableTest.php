<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\ReferralsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\ReferralsTable Test Case
 */
class ReferralsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\ReferralsTable
     */
    public $Referrals;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.referrals'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('Referrals') ? [] : ['className' => 'App\Model\Table\ReferralsTable'];
        $this->Referrals = TableRegistry::get('Referrals', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Referrals);

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
}
