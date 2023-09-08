function getApp(id)  {
    let xhr = new XMLHttpRequest();
	xhr.onload = function(){
		
			console.log(this.responseText);
			initData(JSON.parse(this.responseText));
		
	}
	xhr.open("get", "st_initapp2.php?id=" + id);
	xhr.send();

}

function initData(data) {

    document.getElementById("fname").value = data.firstname;
	document.getElementById("lname").value = data.lastname;
	document.getElementById("civilstate").value = data.lastname;
	document.getElementById("dateofbirth").value = data.lastname;
	document.getElementById("phonecell").value = data.lastname;
	document.getElementById("phonehome").value = data.lastname;
	document.getElementById("otherphonelast5years").value = data.lastname;
	document.getElementById("email").value = data.lastname;
	document.getElementById("otheremaillast5years").value = data.lastname;
	document.getElementById("address").value = data.lastname;
	document.getElementById("city").value = data.lastname;
	document.getElementById("state").value = data.lastname;
	document.getElementById("zipcode").value = data.lastname;
	document.getElementById("placeofbirth").value = data.lastname;
	if (data.gender == "male") {
		document.getElementById("male").checked = true;
	} else {
		document.getElementById("female").checked = true;
	}
	document.getElementById("ppnumber").value = data.ppnumber;
	document.getElementById("driverlicense").value = data.lastname;

}

let usp = new URLSearchParams(window.location.search);
//getApp(usp.get("id"));

var blankjob = document.getElementById("jobs").innerHTML;

function addjob() {
	document.getElementById("jobs").innerHTML += blankjob;

}

var blankschool = document.getElementById("school").innerHTML;

function addschool() {
	document.getElementById("school").innerHTML += blankschool;

}
let par = new URL(document.location).searchParams;
getApp(par.get("id"));

tabChange(0);

function setMarital(select) {
	console.log(select.value)
	if (select.value == "divorced") {
		showOption(select);
	} else {
		hideOption(select);
	}

}