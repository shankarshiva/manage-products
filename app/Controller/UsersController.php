<?php

/*
 * #################################################################
 * Author: Shiva Shankar ; 
 * Created Date:	Dec 26 2011
 * #################################################################
 */

class UsersController extends AppController
{

  /**
   * Controller name
   *
   */
  public $name = "Users";

  /**
   * Used components
   *
   * @var array
   * @access public
   */
  public $components = array(
    'Captcha'
  );

  public function beforeFilter()
  {
    parent::beforeFilter();
    $this->Auth->allow('signup', 'captcha');
  }

  /**
   * Function for check login
   *
   */
  public function login()
  {
    // Setting the page title
    $this->set("title_for_layout", "User Login");
    
    if ($this->request->is('post'))
    {
      if ($this->Auth->login())
      {
        $this->redirect($this->Auth->redirect());
      }
      else
      {
        $this->Session->setFlash(__('Invalid username or password, try again'));
      }
    }
  }

  function logout()
  {
    $this->redirect($this->Auth->logout());
  }

  public function captcha()
  {
    $this->autoRender = false;
    $this->layout = 'ajax';
    $this->Captcha->create();
  }
  
  /**
   * Function for registration new user 
   * and automatically login into the system
   */
  public function signup()
  {
    // Checking if already logged in then redirecting to home page
    if (!$this->checkLogin())
    {
      if ($this->request->is('post'))
      {
        $this->User->create();
        $this->User->setCaptcha($this->Captcha->getVerCode());

        if ($this->User->save($this->request->data))
        {

          $data = array(
            'id' => $this->User->id,
            'name' => $this->request->data['User']['name'], 
            'email_address' => $this->request->data['User']['email_address'], 
            'user_type' => $this->request->data['User']['user_type']
          );

          $this->Auth->login($data);
          
          $this->Session->setFlash(__('Successfully registered'));
          $this->redirect(array(
            'controller' => 'Products', 
            'action' => 'home'
          ));
        }
        else
        {
          $this->Session->setFlash(__('We encountered errors in the information
              you submitted. Please check the fields marked below and try again.'));
        }
      }
    }
    else
    {
      $this->redirect(array(
        'controller' => 'Products', 
        'action' => 'home'
      ));
    }
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
        if ($result = $this->User->getAdminUserDetails($this->request->data))
        {
          $this->Session->write('AdminUser', $result['User']);
          
          return $this->redirect(array(
            'controller' => 'Categories', 
            'action' => 'index', 
            'admin' => true
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
      $this->redirect(array(
        'controller' => 'Categories', 
        'action' => 'index', 
        'admin' => true
      ));
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

    $this->redirect(array(
      'controller' => 'Users', 
      'action' => 'login', 
      'admin' => true
    ));
  }

}
?>