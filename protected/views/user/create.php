<?php
$this->breadcrumbs=array(
	'Users'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List User', 'url'=>array('index')),
	array('label'=>'Manage User', 'url'=>array('admin')),
);
?>

<h2>Create User</h2>

<div id="frmcontainer">

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>

</div>
