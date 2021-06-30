
//recupere l'url de la page courante
let url = document.location.href;

//recupere les id de chaque li
let classIndex = document.querySelector("#index");
let index = document.querySelector("#index").getAttribute('href');

let classActu = document.querySelector("#actu");
let actu = document.querySelector("#actu").getAttribute('href');

let classParent = document.querySelector("#parent");
let parent = document.querySelector("#parent").getAttribute('href');

let classDoc = document.querySelector("#doc");
let dochref = document.querySelector("#dochref").getAttribute('href');

let lien = document.querySelector("#lienUtile").getAttribute('href');

let classContact = document.querySelector("#contact");
let contact = document.querySelector("#contact").getAttribute('href');

//coupe l'url en tableau et recupere le dernier element
let pathArray = window.location.pathname.split( "/" );
let length = pathArray.length-1;
let urlPage = pathArray[length];


//condition d'activation suivant l'url active
if(urlPage == index) {
    classIndex.classList.add("class","active");

} else if(urlPage == actu) {
    classActu.classList.add("class","active");

} else if(urlPage == parent) {
    classParent.classList.add("class","active");

} else if(urlPage == dochref) {
    classDoc.classList.add("class","active");
  
} else if(urlPage == contact) {
    classContact.classList.add("class","active");

} else if(urlPage == lien) {
    classDoc.classList.add("class","active");

}


{/* <div id="wrapper-9cd199b9cc5410cd3b1ad21cab2e54d3">
<div id="map-9cd199b9cc5410cd3b1ad21cab2e54d3"></div><script>(function () {
    var setting = {"height":531,"width":803,"zoom":13,"queryString":"Saint-Pierre-de-Lages, France","place_id":"ChIJKxqDg22RrhIR4BJBL5z2BgQ","satellite":false,"centerCoord":[43.56570565680264,1.6269875470742168],"cid":"0x406f69c2f4112e0","lang":"fr","cityUrl":"/france/toulouse","cityAnchorText":"Carte de Toulouse, Sud de la France, France","id":"map-9cd199b9cc5410cd3b1ad21cab2e54d3","embed_id":"510435"};
    var d = document;
    var s = d.createElement('script');
    s.src = 'https://1map.com/js/script-for-user.js?embed_id=510435';
    s.async = true;
    s.onload = function (e) {
      window.OneMap.initMap(setting)
    };
    var to = d.getElementsByTagName('script')[0];
    to.parentNode.insertBefore(s, to);
  })();</script><a href="https://1map.com/fr/map-embed">1 Map</a></div>
</div> */}