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
	document.getElementById("email").value = data.lastname;
	document.getElementById("address").value = data.lastname;
	document.getElementById("city").value = data.lastname;
	document.getElementById("state").value = data.lastname;
	document.getElementById("zipcode").value = data.lastname;
	document.getElementById("placeofbirth").value = data.lastname;
	document.getElementById("age").value = data.lastname;
	document.getElementById("height").value = data.lastname;
	document.getElementById("weight").value = data.lastname;
	document.getElementById("male").value = data.lastname;
	document.getElementById("female").value = data.lastname;
	document.getElementById("tab2").value = data.lastname;
	document.getElementById("english").value = data.lastname;
	document.getElementById("npass").value = data.lastname;
	document.getElementById("speakpercent").value = data.lastname;
	document.getElementById("writepercent").value = data.lastname;
	document.getElementById("whereenglish").value = data.lastname;
	document.getElementById("driverlicense").value = data.lastname;
	document.getElementById("nodriverlicense").value = data.lastname;
	document.getElementById("driverlicensetype").value = data.lastname;
	document.getElementById("passport").value = data.lastname;
	document.getElementById("nopassport").value = data.lastname;
	document.getElementById("passportoptions").value = data.lastname;
	document.getElementById("expdate").value = data.lastname;
	document.getElementById("npass").value = data.lastname;


}



function btnnext(inc) {
	document.getElementById("form").submit();
	return
    var tabs = document.getElementsByClassName("tab");
    if (!isValid(currentTab)) {
        return false;
    }
    tabs[currentTab].style.display = "none";
    console.log( tabs[currentTab].style.display);
    currentTab = currentTab + inc;
    if (currentTab == tabs.length) {
        document.getElementById("form").submit();
        
    } else {
        tabChange(currentTab)
    }
    return false;
}

function prevent (){
    return false;
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

tabChange(0);