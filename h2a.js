class Applicant {
	constructor(id, fname, lname, cphone, hphone, address, city, state, zip, status, specificarea, 
		whatarea, stay8mo, overtime, extend, extendwhynot, dateofbirth, email, gender, age, height, weight, lift25to40,
		maritalstatus, placeofbirth, whatknowvisa, howhearcita, otherhelp, whatknowcita, ppnumber, ppcity, ppstate, ppdateissue,
		visas, visaissues, visarefused, license, deported, ustravel, crimes) {
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
		this.specificarea = specificarea;
		this.whatarea = whatarea;
		this.stay8mo = stay8mo;
		this.overtime = overtime;
		this.extend = extend;
		this.extendwhynot = extendwhynot;
		this.dateofbirth = dateofbirth;
		this.email = email;
		this.gender = gender;
		this.age = age;
		this.height = height;
		this.weight = weight;
		this.lift25to40 = lift25to40;
		this.maritalstatus = maritalstatus;
		this.placeofbirth = placeofbirth;
		this.whatknowvisa = whatknowvisa; 
		this.howhearcita = howhearcita; 
		this.otherhelp = otherhelp; 
		this.whatknowcita = whatknowcita;
		this.ppnumber = ppnumber;
		this.ppcity = ppcity;
		this.ppstate = ppstate;
		this.ppdateissue = ppdateissue;
		this.visas = visas;
		this.visaissues = visaissues;
		this.visarefused = visarefused;
		this.license = license;
		this.deported = deported;
		this.ustravel = ustravel;
		this.crimes = crimes;
		this.ds160 = new Appds160();
		this.jobs = []
		this.schools = []
	}
	
	update() {
		var formData = new FormData(document.getElementById("newappform"));
		sendData(formData, path + path + "st_updateEmp.php", showResult);
	}

	updateJob() {
		var formData= new FormData(document.getElementById("jobsForm"));
		sendData(formData, path + "st_updateJobs.php", showResult);
	}

	insertJob() {
		var formData = new FormData(document.getElementById("jobsForm"));
		sendData(formData, path + "st_insertJobs.php", showResult)
	}

	updateSchool () {
		var formData = new FormData(document.getElementById("schoolForm"));
		sendData(formData, path + "st_updateSchool.php", showResult);
	}
	insertSchool () {
		var formData = new FormData(document.getElementById("schoolsForm"));
		sendData(formData, path + "st_insertSchool.php", showResult);
	}
	
}
class Appds160{
	constructor(id, marriage, nationality, othernations, otherresident, nationid, ssn, othercontact, socalmedia,
	pploststolen, ppdatedue, father, mother, relatives, spouse, countries, groups, military, legalissues, 
	deportation, applicants, issues, confirmation){
		this.id = id;
		this.marriage = marriage;
		this.nationality = nationality;
		this.othernations = othernations;
		this.otherresident = otherresident;
		this.nationid = nationid;
		this.ssn = ssn;
		this.othercontact = othercontact;
		this.socalmedia = socalmedia;
		this.pploststolen = pploststolen;
		this.ppdatedue = ppdatedue;
		this.father = father;
		this.mother = mother;
		this.relatives = relatives;
		this.spouse = spouse;
		this.countries = countries;
		this.groups = groups;
		this.military = military;
		this.legalissues = legalissues;
		this.deportation = deportation;
		this.applicants = applicants;
		this.issues = issues;
		this.confirmation = confirmation
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
			sendData(formData, path + path + "st_updateSkill.php", showResult);
		} else if (this.skillType == "health") {
			formData = new FormData(document.getElementById("healthsec"));
			sendData(formData, path + path + "st_updateHealth.php", showResult);
		} else {
			formData = new FormData(document.getElementById("abilityForm"));
			sendData(formData, path + path + "st_updateAbility.php", showResult);
		}
	}
	
	insert() {
		var formData;
		if (this.skilltype == "produce") {
			formData = new FormData(document.getElementById("skillsForm"));
			sendData(formData, path + "st_insertSkill.php", showResult);
		} else if (this.skillType == "health") {
			formData = new FormData(document.getElementById("healthsec"));
			sendData(formData, path + "st_insertHealth.php", showResult);
		} else {
			formData = new FormData(document.getElementById("abilityForm"));
			sendData(formData, path + "st_insertAbility.php", showResult);
		}
	}
	
}

class History {
	constructor(historytype, id, entity, address, address2, city, state, zip, datefrom, dateto, applicantsid, major, phone, salary, jobtitle, duties, supervisor) {
		this.historytype = historytype;
		this.id = id
		this.entity = entity;
		this.address = address;
		this.address2 = address2;
		this.city = city;
		this.state = state;
		this.zip = zip;
		this.datefrom = datefrom;
		this.dateto = dateto;
		this.applicantsid = applicantsid;
		this.major = major;
		this.phone = phone;
		this.salary = salary;
		this.jobtitle = jobtitle;
		this.duties = duties;
		this.supervisor = supervisor;
	
	}

	update() {
		var formData;
		if (this.historytype == "jobs") {
			formData = new FormData(document.getElementById("jobsForm"));
			sendData(formData, path + "st_updateJobs.php", showResult);
		} else {
			formData = new FormData(document.getElementById("schoolForm"));
			sendData(formData, path + "st_updateSchool.php", showResult);
		}
	}
	
	insert() {
		var formData;
		if (this.historytype == "jobs") {
			formData = new FormData(document.getElementById("jobsForm"));
			sendData(formData, path + "st_insertJobs.php", showResult);
		} else {
			formData = new FormData(document.getElementById("schoolForm"));
			sendData(formData, path + "st_insertSchool.php", showResult);
		}
	}
}

var currappl = new Applicant (0, "", "", "", "", "", "", "", "", "", "", "");
var currskill = new Experience (0, "", 0, "", "", "", "", "produce");
var currability = new Experience (0, "", 0, "", "", "", "", "ability");
//var currdoc = new Issues (0, "", 0, "", "", "", "", "document");
var currhealth = new Experience (0, "", 0, "", "", "", "", "health");
//var currstatus = new Issues (0, "", 0, "", "status");
var currJob = new History ("jobs", 0)
var currSchool = new History ("school", 0)
var path = "";


function st_show(tab) {
	let tabs = document.getElementsByClassName("st_tab");
	let buttons = document.getElementById("staffmenu").getElementsByTagName("button");
	for (let i = 0; i < tabs.length; i++){
		tabs[i].style.display = "none";
	}
	for (let i = 0; i < buttons.length; i++){
		buttons[i].classList.remove("selected");
	}
	let bi = ['newapplicants', 'applicants', 'companies', 'assignments'].findIndex((t)=>t==tab);
	buttons[bi].classList.add("selected");
	//document.getElementById("searchapp").style.display = "none";
	//document.getElementById("newapplabel").style.display = "none";
	document.getElementById("mainform2").style.display = "none";
	document.getElementById("mainform3").style.display = "none";
	if (tab == "applicants"){
		document.getElementById("newapplicants").style.display = "block";
		document.getElementById("searchstat").innerHTML = oldstats;
		document.getElementById("status").innerHTML = allstats;
		document.getElementById("mainform3").style.display = "block";
		tabs[0].classList.remove("green");
		tabs[0].classList.add("blue");
		showContactTab(1);
		showInfoTab(1);
		document.querySelectorAll(".ds160").forEach(inp => inp.disabled = false);
		document.getElementById("DS-160").disabled = false;
	} else {
		document.getElementById(tab).style.display = "block";
		document.getElementById("searchstat").innerHTML = newstats
		document.getElementById("status").innerHTML = newstats
		document.getElementById("mainform2").style.display = "block";
		tabs[0].classList.add("green");
		tabs[0].classList.remove("blue");
		showContactTab(0);
		showInfoTab(0);
		document.querySelectorAll(".ds160").forEach(inp => inp.disabled = true);
		document.getElementById("DS-160").disabled = true;
	}
}

function setBackColor(tab, tabs){
	
}

function getData(phpFile, callBack, data){
	let xhr = new XMLHttpRequest();
	xhr.onreadystatechange = function(){
		if (this.readyState == 4 && this.status == 200) {
			console.log(this.responseText);
			callBack(JSON.parse(this.responseText));
		}
	}
	xhr.open("post", phpFile);
	xhr.send(data);
}

function getEmployees (stuff) {
	let temp = '';
	if (stuff != 'accepted'){
		temp = stuff;
	} else {
		temp = document.getElementById("searchstat").value;
	}
	let fd = new FormData();
	fd.append("stat", temp);
	getData(path + "st_getEmps.php", fillEmps, fd);
}

function getEmp(row) {
	//console.log(row.firstChild.innerHTML);
	let fd = new FormData();
	fd.append("id", row.firstChild.innerHTML)
	getData(path + "st_getEmpDetail.php", fillEmpDetail, fd);
	resetTable(document.getElementById("newapptab"));
	row.classList.add("selected");
}

function fillEmps(data) {
	//data is an array of objects
	//loop and fill table
	let table = document.getElementById("newapptab");
	let contents = "<tr><th class='namehead'>First name</th><th class='namehead'>Last name</th><th>Phone number</th></tr>";
	
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
	currappl = new Applicant(data.id, data.firstname, data.lastname, data.cphone, data.hphone, data.address, data.city, data.state,
		data.zip, data.status, data.specificarea, data.whatarea, data.stay8mo, data.overtime, data.extend, data.extendwhynot,
		data.dateofbirth, data.email, data.gender, data.age, data.height, data.weight, data.lift25to40, data.maritalstatus, data.placeofbirth,
		data.whatknowvisa, data.howhearcita, data.otherhelp, data.whatknowcita, data.ppnumber, data.ppcity, data.ppstate, data.ppdateissue,
		data.visas, data.visaissues, data.visarefused, data.license, data.deported, data.ustravel, data.crimes)
	if(data.ds160 != undefined){
		currappl.ds160.id = data.ds160.id
		currappl.ds160.marriage = data.ds160.marriage
		currappl.ds160.nationality = data.ds160.nationality
		currappl.ds160.othernations = data.ds160.othernations
        currappl.ds160.otherresident = data.ds160.otherresident
		currappl.ds160.nationid = data.ds160.nationid
		currappl.ds160.ssn = data.ds160.ssn
		currappl.ds160.othercontact = data.ds160.othercontact
		currappl.ds160.socialmedia = data.ds160.socialmedia
		currappl.ds160.pploststolen = data.ds160.pploststolen
		currappl.ds160.ppdatedue = data.ds160.ppdatedue
		currappl.ds160.father = data.ds160.father
		currappl.ds160.mother = data.ds160.mother
		currappl.ds160.relatives = data.ds160.relatives
		currappl.ds160.spouse = data.ds160.spouse
		currappl.ds160.countries = data.ds160.countries
		currappl.ds160.groups = data.ds160.groups
		currappl.ds160.military = data.ds160.military
		currappl.ds160.legalissues = data.ds160.legalissues
		currappl.ds160.deportation = data.ds160.deportation
		currappl.ds160.applicants = data.ds160.applicants
		currappl.ds160.issues = data.ds160.issues
		currappl.ds160.confirmation = data.ds160.confirmation
	}
	let table = document.getElementById("skillsTab");
	let contents = "<tr><th>Experiance</th><th>Years</th><th class='tabcolumn'>Where</th></tr>";
	for (let i = 0; i < data.skills.length; i++){
		contents += "<tr onclick='showSkill(this)'><td class='id'>" + data.skills[i].exid + "</td><td>" + data.skills[i].skillenglish + "</td><td>"
					+ data.skills[i].years + "</td><td>" + data.skills[i].location + "</td><td class='id'>" + data.skills[i].skillsid
					+ "</td><td class='id'>" + data.skills[i].details + "</td></tr>";
	}
	let table2 = document.getElementById("abilityTab");
	let contents2 = "<tr><th>Job Skill</th><th>Years</th><th class='tabcolumn'>Where</th></tr>";
	for (let i = 0; i < data.ability.length; i++){
		contents2 += "<tr onclick='showAbility2(this)'><td class='id'>" + data.ability[i].abid + "</td><td>" + data.ability[i].abeng + "</td><td>"
					+ data.ability[i].years + "</td><td>" + data.ability[i].location
					+ "</td><td class='id'>" + data.ability[i].details + "</td><td class='id'>" + data.ability[i].skillsid + "</td></tr>";
	}

	/*let docTable = document.getElementById("docTab");
	let docContents = "<tr><th>Doc Type</th><th>Years</th><th>Where</th></tr>";
	for (let i = 0; i < data.docs.length; i++){
		docContents += "<tr onclick='showDocs(this)'><td class='id'>" + data.docs[i].docid + "</td><td>" +  data.docs[i].doceng + "</td><td>"
					+ data.docs[i].whengot + "</td><td>" + data.docs[i].location + "</td><td class='id'>" + data.docs[i].issuesid + "</td></tr>";
	}*/

	let healthTable = document.getElementById("healthTab");
	let healthContents = "<tr><th>Health Issue</th><th class='tabcolumn'>Treatment</th></tr>";
	for (let i = 0; i < data.health.length; i++){
		healthContents += "<tr onclick='showHealth(this)'><td class='id'>" + data.health[i].healthid + "</td><td>" +  data.health[i].healtheng + "</td><td>"
					+ data.health[i].medtreatment + "</td><td class='id'>" + data.health[i].reason + "</td><td class='id'>" + data.health[i].skillsid + "</td></tr>";
	}

	/*let statusTable = document.getElementById("statusTab");
	let statusContents = "<tr><th>Issue Type</th></tr>";
	for (let i = 0; i < data.issues.length; i++){
		statusContents += "<tr onclick='showStatus(this)'><td class='id'>" + data.issues[i].statusid + "</td><td>" +  data.issues[i].statuseng + "</td><td class='id'>"
					+ data.issues[i].details + "</td><td class ='id'>" + data.issues[i].issuesid + "</td></tr>";
	}*/

	let jobsTable = document.getElementById("jobsTab");
	let jobsContents = "<tr><th class='tabcolumn'>Jobs</th></tr>";
	for (let i =0; i < data.jobs.length; i++){
		jobsContents += "<tr onclick='showJobs(this)'><td class='id'>" + data.jobs[i].id + "</td><td>" 
			+ data.jobs[i].empname + "</td></tr>";
		currappl.jobs.push(new History("jobs", data.jobs[i].id, data.jobs[i].empname, data.jobs[i].address, data.jobs[i].address2, 
			data.jobs[i].city, data.jobs[i].state, data.jobs[i].zip, data.jobs[i].datefrom, data.jobs[i].dateto, 
			data.jobs[i].applicantsid, "", data.jobs[i].phone, data.jobs[i].salary, data.jobs[i].jobtitle,
			data.jobs[i].duties, data.jobs[i].supervisor))
	}

	let schoolTable = document.getElementById("schoolsTab");
	let schoolContents = "<tr><th class='tabcolumn'>School</th></tr>";
	for (let i =0; i < data.school.length; i++){
		schoolContents += "<tr onclick='showSchool(this)'><td class='id'>" + data.school[i].id + "</td><td>" + data.school[i].schoolname + "</td></tr>"
			+data.school[i].entity + "</td></tr>";
		currappl.schools.push(new History("school", data.school[i].id, data.school[i].entity, data.school[i].address,
			data.school[i].address2, data.school[i].city, data.school[i].state, data.school[i].zip, data.school[i].datefrom,
			data.school[i].dateto, data.school[i].applicantsid, data.school[i].phone, data.school[i].salary, data.school[i].jobtitle,
			data.school[i].duties, data.school[i].supervisor))
	}

	currskill.applicantsid = currappl.id
	table.innerHTML = contents;
	table2.innerHTML = contents2;
	//docTable.innerHTML = docContents;
	healthTable.innerHTML = healthContents;
	//statusTable.innerHTML = statusContents;
	jobsTable.innerHTML = jobsContents;
	schoolTable.innnerHTML = schoolContents;
	document.getElementById("id").value = data.id;
	document.getElementById("apid").value = currappl.id;
	document.getElementById("apid2").value = currappl.id;
	//document.getElementById("apid3").value = currappl.id;
	document.getElementById("apid4").value = currappl.id;
	//document.getElementById("apid5").value = currappl.id;
	clearSkill();
	clearAbility();
	clearJobs();
	clearHealth();
	clearSchool();
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
	document.getElementById("dateofbirth").value = currappl.dateofbirth;
	document.getElementById("email").value = currappl.email;
	document.getElementById("age").value = currappl.age;
	document.getElementById("height").value = currappl.height;
	document.getElementById("weight").value = currappl.weight;
	document.getElementById("maritalstatus").value = currappl.maritalstatus;
	document.getElementById("placeofbirth").value = currappl.placeofbirth;
	document.getElementById("ustravel").value = currappl.ustravel;
	document.getElementById("legalissues").value = currappl.crimes;
	document.getElementById("appconfirm").value = currappl.confirmation;

	if (currappl.gender == "male") {
		document.getElementById("male").checked = true;
	} else {
		document.getElementById("female").checked = true;
	}

	if (currappl.specificarea == "1") {
		document.getElementById("distanceyuma").checked = true;
	} else {
		document.getElementById("distanceany").checked = true;
	}

	document.getElementById("whatarea").value = currappl.whatarea;

	if (currappl.stay8mo == "1") {
		document.getElementById("stay8moyes").checked = true;
	} else {
		document.getElementById("stay8mono").checked = true;
	}

	document.getElementById("extendwhynot").value = currappl.extendwhynot;

	if (currappl.extend == "1") {
		document.getElementById("extendyes").checked = true;
	} else {
		document.getElementById("extendno").checked = true;
	}

	if (currappl.overtime == "1") {
		document.getElementById("overtimeyes").checked = true;
	} else {
		document.getElementById("overtimeno").checked = true;
	}

	if (currappl.lift25to40 == "1") {
		document.getElementById("lift25to40yes").checked = true;
	} else {
		document.getElementById("lift25to40no").checked = true;
	}

	document.getElementById("whatknowvisa").value = currappl.whatknowvisa;
	document.getElementById("howhearcita").value = currappl.howhearcita;
	document.getElementById("otherhelp").value = currappl.otherhelp;
	document.getElementById("whatknowcita").value = currappl.whatknowcita;
    document.getElementById("nationality").value = currappl.nationality
	document.getElementById("othernations").value = currappl.othernations
	document.getElementById("otherresident").value = currappl.otherresident
	document.getElementById("nationid").value = currappl.nationid
	document.getElementById("license").value = currappl.license
	document.getElementById("usresidency").value = currappl.deported
	document.getElementById("legalissues").value = currappl.crimes;
    if(currappl.ds160.marriage != undefined){
		document.getElementById("id").value = currappl.id;
		document.getElementById("marriagedetails").value = currappl.ds160.marriage;
		document.getElementById("nationality").value = currappl.ds160.nationality;
		document.getElementById("othernations").value = currappl.ds160.othernations;
		document.getElementById("otherresident").value = currappl.ds160.otherresident;
		document.getElementById("nationid").value = currappl.ds160.nationid;
		document.getElementById("ssn").value = currappl.ds160.ssn;
		document.getElementById("othercontact").value = currappl.ds160.othercontact;
		document.getElementById("socialmedia").value = currappl.ds160.socialmedia;
		document.getElementById("ppissues").value = currappl.ds160.ppissues;
		document.getElementById("father").value = currappl.ds160.father;
		document.getElementById("mother").value = currappl.ds160.mother;
		document.getElementById("relatives").value = currappl.ds160.relatives;
		document.getElementById("spouse").value = currappl.ds160.spouse;
		document.getElementById("countries").value = currappl.ds160.countries;
		document.getElementById("groups").value = currappl.ds160.groups;
		document.getElementById("military").value = currappl.ds160.military;
		document.getElementById("issues").value = currappl.ds160.issues;
		document.getElementById("appconfirm").value = currappl.ds160.confrimation;
		//document.getElementById("crimes").value = currappl.ds160.crimes;
		//document.getElementById("deportation").value = currappl.ds160.deportation;
		//document.getElementById("applicants").value = currappl.ds160.applicants;

	}
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
	document.getElementById("distanceyuma").checked = false;
	document.getElementById("distanceany").checked = false;
	document.getElementById("whatarea").value = "";
	document.getElementById("stay8moyes").checked = false;
	document.getElementById("stay8mono").checked = false;
	document.getElementById("overtimeyes").checked = false;
	document.getElementById("overtimeno").checked = false;
	document.getElementById("extendyes").checked = false;
	document.getElementById("extendno").checked = false;
	document.getElementById("extendwhynot").value = "";
	document.getElementById("status").value = "";
	document.getElementById("dateofbirth").value = "";
	document.getElementById("email").value = "";
	document.getElementById("male").checked = false;
	document.getElementById("female").checked = false;
	document.getElementById("age").value = "";
	document.getElementById("height").value = "";
	document.getElementById("weight").value = "";
	document.getElementById("lift25to40yes").checked = false;
	document.getElementById("lift25to40no").checked = false;
	document.getElementById("maritalstatus").value = "";
	document.getElementById("placeofbirth").value = "";
	document.getElementById("skillsTab").innerHTML = "<tr><th>Experience</th><th>Years</th><th>Where</th></tr>";
	document.getElementById("abilityTab").innerHTML = "<tr><th>Job skill</th><th>Years</th><th>Where</th></tr>";
	//document.getElementById("docTab").innerHTML = "<tr><th>Doc Type</th><th>Years</th><th>Where</th></tr>";
	document.getElementById("healthTab").innerHTML = "<tr><th>Health Issue</th><th>Treatment</th></tr>";
	//document.getElementById("statusTab").innerHTML = "<tr><th>Issue Type</th></tr>";
	document.getElementById("whatknowvisa").value = ""; 
	document.getElementById("howhearcita").value = ""; 
	document.getElementById("otherhelp").value = ""; 
	document.getElementById("whatknowcita").value = ""; 
    document.getElementById("ppnumber").value = "";
	document.getElementById("ppcity").value = "";
	document.getElementById("ppstate").value = "";
	document.getElementById("ppdateissue").value = "";
	document.getElementById("ppdatedue").value = "";
	document.getElementById("visas").value = "";
	document.getElementById("visaissues").value = "";
	document.getElementById("visarefused").value = "";
	document.getElementById("usresidency").value= "";
	document.getElementById("marriagedetails").value = "";
	document.getElementById("nationality").value = "";
	document.getElementById("othernations").value = "";
	document.getElementById("otherresident").value = "";
	document.getElementById("nationid").value = "";
	document.getElementById("ssn").value = "";
	document.getElementById("othercontact").value = "";
	document.getElementById("socialmedia").value = "";
	document.getElementById("ppissues").value = "";
	document.getElementById("father").value = "";
	document.getElementById("mother").value = "";
	document.getElementById("relatives").value = "";
	document.getElementById("spouse").value = "";
	document.getElementById("countries").value = "";
	document.getElementById("groups").value = "";
	document.getElementById("military").value = "";
	document.getElementById("legalissues").value = "";
	document.getElementById("ustravel").value = "";

	clearSkill();
	clearAbility();
	clearJobs();
	clearHealth();
	clearSchool();
	//resetNewApp();
}

function sendData(data, phpFile, callBack){
	let xhr = new XMLHttpRequest();
	xhr.onreadystatechange = function(){
		if (this.readyState == 4 && this.status == 200) {
			callBack(this.responseText);
		}
	}
	xhr.open("post", phpFile);
	console.log(data)
	xhr.send(data);
}

function showResult(data){
	document.getElementById("result").innerHTML = data;
	if(data.indexOf("saved") == -1) {
		console.log(data);
	}
	document.getElementById("result").classList.remove("fade");
	setTimeout(function(){document.getElementById("result").style.visibility="hidden";}, 5000)
	let temp;
	if (document.getElementById("searchapp").style.display != "none") {
		temp = document.getElementById("searchstat").value;
	} else {
		temp = "new";
	}
	let fd = new FormData();
	fd.append("stat", temp);
	getData(path + "st_getEmps.php", fillEmps, fd);
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
	document.getElementById("details2").value = cells[4].innerHTML;
	document.getElementById("exid2").value = cells[0].innerHTML;
	document.getElementById("abilities").value = cells[5].innerHTML;
	document.getElementById("apid2").value = currappl.id;
	resetTable(document.getElementById("abilityTab"));
	row.classList.add("selected");
}

function showHealth(row){
	let cells = row.getElementsByTagName("td");
	currhealth = new Experience (cells[0].innerHTML, cells[4].innerHTML, currappl.id, cells[2].innerHTML, cells[3].innerHTML, cells[1].innerHTML, "treatment");
	document.getElementById("healthlist").value = cells[4].innerHTML;
	document.getElementById("reason2").value = cells[3].innerHTML;
	document.getElementById("treatment2").value = cells[2].innerHTML;
	document.getElementById("healthid2").value = cells[0].innerHTML;
	document.getElementById("apid4").value = currappl.id;
	resetTable(document.getElementById("healthTab"));
	row.classList.add("selected");
}

function showJobs(row){
	let cells = row.getElementsByTagName("td");
	for (i = 0; i < currappl.jobs.length; i++) {
		if (cells[0].innerHTML == currappl.jobs[i].id) {
			break
		}
	}
	document.getElementById("jid").value = currappl.jobs[i].id;
	document.getElementById("company").value = currappl.jobs[i].entity;
	document.getElementById("salary").value = currappl.jobs[i].salary;
	document.getElementById("jaddress").value = currappl.jobs[i].address;
	document.getElementById("jaddress2").value = currappl.jobs[i].address2;
	document.getElementById("jcity").value = currappl.jobs[i].city;
	document.getElementById("jstate").value = currappl.jobs[i].state;
	document.getElementById("jzip").value = currappl.jobs[i].zip;
	document.getElementById("supervisor").value = currappl.jobs[i].supervisor;
	document.getElementById("jobtitle").value = currappl.jobs[i].jobtitle;
	document.getElementById("datefrom").value = currappl.jobs[i].datefrom;
	document.getElementById("dateto").value = currappl.jobs[i].dateto;
	document.getElementById("jphone").value = currappl.jobs[i].phone;
	resetTable(document.getElementById("jobsTab"));
	row.classList.add("selected");
}

function showSchool(row){
	let cells = row.getElementsByTagName("td");
	for (i = 0; i < currappl.school.length; i++) {
		if (cells[0].innerHTML == currappl.school[i]) {
			break
		}
	}
	document.getElementById("school").value = currappl.school[i].school;
	document.getElementById("major").value = currappl.school[i].major;
	document.getElementById("saddress").value = currappl.school[i].address;
	document.getElementById("saddress2").value = currappl.school[i].address2;
	document.getElementById("scity").value = currappl.school[i].city;
	document.getElementById("sstate").value = currappl.school[i].state;
	document.getElementById("szip").value = currappl.school[i].zip;
	document.getElementById("sdatefrom").value = currappl.school[i].datefrom;
	document.getElementById("sdateto").value = currappl.school[i].dateto;
	resetTable(document.getElementById("schoolsTab"));
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
	let health = document.getElementById("healthlist");
	let healthcontents = "<option value=''></option>";
	let abilities = document.getElementById("abilities");
	let abcontents = "<option value=''></option>";
	for (let i = 0; i < data.length; i++){
		if (data[i].skilltype == "produce"){
			contents += "<option value='" + data[i].id + "'>" + data[i].skillenglish + "</option>"
		} else if (data[i].skilltype == "health") {
			healthcontents += "<option value='" + data[i].id + "'>" + data[i].skillenglish + "</option>"
		} else {
			abcontents += "<option value='" + data[i].id + "'>" + data[i].skillenglish + "</option>"
		}

	}
	
	health.innerHTML = healthcontents;
	options.innerHTML = contents;
	abilities.innerHTML = abcontents;
	let matchlist1a = document.getElementById("chooseskills1a")
	let choices1a = "<tr><th>.  .</th><th>Desired Experiance</th></tr>"
	let split = 0
	for (let i = 0; i < data.length; i++){
		if (data[i].skilltype == "produce"){
			split++
			choices1a += "<tr><td><input type='checkbox' onclick='getMatchingEmps()'></td><td>" + data[i].skillenglish + "</td></tr>"
			if (split == 23){
				split = i + 1; 
				break
			}
		}
	}
	matchlist1a.innerHTML = choices1a;

	let matchlist1b = document.getElementById("chooseskills1b")
	let choices1b = "<tr><th>.  .</th><th>Desired Experiance</th></tr>"
	for (let i = split; i < data.length; i++){
		if (data[i].skilltype == "produce"){
			choices1b += "<tr><td><input type='checkbox' onclick='getMatchingEmps()'></td><td>" + data[i].skillenglish + "</td></tr>"
		}
	}
	matchlist1b.innerHTML = choices1b;

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
	resetTable(document.getElementById("skillsTab"));
}

function clearAbility(){
	document.getElementById("abilities").value = "";
	document.getElementById("years2").value = "";
	document.getElementById("location2").value = "";
	document.getElementById("details2").value = "";
	document.getElementById("exid2").value = 0;
	document.getElementById("apid2").value = currappl.id;
	resetTable(document.getElementById("abilityTab"));
}

function clearJobs(){
	document.getElementById("company").value = "";
	document.getElementById("jaddress").value = "";
	document.getElementById("jaddress2").value = "";
	document.getElementById("jcity").value = "";
	document.getElementById("jstate").value = "";
	document.getElementById("jzip").value = "";
	document.getElementById("supervisor").value = "";
	document.getElementById("jobtitle").value = "";
	document.getElementById("datefrom").value = "";
	document.getElementById("dateto").value = "";
	document.getElementById("jphone").value = "";
	resetTable(document.getElementById("jobsTab"));
}

function clearHealth(){
	document.getElementById("healthlist").value = "";
	document.getElementById("treatment2").value = "";
	document.getElementById("reason2").value = "";
	document.getElementById("healthid2").value = 0;
	document.getElementById("apid4").value = currappl.id;
	resetTable(document.getElementById("healthTab"));
}

function clearSchool(){
	document.getElementById("school").value = "";
	document.getElementById("major").value = "";
	document.getElementById("saddress").value = "";
	document.getElementById("saddress2").value = "";
	document.getElementById("scity").value = "";
	document.getElementById("sstate").value = "";
	document.getElementById("szip").value = "";
	document.getElementById("datefrom").value = "";
	document.getElementById("dateto").value = "";
	resetTable(document.getElementById("schoolsTab"));
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


function saveJob(){
	if (document.getElementById("jid").value == 0) {
		currappl.insertJob()
	} else {
		currappl.updateJob()
	}
}


function saveHealth(){
	if (document.getElementById("healthid2").value == 0) {
		currhealth.insert()
	} else {
		currhealth.update()
	}
}

function saveSchool(){
	if (document.getElementById("scid").value == 0) {
		currappl.insertSchool()
	} else {
		currappl.updateSchool()
	}
}


/*function fillIssue(data){
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
}*/

function showInfoTab(tab){
	if (tab == 0){
		document.getElementById("mainform2").style.display = "block";
		document.getElementById("mainform3").style.display = "none";
		document.getElementById("DS-160").classList.remove("selected");
		document.getElementById("workinfo").classList.add("selected");
	}else{
		document.getElementById("mainform2").style.display = "none";
		document.getElementById("mainform3").style.display = "block";
		document.getElementById("workinfo").classList.remove("selected");
		document.getElementById("DS-160").classList.add("selected");
	}
}
function showContactTab(tab){
	if (tab == 0){
		document.getElementById("contactinfo").style.display = "block";
		document.getElementById("visainfo").style.display = "none";
		document.getElementById("visabtn").classList.remove("selected");
		document.getElementById("contactbtn").classList.add("selected");
	}else{
		document.getElementById("contactinfo").style.display = "none";
		document.getElementById("visainfo").style.display = "block";
		document.getElementById("contactbtn").classList.remove("selected");
		document.getElementById("visabtn").classList.add("selected");
	}
}
function createLink(){
	alert("localhost/h2a/app2.html?id=" + currappl.id);
}
// ................................................................................................................
// ................................................................................................................
// ................................................................................................................
//company funtions
// ................................................................................................................
// ................................................................................................................
// ................................................................................................................

class Employers {
	constructor(id, company, phone, address, city, state, zip) {
		this.id = id
		this.company = company;
		this.phone = phone;
		this.address = address;
		this.city = city;
		this.state = state;
		this.zip = zip;
	}
	
	update() {
		var formData = new FormData(document.getElementById("companydata"));
		sendData(formData, path + "st_updateComp.php", showCompResult);
	}
	
	insert() {
		var formData = new FormData(document.getElementById("companydata"));
		sendData(formData, path + "st_insertComp.php", showCompResult);
	}
	
}

var currcomp = new Employers (0, "", "", "", "", "", "");

function getCompanies() {
	getData(path + "st_getComps.php", fillComp);
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
	getCompData(path + "st_getCompDetail.php?id=" + row.firstChild.innerHTML, fillCompDetail);
	resetTable(document.getElementById("companytab"));
	row.classList.add("selected");
}

function getCompData(phpFile, callBack){
	let xhr = new XMLHttpRequest();
	xhr.onreadystatechange = function(){
		if (this.readyState == 4 && this.status == 200) {
			console.log(this.responseText)
			callBack(JSON.parse(this.responseText));
		}
	}
	xhr.open("get", phpFile);
	xhr.send();
}

function fillCompDetail(data) {
	currcomp = new Employers(data.id, data.company, data.phone, data.address, data.city, data.state, data.zip);
	document.getElementById("compid").value = data.id;
	document.getElementById("compname").value = data.company;
	document.getElementById("officphone").value = data.phone;
	document.getElementById("compaddress").value = data.address;
	document.getElementById("compcity").value = data.city;
	document.getElementById("compstate").value = data.state;
	document.getElementById("compzip").value = data.zip;
	let comptable = document.getElementById("compassigntab");
	let content = "<tr><th>Assign Date</th><th>Count</th></tr>";
	for (i = 0; i < data.assignments.length; i++) {
		content += "<tr onclick='getAssigned(this)'><td>" + data.assignments[i].startdate + "</td><td>" + data.assignments[i].count + "</td></tr>";
	}
	comptable.innerHTML = content; 
	document.getElementById("compempstab").innerHTML = "<tr><th>First Name</th><th>Last Name</th><th>Phone Number</th></tr>";
}	
function getAssigned(row) {
	getCompData(path + "st_getCompAssignedEmps.php?id=" + document.getElementById("compid").value + "&startdate=" + row.firstChild.innerHTML, showAssigned);
	console.log(row.firstChild.innerHTML)
	resetTable(document.getElementById("compassigntab"));
	row.classList.add("selected");
}
function showAssigned(data) {
	let empstab = document.getElementById("compempstab");
	let content = "<tr><th>First Name</th><th>Last Name</th><th>Phone Number</th></tr>";
	for (i = 0; i < data.length; i++) {
		content += "<tr><td>" + data[i].firstname + "</td><td>" + data[i].lastname
		 		+ "</td><td>" + data[i].phonecell + "</td></tr>";
	}
	empstab.innerHTML = content;
}

function clearComp() {
	currcomp = new Employers (0, "", "", "", "", "", "");
	document.getElementById("compid").value = 0;
	document.getElementById("compname").value = "";
	document.getElementById("officphone").value = "";
	document.getElementById("compaddress").value = "";
	document.getElementById("compcity").value = "";
	document.getElementById("compstate").value = "";
	document.getElementById("compzip").value = "";
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
	document.getElementById("compzip").value = currcomp.state;
}

function showCompResult(data){
	document.getElementById("compresult").innerHTML = data;
	getCompanies();
}

// ................................................................................................................
// ................................................................................................................
// ................................................................................................................
//Assignments funtions
// ................................................................................................................
// ................................................................................................................
// ................................................................................................................

function fillCompList(){
	getData(path + "st_getComps.php", fillList);
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
	let rows1a = document.getElementById("chooseskills1a").getElementsByTagName("tr");
	let rows1b = document.getElementById("chooseskills1b").getElementsByTagName("tr");
	let rows2 = document.getElementById("chooseskills2").getElementsByTagName("tr");
	let list = "~";
	for (let i = 1; i < rows1a.length; i++){
		if(rows1a[i].firstChild.firstChild.checked){
			list += rows1a[i].firstChild.nextSibling.innerText + " ~ ";
		}
	}
	for (let i = 1; i < rows1b.length; i++){
		if(rows1b[i].firstChild.firstChild.checked){
			list += rows1b[i].firstChild.nextSibling.innerText + " ~ ";
		}
	}
	for (let i = 1; i < rows2.length; i++){
		if(rows2[i].firstChild.firstChild.checked){
			list += rows2[i].firstChild.nextSibling.innerText + " ~ ";
		}
	}
	let fd = new FormData();
	fd.append("status", list);
	getData(path + "st_getEmpsBySkill.php", fillSim, fd);
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
	let fd = new FormData();
	fd.append("id", row.firstChild.innerText);
	getData(path + "st_getEmpDetail.php", showAssignedData, fd)
}

function selectappback(row) {
	resetTable(document.getElementById("wancomptab"));
	row.classList.add("selected");
}

function showAssignedData(data){
	let healthTable = document.getElementById("healthTab2");
	let healthContents = "<tr><th>Health Issue</th><th>Treatment</th></tr>";
	for (let i = 0; i < data.health.length; i++){
		healthContents += "<tr><td class='id'>" + data.health[i].healthid + "</td><td>" +  data.health[i].healtheng + "</td><td>"
					+ data.health[i].medtreatment + "</td><td class='id'>" + data.health[i].reason + "</td><td class='id'>" + data.health[i].skillsid + "</td></tr>";
	}

	if (data.specificarea == "1") {
		document.getElementById("distanceyuma2").checked = true;
	} else {
		document.getElementById("distanceany2").checked = true;
	}
	healthTable.innerHTML = healthContents;
	document.getElementById("whatarea2").value = data.whatarea;

	if (data.overtime == "1") {
		document.getElementById("overtimeyes2").checked = true;
	} else {
		document.getElementById("overtimeno2").checked = true;
	}

	if (data.extend == "1") {
		document.getElementById("extendyes2").checked = true;
	} else {
		document.getElementById("extendno2").checked = true;
	}
}

function saveAssignment() {
	rows = document.getElementById("wancomptab").getElementsByTagName("tr");
	if (rows.length == 1) {
		alert("You need to move applicants with the arrow button to the list on the right!")
		return

	}
	if (document.getElementById("selectcomps").value =="") {
		alert("You have not assigned a company")
		return

	}
	if (document.getElementById("assignstart").value == 0) {
		alert("You have not assigned starting date")
		return

	}
	for (let i = 1; i < rows.length; i++) {
		document.getElementById("assignappid").value = rows[i].firstChild.innerText;
		let formData = new FormData(document.getElementById("assignform"));
		sendData(formData, path + "st_saveAssignment.php", showAssignResult)
	}
}

var assigncount = 0;

function showAssignResult(data) {
	if (data == "record saved") {
		assigncount++
		document.getElementById("assignresult").innerHTML = "saved " + assigncount + " assignments";
	} else {
		document.getElementById("assignresult").innerHTML = data;
	}
	
	
	document.getElementById("wancomptab").innerHTML = '<tr><th colspan="2">Applicants to assign</th></tr>';
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
	grab3.innerHTML += "<tr onclick='selectappback(this)'>" + grab2[0].innerHTML + "</tr>";
	grab2[0].remove();
	document.getElementById("healthTab2").innerHTML = "<tr><th>Health Issue</th><th>Treatment</th></tr>";
	document.getElementById("distanceyuma2").checked = false;
	document.getElementById("distanceany2").checked = false;
	document.getElementById("whatarea2").value = "";
	document.getElementById("overtimeyes2").checked = false;
	document.getElementById("overtimeno2").checked = false;
	document.getElementById("extendyes2").checked = false; 
	document.getElementById("extendno2").checked = false; 


}

function moc() {
	let grab2 = document.getElementById("wancomptab").getElementsByClassName("selected");
	let grab3 = document.getElementById("wanapptab");
	grab3.innerHTML += "<tr onclick='selectApp(this)'>" + grab2[0].innerHTML + "</tr>";
	grab2[0].remove();
}
