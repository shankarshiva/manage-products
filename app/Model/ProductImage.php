<?php
class ProductImage extends AppModel
{
  var $name = 'ProductImage';

  var $validate = array(
    'product_id' => array(
      'numeric' => array(
        'rule' => array(
          'numeric'
        )
      )
    ), 
    'image_name' => array(
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
    'Product' => array(
      'className' => 'Product', 
      'foreignKey' => 'product_id', 
      'conditions' => '', 
      'fields' => '', 
      'order' => ''
    )
  );

}
?>