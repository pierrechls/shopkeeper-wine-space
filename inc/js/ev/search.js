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

    // ADD BUTTON SEE ALL
    var woocommerceContainer = element.querySelector('.woocommerce');
    var buttonSeeAll = document.createElement('BUTTON');
    var buttonSeeAllText = document.createTextNode('Voir tous les résultats');
    buttonSeeAll.appendChild(buttonSeeAllText);
    buttonSeeAll.setAttribute('style', "background: #BAA571; padding: 1.5rem 2rem; color: #FFFFFF; text-transform: uppercase; font-size: 1.3rem; margin: 1rem auto; display: inline-block; font-family: 'OpenSans'; font-weight: 800; border-radius: 0.5rem; outline: none; cursor: pointer;");
    buttonSeeAll.onclick = function() {
      var form = document.querySelector('.site-search .search-wrapp form');
      if (form) {
        form.submit();
      }
    };
    woocommerceContainer.appendChild(buttonSeeAll);

  });
  observer.observe(element, {childList: true});
});
