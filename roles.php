<?php

$yii=dirname(__FILE__).'/../framework/yii.php';
$config=dirname(__FILE__).'/protected/config/main.php';

require_once($yii);

Yii::createWebApplication($config)->run();

$auth=Yii::app()->authManager;
 
$bizRule='return !Yii::app()->user->isGuest;'; 

$auth->createRole('authenticated', 'authenticated user', $bizRule); 

$bizRule='return Yii::app()->user->isGuest;'; 

$auth->createRole('guest', 'guest user', $bizRule);
 
$role = $auth->createRole('admin', 'administrator'); 

$auth->assign('admin',22); // adding admin to first user created 

$bizRule = 'return Yii::app()->user->id==$params["User"]->id;'; 

$auth->createTask('updateSelf', 'update own information', $bizRule); 

$role = $auth->getAuthItem('authenticated'); // pull up the authenticated role 

$role->addChild('updateSelf'); // assign updateSelf tasks to authenticated users 

$auth->save();






class m120305_163808_create_auth_tables extends CDbMigration
{

// Use safeUp/safeDown to do migration with transaction
public function safeUp()
{
$this->createTable('AuthItem', array(
'name' => 'varchar(64) not null primary key',
'type' => 'integer not null',
'description' => 'text',
'bizrule' => 'text',
'data' => 'text',
));

$this->createTable('AuthItemChild', array( 
'parent' => 'varchar(64) not null',
'child' => 'varchar(64) not null',
'primary key (`parent`, `child`)'
));
//$this->execute('alter table `AuthItemChild` add primary key(`parent`, `child`)');
$this->addForeignKey('fk_parent', 'AuthItemChild', 'parent', 'AuthItem', 'name', 'cascade', 'cascade');
$this->addForeignKey('fk_child', 'AuthItemChild', 'child', 'AuthItem', 'name', 'cascade', 'cascade' );

$this->createTable('AuthAssignment', array(
'itemname' => 'varchar(64) not null primary key',
'userid' => 'varchar(64) not null',
'bizrule' => 'text',
'data' => 'text',
));
$this->addForeignKey('fk_itemName', 'AuthAssignment', 'itemname', 'AuthItem', 'name', 'cascade', 'cascade');
$auth=Yii::app()->authManager;

$bizRule='return !Yii::app()->user->isGuest;';
$auth->createRole('authenticated', 'authenticated user', $bizRule);

$bizRule='return Yii::app()->user->isGuest;';
$auth->createRole('guest', 'guest user', $bizRule);

$role = $auth->createRole('admin', 'administrator');
$auth->assign('admin',1); // adding admin to first user created
$bizRule = 'return Yii::app()->user->id==$params["User"]->id;';
$auth->createTask('updateSelf', 'update own information', $bizRule);

$role = $auth->getAuthItem('authenticated'); // pull up the authenticated role
$role->addChild('updateSelf'); // assign updateSelf tasks to authenticated users
}

public function safeDown()
{
$this->dropTable('AuthItemChild');
$this->dropTable('AuthAssignment');
$this->dropTable('AuthItem');
}
}

?>
