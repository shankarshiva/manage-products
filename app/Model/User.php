<?php
/*
 #################################################################
Author:
Company:		Camo Solutions
Web Site:		Sample Application
Project:		Sample project
Comments:		User Model
Created Date:	Dec 26, 2011
Last Modified:
Reviewed on:
Reviewed by:
Approved by:
#################################################################
*/
class User extends AppModel
{

	public $displayField = 'name';

  public $validate = array(
		'name' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => 'Please give your name',
			),
		),
		'email_address' => array(
			'email_address' => array(
				'rule' => array('email_address'),
				'message' => 'Please give a valid email',
			),
			'unique' => array(
				'rule' => array('isUnique'),
				'message' => 'Email aleready exists',
			) 
		),
		'pass_word' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => 'Please give the password',
				'last' => true
			),
			'compare' =>array(
				'rule' =>'checkPasswords',
				'message' => 'Passwords do not match'
			)
		)
	);
	
	/* function beforeSave()
	{
		$temp = $this->data['User']['pass_word'];
		$this->data['User']['pass_word'] = md5($temp);
		return true;
	} */
	
	function checkPasswords()
	{
		if (strcmp($this->data['User']['pass_word'], $this->data['User']['cpass_word']) == 0)
		{
			return true;
		}
		return false;
	}
	
	function getUserDetails($data)
	{

		if (!empty($data['User']['email_address']) && !empty($data['User']['pass_word']))
		{

			$conditions = array(
											'User.email_address' =>  $data['User']['email_address'],
											//'User.pass_word' =>  md5($data['User']['pass_word'])
			                'User.pass_word' =>  $data['User']['pass_word']
			               
										);
	
			$result = $this->find('first', array('conditions' => $conditions));

			if (!empty($result))
			{
				return $result;
			}
		}
		return false;
	}
}
?>