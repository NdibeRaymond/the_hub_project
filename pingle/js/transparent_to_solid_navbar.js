$(window).on('load', function(){
  if($(window).width()<=786){
    $("#big_nav").addClass("hidden");
    $("#small_nav").removeClass("hidden");
  }else{
    $("#big_nav").removeClass("hidden");
    $("#small_nav").addClass("hidden");

  }

    })

$(window).on("resize", function(){
  if($(window).width()<=786){
    console.log($(window).width());
    $("#big_nav").addClass("hidden");
    $("#small_nav").removeClass("hidden");
  }else{
    $("#big_nav").removeClass("hidden");
    $("#small_nav").addClass("hidden");

  }

    })
//

/**
 * Listen to scroll to change header opacity class
 */
function checkScroll(){

    var startY = $('.navbar.top_nav').height() * 0.1; //The point where the navbar changes in px

    if($(window).scrollTop() > startY){
        $('.navbar.top_nav').addClass("scrolled");
    }else{
        if(($("#bs-example-navbar-collapse-1").is(":visible")) == false){
        console.log("toggle is open")};
        $('.navbar.top_nav').removeClass("scrolled");
    }
}

if($('.navbar.top_nav').length > 0){
    $(window).on("scroll load resize", function(){
        checkScroll();
    });
}


$(".navbar-toggle.collapsed").on("click", function(){
  if(($("#bs-example-navbar-collapse-1").is(":visible")) == false){
  console.log("toggle is open");
  $('.navbar.top_nav').addClass("scrolled");}else{
    checkScroll();
  };})


  $(".panel-footer").on("click", function(){
    if(($("#collapseOne").is(":visible")) == false){
      document.querySelector(".panel-title").textContent = "Click to see less Nominations";
    // $('.navbar').addClass("scrolled");
  }else{
      document.querySelector(".panel-title").textContent = "Click to see all featured Nominations"
      // checkScroll();
    };})


  $("#home").on("click",function(){

    $(".home").removeClass("hidden");
    $("#home").addClass("current");


    $(".deal_hub").addClass("hidden");
    $("#deal_hub").removeClass("current");

    $(".talks").addClass("hidden");
    $("#talks").removeClass("current");

    $(".nominations").addClass("hidden");
    $("#nominations").removeClass("current");

  })

  $("#deal_hub").on("click",function(){

    $(".home").addClass("hidden");
    $("#home").removeClass("current");


    $(".deal_hub").removeClass("hidden");
    $("#deal_hub").addClass("current");

    $(".talks").addClass("hidden");
    $("#talks").removeClass("current");

    $(".nominations").addClass("hidden");
    $("#nominations").removeClass("current");
  })


  $("#talks").on("click",function(){

    $(".home").addClass("hidden");
    $("#home").removeClass("current");


    $(".deal_hub").addClass("hidden");
    $("#deal_hub").removeClass("current");

    $(".talks").removeClass("hidden");
    $("#talks").addClass("current");

    $(".nominations").addClass("hidden");
    $("#nominations").removeClass("current");

  })

  $("#nominations").on("click",function(){

    $(".home").addClass("hidden");
    $("#home").removeClass("current");


    $(".deal_hub").addClass("hidden");
    $("#deal_hub").removeClass("current");

    $(".talks").addClass("hidden");
    $("#talks").removeClass("current");

    $(".nominations").removeClass("hidden");
    $("#nominations").addClass("current");

  })


  $(window).on('load', function(){

      $(".home").removeClass("hidden");
      $("#home").addClass("current");


      $(".deal_hub").addClass("hidden");
      $("#deal_hub").removeClass("current");

      $(".talks").addClass("hidden");
      $("#talks").removeClass("current");

      $(".nominations").addClass("hidden");
      $("#nominations").removeClass("current");

      })



/******************************************************************************/
      /********************privacy policy listener script***************/

      $("#privacy_policy").on("click",function(){

        $(".privacy_policy").removeClass("hidden");
        $("#privacy_policy").addClass("current");


        $(".terms_of_use").addClass("hidden");
        $("#terms_of_use").removeClass("current");
      })



      $("#terms_of_use").on("click",function(){

        $(".terms_of_use").removeClass("hidden");
        $("#terms_of_use").addClass("current");


        $(".privacy_policy").addClass("hidden");
        $("#privacy_policy").removeClass("current");
      })
      /********************privacy policy listener script***************/
/******************************************************************************/


// 786




   //  var elmnt = document.createElement("li");
   //     var textnode = document.createTextNode("Water");
   //     elmnt.appendChild(textnode);
   //
   //     var item = document.getElementById("myList");
   //     item.replaceChild(elmnt, item.childNodes[0]);
   // }

    // var textnode = document.createTextNode("Water");
    //     var item = document.getElementById("myList").childNodes[0];
    //     item.replaceChild(textnode, item.childNodes[0]);
    // }
