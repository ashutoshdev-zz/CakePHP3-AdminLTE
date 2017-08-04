<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\UsePromocodesTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\UsePromocodesTable Test Case
 */
class UsePromocodesTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\UsePromocodesTable
     */
    public $UsePromocodes;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.use_promocodes'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('UsePromocodes') ? [] : ['className' => 'App\Model\Table\UsePromocodesTable'];
        $this->UsePromocodes = TableRegistry::get('UsePromocodes', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->UsePromocodes);

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
