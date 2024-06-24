<?php
header("Content-Type:text/css");
$color = "#f0f"; // Change your Color Here
$secondColor = "#ff8"; // Change your Color Here

function checkhexcolor($color){
    return preg_match('/^#[a-f0-9]{6}$/i', $color);
}

if (isset($_GET['color']) AND $_GET['color'] != '') {
    $color = "#" . $_GET['color'];
}

if (!$color OR !checkhexcolor($color)) {
    $color = "#336699";
}


function checkhexcolor2($secondColor){
    return preg_match('/^#[a-f0-9]{6}$/i', $secondColor);
}

if (isset($_GET['secondColor']) AND $_GET['secondColor'] != '') {
    $secondColor = "#" . $_GET['secondColor'];
}

if (!$secondColor OR !checkhexcolor2($secondColor)) {
    $secondColor = "#336699";
}
?>


.header__top {
    background-color: <?php echo $secondColor ?>fc;
}
.header__bottom,.doctor-widget {
    background-color: <?php echo $secondColor ?>99;
}
.doctor-widget, .cookie__wrapper {
    background-color: <?php echo $secondColor ?>;
}

.category-card::before, .testimoninal-card__footer, .post-card__date {
    background-color: <?php echo $color ?>;
}

.btn--base, .btn--base:hover, .feature-card, .call-item .icon, .subscribe-form .subscribe-btn, .footer-widget .social-link-list li a, .pagination .page-item.active .page-link, .card-view-btn-area button.active{
    background-color: <?php echo $color ?>;
}
.preloader .preloader-container .animated-preloader,
.preloader .preloader-container .animated-preloader:before,
.action-widget__title::after,
.doctor-details-header::before,
.custom-file-upload::before,
.action-sidebar-close,
.action-sidebar-open,
.doctor-slider .slick-dots li.slick-active button,
.blog-details__thumb .post__date .date,
.select2-container--default .select2-results__option--highlighted[aria-selected],
.sidebar .widget .widget__title::after {
    background: <?php echo $color ?>;
}

.header.menu-fixed .header__bottom {
    background-color: <?php echo $secondColor ?>;
}

.work-card-item::before {
    border-top: 1px dashed  <?php echo $color ?>35;
}

.action-sidebar {
    border-color: <?php echo $color ?>38;
    background-color: <?php echo $color ?>17;
}

.footer-action-wrapper {
    border: 2px solid <?php echo $color ?>a6;
}

.text--base, a:hover, .doctor-info-list li i, .work-card-item::after, .read-more {
    color: <?php echo $color ?> !important;
}

.caption-list-two {
    padding: 0.625rem 0.9375rem;
    background-color: <?php echo $color ?>1a;
}


.box--border {
    border: 4px solid <?php echo $color ?>8c;
}

.footer::before, .footer__bottom::after{
    background-color: <?php echo $secondColor ?>;
}

.form--control{
    border-color: <?php echo $color ?>;
}

.form--control:focus {
    border-color: <?php echo $color ?> !important;
}

.form--control:focus {
    box-shadow: 0 0 5px <?php echo $color ?>35 !important;
}


@media (max-width: 575px) {
    .category-slider .slick-arrow {
    background-color: <?php echo $color ?>;
}
}
