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




//revoke booking using ajax
// document.querySelector("#revoke").addEventListener("click", function (argument) {
//   let get;
//   fetch("bookingform.php")
//     .then(item => get = item.responseText)


//     let user = this.getAttribute("data-user");
//     let http = new XMLHttpRequest();
//     http.onreadystatechange = function () {
//       if(http.readyState == 4 && http.status == 200){
//         if(this.response !== ""){
//           document.querySelector("#bookings").innerHTML = get;
//           alert(this.responseText)
//         }
//       }
//     }
//     // http.open("GET", "ajax.php?carted_items_id="+carted_items_id, true);
//     http.open("GET", "user_dashboard.php?user="+user, true);
//     http.send();
//     // alert(this.getAttribute("data-user"));
// })

const timeSet = {
  /*From Ashesi to Somewhere*/
  to:{
    friday:["2:30pm","5:30pm"],
    saturday:["10am","1:30pm","5:30pm"],
    sunday:["4pm"]
  },
  /*From Somewhere to Ashesi*/
  from:{
    friday:["4pm"],
    saturday:["11:30am","3pm","8pm"],
    sunday:["2pm","6pm"]
  }
}


let type = document.querySelector("#bookings select[name=type]"),
    day = document.querySelector("#bookings select[name=day]"),
    time = document.querySelector("#bookings select[name=time]"),
    toFrom = document.querySelector("select[name=location] > option:first-child"),
    price = document.querySelector("#bookings input[name=price]"),
    locationn = document.querySelector("select[name=location]");

type.addEventListener("change", function(){
  if(this.value === "From Ashesi"){
    toFrom.innerHTML = "To";
    if(day.value != "Day"){
      changeTime(toFrom.textContent.toLowerCase(),day.value.toLowerCase());
    }
  }else if(this.value === "To Ashesi"){
    toFrom.innerHTML = "From";
    if(day.value != "Day"){
      changeTime(toFrom.textContent.toLowerCase(),day.value.toLowerCase());
    }
  }
})

day.addEventListener("change", function(){
  // time.style.display = "block";
  if(this.value === "Friday"){
    if(type.value != "Type"){
      changeTime(toFrom.textContent.toLowerCase(),this.value.toLowerCase())
    }
      // alert(this.value)
  }else if(this.value === "Saturday"){
     if(type.value != "Type"){
       changeTime(toFrom.textContent.toLowerCase(),this.value.toLowerCase())
     }
  }else if(this.value === "Sunday"){
     if(type.value != "Type"){
       changeTime(toFrom.textContent.toLowerCase(),this.value.toLowerCase())
     }
  }
})

locationn.addEventListener("change",function(){
  let selectedLocation = this.value;
  // console.log(text)
  // console.log(parseInt(text.split("-")[1]));
  // console.log(this.value)

  // console.log(this.children.filter(child => child.includes(selectedLocation)))

  let [option] = Array.from(this).filter(child => child.textContent.includes(selectedLocation));
  // console.log(option);
  let [,priceText] = option.textContent.split("-");

  // console.log(parseInt(price));

  price.value = parseInt(priceText);


})


function changeTime(type,day){
  time.innerHTML = null;
  for(let timee of timeSet[type][day]){
    // let option = document.createElement("option");
    // option.innerHTML = timee;
    // time.appendChild(option);

    time.innerHTML += (`<option>${timee}</option>`);
  }
}

// let parent = document.querySelector("select[name=time]")




