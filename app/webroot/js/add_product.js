function getSubCategories()
{
	var productId	= $('#ProductCategoryId').val();
	var resultDiv	= $("#ProductSubCategoryId");

	var baseAddr = null;

	if( document.getElementsByTagName ) 
	{
	  var elems = document.getElementsByTagName( 'base' );
	
	  if( elems.length ) 
	  {
		baseAddr = elems[ 0 ].href;
	  }
	}

	$.ajax({  
		type: "POST", url: baseAddr+'/products/getSubCatList', data: "productId="+productId,
		complete: function(data)
		{  
			//print results as appended   
			resultDiv.html(data.responseText);  
		}  
	});  
}
