<?php
/**
 * @package        Joomla.UnitTest
 * @subpackage     TUF
 *
 * @copyright      (C) 2022 Open Source Matters, Inc. <https://www.joomla.org>
 * @license        GNU General Public License version 2 or later; see LICENSE.txt
 */

namespace Joomla\Tests\Unit\Libraries\Cms\TUF;

use Joomla\CMS\TUF\DatabaseStorage;
use Joomla\CMS\TUF\Exception\RoleNotFoundException;
use Joomla\Tests\Integration\DBTestInterface;
use Joomla\Tests\Integration\DBTestTrait;
use Joomla\Tests\Integration\IntegrationTestCase;

/**
 * DatabaseStorageTest
 *
 * @since  __DEPLOY_VERSION__
 */
class DatabaseStorageTest extends IntegrationTestCase implements DBTestInterface
{
	use DBTestTrait;

	/**
	 * @var    DatabaseStorage
	 * @since  __DEPLOY_VERSION__
	 */
	protected $databaseStorage;

	/**
	 * Sets up the test by instantiating DatabaseStorage
	 * This method is called before a test is executed.
	 *
	 * @return  void
	 * @since   __DEPLOY_VERSION__
	 */
	protected function setUp(): void
	{
		parent::setUp();

		$this->databaseStorage = new DatabaseStorage($this->getDBDriver(), 69);
	}

	/**
	 * Retrieve a list of schemas to load for this testcase
	 *
	 * @return  array
	 * @since   __DEPLOY_VERSION__
	 */
	public function getSchemasToLoad(): array
	{
		return ['testtufmetadata.sql'];
	}

	/**
	 * This method is called after a test is executed.
	 *
	 * @return  void
	 * @since   __DEPLOY_VERSION__
	 */
	protected function tearDown(): void
	{
		unset($this->databaseStorage);

		parent::tearDown();
	}

	/**
	 * @testdox  DatabaseStorage->offsetExists() returns false
	 *
	 * @return  void
	 * @since   __DEPLOY_VERSION__
	 */
	public function testOffsetExistsToBeFalse(): void
	{
		$this->assertFalse($this->databaseStorage->offsetExists(''));
		$this->assertFalse($this->databaseStorage->offsetExists('bla.json'));
		$this->assertFalse($this->databaseStorage->offsetExists('bla.jsoon'));
		$this->assertFalse($this->databaseStorage->offsetExists('bla_json'));
	}

	/**
	 * @testdox  DatabaseStorage->offsetExists() returns true
	 *
	 * @return  void
	 * @since   __DEPLOY_VERSION__
	 */
	public function testOffsetExistsToBeTrue(): void
	{
		$this->assertTrue($this->databaseStorage->offsetExists('root.json'));
		$this->assertTrue($this->databaseStorage->offsetExists('snapshot.json'));
		$this->assertTrue($this->databaseStorage->offsetExists('target.json'));
		$this->assertTrue($this->databaseStorage->offsetExists('timestamp.json'));
	}

	/**
	 * Tests the DatabaseStorage->offsetGet method with an invalid role name.
	 *
	 * @return  void
	 * @since   __DEPLOY_VERSION__
	 */
	public function testOffsetGetWithInvalidName(): void
	{
		$this->expectException(RoleNotFoundException::class);
		$this->databaseStorage->offsetGet('My.wrong.name');
	}

	/**
	 * Tests the DatabaseStorage->offsetSet method with an invalid role name.
	 *
	 * @return  void
	 * @since   __DEPLOY_VERSION__
	 */
	public function testOffsetSetWithInvalidName(): void
	{
		$this->expectException(RoleNotFoundException::class);
		$this->databaseStorage->offsetSet('My.wrong.name', '#key');
	}

	/**
	 * Tests the DatabaseStorage->offsetUnset method with an invalid role name.
	 *
	 * @return  void
	 * @since   __DEPLOY_VERSION__
	 */
	public function testOffsetUnsetWithInvalidName(): void
	{
		$this->expectException(RoleNotFoundException::class);
		$this->databaseStorage->offsetUnset('My.wrong.name');
	}
}
