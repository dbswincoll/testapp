<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'searchs-form',
	'action'=>Yii::app()->createUrl($this->route),
        'method'=>'get',
	
	'enableClientValidation'=>true,
	'clientOptions'=>array(
		'validateOnSubmit'=>true,
	),
)); ?> 

    <?php echo CHtml::hiddenField('v', 's')."\n";?>

    <fieldset><legend>&nbsp;Choose the year and the subject area from the dropdown lists below:&nbsp;</legend>
	 <table>
	  <tr>
	   <td width="550" rowspan="2">
		<div class="row">
                <?php 
                               $datetimeArr = getdate(time());
                               $yy = $datetimeArr['year']-2000;
                               if ($datetimeArr["mon"] >= 8 && $datetimeArr["mon"] <= 12) { 
									  $yy0 = ($yy-1)."/".$yy;
                                      $yy1 = $yy."/".($yy+1);
                                      $yy2 = ($yy+1)."/".($yy+2);
                               } else {
							          $yy0 = ($yy-2)."/".($yy-1);
                                      $yy1 = ($yy-1)."/".($yy);
                                      $yy2 = $yy."/".($yy+1);
                               }
                               //echo $yy1 . "--". $yy2 . "<br/>";

                               //$opts = "'".$yy0."'=>'- Previous academic year: 20".$yy0." -','".$yy1."'=>'- Current academic year: 20".$yy1." -','".$yy2."'=>'- Next academic year: 20".$yy2." -'";
                               $opts = "'".$yy1."'=>'- Current academic year: 20".$yy1." -','".$yy2."'=>'- Next academic year: 20".$yy2." -'";
							   
                               eval("\$opts = array($opts);");
        					   echo $form->listBox($model,'year',$opts, array('id'=>'year','name'=>'year','class'=>'dropdown1','style'=>'width:550px !important', 'size'=>1));
                               //echo CHtml::dropDownList('year', '', $opts, array('id'=>'year','class'=>'dropdown1','style'=>'width:510px !important', 'size'=>1));
                ?>

                </div>
                <div class="row">
		           <?php //echo CHtml::dropDownList('subject', '', $model->subjectOptions, array('id'=>'subject','class'=>'dropdown1','style'=>'width:510px !important', 'size'=>1)); ?>
				   <?php echo $form->listBox($model,'subject', $model->subjectOptions, array('id'=>'subject','name'=>'subject','class'=>'dropdown1','style'=>'width:550px !important', 'size'=>1)); ?>
                </div>
          </td>
		  <td>&nbsp;</td>
         </tr>
        <tr valign="bottom">
          <td><?php echo CHtml::submitButton(' Go! ', array('class'=>'btngo')); ?></td>
	    </tr>

	 </table>
    </fieldset>

	<?php 			
	$this->widget('ext.tipsy.Tipsy', array(  
		'trigger' => 'focus',
		'items' => array(
				array('id' => '#year', 'fallback' => 'Select course academic year', 'gravity' => 'e'),
				array('id' => '#subject','fallback' => 'Select course subject area','gravity' => 'e'),
			),  
		)
	);
?>
<?php $this->endWidget(); ?>

</div><!-- form -->