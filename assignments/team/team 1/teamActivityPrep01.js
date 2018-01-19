function colorChangeOne() {
    "use strict";
    var color = document.getElementById("colorChangeSelect").value;
    document.getElementById("one").style.backgroundColor = color;
}

function colorSelectPress(key) {
    "use strict";
    if(key.keyCode == 13){
        colorChangeOne();
    }
}