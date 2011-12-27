<?php
class Product extends AppModel
{
  var $name = 'Product';

  var $displayField = 'product_name';

  var $validate = array(
    'category_id' => array(
      'numeric' => array(
        'rule' => array(
          'numeric'
        )
      )
    ), 
    'product_name' => array(
      'notempty' => array(
        'rule' => array(
          'notempty'
        )
      )
    ), 
    'product_desc' => array(
      'notempty' => array(
        'rule' => array(
          'notempty'
        )
      )
    ), 
    'price' => array(
      'numeric' => array(
        'rule' => array(
          'numeric'
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
    ), 
    'SubCategory' => array(
      'className' => 'SubCategory', 
      'foreignKey' => 'sub_category_id', 
      'conditions' => '', 
      'fields' => '', 
      'order' => ''
    )
  );

  var $hasMany = array(
    'ProductImage' => array(
      'className' => 'ProductImage', 
      'foreignKey' => 'product_id', 
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

  function getRecentlyProducts($condition = null)
  {
    $results = $this->find('all', array(
      'limit' => 10, 
      'order' => array(
        'Product.id' => 'DESC'
      ), 
      'fields' => array(
        'Product.product_name', 
        'Product.product_desc', 
        'Product.id', 
        'Product.price'
      ), 
      'conditions' => $condition
    ));
    return $results;
  }

  function getSearchResults($condition = null)
  {
    $results = $this->find('all', array(
      'order' => array(
        'Product.id' => 'DESC'
      ), 
      'fields' => array(
        'Product.product_name', 
        'Product.product_desc', 
        'Product.id', 
        'Product.price'
      ), 
      'conditions' => $condition
    ));
    return $results;
  }

  function getProductCategories($pId)
  {
    $productDetails = $this->findById($pId);
    return $productDetails;
  }

  function getProductsAgainstMainCategory($catId)
  {
    $results = $this->find('all', array(
      'order' => array(
        'Product.id' => 'DESC'
      ), 
      'fields' => array(
        'Product.product_name', 
        'Product.product_desc', 
        'Product.id', 
        'Product.price'
      ), 
      'conditions' => $condition
    ));
    return $results;
  }

}
?>