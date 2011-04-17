<?php
/**
 * Media Table for mediagalleries Component 
 * @package		Joomla
 * @subpackage	mediagalleries Suite
 * @license	GNU/GPL, see LICENSE.php
 * @link http://3den.org
 */

// no direct access
defined('_JEXEC') or die('Restricted access');

/**
* Media Table class
*
* @package		Joomla
* @subpackage	Media
* @since 1.0
*/
class TableMedia extends JTable
{	
	/**
	 * Constructor
	 *
	 * @param object Database connector object
	 * @since 1.0
	 */
	function __construct(& $db) {
			parent::__construct('#__mediagalleries', 'id', $db);	
	}

	/**
	 * Overloaded check method to ensure data integrity
	 *
	 * @access public
	 * @return boolean True on success
	 * @since 1.0
	 */
	function check(){ 
		// check for valid name 
		if (trim($this->title) == '') {
			$this->setError('COM_MEDIAGALLERIES_MUST_CONTAIN_A_TITLE');
			return false;
		}

		// check for valid name 
		if( empty($this->catid) ) {
			$this->setError('COM_MEDIAGALLERIES_MUST_CONTAIN_A_TITLE');
			return false;
		}
		
		// check for valid url		
		/*
		if ( !(	strpos('http://',$this->url)|| strpos( $this->url, 'https://')) )
		{
			$this->setError('COM_MEDIAGALLERIES_INVALID_URL');
			return false;
		}
		*/
						
		return true;
	}
	
	
	/**
	 * Overloaded blindmethod
	 * 
	 * @todo improvements 
	 * @param array
	 * @return boolean	True on success
	 */
	function bind($data){
	
		if (isset($data['params']) && is_array($data['params'])) {
			$registry = new JRegistry();
			$registry->loadArray($data['params']);
			$data['params'] = (string)$registry;
		}
		
		//Fix uid
		
		//if(empty($data['userid'])){
			$user			=& JFactory::getUser();
			$data['userid']	= $user->get('id');
		//} Just removed the condition so that the right author is saved
		
		// Fix alias
		if(!$data['alias'])
		{
			$data['alias']=$data['title'];	
		}		
		$data['alias'] = JFilterOutput::stringURLSafe($data['alias']);
		$data['media']=$data['url'];
		//To be reviewed later
		$data['thumb_url']="google.com";		
		if(!$data['created_by'])
		{
			$user=JFactory::getUser();
			$data['created_by']=$user->id;
			
		}
		if(!$data['created'])
		{
			$data['created']=JFactory::getDate();
		}
		
		if(!$data['created_by_alias'])
		{
			$user=JFactory::getUser();
			$data['created_by']=$user->id;
		}

		$datenow =& JFactory::getDate($data['created']);
		$data['created'] = $datenow->toMySQL();
		
		// bind
 		return parent::bind($data);
 		
	}


	/**
	 * Method to set the publishing state for a row or list of rows in the database
	 * table.  The method respects checked out rows by other users and will attempt
	 * to checkin rows that it can after adjustments are made.
	 *
	 * @param	mixed	An optional array of primary key values to update.  If not
	 *					set the instance property value is used.
	 * @param	integer The publishing state. eg. [0 = unpublished, 1 = published]
	 * @param	integer The user id of the user performing the operation.
	 * @return	boolean	True on success.
	 * @since	1.0.4
	 */
	public function publish($pks = null, $state = 1, $userId = 0)
	{
		// Initialise variables.
		$k = $this->_tbl_key;

		// Sanitize input.
		JArrayHelper::toInteger($pks);
		$userId = (int) $userId;
		$state  = (int) $state;

		// If there are no primary keys set check to see if the instance key is set.
		if (empty($pks))
		{
			if ($this->$k) {
				$pks = array($this->$k);
			}
			// Nothing to set publishing state on, return false.
			else {
				$this->setError(JText::_('JLIB_DATABASE_ERROR_NO_ROWS_SELECTED'));
				return false;
			}
		}
		   

		// Build the WHERE clause for the primary keys.
		$where = $k.'='.implode(' OR '.$k.'=', $pks);

		// Determine if there is checkin support for the table.
		if (!property_exists($this, 'checked_out') || !property_exists($this, 'checked_out_time')) {
			$checkin = '';
		}
		else {
			$checkin = ' AND (checked_out = 0 OR checked_out = '.(int) $userId.')';
		}

		// Update the publishing state for rows with the given primary keys.
		$this->_db->setQuery(
			'UPDATE `'.$this->_tbl.'`' .
			' SET `state` = '.(int) $state .
			' WHERE ('.$where.')' .
			$checkin
		);
		$this->_db->query();

		// Check for a database error.
		if ($this->_db->getErrorNum()) {
			$this->setError($this->_db->getErrorMsg());
			return false;
		}

		// If checkin is supported and all rows were adjusted, check them in.
		if ($checkin && (count($pks) == $this->_db->getAffectedRows()))
		{
			// Checkin the rows.
			foreach($pks as $pk)
			{
				$this->checkin($pk);
			}
		}

		// If the JTable instance value is in the list of primary keys that were set, set the instance.
		if (in_array($this->$k, $pks)) {
			$this->state = $state;
		}

		$this->setError('');
		return true;
	}
}
