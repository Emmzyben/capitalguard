let pageOpen = false;

function openPage() {
   document.getElementById("upperbase").style.display="block"
    pageOpen = true;
}

function closePage() {
    document.getElementById("upperbase").style.display="none"
    pageOpen = false;
}

document.getElementById("toggleButton").onclick = function() {
    if (pageOpen) {
        closePage();
    } else {
        openPage();
    }
}





