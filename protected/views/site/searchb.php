<?php
$this->pageTitle=Yii::app()->name . ' - Find a Course';
$this->breadcrumbs=array(
	'Basic Search',
);

Yii::app()->clientScript->registerScript('srchb', "
$('#srch1').click(pbar);
$('#srch2').click(pbar);
$('#srch3').click(pbar);
$('#searchb-form').submit(pbar);

//$('#progress').progressbar({'value':0});

");

?>

<h2>Find a Course</h2>

<div id="frmcontainer">
<?php if(Yii::app()->user->hasFlash('searchb')): ?>

<div class="flash-success">
	<?php echo Yii::app()->user->getFlash('searchb'); ?>
</div>

<?php else: ?>

<p class="spinnerImg">Loading...</p> 
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

<p style="both:clear;" class="infoicon2">
To search for a course at Swindon College you can search by subject area or search by qualification. You can also use 
the keyword search.
</p>
	
<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'searchb-form',
	'enableClientValidation'=>true,
	'clientOptions'=>array(
		'validateOnSubmit'=>true,
	),
)); 
?>
	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>
	
	<!-- 
	<table>
	  <tr>
		<td><?php //echo "<a href=\"". Yii::app()->createUrl('site/searchs') ."\"><img src=\"images/search/search-1.1.jpg\"></a>"; ?></td>
	  </tr>  
	</table> 
	-->

    <fieldset><legend>&nbsp;<b>Or,</b>&nbsp;enter a course keyword search&nbsp;<span class="required">*</span>&nbsp;</legend>
	 <table>
	  <tr>
		<td width="550"><div class="row"><?php echo $form->textField($model,'keyword',array('id'=>'keyword','title'=>'Enter course keyword and click "Search" button','maxlength'=>120)); ?></div></td>
		<td valign="top"><?php echo CHtml::submitButton(' Search ', array('class'=>'button')); ?></td>
	  </tr>
	  <tr><td><?php echo $form->error($model,'keyword'); ?></td></tr>  
	 </table>
    </fieldset>
    
	<table>
	  <tr>
		<td align="left" width="550"><?php echo "<a id=\"srch1\" href=\"". Yii::app()->createUrl('site/searchs') ."\"><img src=\"images/search/search-1.2.jpg\"></a>"; ?></td>
		<td align="right"><?php echo "<a id=\"srch2\" href=\"". Yii::app()->createUrl('site/searchq') ."\"><img src=\"images/search/search-2.2.jpg\"></a>"; ?></td>
	  </tr>  
	</table>
	
<?php $this->endWidget(); ?>

    <?php echo "<p>If you wish click <a id=\"srch3\" href=\"". Yii::app()->createUrl('site/searcha') ."\">here</a> to use advanced search form to find a course.</p>"; ?>
	<p>For more information you can speak to an advisor call 0800 731 2250 or click <a href="http://www.swindon-college.ac.uk/contact/">here</a> to use our online form enquiry.</p> 
</div><!-- form -->

<?php 			

	$this->widget('ext.tipsy.Tipsy', array(  
		'trigger' => 'focus',
		'items' => array(
				array('id' => '#searchb-form [title]', 'htmlOptions' => '', 'gravity' => 'e'),
			),  
		)
	);
?>
<?php endif; ?>
</div>