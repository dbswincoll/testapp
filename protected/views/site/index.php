<?php $this->pageTitle=Yii::app()->name; ?>

<h2>Welcome to <i><?php echo CHtml::encode(Yii::app()->name); ?></i></h2>

<p>Congratulations! You have successfully created your Yii application.</p>

<p>You may change the content of this page by modifying the following two files:</p>
<ul>
	<li>View file: <tt><?php echo __FILE__; ?></tt></li>
	<li>Layout file: <tt><?php echo $this->getLayoutFile('main'); ?></tt></li>
</ul>

<p>For more details on how to further develop this application, please read
the <a href="http://www.yiiframework.com/doc/">documentation</a>.
Feel free to ask in the <a href="http://www.yiiframework.com/forum/">forum</a>,
should you have any questions.</p>

<p>
Open yahoo.com in a popup window (800x500) positioned 50 pixels from the
top and left side of the screen.
</p>
<p>
    <?php $this->widget('ext.popup.JPopupWindow', array(
        'content'=>'open popup',
        'url'=>"http://www.yahoo.com",        
        'htmlOptions'=>array('title'=>"yahoo.com"),
        'options'=>array(
            'height'=>500,
            'width'=>800,
            'top'=>50,
            'left'=>50,
        ),
    )); ?><!-- popup -->
</p>
<p>
Open contact form of a Yii skeleton app
</p>
<p>
    <?php $this->widget('ext.popup.JPopupWindow', array(
        'tagName'=>'button',
        'content'=>'open contact form',
        'url'=>array('/site/contact'),        
        'options'=>array(
            'height'=>500,
            'width'=>800,
            'centerScreen'=>1,
        ),
    )); ?><!-- popup -->
</p>
