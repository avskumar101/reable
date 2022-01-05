
/***************************************************************************************
	JavaScript Calendar - Digital Christian Design
	//Script featured on and available at JavaScript Kit: http://www.javascriptkit.com
	// Functions
		changedate(): Moves to next or previous month or year, or current month depending on the button clicked.
		createCalendar(): Renders the calander into the page with links for each to fill the date form filds above.
			
***************************************************************************************/

var thisDate = 1;							// Tracks current date being written in calendar
var Month = new Array("JANUARY","FEBRUARY","MARCH","APRIL","MAY","JUNE","JULY","AUGUST","SEPTEMBER","OCTOBER","NOVEMBER","DECEMBER");
var today = new Date();							// Date object to store the current date
var todaysDay = today.getDay() + 1;					// Stores the current day number 1-7
var todaysDate = today.getDate();					// Stores the current numeric date within the month
var todaysMonth = today.getUTCMonth() + 1;				// Stores the current month 1-12
var todaysYear = today.getFullYear();					// Stores the current year
var monthNum = todaysMonth;						// Tracks the current month being displayed
var yearNum = todaysYear;						// Tracks the current year being displayed
var firstDate = new Date(String(monthNum)+"/1/"+String(yearNum));	// Object Storing the first day of the current month
var firstDay = firstDate.getUTCDay();					// Tracks the day number 1-7 of the first day of the current month
var lastDate = new Date(String(monthNum+1)+"/0/"+String(yearNum));	// Tracks the last date of the current month
var numbDays = 0;
var calendarString = "";
var eastermonth = 0;
var easterday = 0;


function changedate(buttonpressed) {
	if (buttonpressed == "prevyr") yearNum--;
	else if (buttonpressed == "nextyr") yearNum++;
	else if (buttonpressed == "prevmo") monthNum--;
	else if (buttonpressed == "nextmo") monthNum++;
	else  if (buttonpressed == "return") { 
		monthNum = todaysMonth;
		yearNum = todaysYear;
	}

	if (monthNum == 0) {
		monthNum = 12;
		yearNum--;
	}
	else if (monthNum == 13) {
		monthNum = 1;
		yearNum++
	}

	//lastDate = new Date(String(monthNum+1)+"/0/"+String(yearNum));
	lastDate = new Date(String(yearNum), String(monthNum), 0);
	numbDays = lastDate.getDate();
		
	firstDate = new Date(String(monthNum)+"/1/"+String(yearNum));
	firstDay = firstDate.getDay() + 1;
	createCalendar();
		
		
		
	return false;
}

function showcurrentdate(buttonpressed) {
	if (buttonpressed == "prevyr") yearNum--;
	else if (buttonpressed == "nextyr") yearNum++;
	else if (buttonpressed == "prevmo") monthNum--;
	else if (buttonpressed == "nextmo") monthNum++;
	else  if (buttonpressed == "return") { 
		monthNum = todaysMonth;
		yearNum = todaysYear;
	}

	if (monthNum == 0) {
		monthNum = 12;
		yearNum--;
	}
	else if (monthNum == 13) {
		monthNum = 1;
		yearNum++
	}

	lastDate = new Date(String(monthNum+1)+"/0/"+String(yearNum));
	numbDays = lastDate.getDate();
	firstDate = new Date(String(monthNum)+"/1/"+String(yearNum));
	firstDay = firstDate.getDay() + 1;
	createCalendar();
	return;
}
function easter(year) {
// feed in the year it returns the month and day of Easter using two GLOBAL variables: eastermonth and easterday
var a = year % 19;
var b = Math.floor(year/100);
var c = year % 100;
var d = Math.floor(b/4);
var e = b % 4;
var f = Math.floor((b+8) / 25);
var g = Math.floor((b-f+1) / 3);
var h = (19*a + b - d - g + 15) % 30;
var i = Math.floor(c/4);
var j = c % 4;
var k = (32 + 2*e + 2*i - h - j) % 7;
var m = Math.floor((a + 11*h + 22*k) / 451);
var month = Math.floor((h + k - 7*m + 114) / 31);
var day = ((h + k - 7*m +114) % 31) + 1;
eastermonth = month;
easterday = day;
}


function createCalendar() {
	calendarString = '';
	var daycounter = 0;
	calendarString += '<table border="0" width="100%" cellpadding="8" cellspacing="2">';
	calendarString += '<tr>';

//next previous
calendarString += '<td align=\"center\" width=\"50\" bgcolor=\"#37AA9B\" height=\"36\"><a id=\"fondcolr\" href=\"javascript:showgolden(' + daycounter + ',' + monthNum + ',' + yearNum + ',' + i + ',' + x + ')\" onClick=\"changedate(\'prevmo\');changemonth(\'\');changemonth(\'prevmo\');" name=\"PrevMo\" alt=\"Prev Mo\"\/> &lt;<\/a><\/td>';

calendarString += '<td id=\"fondcolr\" colspan=\"5\" bgcolor=\"#37AA9B\" align=\"center\" valign=\"center\" width=\"170\" height=\"28\"> <b>' + Month[monthNum-1] + '&nbsp;&nbsp;' + yearNum + '<\/b> <\/td>';

calendarString += '<td align=\"center\" width=\"50\" height=\"28\" bgcolor=\"#37AA9B\"><a id=\"fondcolr\" href=\"javascript:showgolden(' + daycounter + ',' + monthNum + ',' + yearNum + ',' + i + ',' + x + ')\" onClick=\"changedate(\'nextmo\');changemonth(\'\');changemonth(\'nextmo\');" name=\"NextMo\" alt=\"Next Mo\"\/> &gt; <\/a><\/td><\/tr>';
		
	calendarString += '<\/tr>';
	calendarString += '<tr>';
	calendarString += '<td bgcolor=\"#C3C3C3\" align=\"center\" valign=\"center\" width=\"40\" height=\"22\">Sun<\/td>';
	calendarString += '<td bgcolor=\"#C3C3C3\" align=\"center\" valign=\"center\" width=\"40\" height=\"22\">Mon<\/td>';
	calendarString += '<td bgcolor=\"#C3C3C3\" align=\"center\" valign=\"center\" width=\"40\" height=\"22\">Tue<\/td>';
	calendarString += '<td bgcolor=\"#C3C3C3\" align=\"center\" valign=\"center\" width=\"40\" height=\"22\">Wed<\/td>';
	calendarString += '<td bgcolor=\"#C3C3C3\" align=\"center\" valign=\"center\" width=\"40\" height=\"22\">Thu<\/td>';
	calendarString += '<td bgcolor=\"#C3C3C3\" align=\"center\" valign=\"center\" width=\"40\" height=\"22\">Fri<\/td>';
	calendarString += '<td bgcolor=\"#C3C3C3\" align=\"center\" valign=\"center\" width=\"40\" height=\"22\">Sat<\/td>';
	calendarString += '<\/tr>';

	thisDate == 1;

	for (var i = 1; i <= 6; i++) {
		calendarString += '<tr>';
		for (var x = 1; x <= 7; x++) {
			daycounter = (thisDate - firstDay)+1;
			
			thisDate++;

			if ((daycounter > numbDays) || (daycounter < 1)) {
		
				calendarString += '<td align=\"center\" bgcolor=\"#E5E5E5\" height=\"30\" width=\"40\">&nbsp;<\/td>';
			} else {

				if (checkgolden(daycounter,monthNum,yearNum,i,x)){
					
 					 calendarString += '<td align=\"center\" bgcolor=\"#80FF80\" height=\"30\" width=\"40\">' + daycounter + '<\/td>';
				} else {
				
					calendarString += '<td align=\"center\" bgcolor=\"#E5E5E5\" height=\"30\" width=\"40\">' + daycounter + '<\/td>';
					
				}
			}
		}
		calendarString += '<\/tr>';
	}
	
	
	
calendarString += '<tr>';

calendarString += '<td id=\"fondcolr\" colspan=\"7\" bgcolor=\"#37AA9B\" align=\"left\" valign=\"center\" width=\"170\" height=\"28\"><font color="white">Available = </font><span style="background-color:#80FF80;width:17px;height:20px;">&nbsp;&nbsp;&nbsp;</span><font color="white"> Unavailable = </font><span class="foo" style="background-color:#C3C3C3;width:10px;height:20px;">&nbsp;&nbsp;&nbsp;</span> <\/td>';

calendarString += '<\/tr>';

	var object=document.getElementById('calendar');
	object.innerHTML= calendarString;
	thisDate = 1;
}



function checkgolden(day,month,year,week,dayofweek) 
{
	var numgolden = 0;
	var floater = 0;
		
	  for (var i = 0; i < golden.length; i++)
	   {
		  
		  
		  //end date
	if(golden[i][6]!='1')
	{
	for(datnes=golden[i][2]; datnes <= golden[i][5]; datnes++)
			{  
		  if ((golden[i][0] == "W"))
		   {
		  if((datnes[i] == dayofweek)) numgolden++;
		   }
		  else if(golden[i][0] == "Y")
		   {
		  if ((datnes[i] == day) && (golden[i][1] == month)) numgolden++; 
		   }
		  else if (golden[i][0] == "F") 
		   {
		  if ((golden[i][1] == 3) && (datnes[i] == 0) && (golden[i][3] == 0) ) 
		   {
		  easter(year);
		  
		  if (easterday == day && eastermonth == month) numgolden++;
			  
		  } else {
					  
		  floater = floatingholiday(year,golden[i][1],datnes[i],golden[i][3]);
		  
		  if ((month == 5) && (golden[i][1] == 5) && (datnes == 4) && (golden[i][3] == 2))
		   {
		  if ((floater + 7 <= 31) && (day == floater + 7))
		   {
		  numgolden++;
		  } else
		  if ((floater + 7 > 31) && (day == floater)) numgolden++; }
			
		  else if ((golden[i][1] == month) && (floater == day)) numgolden++; }
		   }
	else if ((datnes == day) && (golden[i][1] == month) && (golden[i][3] == year) )
		   {
		  numgolden++; 
			}
			}
	if(golden[i][1]<golden[i][4])
	{
	
		 for(datnes=golden[i][2]; datnes <=31; datnes++)
			{  

		  if ((golden[i][0] == "W"))
		   {
		  if((datnes[i] == dayofweek)) numgolden++;
		   }
		  else if(golden[i][0] == "Y")
		   {
		  if ((datnes[i] == day) && (golden[i][1] == month)) numgolden++; 
		   }
		  else if (golden[i][0] == "F") 
		   {
		  if ((golden[i][1] == 3) && (datnes[i] == 0) && (golden[i][3] == 0) )  //end date fu
		   {
		  easter(year);
		  
		  if (easterday == day && eastermonth == month) numgolden++;
			  
		  } else {
					  
		  floater = floatingholiday(year,golden[i][1],datnes[i],golden[i][3]);
		  
		  if ((month == 5) && (golden[i][1] == 5) && (datnes == 4) && (golden[i][3] == 2)) 
		   {
		  if ((floater + 7 <= 31) && (day == floater + 7))
		   {
		  numgolden++;
		  } else
		  if ((floater + 7 > 31) && (day == floater)) numgolden++; }
			
		  else if ((golden[i][1] == month) && (floater == day)) numgolden++; }
		   }
	else if ((datnes == day) && (golden[i][1] == month) && (golden[i][3] == year))
		   {
		  numgolden++; 
			}
			}
			}
			if(golden[i][1]<golden[i][4])
			{
			
			var strdts=(golden[i][1] == month) && (golden[i][2]== day) && (golden[i][3]== year)
			 
			for(datness=strdts; datness <= golden[i][5]; datness++)
			{
			
			if ((golden[i][0] == "W"))
			   {
			  if((golden[i][5] == dayofweek)) numgolden++;
			   }
			  else if(golden[i][0] == "Y")
			   {
			  if ((datness == day) && (golden[i][4] == month)) numgolden++; 
			   }
			  else if (golden[i][0] == "F") 
			   {
			  if ((golden[i][4] == 3) && (datness == 0) && (golden[i][6] == 0) ) //start date fun
			   {
			  easter(year);
			  
			  if (easterday == day && eastermonth == month) numgolden++;
				  
			  } else {
						  
			  floater = floatingholiday(year,golden[i][1],datness,golden[i][6]);
			  
			  if ((month == 5) && (golden[i][4] == 5) && (datness == 4) && (golden[i][6] == 2))
			   {
			  if ((floater + 7 <= 31) && (day == floater + 7))
			   {
			  numgolden++;
			  } else
			  if ((floater + 7 > 31) && (day == floater)) numgolden++; }
				
			  else if ((golden[i][4] == month) && (floater == day)) numgolden++; }
			   }
		else if ((datness == day) && (golden[i][4] == month) && (golden[i][6] == year) )
			   {
			  numgolden++; 
					}
	}
	}
	
	if(monthNum>golden[i][1] && monthNum<golden[i][4])
	{
	
	for(datness_c=1; datness_c <= 31; datness_c++)
			{
			
		if ((golden[i][0] == "W"))
			   {
			  if((golden[i][5] == dayofweek)) numgolden++;
			   }
			  else if(golden[i][0] == "Y")
			   {
			  if ((datness_c == day) && (monthNum== month)) numgolden++; 
			   }
			  else if (golden[i][0] == "F") 
			   {
			  if ((monthNum== 3) && (datness_c == 0) && (golden[i][6] == 0) ) //start date fun
			   {
			  easter(year);
			  
			  if (easterday == day && eastermonth == month) numgolden++;
				  
			  } else {
						  
			  floater = floatingholiday(year,golden[i][1],datness_c,golden[i][6]);
			  
			  if ((month == 5) && (monthNum== 5) && (datness_c == 4) && (golden[i][6] == 2))
			   {
			  if ((floater + 7 <= 31) && (day == floater + 7))
			   {
			  numgolden++;
			  } else
			  if ((floater + 7 > 31) && (day == floater)) numgolden++; }
				
			  else if ((monthNum== month) && (floater == day)) numgolden++; }
			   }
		else if ((datness_c == day) && (monthNum== month) && (golden[i][6] == year) )
			   {
			  numgolden++; 
					}
	}
	}
	}
	
	//one date
	else
	{
	
			 if ((golden[i][0] == "W"))
			   {
			  if((golden[i][2] == dayofweek)) numgolden++;
			   }
			  else if(golden[i][0] == "Y")
			   {
			  if ((golden[i][2] == day) && (golden[i][1] == month)) numgolden++; 
			   }
			  else if (golden[i][0] == "F") 
			   {
			  if ((golden[i][1] == 3) && (golden[i][2] == 0) && (golden[i][3] == 0) ) //start date fun
			   {
			  easter(year);
			  
			  if (easterday == day && eastermonth == month) numgolden++;
				  
			  } else {
						  
			  floater = floatingholiday(year,golden[i][1],golden[i][2],golden[i][3]);
			  
			  if ((month == 5) && (golden[i][1] == 5) && (golden[i][2] == 4) && (golden[i][3] == 2))
			   {
			  if ((floater + 7 <= 31) && (day == floater + 7))
			   {
			  numgolden++;
			  } else
			  if ((floater + 7 > 31) && (day == floater)) numgolden++; }
				
			  else if ((golden[i][1] == month) && (floater == day)) numgolden++; }
			   }
		else if ((golden[i][2] == day) && (golden[i][1] == month) && (golden[i][3] == year) )
			   {
			  numgolden++; 
					}
	 }
}
	  if (numgolden == 0) {
	  return false;
	  } else {
	  return true;
	  } 
}

function showgoldenlist(day)
{
	 	
setTimeout(function(){displayfieldvalue(monthNum,yearNum,day)},1000);
}

function floatingholiday(targetyr,targetmo,cardinaloccurrence,targetday) {
var firstdate = new Date(String(targetmo)+"/1/"+String(targetyr));	// Object Storing the first day of the current month.
var firstday = firstdate.getUTCDay();	// The first day (0-6) of the target month.
var dayofmonth = 0;	// zero out our calendar day variable.

	targetday = targetday - 1;

	if (targetday >= firstday) {
		cardinaloccurrence--;	// Subtract 1 from cardinal day.
		dayofmonth = (cardinaloccurrence * 7) + ((targetday - firstday)+1);
	} else {
		dayofmonth = (cardinaloccurrence * 7) + ((targetday - firstday)+1);
	}
return dayofmonth;
}