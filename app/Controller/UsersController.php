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
    'Captcha',
    'Upload'
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
    
    if ($this->Auth->login())
    {

      $this->redirect($this->Auth->redirect());
    }
    else
    {
      if ($this->request->is('post'))
      {
        $this->Session->setFlash(__('Invalid username or password, try again'));
      }
    }
   
    $facebooksecretkey = '4753a9042404a78aaff1069f73aa8994';
    $facebookapikey = '203755806382341';
    
    App::import('Vendor', 'facebook', array('file' => 'facebook/src/facebook.php'));
    
    $facebook = new Facebook(array(
        'appId'  => "$facebookapikey",
        'secret' => "$facebooksecretkey",
    ));

    $user = $facebook->getUser();

    $facebookLoginUrl = $facebook->getLoginUrl();

    $this->set('facebookLoginUrl', $facebookLoginUrl);
 
    if($user)
    {
      $faceBookUserProfile = $facebook->api('/me');
      if(isset($faceBookUserProfile) && !empty($faceBookUserProfile)){

        $this->facebook($faceBookUserProfile);

      }
    }
    //ends here
  }
  
  /**
   * after login with facebook the details is checked here
   */
  function facebook($faceBookUserProfile)
  {
    
    $email = isset($faceBookUserProfile['email'])?$faceBookUserProfile['email']:'';

    if(empty($email)){
      //if user provides the username
      $email = $faceBookUserProfile['username'].'@facebook.com';
    }

    $isExistUser = $this->User->findByEmailAddress($email);

    if((!empty($faceBookUserProfile) && !$isExistUser) && (isset($email) && !empty($email)))
    {
     
      $this->User->create();
      $curDate = date('Y-m-d H:i:s');
      $pass = 'camo1234';
      // Storing the profile.
      $saveData['User'] = array(
          'name' => $faceBookUserProfile['name'],
          'email_address' => $faceBookUserProfile['email'],
          'pass_word' => AuthComponent::password($pass),
          'cpass_word' => AuthComponent::password($pass),
          'user_type' => 1,
          'created_date' => $curDate
      );

      $this->User->save($saveData);
      
      $data1 = array(
          'id' => $this->User->id,
          'name' => $faceBookUserProfile['name'],
          'email_address' => $faceBookUserProfile['email'],
          'user_type' => 1
      );
 
    }
    else
    {
      $data1 = array(
          'id' => $isExistUser['User']['id'],
          'name' => $isExistUser['User']['name'],
          'email_address' => $isExistUser['User']['email_address'],
          'user_type' => 1
      );
    }

    $this->Auth->login($data1);

    $this->redirect('/Products/home');
  }
  
  /**
   * function for edit profile and can crop the profile image.
   */
  public function editProfile($id = null)
  {
    
    // Setting the page title
    $this->set("title_for_layout","Edit Profile");
    
    // if nothing passing then redirecting to home page.
    if (empty($id))
    {
      $this->redirect('home');
    }
    
    if(isset($this->data['cropSubmit']) && ($this->data['cropSubmit'] == 'TRUE'))
    {
    
      $thumb_width = CROP_THUMBNAIL_WIDTH;	// Width of thumbnail image
      $thumb_height = CROP_THUMBNAIL_HEIGHT; // Height of thumbnail image
    
      $random_key   = rand(9999,999999);
      $thumb_image_prefix = "thumbnail_";
    
      $large_image_name  = $this->data['orgImageName'];
    
      $thumb_image_name = $thumb_image_prefix.$large_image_name;
    
      $large_image_location = 'img/profile/'.$large_image_name;
    
      $thumb_image_location = 'img/crop_images/'.$thumb_image_name;
    
      //Get the new coordinates to crop the image.
      $x1 = $_POST["x1"];
      $y1 = $_POST["y1"];
      $x2 = $_POST["x2"];
      $y2 = $_POST["y2"];
      $w = $_POST["w"];
      $h = $_POST["h"];
      //Scale the image to the thumb_width set above
      $scale = $thumb_width/$w;
      $cropped = $this->resizeThumbnailImage($thumb_image_location, $large_image_location,$w,$h,$x1,$y1,$scale);
    
      $this->Session->setFlash(__('Image has been cropped successfully', true));

      $this->redirect(array(
          'controller' => 'Users',
          'action' => 'editProfile/'.$id
      ));
      
    }
    else
    {

      if (!empty($this->data))
      {

        $this->User->recursive = 0;
        $profileImageDetails = $this->User->findById($id);
        $profileImageName = $profileImageDetails['User']['profile_image'];
    
        // initializing the array
        $profileImageArray['User'] = array();
    
        if (isset($this->data['User']['file_data']['name']) &&
            !empty($this->data['User']['file_data']['name']))
        {
          // set the upload destination folder
          $destination = realpath('img/profile/small') . '/';
          $destination1 = realpath('img/profile') . '/';

          // grab the file
          $file = $this->data['User']['file_data'];

          // upload the image using the upload component
          $result = $this->Upload->upload($file, $destination, null, array(
              'type' => 'resizecrop',
              'size' => array(
                  THUMBNAIL_IMAGE_WIDTH,
                  THUMBNAIL_IMAGE_HEIGHT
              ),
              'output' => 'jpg'
          ));
    
          // upload the image using the upload component
          $result = $this->Upload->upload($file, $destination1, null, array(
              'type' => 'resizecrop',
              'size' => array(
                  DETAILS_IMAGE_WIDTH,
                  DETAILS_IMAGE_HEIGHT
              ),
              'output' => 'jpg'
          ));
    
          $errors = $this->Upload->errors;

          if($errors)
          {
            // display error
            $errors = $this->Upload->errors;
             
            // piece together errors
            if(is_array($errors)){
              $errors = implode("<br />",$errors);
            }
             
            $this->Session->setFlash($errors);
    
            $this->redirect(array(
                'controller' => 'Users',
                'action' => 'editProfile/'.$id
            ));
            exit();
          }
          else
          {
            // setting the vlaues into array.
            $profileImageArray['User'] = array(
                'id' => $this->data['User']['id'],
                'name' => $this->data['User']['name'],
                'email_address' => $this->data['User']['email_address'],
                'profile_image' => $this->Upload->result
            );
          }
        }
        else
        {
          // setting the vlaues into array.
          $profileImageArray['User'] = array(
              'id' => $this->data['User']['id'],
              'name' => $this->data['User']['name'],
              'email_address' => $this->data['User']['email_address'],
              'profile_image' => $profileImageName
          );
        }
    
        if ($this->User->save($profileImageArray))
        {
          $this->Session->setFlash(__('The Profile has been updated successfully', true));
          $this->redirect(array(
              'controller'=>'Products',
              'action' => 'home'
          ));
        }
        else
        {
          $this->Session->setFlash(__('The profile image could not be saved. Please, try again.', true));
        }
      }
    }

    if (empty($this->data))
    {
      $this->data = $this->User->read(null, $id);
    }

  }

  public function logout()
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
  public function admin_logout()
  {
    $this->layout = 'admin';
    $this->Session->delete('AdminUser');

    $this->redirect(array(
      'controller' => 'Users', 
      'action' => 'login', 
      'admin' => true
    ));
  }
  
  
  function  logged($from = null){
  
    $this->set('from',preg_replace('/[^a-zA-Z0-9_ -]/s', '', $from));
  
    $this->layout = 'default';
  }
  
 

  //You do not need to alter these functions
  function resizeThumbnailImage($thumb_image_name, $image, $width, $height, $start_width, $start_height, $scale)
  {
    list($imagewidth, $imageheight, $imageType) = getimagesize($image);
    $imageType = image_type_to_mime_type($imageType);
  
    $newImageWidth = ceil($width * $scale);
    $newImageHeight = ceil($height * $scale);
    $newImage = imagecreatetruecolor($newImageWidth,$newImageHeight);
    switch($imageType) {
      case "image/gif":
        $source=imagecreatefromgif($image);
        break;
      case "image/pjpeg":
      case "image/jpeg":
      case "image/jpg":
        $source=imagecreatefromjpeg($image);
        break;
      case "image/png":
      case "image/x-png":
        $source=imagecreatefrompng($image);
        break;
    }
    imagecopyresampled($newImage,$source,0,0,$start_width,$start_height,$newImageWidth,$newImageHeight,$width,$height);
    switch($imageType) {
      case "image/gif":
        imagegif($newImage,$thumb_image_name);
        break;
      case "image/pjpeg":
      case "image/jpeg":
      case "image/jpg":
        imagejpeg($newImage,$thumb_image_name,90);
        break;
      case "image/png":
      case "image/x-png":
        imagepng($newImage,$thumb_image_name);
        break;
    }
    chmod($thumb_image_name, 0777);
    return $thumb_image_name;
  }
  
}
?>