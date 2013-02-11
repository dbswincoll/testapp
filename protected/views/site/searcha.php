<?php
$this->pageTitle=Yii::app()->name . ' - Find a Course (Advanced Search';
$this->breadcrumbs=array(
	'Basic Search'=>array('searchbb'),
	'Advanced Search',
);

Yii::app()->clientScript->registerScript('srcha', "
 
$('.searcha-button').click(function(){
	$('.searchadv-form').toggle();
	if ($('.searcha-button').text() == 'Show Advanced Search') {
		$('.searcha-button').text('Hide Advanced Search');
	} else {
		$('.searcha-button').text('Show Advanced Search');
	}
	return false;
});
 
$('#submita').click(function(){			
		//if ( $('#code').val() == '' && $('#title').val() == '' && $('#subject').val() == 'empty' && $('#qualification').val() == 'empty' && $('#location').val() == 'empty' && $('#year1').val() == '' && $('#year2').val() == '' && $('#sdate').val() == '' && $('#shour').val() == '' && $('#sminute').val() == '' && $('#day').val() == 'empty') {
		if ( $('#code').val() == '' && $('#title').val() == '' && $('#subject').val() == 'empty' && $('#qualification').val() == 'empty' && $('#year1').val() == '' && $('#year2').val() == '' && $('#sdate').val() == '' && $('#shour').val() == '' && $('#sminute').val() == '' && $('#day').val() == 'empty') {
			alert ('Please enter or select at least one form entry!');
			return false
		} 
		pbar();   // start the progress bar 

		//$('.searchadv-form').toggle();   hide the advanced search while processing the adv search form
		
		$('.searcha-form form').submit(function(){		
			$.fn.yiiGridView.update('crs4-grid', {
				data: $(this).serialize()
			});
			return false;
		});
	});
");
?>

<h2>Find a Course (<i>Advanced Search</i>)</h2>

<?php
$this->widget('zii.widgets.jui.CJuiProgressBar', array(
    'id'=>'progress',
    'value'=>0,
    'htmlOptions'=>array(
        'style'=>'width:200px; height:20px;float:left;display:none;'
    ),
));
?>
<div id="amount" style="margin-left:210px; padding:3px;"></div>


<p class="infoicon2 clear">  
<?php echo "If you can't find the course you are looking for, click <a href=\"". Yii::app()->createUrl('site/searchbb') ."\">here</a> to search by keyword."; ?>
</p>

<!-- div id="frmcontainer" -->


<p><?php //echo CHtml::link('Hide Advanced Search','#',array('class'=>'searcha-button')); ?></p>


<div class="searchadv-form" style="display:;">
<?php $this->renderPartial('_searcha',array(
	'model'=>$model,
)); ?>
</div><!-- advanced search-form -->

<?php 			
	$this->widget('ext.tipsy.Tipsy', array(  
		'trigger' => 'focus',
		'items' => array(
				array('id' => '#searcha-form [title]', 'htmlOptions' => '', 'gravity' => 'w'),
				array('id' => '#sdatetip','trigger' => 'hover','gravity' => 'w'),
			),  
		)
	);
?>
<!-- /div -->

<?php if (isset($_GET['submita']) || isset($_GET['code']) ) 
  $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'crs4-grid',
	'dataProvider'=>$model->search(),
	'columns'=>array(
	    array(
            'name'=>'code', 
            'type'=>'raw', 
            //'value'=>'CHtml::link($data["code"], array("site/crsview", "id"=>$data["id"],"code"=>CHtml::encode($this->grid->dataProvider->params["code"]),"title"=>CHtml::encode($this->grid->dataProvider->params["title"]),"subject"=>CHtml::encode($this->grid->dataProvider->params["subject"]),"qualification"=>CHtml::encode($this->grid->dataProvider->params["qualification"]),"location"=>CHtml::encode($this->grid->dataProvider->params["location"]),"year1"=>CHtml::encode($this->grid->dataProvider->params["year1"]),"year2"=>CHtml::encode($this->grid->dataProvider->params["year2"]),"sdateop"=>CHtml::encode($this->grid->dataProvider->params["sdateop"]),"sdate"=>CHtml::encode($this->grid->dataProvider->params["sdate"]),"stimeop"=>CHtml::encode($this->grid->dataProvider->params["stimeop"]),"shour"=>CHtml::encode($this->grid->dataProvider->params["shour"]),"sminute"=>CHtml::encode($this->grid->dataProvider->params["sminute"]),"day"=>CHtml::encode($this->grid->dataProvider->params["day"]),"ajax"=>$this->grid->getId(),"page"=>$this->grid->dataProvider->pagination->currentPage+1,"v"=>$this->grid->dataProvider->params["v"]))', 
            'value'=>'CHtml::link($data["code"], array("site/crsview", "id"=>$data["id"],"code"=>CHtml::encode($this->grid->dataProvider->params["code"]),"title"=>CHtml::encode($this->grid->dataProvider->params["title"]),"subject"=>CHtml::encode($this->grid->dataProvider->params["subject"]),"qualification"=>CHtml::encode($this->grid->dataProvider->params["qualification"]),"year1"=>CHtml::encode($this->grid->dataProvider->params["year1"]),"year2"=>CHtml::encode($this->grid->dataProvider->params["year2"]),"sdateop"=>CHtml::encode($this->grid->dataProvider->params["sdateop"]),"sdate"=>CHtml::encode($this->grid->dataProvider->params["sdate"]),"stimeop"=>CHtml::encode($this->grid->dataProvider->params["stimeop"]),"shour"=>CHtml::encode($this->grid->dataProvider->params["shour"]),"sminute"=>CHtml::encode($this->grid->dataProvider->params["sminute"]),"day"=>CHtml::encode($this->grid->dataProvider->params["day"]),"ajax"=>$this->grid->getId(),"page"=>$this->grid->dataProvider->pagination->currentPage+1,"v"=>$this->grid->dataProvider->params["v"]))', 
            'header'=>'Course Code',
        ),
		array(
		    'name'=>'title', 
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
			/*'value'=> (file_exists('http://ebs4courses.swindon-college.ac.uk/leaflets/$data["code"]')) ? 'CHtml::link(CHtml::image("images/icon/icon_pdf.gif", "View Leaflet", array("title"=>"View Leaflet")), "http://ebs4courses.swindon-college.ac.uk/leaflets/".$data["code"].".pdf", array("target"=>"_blank"))' : 'CHtml::image("images/icon/icon_cross.gif", "No Leaflet", array("title"=>"No Leaflet"))',*/			
			'value' => 'Course::genLeafletLink($data["code"].".pdf", 1)',
			),		
	),

)); ?>
