<?php

class SiteController extends Controller
{

	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column2-site';

	/**
	 * Declares class-based actions.
	 */
	public function actions()
	{
		return array(
			// captcha action renders the CAPTCHA image displayed on the contact page
			'captcha'=>array(
				'class'=>'CCaptchaAction',
				'backColor'=>0xFFFFFF,
			),
			// page action renders "static" pages stored under 'protected/views/site/pages'
			// They can be accessed via: index.php?r=site/page&view=FileName
			'page'=>array(
				'class'=>'CViewAction',
			),
		);
	}

	/**
	 * This is the default 'index' action that is invoked
	 * when an action is not explicitly requested by users.
	 */
	public function actionIndex()
	{
		// renders the view file 'protected/views/site/index.php'
		// using the default layout 'protected/views/layouts/main.php'
		
		//$this->render('index');
		
		$this->redirect(array('site/searchbb'));
	}

	/**
	 * This is the action to handle external exceptions.
	 */
	public function actionError()
	{
	    if($error=Yii::app()->errorHandler->error)
	    {
	    	if(Yii::app()->request->isAjaxRequest)
	    		echo $error['message'];
	    	else
	        	$this->render('error', $error);
	    }
	}

	/**
	 * This is the action to handle course suggestion list.
	 */
	public function actionSuggestCourse()
	{
		//echo SearchFormB::searchSC();
		//Yii::app()->end();
		
		$res =array();

		if (isset($_GET['term'])) {
			// http://www.yiiframework.com/doc/guide/database.dao
			                                        //$sql = "select c.long_description || ' - 20' || c.calocc_occurrence_code As label, ";
			//$sql = "select c.long_description || ' [' || to_char(c.fes_start_date, 'DD/MM/YY') || ' ' || c.fes_moa_code || ' ' || c.keywords || ']' As label, ";
			//$sql = "select c.long_description || ' [' || to_char(c.fes_start_date, 'DD/MM/YY') || ' ' || (CASE WHEN SUBSTR(c.fes_moa_code,1,2) = 'FT' THEN 'Full Time' WHEN SUBSTR(c.fes_moa_code,1,2) = 'UM' THEN '' ELSE 'Part Time' END) || ']' As label, ";
			$sql = "select c.long_description || ' [year: ' || c.calocc_occurrence_code || (CASE WHEN SUBSTR(c.fes_moa_code,1,2) = 'FT' THEN '-Full Time' WHEN SUBSTR(c.fes_moa_code,1,2) = 'UM' THEN '' ELSE '-Part Time' END) || ']' As label, ";

			//$sql = "select concat( c.long_description,' [',date_format(c.fes_start_date,'%d/%m/%y'),' ',c.fes_moa_code,']' ) As label, ";
 
                                                    //$sql.= "c.fes_uins_instance_code As code, ";
			$sql.= "c.uio_id As id ";
			$sql.= "from topics a, unit_instances b, unit_instance_occurrences c "; 
			$sql.= "where a.topic_code=b.topic_topic_code and b.fes_unit_instance_code=c.fes_uins_instance_code ";
			                                        //$sql.= "and lower(c.long_description) like '%".strtolower($_GET['term'])."%' ";
			$sql.= "and (lower(c.keywords) like :keyword or lower(c.long_description) like :keyword) "; //'%".strtolower($_GET['term'])."%' ";
			$sql.= "and a.sp_visible = 'Y' ";
			$sql.= "and c.status = 'ACTIVE' "; 
			                                                    //$sql.= "and c.fes_active = 'Y' ";
			$sql.= "and c.sp_visible = 'Y' ";                   //a flag that decides whether  a course to be published or not
			                                                    //$sql.= "and (sysdate - c.fes_start_date) <= 40 ";
            $sql.= "order by c.long_description Asc ";
			$command =Yii::app()->db->createCommand($sql);
			$keyword = "%".trim(strtolower($_GET['term']))."%";
			$command->bindParam(":keyword",$keyword,PDO::PARAM_STR);
			$res =$command->queryAll();
			
			if (empty($res)) {
				$res = array(array('label'=>'Sorry, no record found! Re-type another keyword.','id'=>''));
			}
		}
		echo CJSON::encode($res);
		Yii::app()->end();
	}
	
    /**
	 * Displays the resultsb page (search results for basic search form)
	 */
	public function actionResultsb()
	{
		$model=new SearchFormB;
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['SearchFormB'])) {
			/*foreach($_GET['SearchFormB'] as $name=>$value)
		      echo($name."-".$value."<br/>");
            exit();*/
			
			$model->attributes=$_GET['SearchFormB'];
        } else {
		    $model->keyword = $_GET['keyword'];
		}
		
		// display the basic search results page
		$this->render('results_bb',array('model'=>$model));					

	}

	/**
	 * Displays the searchb page (basic search for a course web page)
	 */
	public function actionSearchb()
	{
		$model=new SearchFormB;
					
		if(isset($_POST['SearchFormB']))
		{
			$model->attributes=$_POST['SearchFormB'];
						
			if($model->validate())
			{		
                /*echo "keyword: " . $model->keyword ."<br/>"; 
                exit();*/
       			
				// display the basic search results page
				//$this->render('results_bb',array('model'=>$model));		
                $this->redirect(array('site/resultsb','keyword'=>$model->keyword));				
			}
		} 
		else
		{
		    // display the basic search form
		    $this->render('searchb',array('model'=>$model));
		}
	}
	public function actionSearchbb()
	{
		$model=new SearchFormB;
					
		if(isset($_POST['id']))
		{
			$model->id=$_POST['id'];
			$model->keyword=$_POST['keyword'];	
			
			if($model->validate())
			{		
                /*echo "id: " . $model->id ."<br/>"; 
				echo "keyword: " . $model->keyword ."<br/>"; 
                exit();*/
       			
				//display the basic search results page				
                $this->redirect(array('site/crsview','id'=>$model->id,'keyword'=>$model->keyword,'v'=>$_POST['v']));				
			}
		} 
		elseif (isset($_GET['id']))
		{
			$model->id=$_GET['id'];
			$model->keyword=$_GET['keyword'];	
		}
		 
		// display the basic search form
		$this->render('searchbb',array('model'=>$model));	
	}
	
	/**
	 * Displays the searcha page (advance search for a course web page)
	 */
	public function actionSearcha()
	{
		$model=new SearchFormA;
		
		if(isset($_POST['code']))
		{
			$model->code = $_POST['code'];
			$model->title = $_POST['title'];
			$model->subject = $_POST['subject'];
			$model->qualification = $_POST['qualification'];
			//$model->location = $_POST['location'];
			//$model->year1 = $_POST['year1'];
			//$model->year2 = $_POST['year2'];
			$model->year = $_POST['year'];
			$model->sdate = $_POST['sdate'];
			$model->sdateop = $_POST['sdateop'];
			$model->shour = $_POST['shour'];
			$model->sminute = $_POST['sminute'];
			$model->stimeop = $_POST['stimeop'];
			$model->day = $_POST['day'];
		} 
		elseif(isset($_GET['code']))
		{
			$model->code = $_GET['code'];
			$model->title = $_GET['title'];
			$model->subject = $_GET['subject'];
			$model->qualification = $_GET['qualification'];
			//$model->location = $_GET['location'];
			//$model->year1 = $_GET['year1'];
			//$model->year2 = $_GET['year2'];
			$model->year = $_GET['year'];
			$model->sdate = $_GET['sdate'];
			$model->sdateop = $_GET['sdateop'];
			$model->shour = $_GET['shour'];
			$model->sminute = $_GET['sminute'];
			$model->stimeop = $_GET['stimeop'];
			$model->day = $_GET['day'];
			
			/*print_r($_GET);
			exit();*/
		}
       
		$this->render('searcha',array('model'=>$model));
	}

	/**
	 * Displays the searchs page (search for a course by subject area web page)
	 */
	public function actionSearchs()
	{
		$model=new SearchFormS;
			
		if(isset($_GET['subject']))
		{
		    /*foreach($_POST['SearchFormS'] as $name=>$value)
		      echo($name."-".$value."<br/>");
            exit();*/

			//$model->attributes=$_POST['SearchFormS'];
			$model->subject = $_GET['subject'];
			$model->year = $_GET['year'];
	
		} elseif (isset($_POST['subject']))
		{
		    $model->subject = $_POST['subject'];
			$model->year = $_POST['year'];
		}
		$this->render('searchs',array('model'=>$model));
	}	
	/**
	 * Displays the crs-view page (course details view web page)
	 */
	public function actionCrsview()
	{
		$model = new Course;
			
		if(isset($_GET['id']))
		{
			$model->id = $_GET['id'];
		} 
		
		$this->render('crsview',array('model'=>$model));
	}
	
	/**
	 * Displays the searcha page (advance search for a course web page)
	 */
	public function actionSearchq()
	{
		$model=new SearchFormQ;
		if(isset($_GET['qualification']))
		{
		    /*foreach($_POST['SearchFormS'] as $name=>$value)
		      echo($name."-".$value."<br/>");
            exit();*/

			//$model->attributes=$_POST['SearchFormS'];
			$model->qualification = $_GET['qualification'];
			$model->year = $_GET['year'];
	
		} elseif (isset($_POST['qualification']))
		{
		    $model->qualification = $_POST['qualification'];
			$model->year = $_POST['year'];
		}
		
		$this->render('searchq',array('model'=>$model));
	}
	/**
	 * Displays apply for a course form or go back to previous courses list
	 */ 
	public function actionApply()
	{
		//$model = new Apply;
			
		if(isset($_POST['back']))
		{
		    switch ($_POST['v']) {
				case 's':
                    $this->redirect(array('searchs','year'=>$_POST['year'], 'subject'=>$_POST['subject'], 'ajax'=>$_POST['ajax'],'page'=>$_POST['page']));
			        break;
				case 'b':
                    $this->redirect(array('resultsb','keyword'=>$_POST['keyword'], 'ajax'=>$_POST['ajax'],'page'=>$_POST['page']));
			        break;
				case 'bb':
                    $this->redirect(array('searchbb','id'=>$_POST['id'],'keyword'=>$_POST['keyword']));
			        break;
				case 'q':
                    $this->redirect(array('searchq','year'=>$_POST['year'], 'qualification'=>$_POST['qualification'], 'ajax'=>$_POST['ajax'],'page'=>$_POST['page']));
			        break;
				case 'a':
                    //$this->redirect(array('searcha','code'=>$_POST['code2'], 'title'=>$_POST['title'],'subject'=>$_POST['subject'],'qualification'=>$_POST['qualification'], 'location'=>$_POST['location'],'year1'=>$_POST['year1'],'year2'=>$_POST['year2'],'sdateop'=>$_POST['sdateop'],'sdate'=>$_POST['sdate'],'stimeop'=>$_POST['stimeop'],'shour'=>$_POST['shour'],'sminute'=>$_POST['sminute'],'day'=>$_POST['day'],'ajax'=>$_POST['ajax'],'page'=>$_POST['page']));
                    //$this->redirect(array('searcha','code'=>$_POST['code2'], 'title'=>$_POST['title'],'subject'=>$_POST['subject'],'qualification'=>$_POST['qualification'],'year1'=>$_POST['year1'],'year2'=>$_POST['year2'],'sdateop'=>$_POST['sdateop'],'sdate'=>$_POST['sdate'],'stimeop'=>$_POST['stimeop'],'shour'=>$_POST['shour'],'sminute'=>$_POST['sminute'],'day'=>$_POST['day'],'ajax'=>$_POST['ajax'],'page'=>$_POST['page']));
                    $this->redirect(array('searcha','code'=>$_POST['code2'], 'title'=>$_POST['title'],'subject'=>$_POST['subject'],'qualification'=>$_POST['qualification'],'year'=>$_POST['year'],'sdateop'=>$_POST['sdateop'],'sdate'=>$_POST['sdate'],'stimeop'=>$_POST['stimeop'],'shour'=>$_POST['shour'],'sminute'=>$_POST['sminute'],'day'=>$_POST['day'],'ajax'=>$_POST['ajax'],'page'=>$_POST['page']));
			        break;
            }
		} elseif(isset($_POST['apply'])) { 
			Yii::app()->request->redirect("http://ebs4courses.swindon-college.ac.uk/Redirect.ashx?Show=UIO&CourseCode=".$_POST['code']."&CaloccCode=".$_POST['year']);
		}
		
		//$this->render('crsview',array('model'=>$model));
	}
	/**
	 * Displays the contact page
	 */
	public function actionContact()
	{
		$model=new ContactForm;
		if(isset($_POST['ContactForm']))
		{
			$model->attributes=$_POST['ContactForm'];
			if($model->validate())
			{
				$headers="From: {$model->email}\r\nReply-To: {$model->email}";
				mail(Yii::app()->params['adminEmail'],$model->subject,$model->body,$headers);
				Yii::app()->user->setFlash('contact','Thank you for contacting us. We will respond to you as soon as possible.');
				$this->refresh();
			}
		}
		$this->render('contact',array('model'=>$model));
	}

	/**
	 * Displays the login page
	 */
	public function actionLogin()
	{
		$model=new LoginForm;

		// if it is ajax validation request
		if(isset($_POST['ajax']) && $_POST['ajax']==='login-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}

		// collect user input data
		if(isset($_POST['LoginForm']))
		{
			$model->attributes=$_POST['LoginForm'];
			// validate user input and redirect to the previous page if valid
			if($model->validate() && $model->login())
				$this->redirect(array('user/view','id'=>Yii::app()->user->id));
				
				                                               //$this->redirect(array('user/index'));
															  /*$this->redirect(array('site/page', 'view'=>'about')); */															  
				                                               /*$this->redirect(Yii::app()->user->returnUrl);*/
				
		}
		// display the login form
		$this->render('login',array('model'=>$model));
	}

	/**
	 * Logs out the current user and redirect to homepage.
	 */
	public function actionLogout()
	{
		Yii::app()->user->logout();
		$this->redirect(Yii::app()->homeUrl);
	}
}