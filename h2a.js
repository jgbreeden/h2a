class Employee {
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
}

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
	console.log(row.firstChild.innerHTML);
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