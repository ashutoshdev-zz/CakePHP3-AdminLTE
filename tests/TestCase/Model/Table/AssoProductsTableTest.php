<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\AssoProductsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\AssoProductsTable Test Case
 */
class AssoProductsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\AssoProductsTable
     */
    public $AssoProducts;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.asso_products',
        'app.asso_categories'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('AssoProducts') ? [] : ['className' => 'App\Model\Table\AssoProductsTable'];
        $this->AssoProducts = TableRegistry::get('AssoProducts', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->AssoProducts);

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
