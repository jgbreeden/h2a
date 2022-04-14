class Applicant {
	constructor(fname, lname, cphone, hphone, address, city, state, zip, status) {
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
	var h = document.getElementById("first");
	var k = document.getElementById("last");
	h.value = data.firstname
	k.value = data.lastname
	
	var table = document.getElementById("skillsTab");
	var contents = "<tr><th>Job skill</th><th>Years</th><th>Where</th></tr>";
	
	for (let i = 0; i < data.skills.length; i++){
		contents += "<tr><td>" + data.skills[i].skillenglish + "</td><td>"
					+ data.skills[i].years + "</td><td>" + data.skills[i].location
					+ "</td><td></td></tr>";
	}
	currappl = new Applicant(data.firstname, data.lastname, data.phonecell, data.phonehome, data.city, data.state, 0, "new")
	table.innerHTML = contents;
}
function cancelNewApp(){
	let a = document.getElementById("first").value = currappl.firstName;
	let b = document.getElementById("last").value = currappl.lastName;
	let c = document.getElementById("cphone").value = currappl.cellphone;
	let d = document.getElementById("hphone").value = currappl.homephone;
	let e = document.getElementById("address").value = currappl.address;
	let f = document.getElementById("city").value = currappl.city;
	let g = document.getElementById("state").value = currappl.state;
	let h = document.getElementById("zip").value = currappl.zip;
	let i = document.getElementById("status").value = currappl.status;
}