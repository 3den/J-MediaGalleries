<?php
/**
* @version		$Id: helper.php 9764 2007-12-30 07:48:11Z ircmaxell $
* @package		Joomla
* @copyright	Copyright (C) 2005 - 2008 3den. All rights reserved.
* @license		GNU/GPL, see LICENSE.php
* Joomla! is free software. This version may have been modified pursuant
* to the GNU General Public License, and as distributed it includes or
* is derivative of works licensed under the GNU General Public License or
* other free or open source software licenses.
* See COPYRIGHT.php for copyright notices and details.
*/

// no direct access
defined('_JEXEC') or die('Restricted access');

class modJMultimediaHelper
{
	/**
	 * Get list of medias
	 * 
	 * @return array Medias list
	 * @param JParameter $params Module parameters\
	 */
	function getList(&$params){
		global $option;
		$db =& JFactory::getDBO();
		
						
		//Params
		$limit = $params->get('count', 5);
		$mode = $params->get( 'mode', 'auto' );
		if($mode=='auto'){
			$mode = self::_getModeAuto();
			$params->set( 'mode', $mode);
		}	

		// Return rows 
		$db->setQuery( self::_buildQuery($params), 0, $limit );
		return $db->loadObjectList();		
	}		
	
	
	/**
	 * Get list mode automaticaly
	 * 
	 * @access private
	 * @return string Query
	 */	
	function _getModeAuto(){
		global $option;
		$view = JRequest::getCmd('view');
		$layout = JRequest::getCmd('layout');
		
		if($option == 'com_jmultimedia'){
			switch($view){
				// Media View
				case 'media': 
					if($layout == 'form'){// form Layout
						$listmode = 'newer';
					}
					else{// default Layout 
						$listmode = 'related';
					}
					break;
				
				// 
				case 'jmultimedia':
					$listmode = 'newer';
					break; 
					
				// User Channel	
				case 'channel':
				
				// Channels list
				case 'channels':
				
				// Media Categories	
				default:
					$listmode = 'toprated';
					break;
			}
			
		// other Options			
		}else{
			$listmode = 'random';
		}
		
		return $listmode;
	}

	/**
	 * Build List Query
	 * 
	 * @access private
	 * @return string Query
	 * @param string $where SQL query
	 * @param string $orderby SQL query
	 * @param int $limit Items max count
	 */	
	function _buildQuery( &$params ){
		$query = ' SELECT a.id AS id, a.catid AS catid, a.userid AS userid, '
				. ' a.title AS title, a.description AS description, '
				. ' a.url AS url, a.thumb_url AS thumbnail, '
				. ' a.added AS added, a.hits AS views, '
				. ' ( a.rank / (a.votes+1) ) AS rating, '
//				. ' IF(r.votes, (r.rank/r.votes), 0) AS rating, '
				. ' cc.title AS category, u.name AS author '
			. ' FROM #__jmultimedia AS a '
			. ' LEFT JOIN #__categories AS cc ON cc.id = a.catid '
			. ' LEFT JOIN #__users AS u ON u.id = a.userid '
//			. ' LEFT JOIN #__unirating AS r ON r.content_id = a.id '			
			. self::_buildWhere($params)
			. self::_buildOrderBy($params->get('mode'));
		return $query;
	}
	
	/**
	 * Build Where Q
	 * @return string
	 * @param Object $params
	 */
	function _buildWhere(&$params)
	{
		global $option;
		
		// WHERE	
		$where = ' WHERE cc.published=1 AND a.published=1';	
				
		//Categ
		if( $params->get('filter_category') ){
			if( ($option == 'com_jmultimedia') ){
				$catid= JRequest::getInt( 'catid', 0 );
				$id = JRequest::getInt('id', 0);
				if($id){
					$where .=' AND a.catid=(SELECT catid FROM #__jmultimedia WHERE id='.$id.')';
				}elseif($catid){
					$where .=' AND a.catid='.$catid;
				}
			}
		}
		
		// build where 	
		return $where;
	}	

	/**
	 * Build Ordering Query
	 * @return string
	 * @param string $mode
	 */
	function _buildOrderby($mode){				
		// Switch Mode / Order by
		switch($mode){
			case 'newer':
				$orderby = ' ORDER BY added DESC, views DESC, rating DESC';
				break;
			
			case 'related':
				$orderby = ' ORDER BY views DESC, rating DESC, added DESC';
				break;
				
			case 'toprated':
				$orderby = ' ORDER BY rating DESC, views DESC, added DESC';
				break;
			
			case 'popular':
				$orderby = ' ORDER BY views DESC, rating DESC, added DESC';
				break;
			
			case 'ordering':
				$orderby = ' ORDER BY a.ordering, added DESC';
				break;
				
			default:			
			case 'random':	
				$orderby = ' ORDER BY (rand() * added) DESC';
				break;			
		}

		return $orderby;
	}
}