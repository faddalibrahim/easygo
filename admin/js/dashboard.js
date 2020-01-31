
document.querySelector("nav").addEventListener("click",function(e){

  //show loader animation for a few seconds and hide it
  document.querySelector(".loader").style.display = "block";
  window.setTimeout(() => {document.querySelector(".loader").style.display = "none"}, 2000);
  // e.target.cssText = "color: red; background-color: blue";

  // document.querySelectorAll("nav a i").forEach(icon => {
  //   if(icon.classList.contains("clicked")){
  //     icon.classList.remove("clicked");
  //   }
  //   if(icon.parentNode.classList.contains("color-border")){
  //     icon.parentNode.classList.remove("color-border");
  //   }
  // })

  // e.target.classList.add("clicked");
  // e.target.parentNode.classList.add("color-border");
  // e.target.parentNode.style.borderColor = "red";

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