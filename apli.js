var currentTab = 0;
document.getElementById("btnnext").addEventListener("click", function(e){
    e.preventDefault();
    btnnext(1);
})
tabChange(currentTab);

function tabChange(tab) {
    var tabs = document.getElementsByClassName("tab");
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
    var options = document.getElementById(item.id + "options")
    options.style.display = "block";
    var inputs = options.getElementsByTagName("input")
    for (let i = 0; i < inputs.length; i++) {
        if (inputs[i].type == "number"){
            inputs[i].classList.add("required");
        }
    }

}


