
//recupere l'url ded la page courante
let url = document.location.href;

//recupere les id de chaque li
let classIndex = document.querySelector("#index");
let index = document.querySelector("#index").getAttribute('href');

let classActu = document.querySelector("#actu");
let actu = document.querySelector("#actu").getAttribute('href');

let classParent = document.querySelector("#parent");
let parent = document.querySelector("#parent").getAttribute('href');

let classDoc = document.querySelector("#doc");
let doc = document.querySelector("#doc").getAttribute('href');

let classContact = document.querySelector("#contact");
let contact = document.querySelector("#contact").getAttribute('href');



//coupe l'url en tableau et recupere le dernier element
let pathArray = window.location.pathname.split( "/" );
let length = pathArray.length-1;
let urlPage = pathArray[length];


//condition d'activation suivant l'url active
if(urlPage == index) {
    classIndex.classList.add("class","active");
    console.log('ok')
} else if(urlPage == actu) {
    classActu.classList.add("class","active");
    console.log('ok')
} else if(urlPage == parent) {
    classParent.classList.add("class","active");
    console.log('ok')
} else if(urlPage == doc) {
    classDoc.classList.add("class","active");
    console.log('ok')
} else if(urlPage == contact) {
    classContact.classList.add("class","active");
    console.log('ok')
}
