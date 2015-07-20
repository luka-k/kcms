/*
Author: Robert Hashemian
http://www.hashemian.com/

You can use this code in any manner so long as the author's
name, Web address and this disclaimer is kept intact.
********************************************************
Usage Sample:

<script language="JavaScript">
TargetDate = "12/31/2020 5:00 AM";
BackColor = "palegreen";
ForeColor = "navy";
CountActive = true;
CountStepper = -1;
LeadingZero = true;
DisplayFormat = "%%D%% Days, %%H%% Hours, %%M%% Minutes, %%S%% Seconds.";
FinishMessage = "It is finally here!";
</script>
<script language="JavaScript" src="http://scripts.hashemian.com/js/countdown.js"></script>
*/

var test2_timer1 = true;
var test2_timer2 = true;
var test2_timer3 = true;
var test2_timer4 = true;

function calcage(secs, num1, num2) {
  s = ((Math.floor(secs/num1))%num2).toString();
  if (LeadingZero && s.length < 2)
    s = "0" + s;
  return "<b>" + s + "</b>";
}

function CountBack(secs, test_id) {
  if (secs < 0) {
    document.getElementById("cntdwn"+test_id).innerHTML = FinishMessage;
	$('.test'+test_id).addClass('disabled');
	$('.btn'+test_id).removeClass('disabled');
	if (test_id == 2)
	{
		$('#test3_part2').show();
	}
	if (test_id >= 60)
	{
		$('#start'+(test_id-64)+'btn').show();
		$('.test'+test_id).addClass('disabled');
	}
    return;
  }
  DisplayStr = DisplayFormat.replace(/%%D%%/g, calcage(secs,86400,100000));
  DisplayStr = DisplayStr.replace(/%%H%%/g, calcage(secs,3600,24));
  DisplayStr = DisplayStr.replace(/%%M%%/g, calcage(secs,60,60));
  DisplayStr = DisplayStr.replace(/%%S%%/g, calcage(secs,1,60));
  document.getElementById("cntdwn"+test_id).innerHTML = DisplayStr;
  if (CountActive)
    setTimeout("CountBack(" + (secs+CountStepper) + ", "+test_id+")", SetTimeOutPeriod);
}

function CountForward(secs, test_id) {
  if (test_id == 1 && !test2_timer1) return;
  if (test_id == 2 && !test2_timer2) return;
  if (test_id == 3 && !test2_timer3) return;
  if (test_id == 4 && !test2_timer4) return;
  DisplayStr = DisplayFormat.replace(/%%D%%/g, calcage(secs,86400,100000));
  DisplayStr = DisplayStr.replace(/%%H%%/g, calcage(secs,3600,24));
  DisplayStr = DisplayStr.replace(/%%M%%/g, calcage(secs,60,60));
  DisplayStr = DisplayStr.replace(/%%S%%/g, calcage(secs,1,60));
  document.getElementById("cntfwd"+test_id).innerHTML = DisplayStr;
  if (CountActive)
    setTimeout("CountForward(" + (secs-CountStepper) + ", "+test_id+")", SetTimeOutPeriod);
}

if (typeof(TargetDate)=="undefined")
  TargetDate = "12/31/2020 5:00 AM";
if (typeof(DisplayFormat)=="undefined")
  DisplayFormat = "%%D%% Days, %%H%% Hours, %%M%% Minutes, %%S%% Seconds.";
if (typeof(CountActive)=="undefined")
  CountActive = true;
if (typeof(FinishMessage)=="undefined")
  FinishMessage = "";
if (typeof(CountStepper)!="number")
  CountStepper = -1;
if (typeof(LeadingZero)=="undefined")
  LeadingZero = true;

CountActive = true;
CountStepper = -1;
var SetTimeOutPeriod = (Math.abs(CountStepper)-1)*1000 + 990;
function doCountdown(seconds, test_id)
{
	TargetDate = Date.now()+1000*seconds;
	LeadingZero = true;
	DisplayFormat = "%%M%% : %%S%%";
	FinishMessage = "Время вышло!";
	CountStepper = Math.ceil(CountStepper);
	if (CountStepper == 0)
	  CountActive = false;
	var dthen = new Date(TargetDate);
	var dnow = new Date();
	if(CountStepper>0)
	  ddiff = new Date(dnow-dthen);
	else
	  ddiff = new Date(dthen-dnow);
	gsecs = Math.floor(ddiff.valueOf()/1000);
	CountBack(gsecs, test_id);
}
function doCountforward(test_id)
{
	TargetDate = Date.now();
	LeadingZero = true;
	DisplayFormat = "%%M%% : %%S%%";
	FinishMessage = "Время вышло!";
	CountStepper = Math.ceil(CountStepper);
	if (CountStepper == 0)
	  CountActive = false;
	var dthen = new Date(TargetDate);
	var dnow = new Date();
	if(CountStepper>0)
	  ddiff = new Date(dnow-dthen);
	else
	  ddiff = new Date(dthen-dnow);
	gsecs = Math.floor(ddiff.valueOf()/1000);
	CountForward(gsecs, test_id);
}