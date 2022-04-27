var currentTab = 0;
document.getElementById("btnnext").addEventListener("click", function(e){
    e.preventDefault()
    btnnext(1)
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
    // items[0].toggle("current");
   // items[1].toggle("current");
    }
    
function btnnext(inc) {
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

function isValid(tab){
    return true
    console.log(tab)
    let ok = true
    if (tab == 0){
        let inputs = document.getElementById("tab1").getElementsByTagName("input");
        for (let i = 0; i < inputs.length - 2; i++){
           if (inputs[i].value == "" ){
                console.log(inputs[i].id)
                inputs[i].style.backgroundColor = "pink"
                ok = false;
           }
        }
    } else if (tab == 1){
    } else {

    }   
     return ok
}

function showOption(item){
    document.getElementById(item.id + "options").style.display = "block";
}


