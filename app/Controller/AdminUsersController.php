<?php

/*
 * #################################################################
 * Author:		Shiva Shankar Company:		Camo Solutions Web Site:		sample application
 * Project: sample project Comments: User information Created Date:	Dec 26 2011
 * Last Modified: Reviewed on: Reviewed by: Approved by:
 * #################################################################
 */
//App::uses('AppController', 'Controller');

class AdminUsersController extends AppController
{

  /**
   * Controller name
   *
   * @var unknown_type
   */
  var $name = "AdminUsers";

  /**
   * Used helpers
   *
   * @var array
   * @access public
   */

 /*  public function beforeFilter()
  {

    $this->Auth->allow('AdminUsers.login');
    $this->Auth->loginRedirect =  array('controller' => 'Categories', 'action' => 'index');
    $this->Auth->logoutRedirect = array('controller' => 'AdminUsers', 'action' => 'login');
    $this->Auth->authenticate = array(
        'Form' => array(
            'fields' => array(
                'username' => 'email_address',
                'password' => 'pass_word'
            )
        )
    );

    parent::beforeFilter();
    
    //$this->Auth->userScope = array('User.user_type' => 2);

  }
 */
  /**
	 * Function for check login
	 *
	 */
  public function login()
  {
    
    // Setting the layout for admin
    $this->layout = 'admin';
    
    // Setting the page title
    $this->set("title_for_layout", "Admin Login");
    
  if (!$this->checkLogin())
    {
  
      if ($this->request->is('post'))
      {
       
        if ($result = $this->AdminUsers->getUserDetails($this->request->data))
        {

          $this->Session->write('User', $result['User']);
          
          return $this->redirect(array(
            'controller' => 'Categories', 
            'action' => 'admin_index'
          ));
        }
        else
        {
          $this->Session->setFlash(__('Email or password is incorrect'));
        }
      }
    }
    else
    {
      $this->redirect('/Categories/admin_index');
    } 
  }

  /**
   * Function for admin logout
   *
   */
  function logout()
  {
    $this->layout = 'admin';
    $this->Session->delete('User');
    $this->redirect(array(
        'controller' => 'Users',
        'action' => 'admin_login'
    ));
    //$this->redirect($this->Auth->logout());
  }
  
}
?>