<?php

/**
 * MiniRouter - A compact but powerful URI routing class.
 *
 * @author     Reno Philibert <me@renophilibert.com>
 * @copyright  2013-2014 MineDesign, LTD.
 * @license    GNU General Public License v3
 * @version    1.0.0
 * @link       https://github.com/rjp2525/Mini-Router
 *
 */

class MiniRouter {
	/**
	* @var array $_uriList: The list of URIs to validate against
	*/
	private $_uriList = array();

	/**
	* @var array $_paramList: The list of parameters to call
	*/
	private $_paramList = array();

	/**
	* @var string $_uriTrim: The list of URIs to validate against
	*/
	private $_uriTrim = '/\^$';

	/**
	* Adds the function and parameters to the list of URIs to validate
	*
	* @param string $uri The main request
	* @param object $parameters An anonymous function
	*/
	public function add($uri, $parameters) {
		$uri = trim($uri, $this->_uriTrim);
		$this->_uriList[] = $uri;
		$this->_paramList[] = $parameters;
	}

	public function compile() {
		$uri = isset($_REQUEST['uri']) ? $_REQUEST['uri'] : '/';
		$uri = trim($uri, $this->_uriTrim);

		$replacementValues = array();

		// Cycle through the URIs stored in the array
		foreach ($this->_uriList as $listKey => $uriList) {
			
			// Check for a existant matching URI
			if (preg_match("#^$uriList$#", $uri)) {

				// Replace the values
				$realUri = explode('/', $uri);
				$fakeUri = explode('/', $uriList);

				// Gather the parameters from the URI
				foreach ($fakeUri as $key => $value)  {
					if ($value == '.+')  {
						$replacementValues[] = $realUri[$key];
					}
				}
				
				// Pass an array for the parameters
				call_user_func_array($this->_paramList[$listKey], $replacementValues);
			}
			
		}
		
	}

}
