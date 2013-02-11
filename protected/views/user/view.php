<?php
$this->breadcrumbs=array(
	'Users'=>array('index'),
	$model->id,
);

$lblMenu = '';
	
$params = array('User'=>$model);
// now check the bizrule for this user
if (Yii::app()->user->checkAccess('updateSelf', $params) ) {
  $lblMenu .= "array('label'=>'Update User', 'url'=>array('update', 'id'=>".$model->id.")), ";
}

if (Yii::app()->user->checkAccess('admin')) {
  $lblMenu .= "array('label'=>'List User', 'url'=>array('index')), ";
  $lblMenu .= "array('label'=>'Create User', 'url'=>array('create')), ";
  $lblMenu .= "array('label'=>'Delete User', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>".$model->id."),'confirm'=>'Are you sure you want to delete this item?')), ";
  $lblMenu .= "array('label'=>'Manage User', 'url'=>array('admin')), ";
}

eval("\$arr = array($lblMenu);");
$this->menu = $arr;

//print_r($arr);

/*$this->menu=array(
	array('label'=>'List User', 'url'=>array('index')),
	array('label'=>'Create User', 'url'=>array('create')),
	array('label'=>'Update User', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete User', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage User', 'url'=>array('admin')),
);*/
?>

<h2>View User #<?php echo $model->id; ?></h2>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'username',
		'password',
		'email',
	),
)); ?>
