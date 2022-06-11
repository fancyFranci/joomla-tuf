<?php
/**
 * Joomla! Content Management System
 *
 * @copyright  (C) 2022 Open Source Matters, Inc. <https://www.joomla.org>
 * @license    GNU General Public License version 2 or later; see LICENSE.txt
 */

namespace Joomla\CMS\Table;

\defined('JPATH_PLATFORM') or die;

/**
 * TUF map table
 *
 * @since  __DEPLOY_VERSION__
 */
class Tuf extends Table
{
	/**
	 * Constructor
	 *
	 * @param   \Joomla\Database\DatabaseDriver  $db  A database connector object
	 *
	 * @since   __DEPLOY_VERSION__
	 */
	public function __construct($db)
	{
		parent::__construct('#__tuf_metadata', 'id', $db);
	}

	/**
	 * Get targets_json for given extension
	 *
	 * @param   int     $extensionId
	 *
	 * @return  string  Result json of query
	 *
	 * @since   __DEPLOY_VERSION__
	 */
	public function getTargets($extensionId)
	{
		$query = $db->getQuery(true)
			->select($this->_db->quoteName('targets_json'))
			->from($this->_db->quoteName($this->_tbl))
			->where($db->quoteName('extension_id') . ' = :extension_id')
			->bind(':extension_id', $extensionId, ParameterType::INTEGER);
		$db->setQuery($query);

		return $db->loadObject()->targets_json;
	}

	/**
	 * When the validation fails, for example when one file is written but the others don't,
	 * we can roll back everything here
	 *
	 * @return  void
	 *
	 * @since   __DEPLOY_VERSION__
	 */
	public function removeMetadata()
	{
		$query = $db->getQuery(true)
			->delete($this->_db->quoteName($this->_tbl))
			->columns(['snapshot_json', 'targets_json', 'timestamp_json']);
		$db->setQuery($query);
	}
}
