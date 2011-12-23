<?php
class SubCategory extends AppModel
{
  var $name = 'SubCategory';

  var $displayField = 'sub_category_name';

  var $validate = array(
    'category_id' => array(
      'numeric' => array(
        'rule' => array(
          'numeric'
        )
      )
    ), 
    'sub_category_name' => array(
      'notempty' => array(
        'rule' => array(
          'notempty'
        )
      )
    ), 
    'sub_image_name' => array(
      'notempty' => array(
        'rule' => array(
          'notempty'
        )
      )
    )
  );
  
  // The Associations below have been created with all possible keys, those that
  // are not needed can be removed
  
  var $belongsTo = array(
    'Category' => array(
      'className' => 'Category', 
      'foreignKey' => 'category_id', 
      'conditions' => '', 
      'fields' => '', 
      'order' => ''
    )
  );

  var $hasMany = array(
    'Product' => array(
      'className' => 'Product', 
      'foreignKey' => 'sub_category_id', 
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
	 * Function fo getting sub category details
	 */
  function getSubcategoryDetails($categoryId)
  {
    $subCategoryList = $this->find('all', array(
      'fields' => array(
        'SubCategory.sub_category_name', 
        'SubCategory.id', 
        'SubCategory.sub_image_name'
      ), 
      'conditions' => array(
        'SubCategory.category_id ' => $categoryId
      )
    ));
    return $subCategoryList;
  }

  /**
   * Function fo getting sub category name
   */
  function getSubCategoryName($subCatId)
  {
    $categoryResult = $this->findById($subCatId);
    return $categoryResult;
  }

}
?>