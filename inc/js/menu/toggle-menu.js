document.addEventListener('DOMContentLoaded', function(e) {
  var clickedOnLink = false;
  var acc      = document.querySelectorAll('.ev-accordion li');
  var accLinks = document.querySelectorAll('.ev-accordion li a');
  var i;

  for (i = 0; i < acc.length; i++) {
    acc[i].addEventListener('click', function() {
      if (!clickedOnLink) {
        this.classList.toggle('active');
        var panel = this.nextElementSibling;
        if (panel) {
          if (panel.style.maxHeight){
            panel.style.maxHeight = null;
          } else {
            panel.style.maxHeight = panel.scrollHeight + 'px';
          }
        }
      }
      clickedOnLink = false;
    });
  }

  for (i = 0; i < accLinks.length; i++) {
    accLinks[i].addEventListener('click', function(event) {
      clickedOnLink = true;
    });
  }

  var linkOpenMenu = document.getElementById('toggle-menu-open');
  var linkCloseMenu = document.getElementById('toggle-menu-close');
  var menu = document.getElementById('ev-menu-toggle');

  linkOpenMenu.addEventListener('click', function(event) {
    event.preventDefault();
    window.scrollTo(0, 0);
    menu.classList.add('open');
  });

  linkCloseMenu.addEventListener('click', function(event) {
    event.preventDefault();
    menu.classList.remove('open');
  });

});
