<?php
namespace App\Test\TestCase\Controller;

use App\Controller\WeeklyShedulesController;
use Cake\TestSuite\IntegrationTestCase;

/**
 * App\Controller\WeeklyShedulesController Test Case
 */
class WeeklyShedulesControllerTest extends IntegrationTestCase
{

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.weekly_shedules',
        'app.orders',
        'app.order_items',
        'app.products',
        'app.subscription_plans',
        'app.subscription_types',
        'app.users',
        'app.staticpages',
        'app.alergies',
        'app.days',
        'app.categories',
        'app.subcategories',
        'app.asso_products',
        'app.asso_categories',
        'app.cfoods'
    ];

    /**
     * Test index method
     *
     * @return void
     */
    public function testIndex()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test view method
     *
     * @return void
     */
    public function testView()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test add method
     *
     * @return void
     */
    public function testAdd()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test edit method
     *
     * @return void
     */
    public function testEdit()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test delete method
     *
     * @return void
     */
    public function testDelete()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
