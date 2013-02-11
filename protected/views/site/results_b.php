<?php
$this->breadcrumbs=array(
	'Basic Search'=>array('searchb'),
	'Search Results',
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('course-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h2>Search Results</h2>

<p class="infoicon2">
You may optionally enter a comparison operator (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
or <b>=</b>) at the beginning of each of your search values to specify how the comparison should be done.
</p>

<?php //echo CHtml::link('Advanced Search','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:;">
<?php $this->renderPartial('_searchb',array(
	'model'=>$model,
)); ?>
</div><!-- basic search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'course-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		array(
		    'name'=>'code',
		    'header'=>'Code',
		),
		'title',
		'days',
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
		    'header'=>'Action',
		    'class'=>'CButtonColumn',
               'template'=>'{view}',
		),
	),
)); ?>
