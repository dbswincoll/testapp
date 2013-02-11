function pbar(){
	
    var count = 0;
	
    var count2 = 0;
	
    var step  = 10;
	
    var speed = 500;
	

    $('#progress').show();
	

    function progress() {
		
       $('#amount').text(count2+'');
		
       $('#progress').progressbar('option', 'value', count);
		
       count = count % 100;
		

       if(count2 < 1000) {
			
           count = count+step;
			
           count2 = count2+step;
			
           setTimeout(progress, speed);
		
       }
	
     }
	

     progress();

	


    /*$('.spinnerImg').toggle(0, function() {
	           
         //$('.spinnerImg').toggle(1000);
	   
         //setTimeout(hideSpinner, 1000);
	   
           hideSpinner();
    
       });*/
	

}



function hideSpinner() { 
    
         //alert('ok');   
    
         $('.spinnerImg').toggle();
	
         setTimeout(hideSpinner, 500);

    }


function JSClock() {  
                       //var month = new Array("January", "February", "March","April", "May", "June", "July", "August", "September","October", "November", "December");
                       var month = new Array("Jan", "Feb", "Mar","Apr", "May", "Jun", "Jul", "Aug", "Sep","Oct", "Nov", "Dec");
                       var weekday = new Array("Sun","Mon","Tue","Wed","Thu","Fri", "Sat");      
                       //var weekday = new Array("Sunday","Monday","Tuesday","Wednesday","Thursday","Friday","Saturday");  
  
                       var time = new Date();          
                       var hour = time.getHours();          
                       var minute = time.getMinutes();          
                       var second = time.getSeconds(); 
                                
                       var temp = "" + ((hour > 12) ? hour - 12 : hour);          
                       temp += ((minute < 10) ? ":0" : ":") + minute;          
                       temp += ((second < 10) ? ":0" : ":") + second;          
                       temp += (hour >= 12) ? " PM" : " AM"; 

                       var str = new String(time.getFullYear());  
                       temp2 = weekday[time.getDay()] + ", " + time.getDate() + " " + month[time.getMonth()] + " " + str.substring(2,4);

                       /*temp = weekday[time.getDay()] + "  " + temp;
                       var str = new String(time.getFullYear());
                       temp = time.getDate() +"/" + (time.getMonth()+1) + "/" + str.substring(2,4) + "  " + temp;*/
         
                       $('.jclock').text(temp);
                       $('.jdate').text(temp2);
          
                       id = setTimeout(JSClock,1000);
                   }
