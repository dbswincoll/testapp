<?php
$this->pageTitle=Yii::app()->name . ' - Find a Course';
$this->breadcrumbs=array(
	'Basic Search'=>array('searchb'),
	'Search by Qualification',
);
Yii::app()->clientScript->registerScript('jsval2', "
$('#searchq-form').submit(function(){
	if ( $('#SearchFormQ_qualification').val() == 'empty') {
	        alert ('Must select your qualification!');
	        return false;
	}
});
");
?>

<h2>Find a Course</h2>

<!-- div id="frmcontainer" -->
<?php if(Yii::app()->user->hasFlash('searchq')): ?>

<div class="flash-success">
	<?php echo Yii::app()->user->getFlash('searchq'); ?>
</div>

<?php else: ?>

<p class="infoicon2">
To search for a course at Swindon College use the search by qualification form below.
<?php echo "If you wish click <a href=\"". Yii::app()->createUrl('site/searchb') ."\">here</a> to use basic search form to find a course."; ?>
</p>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'searchq-form',
	'enableClientValidation'=>true,
	'clientOptions'=>array(
		'validateOnSubmit'=>true,
	),
)); ?>
	
    <fieldset><legend>&nbsp;Choose your course qualification from the provided dropdown list&nbsp;</legend>
	 <table>
	  <tr>
		<td width="470"><div class="row">
<?php echo $form->listBox($model,'qualification',array('empty'=>' - Select Course Qualification -'), array('class'=>'dropdown1','style'=>'width:470px !important', 'size'=>1)); ?></div>
          </td>
		<td valign="top"><?php echo CHtml::submitButton(' Search ', array('class'=>'button')); ?></td>
	  </tr>
	  
	 </table>
    </fieldset>

<?php $this->endWidget(); ?>

	</div><!-- form -->

<?php endif; ?>
<!-- /div -->