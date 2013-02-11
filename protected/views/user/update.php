<?php
$this->breadcrumbs=array(
	'Users'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$lblMenu = '';
	
$params = array('User'=>$model);
// now check the bizrule for this user
if (Yii::app()->user->checkAccess('updateSelf', $params) ) {
  $lblMenu .= "array('label'=>'View User', 'url'=>array('view', 'id'=>".$model->id.")), ";
}

if (Yii::app()->user->checkAccess('admin')) {
  $lblMenu .= "array('label'=>'List User', 'url'=>array('index')), ";
  $lblMenu .= "array('label'=>'Create User', 'url'=>array('create')), ";
  $lblMenu .= "array('label'=>'Manage User', 'url'=>array('admin')), ";
}

eval("\$arr = array($lblMenu);");
$this->menu = $arr;

/*$this->menu=array(
	array('label'=>'List User', 'url'=>array('index')),
	array('label'=>'Create User', 'url'=>array('create')),
	array('label'=>'View User', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage User', 'url'=>array('admin')),
);*/
?>

<h2>Update User #<?php echo $model->id; ?></h2>

<div id="frmcontainer">

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>

</div>