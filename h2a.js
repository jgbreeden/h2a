class Applicant {
	constructor(id, fname, lname, cphone, hphone, address, city, state, zip, status) {
		this.id = id
		this.firstName = fname;
		this.lastName = lname;
		this.cellphone = cphone;
		this.homephone = hphone;
		this.address = address;
		this.city = city;
		this.state = state;
		this.zip = zip;
		this.status = status;
	}
	update() {
		var formData = new FormData(document.getElementById("newappform"));
		sendData(formData, "st_updateEmp.php", showResult);
	}
}
var currappl;
function st_show(tab) {
	var tabs = document.getElementsByClassName("st_tab");
	for (let i = 0; i < tabs.length; i++){
		tabs[i].style.display = "none";
	}
	document.getElementById(tab).style.display = "block";
}

function getData(phpFile, callBack){
	let xhr = new XMLHttpRequest();
	xhr.onreadystatechange = function(){
		if (this.readyState == 4 && this.status == 200) {
			callBack(JSON.parse(this.responseText));
		}
	}
	xhr.open("get", phpFile);
	xhr.send();
}

function getEmployees () {
	getData("st_getEmps.php", fillEmps);
}

function getEmp(row) {
	//console.log(row.firstChild.innerHTML);
	getData("st_getEmpDetail.php?id=" + row.firstChild.innerHTML, fillEmpDetail);
}

function fillEmps(data) {
	//data is an array of objects
	//loop and fill table
	var table = document.getElementById("newapptab");
	var contents = "<tr><th>First name</th><th>Last name</th><th>Phone number</th></tr>";
	
	for (let i = 0; i < data.length; i++){
		contents += "<tr onclick='getEmp(this)'><td class='id'>" + data[i].id + "</td><td>"
					+ data[i].firstname + "</td><td>" + data[i].lastname
					+ "</td><td></td></tr>";
	}
	table.innerHTML = contents;
	//console.log(data);
}

function fillEmpDetail(data) {
	var table = document.getElementById("skillsTab");
	var contents = "<tr><th>Job skill</th><th>Years</th><th>Where</th></tr>";
	
	for (let i = 0; i < data.skills.length; i++){
		contents += "<tr><td>" + data.skills[i].skillenglish + "</td><td>"
					+ data.skills[i].years + "</td><td>" + data.skills[i].location
					+ "</td><td></td></tr>";
	}
	currappl = new Applicant(data.id, data.firstname, data.lastname, data.cphone, data.hphone, data.address, data.city, data.state, 0, "new")
	table.innerHTML = contents;
	document.getElementById("id").value = data.id;
	resetNewApp();
}
function resetNewApp(){
	document.getElementById("first").value = currappl.firstName;
	document.getElementById("last").value = currappl.lastName;
	document.getElementById("cphone").value = currappl.cellphone;
	document.getElementById("hphone").value = currappl.homephone;
	document.getElementById("address").value = currappl.address;
	document.getElementById("city").value = currappl.city;
	document.getElementById("state").value = currappl.state;
	document.getElementById("zip").value = currappl.zip;
	document.getElementById("status").value = currappl.status;
}

function sendData(data, phpFile, callBack){
	let xhr = new XMLHttpRequest();
	xhr.onreadystatechange = function(){
		if (this.readyState == 4 && this.status == 200) {
			callBack(this.responseText);
		}
	}
	xhr.open("post", phpFile);
	xhr.send(data);
}

function showResult(data){
	document.getElementById("result").innerHTML = data
}