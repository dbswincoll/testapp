<?php $this->beginContent('//layouts/main'); ?>
<div class="span-191">
	<div id="content">
		<?php echo $content; ?>
	</div><!-- content -->
</div>
<div class="span-51 last">
	<div id="sidebar">
		<?php
			$this->beginWidget('zii.widgets.CPortlet', array(
				'title'=>'User Management',
			));
			$this->widget('zii.widgets.CMenu', array(
				'items'=>$this->menu,
				'htmlOptions'=>array('class'=>'operations'),
			));	
			$this->endWidget();
		?>
		<div class="portlet" id="c0">
			<div class="portlet-decoration">
				<div class="portlet-title">Calendar</div>
			</div>
			<!-- Calendar starts here -->
            <script type="text/javascript">
                    addContentLoadListener( function() { 
			                             new CalendarJS().init("calendar");
	                                        } );
            </script>
			<div id="calendar" class="portlet-content">[Calendar JS by derletztekick.com]</div>
            <!-- End of calendar -->
		</div>			

	</div><!-- sidebar -->
</div>
<?php $this->endContent(); ?>