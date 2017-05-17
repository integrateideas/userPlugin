<?php
namespace Integrateideas\User\Test\TestCase\Model\Table;

use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;
use Integrateideas\User\Model\Table\ResetPasswordHashesTable;

/**
 * Integrateideas\User\Model\Table\ResetPasswordHashesTable Test Case
 */
class ResetPasswordHashesTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \Integrateideas\User\Model\Table\ResetPasswordHashesTable
     */
    public $ResetPasswordHashes;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'plugin.integrateideas/user.reset_password_hashes',
        'plugin.integrateideas/user.users',
        'plugin.integrateideas/user.roles',
        'plugin.integrateideas/user.user_old_passwords'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('ResetPasswordHashes') ? [] : ['className' => 'Integrateideas\User\Model\Table\ResetPasswordHashesTable'];
        $this->ResetPasswordHashes = TableRegistry::get('ResetPasswordHashes', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->ResetPasswordHashes);

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
