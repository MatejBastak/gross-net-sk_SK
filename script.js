var t;
var c=0;
var timer_is_on=0;

function fc_has_child_bonus()
    {
  	if (document.getElementById("has_child_bonus").value == 1)
			document.getElementById("child_bonus_span").style.display = "";
		else
			{
				document.getElementById("child_bonus_span").style.display = "none";
				document.getElementById("children_nr").value = "";
			}
    }

function fc_has_spouse_bonus()
    {
		if (document.getElementById("has_spouse_bonus").value == 1)
			document.getElementById("spouse_bonus_span").style.display = "";
		else
			{
				document.getElementById("spouse_bonus_span").style.display = "none";
				document.getElementById("spouse_income").value = "";
			}
    }

function fc_has_pension_bonus()
    {
		if (document.getElementById("has_pension_bonus").value == 1)
			document.getElementById("pension_bonus_span").style.display = "";
		else
			{
				document.getElementById("pension_bonus_span").style.display = "none";
				document.getElementById("pension").value = "";
			}
    }

function help_on(help_text,position,height,indent)
	{	
		stopCount();
		
		if ((document.getElementById("alert1").style.display != "none") && (position > 0))
			indent = indent + 27;

		if ((document.getElementById("has_child_bonus").value == 1) && (position > 3))
			indent = indent + 27;

		if ((document.getElementById("has_spouse_bonus").value == 1) && (position > 4))
			indent = indent + 27;

		if ((document.getElementById("has_pension_bonus").value == 1) && (position > 5))
			indent = indent + 27;

		if ((document.getElementById("alert2").style.display != "none") && (position > 1))
			indent = indent + 27;
			
		if ((document.getElementById("sent").value == "yes")  && (position >= 100))
			indent = indent + 22;
		
		if (position >= 100)
			position = position - 100;
		
		var top = indent + (position * height);
		document.getElementById("help_message_span").innerHTML = '<div class="help_message" style="top:' + top + 'px;"><p>' + help_text + '</p></div>';
	}

function timedCount()
	{
		if (c < 3)
			c = c + 1;
		else 
			document.getElementById("help_message_span").innerHTML = '';
		t = setTimeout("timedCount()",125)	
	}
	
function help_off()
	{
		c=0;
		if (!timer_is_on)
			{
				timer_is_on=1;
				timedCount();
			}
	}
	
function stopCount()
	{
		clearTimeout(t);
		timer_is_on=0;
	}
	
function check_input(destination)
	{
		var test1 = test2 = "OK";
		
		switch (destination)
			{
			case 1:
				x = document.getElementById("gross_wage");
				break;
			case 2:
				x = document.getElementById("children_nr");	
				break;
			case 3:
				x = document.getElementById("spouse_income");	
				break;
			case 4:
				x = document.getElementById("pension");	
				break;
			}
					
		x.value = x.value.replace(",", ".");
		x.value = x.value.replace(" ", "");
	
		if (isNaN(x.value))
			{
				x.value = 0;
				test1 = "NOK";
				alert_message = "Nezadali ste číslo v správnom formáte";
			}
		
		if (x.value < 0)
			{
				x.value = 0;
				test2 = "NOK";
				if (destination == 2)
					alert_message = "Počet detí nemôže byť záporný";
				else
					alert_message = "Hodnota nemôže byť nižšia ako 0";
			}
		
		if ((x.value > 270.16) && (destination == 3)) // 19.2 nasobok platneho zivotneho minima / 12
			{
				alert_message = "Tento mesiac nemáte nárok na uplatnenie tohto bonusu";
				document.getElementById("spouse_bonus_span").style.display = "none";
				document.getElementById("spouse_income").value = "";
				document.getElementById("has_spouse_bonus").value = 0;
				test3 = "NOK";
			}
		else
			test3 = "OK";
			
		if (x.value == "")
			x.value = 0;
		
		if ((test1 == "OK") && (test2 == "OK") && (test3 == "OK"))
			document.getElementById("alert" + destination).style.display = "none";
		else
			{
				document.getElementById("alert" + destination).style.display = "";
				document.getElementById("alert_message" + destination).innerHTML = alert_message;
			}
		
	}	
