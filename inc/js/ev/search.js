document.addEventListener('DOMContentLoaded', function(e) {
  var element = document.querySelector('.site-search .search-wrapp .search-suggestions-wrapp');
  var in_dom = document.body.contains(element);
  var observer = new MutationObserver(function(mutations) {
    var i;

    // MANAGE IMAGES
    var imgs = element.querySelectorAll('.woocommerce li img');
    for (i = 0; i < imgs.length; i++) {
      var imgsrc = imgs[i].src;
      imgsrc = imgsrc.replace('wp-content/plugins/woocommerce/assets/images/placeholder.png', 'wp-content/themes/wine-space-shopkeeper/images/products/default-bottle.svg');
      imgs[i].src = imgsrc;
    }

    // MANAGE LABEL
    var outOfStock = element.querySelectorAll('.woocommerce li .out_of_stock_badge_loop');
    for (i = 0; i < outOfStock.length; i++) {
      outOfStock[i].innerHTML = 'Bientôt disponible';
    }

  });
  observer.observe(element, {childList: true});
});
