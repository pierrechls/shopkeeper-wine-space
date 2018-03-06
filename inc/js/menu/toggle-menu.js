document.addEventListener('DOMContentLoaded', function(e) {
  var acc = document.querySelectorAll('.ev-accordion li');
  var i;

  for (i = 0; i < acc.length; i++) {
    acc[i].addEventListener('click', function() {
      this.classList.toggle('active');
      var panel = this.nextElementSibling;
      if (panel) {
        if (panel.style.maxHeight){
          panel.style.maxHeight = null;
        } else {
          panel.style.maxHeight = panel.scrollHeight + 'px';
        }
      }
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
