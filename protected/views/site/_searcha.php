<div class="form wide">

<?php $form=$this->beginWidget('CActiveForm', array(  
    'action'=>Yii::app()->createUrl($this->route),
	'id'=>'searcha-form',
	'method'=>'get',
	'enableClientValidation'=>true,
	'clientOptions'=>array(
		'validateOnSubmit'=>true,
	),
)); ?>

	<!-- <p class="note">Fields with <span class="required">*</span> are required.</p> -->
	<?php //echo $form->errorSummary($model); ?>

	<?php echo CHtml::hiddenField('v', 'a')."\n";?>
	
	<fieldset><legend></legend>

	<div class="row">
		<?php echo $form->labelEx($model,'code'); ?>
		<?php echo $form->textField($model,'code',array('name'=>'code','title'=>'Enter some characters of course code','size'=>17,'maxlength'=>15)); ?>
	</div>
	<div class="row">
		<?php echo $form->labelEx($model,'title'); ?>
		<?php echo $form->textField($model,'title',array('name'=>'title','title'=>'Enter some characters of course title','class'=>'size','style'=>'width:475px','maxlength'=>128)); ?>
	</div>
	<div class="row">
		<?php echo $form->labelEx($model,'subject'); ?>
		<?php //echo CHtml::dropDownList('subject', '', SearchFormS::getSubjectOptions("Any Subject"), array('title'=>'Select course subject area','class'=>'dropdown1','style'=>'width:480px !important', 'size'=>1)); ?>
		<?php echo $form->listBox($model,'subject',SearchFormS::getSubjectOptions("Any Subject"), array('name'=>'subject','title'=>'Select course subject area','class'=>'dropdown1','style'=>'width:480px !important', 'size'=>1)); ?>

	</div>
	<div class="row">
		<?php echo $form->labelEx($model,'qualification'); ?>
		<?php //echo CHtml::dropDownList('qualification', '', SearchFormQ::getQualificationOptions("Any Qualification"), array('title'=>'Select course qualification','class'=>'dropdown1','style'=>'width:480px !important', 'size'=>1)); ?>
		<?php echo $form->listBox($model,'qualification', SearchFormQ::getQualificationOptions("Any Qualification"), array('name'=>'qualification','title'=>'Select course qualification','class'=>'dropdown1','style'=>'width:480px !important', 'size'=>1)); ?>
	</div>
	<!-- no need for location 
	<div class="row">
		<?php //echo $form->labelEx($model,'location'); ?>
		<?php       //echo CHtml::dropDownList('location', '', $model->locationOptions, array('title'=>'Select course location','class'=>'dropdown1','style'=>'width:480px !important', 'size'=>1)); ?>
		<?php //echo $form->listBox($model,'location', $model->locationOptions, array('name'=>'location','title'=>'Select course location','class'=>'dropdown1','style'=>'width:480px !important', 'size'=>1)); ?>
	</div>
	//-->
	<div class="row">
		<?php echo $form->labelEx($model,'year'); ?>
		<?php //echo "20".$form->textField($model,'year1',array('name'=>'year1','title'=>'Enter two digits start academic year (ex. 09, 10)','size'=>2,'maxlength'=>2)); ?>
		<?php //echo "20".$form->textField($model,'year2',array('name'=>'year2','title'=>'Enter two digits end academic year (ex. 09, 10)','size'=>2,'maxlength'=>2)); ?>
		<?php echo $form->listBox($model,'year',$model->getAcademicYearOptions("Any Year"), array('name'=>'year','title'=>'Select course academic year','class'=>'dropdown1','style'=>'width:145px !important', 'size'=>1)); ?>        
	</div>	
	<div class="row">
		<?php echo $form->labelEx($model,'sdate'); ?>
		<?php echo $form->listBox($model,'sdateop',array('0'=>' = ','5'=>'!=','1'=>' > ','2'=>'>=','3'=>'<','4'=>'<='), array('name'=>'sdateop','title'=>'Enter start date search operation','size'=>1)); ?>&nbsp;
		<?php //echo $form->textField($model,'sdate',array('size'=>11,'maxlength'=>10)); ?>
		<?php $this->widget('zii.widgets.jui.CJuiDatePicker', array(
				/*'model'=>$model,
				'attribute'=>'sdate',
				'value'=>$model->sdate,*/
				'name'=>'sdate',
				// additional javascript options for the date picker plugin
				'options'=>array(
						'showAnim'=>'fold',
						'showButtonPanel'=>false,
						'autoSize'=>true,
						'dateFormat'=>'dd-mm-yy',
						/*'defaultDate'=>$model->sdate,*/
				),
			)); 
		?>
		<?php echo CHtml::image(
            Yii::app()->baseUrl.'/images/icon/icon_help2.gif', '', array(
            'id' => 'sdatetip',
            'title' => 'Click on the input textbox to select a start date',
			));
        ?>
	</div>	
	<div class="row">
		<?php echo $form->labelEx($model,'stime'); ?>
		<?php echo $form->listBox($model,'stimeop',array('0'=>' = ','5'=>'!=','1'=>' > ','2'=>'>=','3'=>'<','4'=>'<='), array('name'=>'stimeop','title'=>'Enter start time search operation','size'=>1)); ?>&nbsp;
		<?php echo $form->textField($model,'shour',array('name'=>'shour','title'=>'Enter start hour (ex. 09, 18)','size'=>1,'maxlength'=>2)); ?>&nbsp;:&nbsp;
		<?php echo $form->textField($model,'sminute',array('name'=>'sminute','title'=>'Enter start minute (ex. 00, 30)','size'=>1,'maxlength'=>2)); ?>
	</div>	
	<div class="row">
		<?php echo $form->labelEx($model,'day'); ?>
		<?php echo $form->listBox($model,'day',array('empty'=>'- Any Day -','Mo'=>' Monday ','Tu'=>' Tuesday ','We'=>' Wednesday ','Th'=>' Thursday ','Fr'=>' Friday ','Sa'=>' Saturday '), array('name'=>'day','title'=>'Select your day','class'=>'dropdown1','style'=>'width:145px', 'size'=>1)); ?>
	</div>	
	<div class="row buttons" style="text-align:left">
		<?php //echo CHtml::resetButton ('  Clear  ', array('class'=>'button')); ?>
		<?php echo CHtml::submitButton('    Search    ', array('name'=>'submita','id'=>'submita','class'=>'button')); ?>
	</div>

	</fieldset>
	
<?php $this->endWidget(); ?>

</div><!-- form -->