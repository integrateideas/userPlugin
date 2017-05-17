<?php
namespace Integrateideas\User\Test\TestCase\Controller\Component;

use Cake\Controller\ComponentRegistry;
use Cake\TestSuite\TestCase;
use Integrateideas\User\Controller\Component\EventsComponent;

/**
 * Integrateideas\User\Controller\Component\EventsComponent Test Case
 */
class EventsComponentTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \Integrateideas\User\Controller\Component\EventsComponent
     */
    public $Events;

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $registry = new ComponentRegistry();
        $this->Events = new EventsComponent($registry);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Events);

        parent::tearDown();
    }

    /**
     * Test initial setup
     *
     * @return void
     */
    public function testInitialization()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
