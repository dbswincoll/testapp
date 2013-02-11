<?php
$this->breadcrumbs=array(
	'Basic Search'=>array('searchb'),
	'Search Results',
);


Yii::app()->clientScript->registerScript('search', "
$('.searchb-button').click(function(){
	$('.searchb-form').toggle();
	return false;
});
$('.searchb-form form').submit(function(){
	$.fn.yiiGridView.update('crs1-grid', {
		data: $(this).serialize()
	});
	return false;
});
");

?>

<h2>Search Results</h2>

<p class="infoicon2">
To search for a course at Swindon College you can use keyword search below.
<?php echo "If you wish click <a href=\"". Yii::app()->createUrl('site/searchb') ."\">here</a> to go back to the main basic search form."; ?>

</p>


<?php //echo CHtml::link('Advanced Search','#',array('class'=>'searchb-button')); ?>
<div class="searchb-form" style="display:;">
<?php $this->renderPartial('_searchb',array(
	'model'=>$model,
)); ?>

</div><!-- basic search-form -->


<?php 
  /*$this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'user-grid',
	'dataProvider'=>$model->search(),
	//'filter'=>User::model(),
	'columns'=>array(
		array(
		    'name'=>'id',
		    'header'=>'User ID',
		),
                array(
                    'name'=>'username', 
                    'type'=>'raw', 
                    'value'=>'CHtml::link($data["username"], array("site/view", "id"=>$data["id"]))', 
                    'header'=>'Username',
                 ),
		'password',
		'email',
		array(
		    'header'=>'Actions',
	            'class'=>'CButtonColumn',
                    'template'=>'{view}',
                    'viewButtonUrl'=>'Yii::app()->createUrl("site/view",array("id"=>$data["id"]))',
		),
	),
)); */

if (isset($_POST['keyword']) || isset($_GET['keyword'])) 
  $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'crs1-grid',
	'dataProvider'=>$model->search(),
	//'filter'=>User::model(),
	'columns'=>array(
	    array(
            'name'=>'code', 
            'type'=>'raw', 
            'value'=>'CHtml::link($data["code"], array("site/crsview", "id"=>$data["id"],"keyword"=>CHtml::encode($this->grid->dataProvider->params["keyword"]),"ajax"=>$this->grid->getId(),"page"=>$this->grid->dataProvider->pagination->currentPage+1,"v"=>$this->grid->dataProvider->params["v"]))', 
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
			'header'=>'Weeks',
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

		/*array(
		    'header'=>'',
		    'class'=>'CButtonColumn',
               'template'=>'{view}',
			   'viewButtonUrl'=>'Yii::app()->createUrl("site/crs-view",array("id"=>$data["id"]))',
		),*/
	),

));
?>