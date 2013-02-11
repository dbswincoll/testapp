<?php
$this->pageTitle=Yii::app()->name . ' - Find a Course';
$this->breadcrumbs=array(
	'Basic Search'=>array('searchbb'),
	'Search by Subject',
);
Yii::app()->clientScript->registerScript('jsval3', "
$('#searchs-form').submit(function(){
  if ( $('#subject').val() != 'empty') {
	$.fn.yiiGridView.update('crs2-grid', {
		data: $(this).serialize()
	});
	return false;
  } 
  else 
  { 
	//alert ('Must select your subject area!');
        alert ('Please select a course subject!');
	return false;
  }
});


$('#subject').change(function(){
    if ( $('#subject').val() != 'empty') {
	  //alert ('ok');
	  $('#searchs-form').trigger('submit');
	  return false;
	} 
	else 
	{
	  alert ('Must select your subject area!');
	  return false;
	}
	
});
/*********************
$('#year').change(function(){
    if ( $('#year').val() != 'empty') {
	  //alert ('ok');
	  $('#searchs-form').trigger('submit');
	  return false;
	} 
	else 
	{
	  alert ('Must select academic year!');
	  return false;
	}
	
});
**********************/

");
?>

<h2>Find a Course by "<i>Subject Area</i>"</h2>

<p class="infoicon2 clear">  
<?php echo "If you can't find the course you are looking for, click <a href=\"". Yii::app()->createUrl('site/searchbb') ."\">here</a> to search by keyword."; ?>
</p>


<?php //echo CHtml::link('Advanced Search','#',array('class'=>'searchs-button')); ?>
<div class="searchs-form" style="display:;">
<?php $this->renderPartial('_searchs',array(
	'model'=>$model,
)); ?>

</div><!-- basic search-form -->


<?php if (isset($_POST['subject']) || isset($_GET['subject'])) 
  $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'crs2-grid',
	'dataProvider'=>$model->search(),
	//'filter'=>User::model(),
	'columns'=>array(
	    array(
            'name'=>'code', 
            'type'=>'raw', 
            'value'=>'CHtml::link($data["code"], array("site/crsview", "id"=>$data["id"],"subject"=>CHtml::encode($this->grid->dataProvider->params["subject"]),"year"=>CHtml::encode($this->grid->dataProvider->params["year"]),"ajax"=>$this->grid->getId(),"page"=>$this->grid->dataProvider->pagination->currentPage+1,"v"=>$this->grid->dataProvider->params["v"]))', 
            'header'=>'Course Code',
        ),
		array(
		    'name'=>'title', 
            /*'type'=>'raw', 
            'value'=>'CHtml::link($data["title"], array("site/crs-view", "id"=>$data["id"]))', */
            'header'=>'Course Title',
		),
		array(
		    'name'=>'days',
			'header'=>'Days',
		),
		array(
		    'name'=>'weeks',
			'header'=>'Wks',
		),
		array(
		    'name'=>'type',
			'header'=>'F/P',
		),
		array(
		    'name'=>'sdate',
			'header'=>'Start Date',
		),
		array(
		    'name'=>'stime',
			'header'=>'Start Time',
		),
		array(  
			
            'header'=> 'Pdf',
			'type' => 'raw',
			/*'value'=> (file_exists('//SCIS034/leaflets/$data["code"]')) ? 'CHtml::link(CHtml::image("images/icon/icon_pdf.gif", "View Leaflet", array("title"=>"View Leaflet")), "http://ebs4courses.swindon-college.ac.uk/leaflets/".$data["code"].".pdf", array("target"=>"_blank"))' : 'CHtml::image("images/icon/icon_cross.gif", "No Leaflet", array("title"=>"No Leaflet"))',*/	
			'value' => 'Course::genLeafletLink($data["code"].".pdf", 1)',
        ),  
		/*array(,
		    'header'=>'',
		    'class'=>'CButtonColumn',
               'template'=>'{view}',
			   'viewButtonUrl'=>'Yii::app()->createUrl("site/crs-view",array("id"=>$data["id"]))',
		),*/
	),

)); ?>
