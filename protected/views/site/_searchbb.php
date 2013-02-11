<div class="form">
<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
	'id'=>'searchb-form',	
    'enableClientValidation'=>true,	
    'clientOptions'=>array(		
                  'validateOnSubmit'=>true,	
		),
)); ?>

<?php echo $form->errorSummary($model); ?>

<?php echo CHtml::hiddenField('v', 'b')."\n";?>

<fieldset><legend>&nbsp;Enter a course keyword&nbsp;</legend>
	 <table>
	  <tr>
		<td><div class="row" width="300px"><?php echo $form->textField($model,'keyword',array('size'=>80,'maxlength'=>120)); ?></div></td>
		<td valign="top" width="150"><?php echo CHtml::submitButton(' Search ', array('class'=>'button')); ?></td>
	  </tr>
	  <tr><td><?php echo $form->error($model,'keyword'); ?></td></tr>  
	 </table>
</fieldset>

<?php $this->endWidget(); ?>

</div><!-- form -->