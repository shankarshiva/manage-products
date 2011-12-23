
// While submitting the search form.
function productSearch()
{
  var parent = $(this).parents('form');
  var keywords = $('#ProductKeywords').val();
  var resultDiv = $("#productListing"); //target div to print results
  
  var baseAddr = null;

  if( document.getElementsByTagName ) 
  {
	var elems = document.getElementsByTagName( 'base' );

	if( elems.length ) 
	{
	  baseAddr = elems[ 0 ].href;
	}
  }

 // var imageDiv	= $("#content"); //target div to print results images 
  if ($('.issue'))
  {
    $('.issue').remove();
  }
  if (keywords == '')
  {
    $(parent).before('<div class="issue">Please enter alteast one criteria for search..</div>');
  }
  else
  {
    $('.issue').remove();
    var formData = $(this).parents('form').serialize();
	$.ajax({  
	  type: "POST", url: baseAddr+'/products/searchResults', data: "keywords="+keywords+"&is_search=1",
	  complete: function(data)
	  {  
	    //print results as appended   
	    resultDiv.html(data.responseText);  

	  }  
	});  
  }

}
  
// Function for reset the form.
function reSet()
{
	location.reload(true)
}