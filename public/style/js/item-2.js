$(function(){
  var deadline = addDaysToDate(new Date(), 3).getTime();
var daysSpan = document.getElementById('days');
var hoursSpan = document.getElementById('hours');
var minutesSpan = document.getElementById('minutes');
var secondsSpan = document.getElementById('seconds');

if(document.getElementById('expired') !== null) {
  updateClock(deadline);
}
var interval = setInterval(updateClock, 1000);

function addDaysToDate(startDate, numberOfDays) {
  return new Date(
    startDate.getFullYear(),
    startDate.getMonth(),
    startDate.getDate() + numberOfDays,
    startDate.getHours(),
    startDate.getMinutes(),
    startDate.getSeconds()
  );
}

function getRemainingTime(deadline) {
  var total = deadline - new Date().getTime();
  
  if (isNaN(total)) {
    return false;
  }
  
  var seconds = Math.floor( (total / 1000) % 60 );
  var minutes = Math.floor( (total / 1000 / 60) % 60 );
  var hours = Math.floor( (total / (1000 * 60 * 60)) % 24 );
  var days = Math.floor( total / (1000 * 60 * 60 * 24) );
  
  return {
    'total': total,
    'days': days,
    'hours': hours,
    'minutes': minutes,
    'seconds': seconds
  };
}

function updateClock() {
  var remainingTime = getRemainingTime(deadline);
  
  if (remainingTime.total <= 0) {
    clearInterval(interval);
    
    document.getElementById('expired').classList.add('show');
    
    return false;
  } else if (!remainingTime) {
    return false;
  }
  if(document.getElementById('expired') !== null) {
    daysSpan.innerText = addLeadingZeros(remainingTime.days);
    hoursSpan.innerText = addLeadingZeros(remainingTime.hours);
    minutesSpan.innerText = addLeadingZeros(remainingTime.minutes);
    secondsSpan.innerText = addLeadingZeros(remainingTime.seconds);
  }
}

function addLeadingZeros(time) {
  return ('0' + time).slice(-2);
}

  
});