
document.querySelector("nav").addEventListener("click",function(e){

  //show loader animation for a few seconds and hide it
  document.querySelector(".loader").style.display = "block";
  window.setTimeout(() => {document.querySelector(".loader").style.display = "none"}, 2000);

  //remove .click if any and add .click to the clicked item
  document.querySelectorAll("nav a").forEach(a => {
    if(a.classList.contains("clicked")){
      a.classList.remove("clicked");
    }
  })

  e.target.parentNode.classList.add("clicked");

})


// window.addEventListener("beforeunload",function(e){
//   e.preventDefault();

//    e.returnValue = '';
//   // alert("whats gooood")
// })