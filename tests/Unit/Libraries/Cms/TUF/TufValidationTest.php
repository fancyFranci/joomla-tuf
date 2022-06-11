<?php
/**
 * @package        Joomla.UnitTest
 * @subpackage     TUF
 *
 * @copyright      (C) 2022 Open Source Matters, Inc. <https://www.joomla.org>
 * @license        GNU General Public License version 2 or later; see LICENSE.txt
 */

namespace Joomla\Tests\Unit\Libraries\Cms\TUF;

use Joomla\CMS\TUF\TufValidation;

/**
 * Test class for TufValidation.
 *
 * @since       __DEPLOY_VERSION__
 */
class TufValidationTest extends \PHPUnit\Framework\TestCase
{
	/**
	 * Tests the constructor
	 *
	 * @return  void
	 *
	 * @since   __DEPLOY_VERSION__
	 */
	public function testIsConstructable()
	{
		$this->assertInstanceOf(TufValidation::class, new TufValidation(77, []));
	}

	public function testGetValidUpdate()
	{
		$tufValidation = $this->createTufValidation([]);
		$this->assertEquals('', $tufValidation);
	}

	/**
	 * Helper function to create a toolbar
	 *
	 * @param   string  $params  array of configuration params
	 *
	 * @return  TufValidation
	 *
	 * @since   __DEPLOY_VERSION__
	 */
	protected function createTufValidation($params): TufValidation
	{
		return new TufValidation(77, $params);
	}
}
