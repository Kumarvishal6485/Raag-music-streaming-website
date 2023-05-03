let homee = document.getElementById("home");
let fav = document.getElementById("fav");
let play = document.getElementById("play");
let rec = document.getElementById("rec");
let str = document.getElementById("str");
let hr = document.getElementById("hr");
let hr1 = document.getElementById("hr1");
let hr2 = document.getElementById("hr2");
let hr3 = document.getElementById("hr3");
function home() {
    homee.style.color = "red";
    fav.style.color = "white";
    play.style.color = "white";
    rec.style.color = "white";
    str.style.color = "white";
    hr.style.color = "white";
    hr1.style.color = "white";
    hr2.style.color = "white";
    hr3.style.color = "white";
}
function favourite() {
    homee.style.color = "red";
    fav.style.color = "red";
    play.style.color = "white";
    rec.style.color = "white";
    str.style.color = "white";
    hr.style.color = "red";
    hr1.style.color = "white";
    hr2.style.color = "white";
    hr3.style.color = "white";
}

function playlist() {
    homee.style.color = "red";
    fav.style.color = "red";
    play.style.color = "red";
    rec.style.color = "white";
    str.style.color = "white";
    hr.style.color = "red";
    hr1.style.color = "red";
    hr2.style.color = "white";
    hr3.style.color = "white";
}


function recent() {
    homee.style.color = "red";
    fav.style.color = "red";
    play.style.color = "red";
    rec.style.color = "red";
    str.style.color = "white";
    hr.style.color = "red";
    hr1.style.color = "red";
    hr2.style.color = "red";
    hr3.style.color = "white";
}

function stream() {
    homee.style.color = "red";
    fav.style.color = "red";
    play.style.color = "red";
    rec.style.color = "red";
    str.style.color = "red";
    hr.style.color = "red";
    hr1.style.color = "red";
    hr2.style.color = "red";
    hr3.style.color = "red";
}

///function hower() {
//    let img_play_button = document.getElementsByClassName('favsongs', 'streaming');
//    for (var i = 0; i < img_play_button.length; i++) {
//        console.log('hello');
//        img_play_button[i].lastElementChild.style.visibility = 'unset';
//    }
//}
//function unhower() {
//   let img_play_button = document.getElementsByClassName('favsongs');
//    for (var i = 0; i < img_play_button.length; i++) {
//        img_play_button[i].lastElementChild.style.visibility = 'hidden';
//    }
//}