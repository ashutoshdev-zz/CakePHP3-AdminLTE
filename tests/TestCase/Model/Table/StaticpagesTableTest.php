<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\StaticpagesTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\StaticpagesTable Test Case
 */
class StaticpagesTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\StaticpagesTable
     */
    public $Staticpages;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.staticpages',
        'app.users'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('Staticpages') ? [] : ['className' => 'App\Model\Table\StaticpagesTable'];
        $this->Staticpages = TableRegistry::get('Staticpages', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Staticpages);

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
