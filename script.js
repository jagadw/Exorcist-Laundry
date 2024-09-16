function show() {
    var x = document.querySelector(".corenav");
    if (x.className === "corenav") {
        x.className += " show";
    } else {
        x.className = "corenav";
    }
}
function showdropdown() {
    var x = document.querySelector(".dropdowncontent");
    if (x.className === "dropdowncontent") {
        x.className += " show";
    } else {
        x.className = "dropdowncontent";
    }
}
var timewidgettime = document.querySelector('#currenttime');
function time(){
	function twodigits(i){
		if(i<10){
			i = "0" + i;
		}
		return i;
	}
	var currenttime = new Date();
	var currenthour = currenttime.getHours();
	var currentminute = currenttime.getMinutes();
	var currentsecond = currenttime.getSeconds();
	timewidgettime.textContent = twodigits(currenthour) + ":" + twodigits(currentminute) + ":" + twodigits(currentsecond);
};
setInterval(time,1000);
