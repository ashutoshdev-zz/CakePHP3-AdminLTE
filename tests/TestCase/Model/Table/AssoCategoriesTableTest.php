<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\AssoCategoriesTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\AssoCategoriesTable Test Case
 */
class AssoCategoriesTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\AssoCategoriesTable
     */
    public $AssoCategories;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
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
        $config = TableRegistry::exists('AssoCategories') ? [] : ['className' => 'App\Model\Table\AssoCategoriesTable'];
        $this->AssoCategories = TableRegistry::get('AssoCategories', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->AssoCategories);

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
