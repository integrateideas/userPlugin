<?php
namespace Integrateideas\User\Test\TestCase\Model\Table;

use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;
use Integrateideas\User\Model\Table\UserOldPasswordsTable;

/**
 * Integrateideas\User\Model\Table\UserOldPasswordsTable Test Case
 */
class UserOldPasswordsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \Integrateideas\User\Model\Table\UserOldPasswordsTable
     */
    public $UserOldPasswords;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'plugin.integrateideas/user.user_old_passwords',
        'plugin.integrateideas/user.users',
        'plugin.integrateideas/user.roles'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('UserOldPasswords') ? [] : ['className' => 'Integrateideas\User\Model\Table\UserOldPasswordsTable'];
        $this->UserOldPasswords = TableRegistry::get('UserOldPasswords', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->UserOldPasswords);

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
