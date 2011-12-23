<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" >
    <title>
      <?php 
        echo $title_for_layout; 
      ?>
    </title>
    <base href = "<?php echo HTTP_HOST;?>">
    <?php 
      echo $this->Html->css('style.css'); 
      echo $this->Html->css('style_menu.css'); 
      echo $this->Html->css('jquery.ennui.contentslider.css'); 
      echo $this->Html->script(array('jquery.min.1.7.1.js', 'product_search.js'));
    ?>
  </head>
  <body>
    <div id="shopfriend">
      <div class="headerTop"></div>
      <!-- Header Part Starts Here -->
      <div id="header">
        <div class="headerWrap">
        	<div class="top_links">
        	  <div style="float:left;">
        	     <?php 
        	       echo __('Welcome Guest!'); 
        	     ?>
        	  </div>
        	</div>
        	<table cellpadding="0" cellspacing="0" width="100%" border="0">				
        		<tr>
        			<td class="spacer20"></td>
        			<td align="right" valign="top">
        			<?php 
        			  echo $this->Form->create('Product',array('action'=>'searchResult')); 
        			?>
        				<table cellpadding="0" cellspacing="0" border="0">
        					<tr>
        						<td align="right"><img src="<?php echo HTTP_HOST;?>/images/left_curve.gif" alt="" ></td>
        						<td class="top_bg" align="right">
          						<?php echo __('What Are You Looking For : '); 
          						echo $this->Form->input("keywords", array('label'=>false,'class'=>'txt_box','style'=>'width:330px;','div'=>false)); 
          						?>
          						<input type="submit" value="" class="search" id="search-submit" >
        						</td>
        						<td align="left"><img src="<?php echo HTTP_HOST;?>/images/right_curve.gif" alt="" ></td>
        					</tr>
        				</table>
        			<?php echo $this->Form->end(); ?>
        			</td>
        			<td class="spacer"></td>
        		</tr>
        	</table>
        </div>
      </div>
      <!-- Header Part Ends Here -->
      <!-- Top menu Part Starts Here -->
      <div class="top_menu"><div class="top_menuWrap">
      	<ul>	
      		<li class="home"><a href="<?php echo HTTP_HOST;?>/products/home">Home</a></li>					
      	</ul>
      </div>
    </div>
    <!-- Top menu Part Ends Here -->
    <div id="content">
    	<?php 
    	  echo $content_for_layout; 
    	?>
    </div>
    <?php 
      echo $this->Element('footer'); 
    ?>
  </body>
</html>