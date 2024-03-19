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
	let comma = (data.placeofbirth.indexOf(",") == -1)? data.placeofbirth.length: data.placeofbirth.indexOf(",");
	document.getElementById("placeofbirth").value = data.placeofbirth.substr(0, comma);
	document.getElementById("phonecell").value = data.cphone;
	document.getElementById("phonehome").value = data.hphone;
	document.getElementById("email").value = data.email;
	document.getElementById("address").value = data.address;
	document.getElementById("address2").value = data.address2;
	document.getElementById("city").value = data.city;
	document.getElementById("state").value = data.state;
	document.getElementById("zipcode").value = data.zip;
	document.getElementById("country").value = data.country;
	document.getElementById("id").value = data.id;
	document.getElementById("pptype").value = data.pptype;
	document.getElementById("ppcity").value = data.ppcity;
	document.getElementById("ppissuedate").value = data.ppdateissue;
	document.getElementById("ppduedate").value = data.ppdatedue;
	document.getElementById("ovisas").value = data.visas;
	document.getElementById("ovisaissues").value = data.visaissues;
	document.getElementById("ovisarefused").value = data.visarefused;
	document.getElementById("olicense").value = data.license;
	document.getElementById("oustravel").value = data.ustravel;
	document.getElementById("odeported").value = data.deported;
	document.getElementById("ofarmwork").value = data.farmwork;
	document.getElementById("ocrimes").value = data.crimes;
	document.getElementById("onotes").value = data.notes;

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
	let job = document.createElement("div");
	job.innerHTML = blankjob;
	document.getElementById("jobs").appendChild(job);
})
tabChange(currentTab);

document.getElementById("addSchoolBtn").addEventListener("click", function(e){
    e.preventDefault();
	let school = document.createElement("div");
	school.innerHTML = blankschool;
	document.getElementById("school").appendChild(school);
})
tabChange(currentTab);