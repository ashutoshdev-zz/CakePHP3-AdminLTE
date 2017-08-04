<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\AlergiesTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\AlergiesTable Test Case
 */
class AlergiesTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\AlergiesTable
     */
    public $Alergies;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.alergies',
        'app.products',
        'app.plans',
        'app.users',
        'app.staticpages',
        'app.days',
        'app.order_items',
        'app.orders'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('Alergies') ? [] : ['className' => 'App\Model\Table\AlergiesTable'];
        $this->Alergies = TableRegistry::get('Alergies', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Alergies);

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
