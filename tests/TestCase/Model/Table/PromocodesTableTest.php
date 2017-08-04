<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\PromocodesTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\PromocodesTable Test Case
 */
class PromocodesTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\PromocodesTable
     */
    public $Promocodes;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.promocodes'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('Promocodes') ? [] : ['className' => 'App\Model\Table\PromocodesTable'];
        $this->Promocodes = TableRegistry::get('Promocodes', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Promocodes);

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
