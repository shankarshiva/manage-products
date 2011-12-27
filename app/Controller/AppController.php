<?php
/**
 * Application level Controller
 *
 * This file is application-wide controller file. You can put all
 * application-wide controller-related methods here.
 *
 * PHP versions 4 and 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright 2005-2010, Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright 2005-2010, Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       cake
 * @subpackage    cake.app
 * @since         CakePHP(tm) v 0.2.9
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @package       cake
 * @subpackage    cake.app
 */
class AppController extends Controller
{

  var $components = array(
    'Session', 
    'Auth'
    /* 'Auth' => array(
      'loginRedirect' => array(
        'controller' => 'Products', 
        'action' => 'home'
      ), 
      'logoutRedirect' => array(
        'controller' => 'Users', 
        'action' => 'login'
      ), 
      'authenticate' => array(
        'Form' => array(
          'fields' => array(
            'username' => 'email_address', 
            'password' => 'pass_word'
          )
        )
      )
    ) */
  );

  /**
	 * Used helpers
	 *
	 * @var array
	 * @access public
	 */
  
  var $helpers = array(
    'Functions',
    'Session',
      'Form',
      'Html'
  );

  /**
   * Load the Authentication
   *
   * @access public
   */

  /*
   * function beforeFilter(){ //Set up Auth Component
   * $this->Auth->allow('index','view'); $this->Auth->authError = 'Please login
   * to view that page'; $this->Auth->loginError = 'Incorrect username /
   * password combination'; //$this->Auth->loginAction = array('controller' =>
   * 'Users', 'action' => 'login'); $this->Auth->loginRedirect =
   * array('controller' => 'Products', 'display' => 'home');
   * $this->Auth->logoutRedirect = array('controller' => 'Products', 'display'
   * => 'home'); // Controller autorization is the simplest form.
   * $this->Auth->authorize = 'controller'; // Additional criteria for loging.
   * $this->Auth->userScope = array('User.active' => 1); //user needs to be
   * active. }
   */

  function adminCheckLogin()
  {

    $userId = $this->Session->read('AdminUser.id');

    if (!empty($userId))
    {
      return true;
    }
    else
    {
      return false;
    }
  }

  function checkLogin()
  {

    $userId = $this->Session->read('User.id');

    if (!empty($userId))
    {
      return true;
    }
    else
    {
      return false;
    }
  }

}
