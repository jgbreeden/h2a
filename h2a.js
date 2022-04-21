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

class Experience {
	constructor(id, skillsid, applicantsid, year, location, details, skillenglish) {
		this.id = id
		this.skillsid = skillsid;
		this.applicantsid = applicantsid;
		this.year = year;
		this.location = location;
		this.details = details;
		this.skillenglish = skillenglish;
	}
	
	update() {
		var formData = new FormData(document.getElementById("skillsForm"));
		sendData(formData, "st_updateSkill.php", showResult);
	}
	
	insert() {
		var formData = new FormData(document.getElementById("skillsForm"));
		sendData(formData, "st_insertSkill.php", showResult);
	}
	
}

var currappl;
var currskill = new Experience (0, "", 0, "", "", "", "");;
var skilllist = [];

function st_show(tab) {
	let tabs = document.getElementsByClassName("st_tab");
	for (let i = 0; i < tabs.length; i++){
		tabs[i].style.display = "none";
	}
	document.getElementById(tab).style.display = "block";
}

function getData(phpFile, callBack){
	let xhr = new XMLHttpRequest();
	xhr.onreadystatechange = function(){
		if (this.readyState == 4 && this.status == 200) {
			console.log(this.responseText);
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
	resetTable(document.getElementById("newapptab"));
	row.classList.add("selected");
}

function fillEmps(data) {
	//data is an array of objects
	//loop and fill table
	let table = document.getElementById("newapptab");
	let contents = "<tr><th>First name</th><th>Last name</th><th>Phone number</th></tr>";
	
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
		contents += "<tr onclick='showSkill(this)'><td class='id'>" + data.skills[i].exid + "</td><td>" + data.skills[i].skillenglish + "</td><td>"
					+ data.skills[i].years + "</td><td>" + data.skills[i].location + "</td><td class='id'>" + data.skills[i].skillsid
					+ "</td><td class='id'>" + data.skills[i].details + "</td></tr>";
	}
	currappl = new Applicant(data.id, data.firstname, data.lastname, data.cphone, data.hphone, data.address, data.city, data.state, 0, "new")
	currskill.applicantsid = currappl.id
	table.innerHTML = contents;
	document.getElementById("id").value = data.id;
	document.getElementById("apid").value = currappl.id;
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
	document.getElementById("result").innerHTML = data;
}

function showSkill(row){
	let cells = row.getElementsByTagName("td");
	currskill = new Experience (cells[0].innerHTML, cells[4].innerHTML, currappl.id, cells[2].innerHTML, cells[3].innerHTML, cells[5].innerHTML,cells[1].innerHTML);
	document.getElementById("skill").value = cells[4].innerHTML;
	document.getElementById("years").value = cells[2].innerHTML;
	document.getElementById("location").value = cells[3].innerHTML;
	document.getElementById("details").value = cells[5].innerHTML;
	document.getElementById("exid").value = cells[0].innerHTML;
	document.getElementById("apid").value = currappl.id;
	resetTable(document.getElementById("skillsTab"));
	row.classList.add("selected");
}

function resetTable(tabl){
	rows = tabl.getElementsByTagName("tr");
	for (let i = 0; i < rows.length; i++){
		rows[i].classList.remove("selected");
	}
}

function fillSkill(data){
	let options = document.getElementById("skill");
	let contents = "<option value=''></option>";
	for (let i = 0; i < data.length; i++){
		contents += "<option value='" + data[i].id + "'>" + data[i].skillenglish + "</option>"
	}
	options.innerHTML = contents;
}

function clearSkill(){
	document.getElementById("skill").value = "";
	document.getElementById("years").value = "";
	document.getElementById("location").value = "";
	document.getElementById("details").value = "";
	document.getElementById("exid").value = 0;
	document.getElementById("apid").value = currappl.id;
}

function saveSkill(){
	if (document.getElementById("exid").value == 0) {
		currskill.insert()
	} else {
		currskill.update()
	}
}