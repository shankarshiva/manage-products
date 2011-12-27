<?php

/*
 * #################################################################
 * Author:		Shiva Shankar Company:		Camo Solutions Web Site:		sample application
 * Project: sample project Comments: User information Created Date:	Dec 26 2011
 * Last Modified: Reviewed on: Reviewed by: Approved by:
 * #################################################################
 */

class UsersController extends AppController
{

  /**
   * Controller name
   *
   * @var unknown_type
   */
  var $name = "Users";

  /**
   * Used helpers
   *
   * @var array
   * @access public
   */
  var $helpers = array(
    'Form', 
    'Html'
  );
  
  public function beforeFilter()
  {
    
    $this->Auth->allow('registration');
    $this->Auth->loginRedirect =  array('controller' => 'Products', 'action' => 'home');
   // $this->Auth->logoutRedirect = array('controller' => 'Users', 'action' => 'login');
    $this->Auth->authenticate = array(
        'Form' => array(
            'fields' => array(
                'username' => 'email_address',
                'password' => 'pass_word'
            )
        )
    );
    
    parent::beforeFilter();
    
  }

  
  /**
   * Function for check login
   *
   */
  public function login()
  {
    // Setting the page title
    $this->set("title_for_layout", "User Login");
    
    //echo "===".AuthComponent::password('shiva1234');
    if ($this->Auth->login())
    {
      $this->redirect($this->Auth->redirect());
    }
    else
    {
      $this->Session->setFlash(__('Invalid username or password, try again'));
    }
  }

  function logout()
  {
    $this->redirect($this->Auth->logout());
  }

  
  /**
   * Function for check login
   *
   */
  public function admin_login()
  {
  
    // Setting the layout for admin
    $this->layout = 'admin';
  
    // Setting the page title
    $this->set("title_for_layout", "Admin Login");
  
    if (!$this->adminCheckLogin())
    {
      if ($this->request->is('post'))
      {
        if ($result = $this->User->getUserDetails($this->request->data))
        {
          $this->Session->write('AdminUser', $result['User']);

          /* return $this->redirect(array(
              'controller' => 'Categories',
              'action' => 'index'
          )); */
          return $this->redirect(array('controller'=>'Categories','action' => 'index', 'admin'=>1));
        }
        else
        {
          $this->Session->setFlash(__('Email or password is incorrect'));
        }
      }
    }
    else
    {

      $this->redirect(array('controller'=>'Categories','action'=>'index', 'admin'=>1));
      //$this->redirect(array('controller'=>'Categories','action' => 'admin_index'), null, true);
    }
  }
  
  /**
   * Function for admin logout
   *
   */
  function admin_logout()
  {
    $this->layout = 'admin';
    $this->Session->delete('AdminUser');
    /* $this->redirect(array(
        'controller' => 'Users',
        'action' => 'login'
    )); */
    $this->redirect(array('controller'=>'Users','action' => 'login', 'admin'=>1));
  }
  
  
}
?>