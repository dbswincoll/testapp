<?php
return array (
  'authenticated' => 
  array (
    'type' => 2,
    'description' => 'authenticated user',
    'bizRule' => 'return !Yii::app()->user->isGuest;',
    'data' => NULL,
    'children' => 
    array (
      0 => 'updateSelf',
    ),
  ),
  'guest' => 
  array (
    'type' => 2,
    'description' => 'guest user',
    'bizRule' => 'return Yii::app()->user->isGuest;',
    'data' => NULL,
  ),
  'admin' => 
  array (
    'type' => 2,
    'description' => 'administrator',
    'bizRule' => NULL,
    'data' => NULL,
    'assignments' => 
    array (
      22 => 
      array (
        'bizRule' => NULL,
        'data' => NULL,
      ),
    ),
  ),
  'updateSelf' => 
  array (
    'type' => 1,
    'description' => 'update own information',
    'bizRule' => 'return Yii::app()->user->id==$params["User"]->id;',
    'data' => NULL,
  ),
);
