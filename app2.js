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
	document.getElementById("lname").value = data.lastname;
	document.getElementById("lname").value = data.lastname;
	document.getElementById("lname").value = data.lastname;
}