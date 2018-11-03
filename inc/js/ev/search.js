document.addEventListener('DOMContentLoaded', function(e) {
  var element = document.querySelector('.site-search .search-wrapp .search-suggestions-wrapp');
  var in_dom = document.body.contains(element);
  var observer = new MutationObserver(function(mutations) {
    var imgs = element.querySelectorAll('.woocommerce li img');
    var i;

    for (i = 0; i < imgs.length; i++) {
      var imgsrc = imgs[i].src;
      imgsrc = imgsrc.replace('wp-content/plugins/woocommerce/assets/images/placeholder.png', 'wp-content/themes/wine-space-shopkeeper/images/products/default-bottle.svg');
      imgs[i].src = imgsrc;
    }

  });
  observer.observe(element, {childList: true});
});
