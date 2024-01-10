var currentTab = 0;
document.getElementById("btnnext").addEventListener("click", function(e){
    e.preventDefault();
    btnnext(1);
})
tabChange(currentTab);

function tabChange(tab) {
    var tabs = document.getElementsByClassName("tab");
    currentTab = tab;
    if (tab == 0) {
        document.getElementById("btnback").style.display = "none";
    } else {
        document.getElementById("btnback").style.display = "inline";
    }
    if (tab == (tabs.length - 1)) {
        document.getElementById("btnnext").innerHTML = "Enviar";
    } else {
        document.getElementById("btnnext").innerHTML = "Proximo";
    }
    var items = document.getElementsByClassName("tabbtn");
    var tabs = document.getElementsByClassName("tab");
   for( i = 0; i < items.length; i++){
       items[i].classList.remove("current")
        tabs[i].style.display = "none"

   }

   items[tab].classList.add("current")
   tabs[tab].style.display = "block"
   //allow use of this file in both mk.html and app2.html
   if (typeof usp === "undefined" ){
        if (tab == 1) {
                document.getElementById("english").focus();

            } else if (tab == 2) {
                document.getElementById("acelga").focus();
            }
            // items[0].toggle("current");
        // items[1].toggle("current");
    }
    else{ 
        if(tab == 1){
            document.getElementById("fatherFname").focus(); 
        } else if (tab == 2) {
            document.getElementById("disease").focus();
        }
    }
}
    
function btnnext(inc) {
    var tabs = document.getElementsByClassName("tab");
    if (!isValid(currentTab)) {
        return false;
    }
    tabs[currentTab].style.display = "none";
    //console.log( tabs[currentTab].style.display);
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

function isValid(tab){
    //return true
    console.log(tab)
    let ok = true
    let inputs; 
    if (tab == 0){
         inputs = document.getElementById("tab1").getElementsByClassName("required");
    } else if (tab == 1) {
         inputs = document.getElementById("tab2").getElementsByClassName("required");
    } else {
         inputs = document.getElementById("tab3").getElementsByClassName("required");
    }
    for (let i = 0; i < inputs.length; i++){
        if (inputs[i].value == "" ){
            console.log(inputs[i].name)
            inputs[i].style.backgroundColor = "pink"
            ok = false;
        }
    }   
     return ok
}

function hideOption(item){
    if (item.value == "yes"){
        var options = document.getElementById("no" + item.id + "options")
        options.style.display = "none";

    }else{
        var options = document.getElementById(item.name + "options")
        options.style.display = "none";
        var inputs = options.getElementsByTagName("input")
        for (let i = 0; i < inputs.length; i++) {
            if (inputs[i].type == "number"){
                inputs[i].classList.remove("required")
            }
        }
    }
}

function showOption(item){
    if (item.value == "no"){
        var options = document.getElementById("no" + item.name + "options")
        options.style.display = "block";

    }else{
        var options = document.getElementById(item.id + "options")
        options.style.display = "block";
        var inputs = options.getElementsByTagName("input")
        for (let i = 0; i < inputs.length; i++) {
            if (inputs[i].type == "number"){
                inputs[i].classList.add("required");
            }
        }
    }
}

function accept(box) {
    document.getElementById("continuebutton").disabled = !box.checked;
    //console.log(!box.checked);
}
function agree0() {
    const signdate = new Date(document.getElementById("dateapplisigned1").value);
    const thisyear = new Date();
    if (document.getElementById("applisign1").value == "" 
        || !Number.isInteger(signdate.getFullYear()) 
        || signdate.getFullYear() < thisyear.getFullYear()) {
        alert("Por favor firme y feche para continuar.");
        return;
    }
    document.getElementById("applisign").value += document.getElementById("applisign1").value + "</span>";
    document.getElementById("dateapplisigned").value = document.getElementById("dateapplisigned1").value;
    document.getElementById("cita2").style.display = "block";
    if (document.getElementById("cita2").parentElement.id == "cita2") {
        agree2()
    }
}

function agree1() {
    var accept = document.getElementById("cita3");
    accept.remove();
    var cita2 = document.getElementById("cita2");
    cita2.appendChild(accept);
    document.getElementById("cita2").style.display = "block";
    //document.documentElement.scrollTop = 0;
}

function agree2() {
    document.getElementById("cita").style.display = "none";
    document.getElementById("cita2").style.display = "none";
    document.getElementById("cita3").style.display = "none";
    document.getElementById("application").style.display = "block";
}
function setFont(font) {
    document.getElementById("applisign1").style.fontFamily = font;
    document.getElementById("applisign").value = "<span style='font-family:" + font + "'>";
}
