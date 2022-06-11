<?php
/**
 * @package        Joomla.UnitTest
 * @subpackage     TUF
 *
 * @copyright      (C) 2022 Open Source Matters, Inc. <https://www.joomla.org>
 * @license        GNU General Public License version 2 or later; see LICENSE.txt
 */
namespace Joomla\Tests\Unit\Libraries\Cms\Table;

use Joomla\CMS\Table\Tuf;
use Joomla\Tests\Integration\DBTestInterface;
use Joomla\Tests\Integration\DBTestTrait;
use Joomla\Tests\Integration\IntegrationTestCase;

/**
 * TufTest
 *
 * @since  __DEPLOY_VERSION__
 */
class TufTest extends IntegrationTestCase implements DBTestInterface
{
	use DBTestTrait;

	/**
	 * @var    Tuf
	 * @since  __DEPLOY_VERSION__
	 */
	protected $tuf;

	/**
	 * Sets up the test by instantiating Tuf
	 * This method is called before a test is executed.
	 *
	 * @return  void
	 * @since   __DEPLOY_VERSION__
	 */
	protected function setUp(): void
	{
		parent::setUp();

		$this->tuf = new Tuf($this->getDBDriver());
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
		unset($this->tuf);

		parent::tearDown();
	}

	/**
	 * Test that the table object has attributes equal to the columns of the table
	 *
	 * @return  void
	 * @since   __DEPLOY_VERSION__
	 */
	public function testTableHasAttributesFromTable()
	{
		$fields = [
			'id',
			'extension_id',
			'root_json',
			'snapshot_json',
			'targets_json',
			'timestamp_json',
			'mirrors_json',
		];

		$this->assertEquals(
			$fields,
			array_keys($this->tuf->getFields())
		);
	}

	/**
	 * Test if getTargets returns targets
	 *
	 * @return  void
	 * @since   __DEPLOY_VERSION__
	 */
	public function testGetTargets()
	{
		$this->assertEquals(`{thing-x: "hello I'm a #key"}`, $this->tuf->getTargets(77));
	}

	/**
	 * Test if removeMetadata sets targets_json to null
	 *
	 * @return  void
	 * @since   __DEPLOY_VERSION__
	 */
	public function testRemoveMetadata()
	{
		$this->tuf->removeMetadata();
		$this->assertNull($this->tuf->getTargets(77));
	}
}
