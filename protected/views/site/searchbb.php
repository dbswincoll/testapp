<?php
$this->pageTitle=Yii::app()->name . ' - Find a Course';
/*$this->breadcrumbs=array(
	'Basic Search',
);*/

Yii::app()->clientScript->registerScript('srchb', "
$(document).ready(function () {  
	if ( $('#id').val().length == 0 ) {
	    $('#keyword').autocomplete( 'search', $('#keyword').val() );
	}
	$('#keyword').select();
});

$('#srch1').click(pbar);
$('#srch2').click(pbar);
$('#srch3').click(pbar);

//$('#searchb-form').submit(pbar);

$('#searchb-form').submit(function(){
    if ( $('#keyword').val() == '' || $('#id').val() == '' ) {
	  //alert ('ok');
	  $('#mymodal1').dialog('open');
	  return false;
    }	
	//show progress bar
	pbar();
});

//$('#progress').progressbar({'value':0});

");

?>

<h2>Find a Course (<i>Basic Search</i>)</h2>

<div id="frmcontainer">
    <?php //if(Yii::app()->user->hasFlash('searchb')): ?>

    <!--
          <div class="flash-success">
	           <?php //echo Yii::app()->user->getFlash('searchb'); ?>
          </div>
    // -->
    <?php //else: ?>

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
To search for a course at Swindon College, use the keyword search below.<br/>You can also search by subject area or qualification.
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
	<!-- <p class="note">Fields with <span class="required">*</span> are required.</p> -->

	<?php echo $form->errorSummary($model); ?>
	<?php echo CHtml::hiddenField('id', (isset($_GET['id'])) ? $_GET['id'] : '')."\n";?>
	<?php echo CHtml::hiddenField('v','bb')."\n";?>
	
	<!-- <span class="required">*</span>&nbsp; -->
    <fieldset><legend>&nbsp;Enter a course keyword search&nbsp;</legend>
	 <table>
	  <tr>
		<td width="542"><div class="row">
		   <?php                                                              //echo $form->textField($model,'keyword',array('name'=>'keyword','id'=>'keyword','class'=>'autocomplete','title'=>'Enter course keyword, select course from dropdown list and click "View Course" button','size'=>60,'maxlength'=>120)); ?>
		   <?php $this->widget('zii.widgets.jui.CJuiAutoComplete', array(
				'id'=>'keyword',
				'name'=>'keyword',
				'value'=>(isset($_GET['keyword'])) ? $_GET['keyword'] : '',
				'source'=>Yii::app()->createUrl('site/suggestCourse'),
				                                                              //'source'=>array('apple','banana','grape','orange','olive'),
				'options'=>array(
					'minLength'=>'2',
					'showAnim'=>'fold',
					'select'=>'js:function( event, ui ) {$("#keyword").val( ui.item.label );$("#id").val( ui.item.id ); return false; }',
					'open'=> 'js:function(event, ui) {  
							$( this ).autocomplete( "widget" )
								.find( "ui-menu-item-alternate" )
								.removeClass( "ui-menu-item-alternate" )
								.end()
								.find( "li.ui-menu-item:odd a" )
								.addClass( "ui-menu-item-alternate" ); }',
				),
				'htmlOptions'=>array(
					//'size'=>'74',
					'title'=>'Enter course keyword, select course from the suggested dropdown list and click <Go!> button',
					
				),
			)); ?>
		   </div></td>
		<td valign="top"><?php echo CHtml::submitButton(' Go! ', array('class'=>'btngo')); ?></td>
	  </tr>
	  <!-- <tr><td colspan="2"><?php //echo $form->error($model,'keyword'); ?></td></tr> -->
	 </table>
    </fieldset>
    <fieldset><legend>&nbsp;<b>Or</b>, click on either button below&nbsp;</legend>
		<table>
		<tr>
			<td align="left" width="550px"><?php echo "<a id=\"srch1\" href=\"". Yii::app()->createUrl('site/searchs') ."\"><img src=\"images/search/search-1.2.jpg\"></a>"; ?></td>
			<td align="right"><?php echo "<a id=\"srch2\" href=\"". Yii::app()->createUrl('site/searchq') ."\"><img src=\"images/search/search-2.2.jpg\"></a>"; ?></td>
		</tr>  
		</table>
	</fieldset>
	
<?php $this->endWidget(); ?>
	<fieldset><legend></legend>
		<?php echo "<br><p class='frontpage'>If you want to use the advanced course search, click <a id=\"srch3\" href=\"". Yii::app()->createUrl('site/searcha') ."\">here</a>.</p>"; ?>
		<p class="frontpage">For more information you can speak to an advisor on 0800 731 2250 or (01793) 491591 or click <a href="http://www.swindon-college.ac.uk/contact/" target="_blank">here</a> to use our online enquiry form.</p> 
	</fieldset>
</div><!-- form -->

<?php 			

	$this->widget('ext.tipsy.Tipsy', array(  
		'trigger' => 'focus',
		'items' => array(
				array('id' => '#searchb-form [title]', 'htmlOptions' => '', 'gravity' => 'sw'),
			),  
		)
	);
	
	$this->beginWidget('zii.widgets.jui.CJuiDialog', array(
    'id'=>'mymodal1',
    'options'=>array(
        'title'=>'Information Message',
        'width'=>380,
        'height'=>190,
        'autoOpen'=>false,
		'hide'=> 'explode',
        'resizable'=>false,
        'modal'=>true,
        'overlay'=>array(
            'backgroundColor'=>'#000',
            'opacity'=>'0.5'
        ),
        'buttons'=>array(
            //'OK'=>'js:function(){alert("OK");}',
            'Ok'=>'js:function(){$(this).dialog("close");$("#keyword").focus();}',    
        ),
    ),
	));
    echo 'Please enter a valid course keyword and then select a course title from the dropdown suggested courses list.';
	$this->endWidget('zii.widgets.jui.CJuiDialog');
?>
<?php //endif; ?>
</div>