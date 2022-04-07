var currentTab = 0;

function tabChange(tab) {
    var tabs = document.getElementsByClassName("tab");
    tabs[tab].style.display = "block";
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
   // var items = document.getElementById("tabmenu").getElementsByTagName("button");
   // items[0].toggle("current");
   // items[1].toggle("current");
    }
    
function btnnext(inc) {
    var tabs = document.getElementsByClassName("tab");
    //if (inc == 1 && !formisValid()) {
   //     return false;
  //  }
    tabs[currentTab].style.display = "none";
    console.log( tabs[currentTab].style.display);
    currentTab = currentTab + inc;
    if (currentTab = tabs.length) {
        document.getElementById("form").submit();
    } else {
        tabChange(currentTab)
    }
    return false;
    }




