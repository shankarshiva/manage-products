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

  /**
   * Used helpers
   *
   * @var array
   * @access public
   */
  public $helpers = array(
      'Functions',
      'Session',
      'Form',
      'Html'
  );

  /**
   * Used components
   *
   * @var array
   * @access public
   */
  public $components = array(
    'Session', 
      'Auth'
  );

  function beforeFilter()
  {
   
    if (empty($this->params[Configure::read('Routing.admin')]) || !$this->params[Configure::read('Routing.admin')]) {
      $this->Auth->allow('signup', $this->params['action']);
    }
    else
    {
      $this->Auth->allow('signup');
    }
    
    $this->Auth->loginRedirect = array(
        'controller' => 'Products',
        'action' => 'home'
    );
    $this->Auth->loginRedirect = array(
        'controller' => 'Products',
        'action' => 'home','plugin' => false,'admin'=>false
    );
    $this->Auth->authenticate = array(
        'Form' => array(
            'fields' => array(
                'username' => 'email_address',
                'password' => 'pass_word'
            )
        )
    );
  }

  /**
   * Load the Authentication
   *
   * @access public
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
