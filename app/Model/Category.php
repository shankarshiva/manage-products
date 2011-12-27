<?php
class Category extends AppModel
{
  var $name = 'Category';

  var $displayField = 'category_name';

  var $validate = array(
    'category_name' => array(
      'notempty' => array(
        'rule' => array(
          'notempty'
        )
      )
    ), 
    'category_image' => array(
      'notempty' => array(
        'rule' => array(
          'notempty'
        )
      )
    )
  );
  
  // The Associations below have been created with all possible keys, those that
  // are not needed can be removed
  
  var $hasMany = array(
    'Product' => array(
      'className' => 'Product', 
      'foreignKey' => 'category_id', 
      'dependent' => false, 
      'conditions' => '', 
      'fields' => '', 
      'order' => '', 
      'limit' => '', 
      'offset' => '', 
      'exclusive' => '', 
      'finderQuery' => '', 
      'counterQuery' => ''
    ), 
    'SubCategory' => array(
      'className' => 'SubCategory', 
      'foreignKey' => 'category_id', 
      'dependent' => false, 
      'conditions' => '', 
      'fields' => '', 
      'order' => '', 
      'limit' => '', 
      'offset' => '', 
      'exclusive' => '', 
      'finderQuery' => '', 
      'counterQuery' => ''
    )
  );

  /**
	 * Function fo getting category list
	 */
  function getCategoryList()
  {
    $categoryList = $this->find('all', array(
      'fields' => array(
        'Category.category_name', 
        'Category.id'
      )
    ));
    return $categoryList;
  }

  /**
   * Function fo getting category name
   */
  function getCategoryName($categoryId)
  {
    $categoryResult = $this->findById($categoryId);
    return $categoryResult;
  }

}
?>