<?php
$this->pageTitle=Yii::app()->name . ' - Find a Course';
$this->breadcrumbs=array(
	'Basic Search'=>array('searchbb'),
	'Course Detail',
);

Yii::app()->clientScript->registerScript('srchb', "  

$('#apply-form').submit(pbar);

");

?>

<h2>View Course Detail</h2>

<p class="infoicon2">
To apply for this course click on the button below and to go back to courses list click on "Back to list" button.
</p>

<div class="csstitle"><?php $title=$model->findCourseTitleById($model->id); echo($title['title']); ?></div>

<div class="div-detail-view">
<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model->findCourseById2($model->id),
	'attributes'=>array(

	        /*array(     
					 'name' => 'title',
					 'type'=>'raw',
					 'template'=>'{value}',
					 'value'=>CHtml::tag('caption', array('class'=>'csstitle'),$model->title),
             ),*/

			array(  
                     'name' => 'content', 
                     'type' => 'html',            
                     'label'=> 'Course Summary:',
                     //'value'=> str_replace(array("\r\n","\r","\n"), "<br/>", $model->content),
					 'value'=>(trim($model->content) != '') ? str_replace(array("\r\n","\r","\n"), "<br/>", $model->content) : null,
             ),    
	        /*array(     
                     'name' =>'enrol',          
                     'label'=>'CAN ENROL?',
             ),
			array(     
                     'name' =>'apply',          
                     'label'=>'CAN APPLY?',
             ),
			array(     
                     'name' =>'enquire',          
                     'label'=>'CAN ENQUIRE?',
             ),
	        array(     
                     'name' =>'ucas2',          
                     'label'=>'CAN UCAS?',
             ),
	        array(     
                     'name' =>'ucas',          
                     'label'=>'IS UCAS?',
             ), */
			 

            /*array(     
                     'name' =>'title',          
                     'label'=>'Course Title:',
					 'type' => 'raw',
					 'value'=>CHtml::label($model->title,'title1',array('class'=>'csstitle')),
             ),*/

			array(                                   
                     'label'=> 'Course Leaflet:',
                     'type' => 'raw',
                     /*'value'=>($model->filename != '') ? 'Please click '.CHtml::link("here", genNewPath($model->filename), array('target'=>'_blank')).' to view or download course leaflet.' : 'Not available!', */
					 'value' => $model->genLeafletLink($model->code.'.pdf'),
            ), 
			/*array(     
                     'name' =>'filename',          
                     'label'=>'Course Leaflet:',
            ),*/
            array(     
                     'name' =>'code',          
                     'label'=>'Course Code:',
            ),
			array(     
                     'type' =>'raw',          
                     'label'=>'UCAS/UKPASS Code:',
					 'value'=> ($model->ucascode == '') ? '<span class="null">Not UCAS/UKPASS course</span>' : $model->ucascode,
            ),

			array(     
                     'type' =>'raw',          
                     'label'=>'Course Qualification:',
					 'value'=> ($model->qual == '') ? null : $model->qual,
             ),
			 array(  
                     'name' => 'qual_descr', 
                     'type' => 'html',             
                     'label'=> 'Qualification Description:',
					 'value'=>(trim($model->qual_descr) != '') ? str_replace(array("\r\n","\r","\n"), "<br/>", $model->qual_descr) : null,
             ),
            /* array(     
                     'name' =>'id',          
                     'label'=>'Course ID:',
             ),*/

             array(  
                     /*'name' => 'year',*/             
                     'label'=> 'Academic Year:', 
					 'type' => 'raw', 
					 'value' => '20'.$model->year,
             ),   

             array(     
                     'name' =>'type',          
                     'label'=>'Study Type:',
             ),
			 array(  
                     'label'=> 'Dates (start - end):',
					 'type' => 'raw',
					 'value'=>$model->sdate.' - '.$model->edate,
             ),   

             /*array(  
                     'name' => 'sdate',             
                     'label'=> 'Start Date:',
             ),  
             array(  
                     'name' => 'edate',             
                     'label'=> 'End Date:',
             ), */  
			 array(  
                     'label'=> 'Times (start - end):',
					 'type' => 'raw',
					 'value'=>($model->stime != '' && $model->etime != '') ? $model->stime.' - '.$model->etime : null,
             ),   
			 
			 /*array(  
                     'name' => 'stime',             
                     'label'=> 'Start Time:',
             ),   
			 array(  
                     'name' => 'etime',             
                     'label'=> 'End Time:',
             ),*/   
             array(  
                     'name' => 'hours',             
                     'label'=> 'Hours per week:',
             ),    
             array(  
                     'name' => 'days',             
                     'label'=> 'Study Days:',
             ),   
             array(  
                     'name' => 'weeks',             
                     'label'=> 'Number of Weeks:',
             ),   
            array(  
                     'name' => 'fees',             
                     'label'=> 'Current Course Fees:',
					 'type' => 'raw',
					 'value'=> ($model->fees == '') ? '<span class="null">To be confirmed</span>' : Yii::app()->params->currency.''.Yii::app()->format->number($model->fees),
					 //'value'=> ($model->fees == '' || $model->year=='13/14') ? '<span class="null">To be confirmed</span>' : Yii::app()->params->currency.' '.Yii::app()->format->number($model->fees),
					 //'value'=> ($model->fees == '') ? Yii::app()->params->currency.' 0' : Yii::app()->params->currency.' '.Yii::app()->format->number($model->fees),
	        ),  

             array(                                   
                     'label'=> 'Location:',
                     'type' => 'raw',
                     'value'=>(trim($model->postcode) != '') ? CHtml::link($model->location, "http://maps.google.co.uk/maps?q=".$model->postcode, array('target'=>'_blank')) : null, 
             ), 
             array(  
                     'name' => 'entry_req', 
                     'type' => 'html',             
                     'label'=> 'Entry Requirements:',
                     //'value'=> str_replace(array("\r\n","\r","\n"), "<br/>", $model->entry_req),
					 'value'=>(trim($model->entry_req) != '') ? str_replace(array("\r\n","\r","\n"), "<br/>", $model->entry_req) : null,
             ),              
			 array(  
                     'name' => 'need_to_bring', 
                     'type' => 'html',             
                     'label'=> 'What Do I Need To Bring?',
					 'value'=>(trim($model->need_to_bring) != '') ? str_replace(array("\r\n","\r","\n"), "<br/>", $model->need_to_bring) : null,
             ), 
			 array(  
                     'name' => 'exam_info', 
                     'type' => 'html',             
                     'label'=> 'Assessment/Exam Information',
					 'value'=>(trim($model->exam_info) != '') ? str_replace(array("\r\n","\r","\n"), "<br/>", $model->exam_info) : null,
             ), 
			 array(  
                     'name' => 'extra_costs', 
                     'type' => 'html',             
                     'label'=> 'Any Extra Costs?',
					 'value'=>(trim($model->extra_costs) != '') ? str_replace(array("\r\n","\r","\n","£","#"), array("<br/>","<br/>","<br/>",Yii::app()->params->currency,Yii::app()->params->currency), $model->extra_costs) : null,
             ), 
			 array(  
                     'name' => 'other_info', 
                     'type' => 'html',             
                     'label'=> 'Other Information:',
					 'value'=>(trim($model->other_info) != '') ? str_replace(array("\r\n","\r","\n"), "<br/>", $model->other_info) : null,
             ), 
			 array(  
                     'name' => 'can_do_next', 
                     'type' => 'html',             
                     'label'=> 'What Can I Do Next?',
					 'value'=>(trim($model->can_do_next) != '') ? str_replace(array("\r\n","\r","\n"), "<br/>", $model->can_do_next) : null,
             ), 
			 array(  
                     'name' => 'how_to_apply', 
                     'type' => 'html',             
                     'label'=> 'How To Apply?',
					 'value'=>(trim($model->how_to_apply) != '') ? str_replace(array("\r\n","\r","\n"), "<br/>", $model->how_to_apply) : null,
             ),  
            
	),
)); ?>

</div> <!-- end of div-detail-view //-->

<div class="form wide">

<?php $form=$this->beginWidget('CActiveForm', array(
	
        'id'=>'apply-form',
	
        'action'=>Yii::app()->createUrl('site/apply'),
        'method'=>'post',

      )
); ?>

<?php echo CHtml::hiddenField('enrol', $model->enrol)."\n";?>
<?php echo CHtml::hiddenField('apply', $model->apply)."\n";?>
<?php //echo CHtml::hiddenField('enquire', $model->enquire)."\n";?>
<?php echo CHtml::hiddenField('ucas', $model->ucas)."\n";?>
<?php //echo CHtml::hiddenField('ucas2', $model->ucas2)."\n";?>
<?php echo CHtml::hiddenField('code', $model->code)."\n";?>
<?php echo CHtml::hiddenField('year', $model->year)."\n";?>

<?php if(isset($_GET['id'])) {echo CHtml::hiddenField('id', $_GET['id'])."\n";}?>
<?php if(isset($_GET['v'])) {echo CHtml::hiddenField('v', $_GET['v'])."\n";}?>
<?php if(isset($_GET['keyword'])) {echo CHtml::hiddenField('keyword', $_GET['keyword'])."\n";}?>

<?php if(isset($_GET['code'])) {echo CHtml::hiddenField('code2', $_GET['code'])."\n";}?>
<?php if(isset($_GET['title'])) {echo CHtml::hiddenField('title', $_GET['title'])."\n";}?>
<?php if(isset($_GET['subject'])) {echo CHtml::hiddenField('subject', $_GET['subject'])."\n";}?>
<?php if(isset($_GET['qualification'])) {echo CHtml::hiddenField('qualification', $_GET['qualification'])."\n";}?>
<?php //if(isset($_GET['location'])) {echo CHtml::hiddenField('location', $_GET['location'])."\n";}?>
<?php //if(isset($_GET['year1'])) {echo CHtml::hiddenField('year1', $_GET['year1'])."\n";}?>
<?php //if(isset($_GET['year2'])) {echo CHtml::hiddenField('year2', $_GET['year2'])."\n";}?>
<?php if(isset($_GET['sdateop'])) {echo CHtml::hiddenField('sdateop', $_GET['sdateop'])."\n";}?>
<?php if(isset($_GET['sdate'])) {echo CHtml::hiddenField('sdate', $_GET['sdate'])."\n";}?>
<?php if(isset($_GET['stimeop'])) {echo CHtml::hiddenField('stimeop', $_GET['stimeop'])."\n";}?>
<?php if(isset($_GET['shour'])) {echo CHtml::hiddenField('shour', $_GET['shour'])."\n";}?>
<?php if(isset($_GET['sminute'])) {echo CHtml::hiddenField('sminute', $_GET['sminute'])."\n";}?>
<?php if(isset($_GET['day'])) {echo CHtml::hiddenField('day', $_GET['day'])."\n";}?>
<?php if(isset($_GET['ajax'])) {echo CHtml::hiddenField('ajax', $_GET['ajax'])."\n";}?>
<?php if(isset($_GET['page'])) {echo CHtml::hiddenField('page', $_GET['page'])."\n";}?>

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
        <div class="row buttons" style="text-align:center">
		
          <?php echo CHtml::submitButton(' Back to list ', array('name'=>'back','class'=>'button') ); ?>&nbsp;
		
          <?php if ($model->enrol == 'Y') {
					echo CHtml::submitButton('  Enrol now  ', array('name'=>'apply','class'=>'button') );
				} elseif ($model->apply == 'Y') {
					echo CHtml::submitButton('  Apply now  ', array('name'=>'apply','class'=>'button') );
				} elseif ($model->ucas == 'HEFC' || $model->ucas == 'FRANHEB' || $model->ucas == 'FRANHEO') {
					echo CHtml::button(' How to Apply? ', array('id'=>'applytoucas','class'=>'button','onclick'=>"$('#mymodal3').dialog('open'); return false;") );

				/*} elseif ($model->enquire == 'Y') {
					echo CHtml::submitButton('  Enquire now  ', array('name'=>'apply','class'=>'button') );*/
				} else {
					echo CHtml::button(' How to Apply? ', array('id'=>'howtoapply','class'=>'button','onclick'=>"$('#mymodal2').dialog('open'); return false;") );
				} 
		  ?>

        </div>



<fieldset><legend></legend>
For more information you can speak to an advisor call 0800 731 2250 or click <a href="http://www.swindon-college.ac.uk/contact/" target="_blank">here</a> to use our online form enquiry.
</fieldset> 

<?php $this->endWidget(); ?>

</div><!-- form -->

<?php 	

	$this->beginWidget('zii.widgets.jui.CJuiDialog', array(
    'id'=>'mymodal2',
    'options'=>array(
        'title'=>'Information Message',
        'width'=>400,
        'height'=>270,
        'autoOpen'=>false,
		//'show'=> 'blind',
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
    //echo 'To find out how to apply please call us on the phone number (if any) provided on the course summary or call an advisor on <b>0800 731 2250</b> or click <a href="http://www.swindon-college.ac.uk/contact/" target="_blank">here</a> to use our online form enquiry.';
    //echo 'A and AS Levels can be studied in addition to your main college course. Please discuss your options with the tutor at your course interview. If you would like any further information, please contact our Student Services team on <b>0800 731 2250</b> or click <a href="http://www.swindon-college.ac.uk/contact/" target="_blank">here</a> to email your enquiry.';
    if ($model->how_to_apply != '') {
		echo $model->how_to_apply;
	} else {
		echo 'Please contact our Student Services team on <b>0800 731 2250</b> or click <a href="http://www.swindon-college.ac.uk/contact/" target="_blank">here</a> to email your enquiry.';
	}
	
	$this->endWidget('zii.widgets.jui.CJuiDialog');

	$this->beginWidget('zii.widgets.jui.CJuiDialog', array(
    'id'=>'mymodal3',
    'options'=>array(
        'title'=>'Information Message',
        'width'=>400,
        'height'=>200,
        'autoOpen'=>false,
		//'show'=> 'blind',
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
    
	if (strlen($model->ucascode) == 4){
		echo 'To apply via UCAS (for BAs, BSCs, FDa, FDSc, HND) click <a href="http://search.ucas.com/cgi-bin/hsrun/search/search/search.hjx;start=search.HsCodeSearch.run?w=H" target="_blank">here</a>. Please use the UCAS course code provided.';
	} else {
		echo 'To apply via UKPASS (for MAs only) click <a href="http://ukpass.prospects.ac.uk/pgsearch/UKPASSCourse" target="_blank">here</a>. Please use the UKPASS course code provided.';
	}
	$this->endWidget('zii.widgets.jui.CJuiDialog');
	
?>

