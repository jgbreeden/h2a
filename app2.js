function getApp(id)  {
    let xhr = new XMLHttpRequest();
	xhr.onload = function(){
		if (this.responseText == "completed" ){
			deny();
		}
		else {
			console.log(this.responseText);
			initData(JSON.parse(this.responseText));
		}
		
	}
	xhr.open("get", "st_initapp2.php?id=" + id);
	xhr.send();

}
function deny() {
	document.querySelectorAll(".intro").forEach(div => div.classList.add("hidden"));
	document.getElementById("done").classList.remove("hidden");
}

function initData(data) {
    document.getElementById("fname").value = data.firstname;
	document.getElementById("lname").value = data.lastname;
	document.getElementById("maritalstatus").value = data.maritalstatus;
	document.getElementById("dateofbirth").value = data.dateofbirth;
	document.getElementById("phonecell").value = data.cphone;
	document.getElementById("phonehome").value = data.hphone;
	document.getElementById("email").value = data.email;
	document.getElementById("address").value = data.address;
	document.getElementById("city").value = data.city;
	document.getElementById("state").value = data.state;
	document.getElementById("zipcode").value = data.zip;
	document.getElementById("id").value = data.id;
	document.getElementById("ppcity").value = data.ppcity;
	document.getElementById("ppstate").value = data.ppstate;
	document.getElementById("ppissuedate").value = data.ppdateissue;
	document.getElementById("ovisas").value = data.ovisas;
	document.getElementById("ovisaissues").value = data.ovisaissues;
	document.getElementById("ovisarefused").value = data.ovisarefused;
	document.getElementById("olicense").value = data.olicense;
	document.getElementById("oustravel").value = data.oustravel;
	document.getElementById("odeported").value = data.odeported;
	document.getElementById("ofarmwork").value = data.ofarmwork;
	document.getElementById("ocrimes").value = data.ocrimes;

	//document.getElementById("placeofbirth").value = data.placeofbirth;
	if (data.gender == "male") {
		document.getElementById("male").checked = true;
	} else {
		document.getElementById("female").checked = true;
	}
	document.getElementById("ppnumber").value = data.ppnumber;
	//document.getElementById("driverlicense").value = data.lastname;

}

let usp = new URLSearchParams(window.location.search);
//getApp(usp.get("id"));

var blankjob = document.getElementById("jobs").innerHTML;

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

document.getElementById("addJobBtn").addEventListener("click", function(e){
    e.preventDefault();
	document.getElementById("jobs").innerHTML += blankjob;
})
tabChange(currentTab);

document.getElementById("addSchoolBtn").addEventListener("click", function(e){
    e.preventDefault();
	document.getElementById("school").innerHTML += blankjob;
	con
})
tabChange(currentTab);