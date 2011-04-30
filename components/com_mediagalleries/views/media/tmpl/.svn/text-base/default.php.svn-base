<?php
jimport("joomla.html"); 
JHTML::_( 'behavior.modal' ); 
JHtmlBehavior::modal();
?>
This is some change..
<div class="mediagallery<?php echo $this->params->get('pageclass_sfx')?>" >
	<?php //echo $this->thumb; ?>
	<div class="media"><?php echo $this->media; ?></div>
	
	<?php if($this->params->get('show_cat',1)): ?>
		<div class ="media_title"><?php  echo $this->item->catid; ?></div>
	<?php endif; ?>
	
	<?php if($this->params->get('show_title',1)): ?>
	<div class ="media_cat"><?php  echo $this->item->title; ?></div>
	<?php endif; ?>
	
	<?php if($this->params->get('show_url',1)): ?>
	<div class ="media_url"><a href="index.php?option=com_mediagalleries&view=media&layout=modal&tmpl=component&id=<?php echo $this->item->id; ?>" class="modal"><?php  echo $this->item->url; ?></a></div>
	
	<?php endif; ?>
	
	<?php if($this->params->get('show_desc',1)): ?>
	<div class ="media_desc"><?php  echo $this->item->description; ?></div>
	<?php endif; ?>
	
	<?php if($this->params->get('show_hits',1)): ?>
	<div class ="media_hits"><?php  echo $this->item->hits; ?></div>
	<?php endif; ?>
	
	<?php if($this->params->get('show_creation',1)): ?>
	<div class ="media_creation"><?php  echo $this->item->created; ?></div>
	<?php endif; ?>
	
	
	<?php if($this->params->get('show_author',1)): ?>
	<div class ="media_author"><?php  echo $this->item->created_by; ?></div>
	<?php endif; ?>
	
	
	<?php if($this->params->get('show_modified',1)): ?>
	<div class ="media_modified_by"><?php  echo $this->item->modified; ?></div>
	<?php endif; ?>


</div>