<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\PaymentHistoriesTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\PaymentHistoriesTable Test Case
 */
class PaymentHistoriesTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\PaymentHistoriesTable
     */
    public $PaymentHistories;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.payment_histories',
        'app.carts',
        'app.subscription_plans',
        'app.subscription_types',
        'app.products',
        'app.users',
        'app.staticpages',
        'app.alergies',
        'app.days',
        'app.categories',
        'app.subcategories',
        'app.asso_products',
        'app.asso_categories',
        'app.order_items',
        'app.orders',
        'app.checksums',
        'app.txns'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('PaymentHistories') ? [] : ['className' => 'App\Model\Table\PaymentHistoriesTable'];
        $this->PaymentHistories = TableRegistry::get('PaymentHistories', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->PaymentHistories);

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
