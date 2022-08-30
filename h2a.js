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
	constructor(id, skillsid, applicantsid, year, location, details, skillenglish, skilltype) {
		this.id = id
		this.skillsid = skillsid;
		this.applicantsid = applicantsid;
		this.year = year;
		this.location = location;
		this.details = details;
		this.skillenglish = skillenglish;
		this.skilltype = skilltype;
	}
	

	update() {
		var formData;
		if (this.skilltype == "produce") {
			formData = new FormData(document.getElementById("skillsForm"));
			sendData(formData, "st_updateSkill.php", showResult);
		} else {
			formData = new FormData(document.getElementById("abilityForm"));
			sendData(formData, "st_updateAbility.php", showResult);
		}
	}
	
	insert() {
		var formData;
		if (this.skilltype == "produce") {
			formData = new FormData(document.getElementById("skillsForm"));
			sendData(formData, "st_insertSkill.php", showResult);
		} else {
			formData = new FormData(document.getElementById("abilityForm"));
			sendData(formData, "st_insertAbility.php", showResult);
		}
	}
	
}

class Issues  {
	constructor(id, skillsid, applicantsid, when, location, type, issueenglish, issuetype, whyhow, punished, punishtime, punishreason) {
		this.id = id
		this.skillsid = skillsid;
		this.applicantsid = applicantsid;
		this.when = when;
		this.location = location;
		this.type = type;
		this.issueenglish = issueenglish;
		this.issuetype = issuetype;
		this.whyhow = whyhow;
		this.punished = punished;
		this.punishtime = punishtime;
		this.punishreason = punishreason;
	}



	update() {
		var formData;
		if (this.skilltype == "document") {
			formData = new FormData(document.getElementById("docform"));
			sendData(formData, "st_updateDocs.php", showResult);
		} else {
			formData = new FormData(document.getElementById("healthsec"));
			sendData(formData, "st_updateDocs.php", showResult);
		}
	}
	
	insert() {
		var formData;
		if (this.issuetype == "document") {
			formData = new FormData(document.getElementById("docform"));
			sendData(formData, "st_insertDocs.php", showResult);		
		} else {
			formData = new FormData(document.getElementById("healthsec"));
			sendData(formData, "st_insertDocs.php", showResult);
		}
	}
}

var currappl;
var currskill = new Experience (0, "", 0, "", "", "", "", "produce");
var currability = new Experience (0, "", 0, "", "", "", "", "ability");
var currdoc = new Issues (0, "", 0, "", "", "", "", "document");
var currhealth = new Issues (0, "", 0, "", "", "", "", "health");
var currstatus = new Issues (0, "", 0, "", "", "", "", "status");
var skilllist = [];
var curdoc;

function st_show(tab) {
	let tabs = document.getElementsByClassName("st_tab");
	for (let i = 0; i < tabs.length; i++){
		tabs[i].style.display = "none";
	}
	document.getElementById("searchapp").style.display = "none";
	if (tab == "applicants"){
		document.getElementById("newapplicants").style.display = "block";
		document.getElementById("searchapp").style.display = "block";
	} else {
		document.getElementById(tab).style.display = "block";
	}
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

function getEmployees (stuff) {
	if (stuff != 'accepted'){
		getData("st_getEmps.php?stat=" + stuff, fillEmps);
	} else {
		let temp = document.getElementById("searchstat").value;
		getData("st_getEmps.php?stat=" + temp, fillEmps);
	}
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
					+ data[i].firstname + "</td><td>" + data[i].lastname + "</td><td>"
					+ data[i].cellphone + "</td><td></td></tr>";
	}
	table.innerHTML = contents;
	clearNewApp();
	//console.log(data);
}

function fillEmpDetail(data) {
	let table = document.getElementById("skillsTab");
	let contents = "<tr><th>Job skill</th><th>Years</th><th>Where</th></tr>";
	for (let i = 0; i < data.skills.length; i++){
		contents += "<tr onclick='showSkill(this)'><td class='id'>" + data.skills[i].exid + "</td><td>" + data.skills[i].skillenglish + "</td><td>"
					+ data.skills[i].years + "</td><td>" + data.skills[i].location + "</td><td class='id'>" + data.skills[i].skillsid
					+ "</td><td class='id'>" + data.skills[i].details + "</td></tr>";
	}
	let table2 = document.getElementById("abilityTab");
	let contents2 = "<tr><th>Job ability</th><th>Years</th><th>Where</th></tr>";
	for (let i = 0; i < data.ability.length; i++){
		contents2 += "<tr onclick='showAbility2(this)'><td class='id'>" + data.ability[i].abid + "</td><td>" + data.ability[i].abeng + "</td><td>"
					+ data.ability[i].years + "</td><td>" + data.ability[i].location + "</td><td class='id'>" + data.ability[i].percent
					+ "</td><td class='id'>" + data.ability[i].details + "</td><td class='id'>" + data.ability[i].skillsid + "</td></tr>";
	}

	let docTable = document.getElementById("docTab");
	let docContents = "<tr><th>Doc Type</th><th>Years</th><th>Where</th></tr>";
	for (let i = 0; i < data.docs.length; i++){
		docContents += "<tr onclick='showDocs(this)'><td class='id'>" + data.docs[i].docid + "</td><td>" +  data.docs[i].doceng + "</td><td>"
					+ data.docs[i].when + "</td><td>" + data.docs[i].location + "</td>";
	}

	let healthTable = document.getElementById("healthTab");
	let healthContents = "<tr><th>Health Issue</th><th>Treatment</th></tr>";
	for (let i = 0; i < data.health.length; i++){
		healthContents += "<tr onclick='showHealth(this)'><td class='id'>" + data.health[i].healthid + "</td><td>" +  data.health[i].healtheng + "</td><td>"
					+ data.health[i].when + "</td><td>" + data.health[i].location + "</td>";
	}

	let statusTable = document.getElementById("statusTab");
	let statusContents = "<tr><th>Status Issue</th><th>Reason</th></tr>";
	for (let i = 0; i < data.health.length; i++){
		statusContents += "<tr onclick='showstatus(this)'><td class='id'>" + data.status[i].statusid + "</td><td>" +  data.status[i].statuseng + "</td><td>"
					+ data.status[i].when + "</td><td>" + data.status[i].location + "</td>";
	}

	currappl = new Applicant(data.id, data.firstname, data.lastname, data.cphone, data.hphone, data.address, data.city, data.state, 0, data.status)
	currskill.applicantsid = currappl.id
	table.innerHTML = contents;
	table2.innerHTML = contents2;
	docTable.innerHTML = docContents;
	healthTable.innerHTML = healthContents;
	document.getElementById("id").value = data.id;
	document.getElementById("apid").value = currappl.id;
	document.getElementById("apid2").value = currappl.id;
	document.getElementById("apid3").value = currappl.id;
	document.getElementById("apid4").value = currappl.id;
	clearSkill();
	clearAbility();
	clearDoc();
	clearHealth();
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

function clearNewApp(){
	document.getElementById("first").value = "";
	document.getElementById("last").value = "";
	document.getElementById("cphone").value = "";
	document.getElementById("hphone").value = "";
	document.getElementById("address").value = "";
	document.getElementById("city").value = "";
	document.getElementById("state").value = "";
	document.getElementById("zip").value = "";
	document.getElementById("status").value = "";
	document.getElementById("skillsTab").innerHTML = "<tr><th>Job skill</th><th>Years</th><th>Where</th></tr>";
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
	currskill = new Experience (cells[0].innerHTML, cells[4].innerHTML, currappl.id, cells[2].innerHTML, cells[3].innerHTML, cells[5].innerHTML,cells[1].innerHTML, "produce");
	document.getElementById("skill").value = cells[4].innerHTML;
	document.getElementById("years").value = cells[2].innerHTML;
	document.getElementById("location").value = cells[3].innerHTML;
	document.getElementById("details").value = cells[5].innerHTML;
	document.getElementById("exid").value = cells[0].innerHTML;
	document.getElementById("apid").value = currappl.id;
	resetTable(document.getElementById("skillsTab"));
	row.classList.add("selected");
}

function showAbility2(row){
	let cells = row.getElementsByTagName("td");
	currability = new Experience (cells[0].innerHTML, cells[4].innerHTML, currappl.id, cells[2].innerHTML, cells[3].innerHTML, cells[5].innerHTML,cells[1].innerHTML, "ability");
	document.getElementById("skid2").value = cells[4].innerHTML;
	document.getElementById("years2").value = cells[2].innerHTML;
	document.getElementById("location2").value = cells[3].innerHTML;
	document.getElementById("details2").value = cells[5].innerHTML;
	document.getElementById("exid2").value = cells[0].innerHTML;
	document.getElementById("apid2").value = currappl.id;
	resetTable(document.getElementById("skillTab"));
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
	let abilities = document.getElementById("abilities");
	let abcontents = "<option value=''></option>";
	for (let i = 0; i < data.length; i++){
		if (data[i].skilltype == "produce"){
			contents += "<option value='" + data[i].id + "'>" + data[i].skillenglish + "</option>"
		} else {
			abcontents += "<option value='" + data[i].id + "'>" + data[i].skillenglish + "</option>"
		}

	}
	
	options.innerHTML = contents;
	abilities.innerHTML = abcontents;
	let matchlist1 = document.getElementById("chooseskills1")
	let choices1 = "<tr><th>.  .</th><th>Desired skill</th></tr>"
	for (let i = 0; i < data.length; i++){
		if (data[i].skilltype == "produce"){
			choices1 += "<tr><td><input type='checkbox' onclick='getMatchingEmps()'></td><td>" + data[i].skillenglish + "</td></tr>"
		}
	}

	matchlist1.innerHTML = choices1;
	let matchlist2 = document.getElementById("chooseskills2")
	let choices2 = "<tr><th>.  .</th><th>Desired skill</th></tr>"
	for (let i = 0; i < data.length; i++){
		if (data[i].skilltype == "ability"){
			choices2 += "<tr><td><input type='checkbox' onclick='getMatchingEmps()'></td><td>" + data[i].skillenglish + "</td></tr>"
		}
	}
	matchlist2.innerHTML = choices2;
}

function clearSkill(){
	document.getElementById("skill").value = "";
	document.getElementById("years").value = "";
	document.getElementById("location").value = "";
	document.getElementById("details").value = "";
	document.getElementById("exid").value = 0;
	document.getElementById("apid").value = currappl.id;
}

function clearAbility(){
	document.getElementById("abilities").value = "";
	document.getElementById("years2").value = "";
	document.getElementById("location2").value = "";
	document.getElementById("details2").value = "";
	document.getElementById("exid2").value = 0;
	document.getElementById("apid2").value = currappl.id;
}

function clearDoc(){
	document.getElementById("docid2").value = "";
	document.getElementById("when2").value = "";
	document.getElementById("locationdoc2").value = "";
	document.getElementById("doctype2").value = "";
	document.getElementById("isid").value = 0;
	document.getElementById("apid3").value = currappl.id;
}

function clearHealth(){
	document.getElementById("healthid2").value = "";
	document.getElementById("when2").value = "";
	document.getElementById("treatment2").value = "";
	document.getElementById("doctype2").value = "";
	document.getElementById("isid4").value = 0;
	document.getElementById("apid4").value = currappl.id;
}

function clearStatus(){
	document.getElementById("statusid").value = "";
	document.getElementById("when").value = "";
	document.getElementById("whyhow").value = "";
	document.getElementById("punishtime").value = "";
	document.getElementById("punishreason").value = "";
	document.getElementById("isid5").value = 0;
	document.getElementById("apid5").value = currappl.id;
}

function saveSkill(){
	if (document.getElementById("exid").value == 0) {
		currskill.insert()
	} else {
		currskill.update()
	}
}

function saveAbility(){
	if (document.getElementById("exid2").value == 0) {
		currability.insert()
	} else {
		currability.update()
	}
}


function saveDoc(){
	if (document.getElementById("docid2").value == 0) {
		currdoc.insert()
	} else {
		currdoc.update()
	}
}


function saveHealth(){
	if (document.getElementById("isid4").value == 0) {
		currhealth.insert()
	} else {
		currhealth.update()
	}
}

function saveStatus(){
	if (document.getElementById("isid5").value == 0) {
		currstatus.insert()
	} else {
		currstatus.update()
	}
}


function fillIssue(data){
	let docs = document.getElementById("doclist");
	let doccontents = "<option value=''></option>";
	let health = document.getElementById("healthlist");
	let healthcontents = "<option value=''></option>";
	let status = document.getElementById("statuslist");
	let statuscontents = "<option value=''></option>";
	for (let i = 0; i < data.length; i++){
		if (data[i].issuetype == "document"){
			doccontents += "<option value='" + data[i].id + "'>" + data[i].issueenglish + "</option>"
		} else if (data[i].issuetype == "health") {
			healthcontents += "<option value='" + data[i].id + "'>" + data[i].issueenglish + "</option>"
		} else {
			statuscontents += "<option value='" + data[i].id + "'>" + data[i].issueenglish + "</option>"
		}
		
	}
	docs.innerHTML = doccontents;
	health.innerHTML = healthcontents;
	status.innerHTML= statuscontents;
}

// ................................................................................................................
// ................................................................................................................
// ................................................................................................................
//company funtions
// ................................................................................................................
// ................................................................................................................
// ................................................................................................................

class Employers {
	constructor(id, company, phone, address, city, state) {
		this.id = id
		this.company = company;
		this.phone = phone;
		this.address = address;
		this.city = city;
		this.state = state;
	}
	
	update() {
		var formData = new FormData(document.getElementById("companydata"));
		sendData(formData, "st_updateComp.php", showCompResult);
	}
	
	insert() {
		var formData = new FormData(document.getElementById("companydata"));
		sendData(formData, "st_insertComp.php", showCompResult);
	}
	
}

var currcomp = new Employers (0, "", "", "", "", "");

function getCompanies() {
	getData("st_getComps.php", fillComp);
}

function fillComp(row) {
	console.log(row);
	let table = document.getElementById("companytab");
	let contents = "<tr><th>Company Name</th></tr>";
	
	for (let i = 0; i < row.length; i++){
		contents += "<tr onclick='getComp(this)'><td class='id'>"
					+ row[i].id + "</td><td>" + row[i].company
					+ "</td></tr>";
	}
	table.innerHTML = contents;
	clearComp();
}

function getComp(row){
	getCompData("st_getCompDetail.php?id=" + row.firstChild.innerHTML, fillCompDetail);
	resetTable(document.getElementById("companytab"));
	row.classList.add("selected");
}

function getCompData(phpFile, callBack){
	let xhr = new XMLHttpRequest();
	xhr.onreadystatechange = function(){
		if (this.readyState == 4 && this.status == 200) {
			callBack(JSON.parse(this.responseText));
		}
	}
	xhr.open("get", phpFile);
	xhr.send();
}

function fillCompDetail(data) {
	currcomp = new Employers(data.id, data.company, data.phone, data.address, data.city, data.state);
	document.getElementById("compid").value = data.id;
	document.getElementById("compname").value = data.company;
	document.getElementById("officphone").value = data.phone;
	document.getElementById("compaddress").value = data.address;
	document.getElementById("compcity").value = data.city;
	document.getElementById("compstate").value = data.state;
}

function clearComp() {
	currcomp = new Employers (0, "", "", "", "", "");
	document.getElementById("compid").value = 0;
	document.getElementById("compname").value = "";
	document.getElementById("officphone").value = "";
	document.getElementById("compaddress").value = "";
	document.getElementById("compcity").value = "";
	document.getElementById("compstate").value = "";
	resetTable(document.getElementById("companytab"));
}

function saveComp(){
	if (document.getElementById("compid").value == 0) {
		currcomp.insert()
	} else {
		currcomp.update()
	}
}

function resetComp(){
	document.getElementById("compname").value = currcomp.company;
	document.getElementById("officphone").value = currcomp.phone;
	document.getElementById("compaddress").value = currcomp.address;
	document.getElementById("compcity").value = currcomp.city;
	document.getElementById("compstate").value = currcomp.state;
}

function showCompResult(data){
	document.getElementById("compresult").innerHTML = data;
}

// ................................................................................................................
// ................................................................................................................
// ................................................................................................................
//Assignments funtions
// ................................................................................................................
// ................................................................................................................
// ................................................................................................................

function fillCompList(){
	getData("st_getComps.php", fillList);
}

function fillList(row){
	console.log(row);
	let table = document.getElementById("selectcomps");
	let contents = "<option></option>";
	
	for (let i = 0; i < row.length; i++){
		contents += "<option value='" + row[i].id + "'>" + row[i].company + "</option>";
	}
	table.innerHTML = contents;
}

function selectedComp(){
	let grabed = document.getElementById("selectcomps").value;
	
	console.log("working");
}

function getMatchingEmps(){
	let rows1 = document.getElementById("chooseskills1").getElementsByTagName("tr");
	let rows2 = document.getElementById("chooseskills2").getElementsByTagName("tr");
	let list = "";
	for (let i = 1; i < rows1.length; i++){
		if(rows1[i].firstChild.firstChild.checked){
			list += rows1[i].firstChild.nextSibling.innerText + " ~ ";
		}
	}
	for (let i = 1; i < rows2.length; i++){
		if(rows2[i].firstChild.firstChild.checked){
			list += rows2[i].firstChild.nextSibling.innerText + " ~ ";
		}
	}
	getData("st_getEmpsBySkill.php?status=" + list, fillSim)
}

function fillSim(data){
	let table = document.getElementById("wanapptab");
	let contents = "<tr><th>First name</th><th>Last name</th></tr>";
	
	for (let i = 0; i < data.length; i++){
		contents += "<tr onclick='selectApp(this)'><td class='id'>" + data[i].id + "</td><td>"
					+ data[i].firstname + "</td><td>" + data[i].lastname + "</td><td></td></tr>";
	}
	table.innerHTML = contents;
}

function selectApp(row){
	resetTable(document.getElementById("wanapptab"));
	row.classList.add("selected");
}

function mtc(){
	let grab0 = document.getElementById("wanapptab");
	let grab1 = document.getElementById("wanapptab").getElementsByTagName("tr");
	let grab2 = document.getElementById("wanapptab").getElementsByClassName("selected");
	let grab3 = document.getElementById("wancomptab");
	//for (let i = 0; i < grab1.length; i++){
		//if (grab1[i] == grab2[0]){
			//grab0.removeChild(grab0.children[i]);
		//}
	//}
	//console.log(grab4);
	grab3.innerHTML += grab2[0].innerHTML;
	grab2[0].remove();
}