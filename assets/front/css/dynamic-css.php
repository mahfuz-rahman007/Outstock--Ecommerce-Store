<?php

header("Content-Type:text/css");

$color = $_GET['color']; // Change Your Color Form Here


if( isset( $_GET[ 'color' ] ) ) {
    $color = '#'.$_GET[ 'color' ];
}else{
  $color = "#bc8246";
}

?>


*::-moz-selection,
::-moz-selection,
::selection,
.theme-bg,
.sidebar__widget-content .price__slider button:hover,
.sidebar__widget-content .size ul li a:hover,
.features__product-wrapper .add-cart a:hover::after,
.product__wrapper .add-cart a:hover::after,
.product__sale span,
.product__modal-close button,
.ui-state-default, .ui-widget-content .ui-state-default, .ui-widget-header .ui-state-default, .ui-button, html .ui-button.ui-state-disabled:hover, html .ui-button.ui-state-disabled:active,
.ui-widget-header,
.postbox__quote p::before,
.highlight.theme::after,
.user-dashboard-area .card .card-header,
.dashboard-inner .card  {
    background : <?php echo $color ?> !important;
}

.theme-color,
.os-btn-4 span,
.os-btn-5 span,
.link-btn:hover,
.page__title-breadcrumb .breadcrumb-item a:hover,
.rating ul li span,
.rating.rating-shop ul li span,
.rating-left a:hover,
.header__action ul li .mini-cart .mini-cart-list li .cart-content h5:hover,
.header__action ul li .extra-info li ul li a:hover,
.header__action ul li .extra-info li ul li a.active,
.header__search-btn-close ,
.header__search-categories ul li a:hover,
.extra__info-close a:hover,
.side-mobile-menu ul li > a:hover,
.side-mobile-menu ul li ul li:hover > a,
.banner__content span,
.banner__content h5 a:hover,
.banner__content-2 span,
.banner__content-2 h4 a:hover,
.shop__header-left .search-box button,
.sidebar__widget-content .categories .shop-accordion-btn,
.sidebar__widget-content .categories .shop-accordion-btn.collapsed:hover,
.sidebar__widget-content .categories .shop-accordion-btn.collapsed.active,
.sidebar__widget-content .categories__list ul li a:hover,
.sidebar__widget-content .categories__list ul li a.active,
.sidebar__widget-content .brand ul li a:hover,
.features__product-wrapper .add-cart a:hover,
.features__product-content h5 a:hover,
.product__wrapper .add-cart a:hover,
.product__action a:hover,
.product__action a.active,
.product__content h4 a:hover,
.product__tag span a:hover,
.product__banner-content h4 a:hover,
.product__offer-slider .owl-nav div button:hover,
.user-rating ul li a,
.product__modal-content h4 a:hover,
.table-content table td.product-name a:hover,
.your-order-table table tr.order-total td span,
.blog__content h4 a:hover,
.blog__meta span a,
.postbox__social ul li a:hover,
.postbox__tag a:hover,
.reply:hover,
.load-comments,
.highlight.theme,
.highlight.comment,
.rc__post-content h6 a:hover,
.rc__meta span:hover,
.avater__info span,
.contact__social ul li a:hover,
.forgot-login a:hover,
.footer__copyright p a,
.footer__social ul li a:hover,
.shop-pagination-wrapper nav ul .page-item .page-link,
.user-dashboard-area .user-menu ul li a:hover, .user-dashboard-area .user-menu ul li a.active  {
    color: <?php echo $color ?> !important;
}


.shop-pagination-wrapper nav ul .page-item.active .page-link {
    background-color: <?php echo $color ?> !important;
    border-color: <?php echo $color ?> !important;
}

.os-btn::after,
.os-btn:hover,
.checkbox-form h3,
.your-order h3{
    background-color: <?php echo $color ?>!important;
}


.os-btn-black:hover,
.slider__area .slick-dots li.slick-active button,
.shop__header-left .search-box input:focus,
.shop__header-right .sort-wrapper select:focus,
.product__modal-nav-item.slick-center,
.conatct-post-form input:focus,
.conatct-post-form textarea:focus,
.subscribe__form input:focus,
.testimonial__wrapper .slick-dots li.slick-active button,
.contact__input input:focus, .contact__input textarea:focus,
.error__search input:focus,
.user-dashboard-area form input:focus  {
  border-color: <?php echo $color ?>!important;

}

.product__modal-box .nav-tabs .nav-link.active{
    border: 2px solid <?php echo $color ?>!important;
}

.coupon-accordion h3{
  border-top: 3px solid <?php echo $color ?>;

}

#scroll a {  background : <?php echo $color ?> !important;  border: 1px solid <?php echo $color ?>; }

.header__search-input input:focus{
  border-bottom-color: <?php echo $color ?>;

}

.product__featured span::after  {
    border: 5px solid <?php echo $color ?>;
    border-color: transparent transparent <?php echo $color ?> <?php echo $color ?>;
}

.product__featured span::before{
    border: 5px solid <?php echo $color ?>;
    border-color: <?php echo $color ?> transparent transparent <?php echo $color ?>;
}

