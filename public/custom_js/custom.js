/*global jQuery:false */
jQuery(document).ready(function($) {
    "use strict";
    
        

  //adding a class


    $('#menu-nav a').click(function(e) {
            var link = $(this);

            var item = link.parent("li");
            
            if (item.hasClass("active")) {
                item.removeClass("active").children("a").removeClass("active");
            } else {
                item.addClass("active").children("a").addClass("active");
            }

            if (item.children("ul").length > 0) {
                var href = link.attr("href");
                link.attr("href", "#");
                setTimeout(function () { 
                    link.attr("href", href);
                }, 300);
                e.preventDefault();
            }
        })
        .each(function() {
            var link = $(this);
            if (link.get(0).href === location.href) {
                link.addClass("active").parents("li").addClass("active");
                return false;
            }
        });







  //<!-- jquery and javascript for navigation stick on top--> 
     //on scroll stay fixed on top
  
    


	/* ==============================================
			SCROLL UP
		=============================================== */
			
        $(window).scroll(function(){
            if ($(this).scrollTop() > 100) {
                $('.scrollup').fadeIn();
            } else {
                $('.scrollup').fadeOut();
            }
        }); 
        
        $('.scrollup').click(function(){
            $("html, body").animate({ scrollTop: 0 }, 600);
            return false;
        });
    




    });





function DefaultNavFunction(el) {
  const n = document.getElementById("navigation");
  const x = document.getElementById("responsive-nav");

  const isActive = x.classList.contains("responsive");

  if (isActive) {
    x.classList.remove("responsive");
    n.classList.remove("shadow");
    document.body.classList.remove('lock-scroll'); // Restore body scrolling
  } else {
    x.classList.add("responsive");
    n.classList.add("shadow");
    document.body.classList.add('lock-scroll');
  }
}

if (document.getElementById("responsive-nav")) {
   const n = document.getElementById("navigation");
  const x = document.getElementById("responsive-nav");

    n.addEventListener('click', function(event) {
     
     if (event.target.classList.contains('shadow')) {
     x.classList.remove("responsive");
      //navx.classList.remove("h-auto");
      n.classList.remove("shadow");
  document.body.classList.remove('lock-scroll'); // Restore body scrolling
}

    });
}


//});
/////////////////////////
if(document.querySelector('.navigation')!==null){
  var firstNav = document.querySelector('.navigation-transparent');

  if (firstNav !== null) {
    var prevScrollPos = window.pageYOffset;

    window.addEventListener('scroll', function() {
      var currentScrollPos = window.pageYOffset;
       if (currentScrollPos > 150) {
      //if (currentScrollPos > prevScrollPos * 100) {
        // Scrolling down
          firstNav.classList.remove('navigation-transparent');

      } else {
        // Scrolling up
        // Reset the top property of the first navigation when at the very top
        if (currentScrollPos === 0) {
          firstNav.classList.add('navigation-transparent');
        }
      }

      prevScrollPos = currentScrollPos;
    });
  }
  }
//});*/
//////////