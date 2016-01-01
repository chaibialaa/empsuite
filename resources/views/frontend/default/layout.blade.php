<!doctype html>
<!--[if IE 9]>
<html class="ie9" lang="en"><![endif]-->
<!--[if (gt IE 9)|!(IE)]><!-->
<html lang="en"><!--<![endif]-->
<head>
    <title>{!! $title or 'EMPSuite' !!}</title>
    <!--meta info-->
    <meta charset="utf-8">
    <meta name="viewport" content="initial-scale=1.0,maximum-scale=1.0,user-scalable=no">
    <meta name="author" content="">
    <meta name="keywords" content="">
    <meta name="description" content="">
    <link rel="shortcut icon" type="image/x-icon" href="images/fav.ico">
    <!--web fonts-->
    <link href='http://fonts.googleapis.com/css?family=Lato:100,300,400,700,900,100italic,300italic,400italic'
          rel='stylesheet' type='text/css'>
    <!--libs css-->
    <link href="{{ asset("/assets/libraries/font-awesome/css/font-awesome.min.css")}}" rel="stylesheet"
          type="text/css"/>
    <link rel="stylesheet" type="text/css" media="all" href="{{ asset("/assets/libraries/bootstrap/bootstrap.css")}}">
    <link rel="stylesheet" type="text/css" media="all"
          href="{{ asset("/assets/theme/frontend/default/css/theme-animate.css")}}">
    <link rel="stylesheet" type="text/css" media="all"
          href="{{ asset("/assets/theme/frontend/default/css/style.css")}}">
    <!--head libs-->
    <script src="{{ asset("/assets/libraries/jQuery/jQuery-2.1.4.min.js")}}"></script>
    <script src="{{ asset("/assets/libraries/bootstrap/js/bootstrap.js")}}"></script>
    <script src="{{ asset("/assets/theme/frontend/default/js/memmenu.js")}}"></script>
    <script src="{{ asset("/assets/libraries/sweetalert/dist/sweetalert.min.js") }}"></script>

    @if (Route::getCurrentRoute()->getPath() == "/")
    <link rel="stylesheet" type="text/css" href="{{ asset("/assets/libraries/flexslider/flexslider.css")}}">
    <script src="{{ asset("/assets/libraries/flexslider/flexslider-min.js") }}"></script>
    @endif

    <link rel="stylesheet" type="text/css" href="{{ asset("/assets/libraries/sweetalert/dist/sweetalert.css")}}">

    @if((isset($additionalLibs)) and (count($additionalLibs)>0))
        @foreach($additionalLibs as $additionalLib)
            <script src="{{ asset("/assets/".$additionalLib)}}"></script>
        @endforeach
    @endif
    @if((isset($additionalCsss)) and (count($additionalCsss)>0))
        @foreach($additionalCsss as $additionalCss)
            <link href="{{ asset("/assets/".$additionalCss) }}" rel="stylesheet" type="text/css" media="all"/>
        @endforeach
    @endif
    <link href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css" rel="stylesheet">
    <script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
</head>

<body class="sticky_menu">

<button id="open_side_menu" class="fa fa-_wrap_size_2 circle color_black">
    <i class="fa fa-menu"></i>
</button>

<!--layout-->
<div class="wide_layout bg_light">



    <header role="banner" class="relative">
        <span class="gradient_line"></span>
        <!--top part-->
        <section class="header_top_part">
            <div class="container">
                <div class="row">

                    @if((isset($top_header_left)) and (count($top_header_left)>0))

                        @foreach($top_header_left as $thl)
                            <div class="col-lg-3 col-md-3 col-sm-3 t_xs_align_c">
                                <ul class="hr_list fs_small color_grey_light">
                                    <li class="m_right_20 f_xs_none m_xs_right_0 m_xs_bottom_5">

                                                     {!! $thl !!}
                                    </li>

                                </ul>
                            </div>
                        @endforeach


                    @endif


                        @if((isset($top_header_right)) and (count($top_header_right)>0))

                                        @foreach($top_header_right as $thr)
                    <div class="col-lg-9 col-md-9 col-sm-9 t_align_r t_xs_align_c">
                                                {!! $thr !!}
                    </div>
                                        @endforeach


                        @endif


                </div>
            </div>
        </section>
        <hr>
        <!--header bottom part-->
        <section class="header_bottom_part bg_light">
            <div class="container">
                <div class="d_table w_full d_xs_block">
                    <!--logo-->
                    <div class="col-lg-2 col-md-2 col-sm-2 d_table_cell d_xs_block f_none v_align_m logo t_xs_align_c">
                        <a href="/" class="d_inline_m m_xs_top_20 m_xs_bottom_20">
                            <h4> {!! $title or 'EMPSuite' !!}</h4>
                        </a>
                    </div>
                    <div class="col-lg-10 col-md-10 col-sm-10 t_align_r d_table_cell d_xs_block f_none">
                        <div class="relative clearfix t_align_r">
                            <button id="menu_button"
                                    class="r_corners tr_all color_blue db_centered m_bottom_20 d_none d_xs_block">
                                <i class="fa fa-menu"></i>
                            </button>
                            <!--main navigation-->
                            <nav role="navigation"
                                 class="d_inline_m d_xs_none m_xs_right_0 m_right_15 m_sm_right_5 t_align_l m_xs_bottom_15">
                                <ul class="hr_list main_menu fw_light">
                                    <li class="container3d relative f_xs_none m_xs_bottom_5">
                                        <a class="color_dark fs_large relative r_xs_corners" href="index.html">Home
                                            <i class="fa fa-angle-down d_inline_m"></i>
                                        </a>
                                        <!--sub menu-->
                                        <ul class="sub_menu r_xs_corners bg_light vr_list tr_all tr_xs_none trf_xs_none bs_xs_none d_xs_none">
                                            <li class="container3d relative">
                                                <a href="index.html" class="d_block color_dark relative">Layouts
                                                    <i class="fa fa-angle-right"></i>
                                                </a>
                                                <ul class="sub_menu bg_light vr_list tr_all tr_xs_none trf_xs_none bs_xs_none d_xs_none">
                                                    <li><a href="index.html" class="d_block color_dark">Business</a>
                                                    </li>
                                                    <li><a href="index_agency.html"
                                                           class="d_block color_dark">Agency</a></li>
                                                    <li><a href="index_portfolio.html" class="d_block color_dark">Portfolio</a>
                                                    </li>
                                                    <li><a href="index_landing.html" class="d_block color_dark">Landing
                                                            page</a></li>
                                                    <li><a href="index_magazine.html" class="d_block color_dark">Magazine</a>
                                                    </li>
                                                    <li><a href="shop.html" class="d_block color_dark">Shop</a></li>
                                                </ul>
                                            </li>
                                            <li class="container3d relative">
                                                <a href="index.html" class="d_block color_dark relative">Sliders
                                                    <i class="fa fa-angle-right"></i>
                                                </a>
                                                <!--sub menu (third level)-->
                                                <ul class="sub_menu bg_light vr_list tr_all tr_xs_none trf_xs_none bs_xs_none d_xs_none">
                                                    <li><a href="index.html" class="d_block color_dark">Revolution</a>
                                                    </li>
                                                    <li><a href="index_magazine.html"
                                                           class="d_block color_dark">Flex</a></li>
                                                    <li><a href="shop.html" class="d_block color_dark">iosSlider</a>
                                                    </li>
                                                    <li><a href="index_portfolio.html"
                                                           class="d_block color_dark">Layer</a></li>
                                                    <li><a href="index_video_slider.html" class="d_block color_dark">Video
                                                            Slider</a></li>
                                                    <li class="container3d relative">
                                                        <a href="index_text_and_form.html"
                                                           class="d_block color_dark relative">Static Content
                                                            <i class="fa fa-angle-right"></i>
                                                        </a>
                                                        <!--sub menu (fourth level)-->
                                                        <ul class="sub_menu bg_light vr_list tr_all tr_xs_none trf_xs_none bs_xs_none d_xs_none">
                                                            <li><a href="index_text_and_form.html"
                                                                   class="d_block color_dark">Text &amp; Form</a></li>
                                                            <li><a href="index_other_head_static_content.html"
                                                                   class="d_block color_dark">Event Countdown</a></li>
                                                            <li><a href="index_video_background.html"
                                                                   class="d_block color_dark">Video Background</a></li>
                                                            <li><a href="index_video_in_popup.html"
                                                                   class="d_block color_dark">Video in Popup Window</a>
                                                            </li>
                                                            <li><a href="index_static_image.html"
                                                                   class="d_block color_dark">Static Image</a></li>
                                                            <li><a href="index_boxed_static_video.html"
                                                                   class="d_block color_dark ">Static Video</a></li>
                                                        </ul>
                                                    </li>
                                                </ul>
                                            </li>
                                        </ul>
                                    </li>
                                    <li class="current container3d relative f_xs_none m_xs_bottom_5">
                                        <a class="color_dark fs_large relative r_xs_corners" href="pages_about.html">Pages
                                            <i class="fa fa-angle-down d_inline_m"></i>
                                        </a>
                                        <ul class="sub_menu r_xs_corners bg_light vr_list tr_all tr_xs_none trf_xs_none bs_xs_none d_xs_none">
                                            <li>
                                                <a href="pages_about.html" class="d_block color_dark relative">About
                                                    us</a>
                                            </li>
                                            <li>
                                                <a href="pages_services.html" class="d_block color_dark relative">Services</a>
                                            </li>
                                            <li>
                                                <a href="pages_team.html" class="d_block color_dark relative">Team</a>
                                            </li>
                                            <li>
                                                <a href="pages_process.html"
                                                   class="d_block color_dark relative">Process</a>
                                            </li>
                                            <li>
                                                <a href="pages_careers.html"
                                                   class="d_block color_dark relative">Careers</a>
                                            </li>
                                            <li>
                                                <a href="pages_faq.html" class="d_block color_dark relative">FAQ</a>
                                            </li>
                                            <li>
                                                <a href="index_landing.html" class="d_block color_dark relative">Landing
                                                    Page</a>
                                            </li>
                                            <li>
                                                <a href="pages_404.html" class="d_block color_dark relative">404
                                                    Page</a>
                                            </li>
                                            <li>
                                                <a href="pages_coming_soon.html" class="d_block color_dark relative">Coming
                                                    soon page</a>
                                            </li>
                                            <li>
                                                <a href="pages_sitemap.html"
                                                   class="d_block color_dark relative">Sitemap</a>
                                            </li>
                                            <li>
                                                <a href="pages_full_width.html" class="d_block color_dark relative">Full
                                                    width text page</a>
                                            </li>
                                            <li class="current">
                                                <a href="pages_right_sidebar.html" class="d_block color_dark relative">Text
                                                    page with right sidebar</a>
                                            </li>
                                            <li>
                                                <a href="pages_left_sidebar.html" class="d_block color_dark relative">Text
                                                    page with left sidebar</a>
                                            </li>
                                            <li>
                                                <a href="pages_contact.html" class="d_block color_dark relative">Contact
                                                    us</a>
                                            </li>
                                        </ul>
                                    </li>
                                    <li class="container3d relative f_xs_none m_xs_bottom_5">
                                        <a class="color_dark fs_large relative r_xs_corners"
                                           href="portfolio_classic_1_column.html">Portfolio
                                            <i class="fa fa-angle-down d_inline_m r_xs_corners"></i>
                                        </a>
                                        <!--sub menu-->
                                        <ul class="sub_menu r_xs_corners bg_light vr_list tr_all tr_xs_none trf_xs_none bs_xs_none d_xs_none">
                                            <li class="container3d relative">
                                                <a href="portfolio_classic_1_column.html"
                                                   class="d_block color_dark relative">Classic
                                                    <i class="fa fa-angle-right"></i>
                                                </a>
                                                <!--sub menu (third level)-->
                                                <ul class="sub_menu bg_light vr_list tr_all tr_xs_none trf_xs_none bs_xs_none d_xs_none">
                                                    <li><a href="portfolio_classic_1_column.html"
                                                           class="d_block color_dark">1 column</a></li>
                                                    <li><a href="portfolio_classic_2_columns.html"
                                                           class="d_block color_dark">2 columns</a></li>
                                                    <li><a href="portfolio_classic_2_columns_rsidebar.html"
                                                           class="d_block color_dark">2 columns with right sidebar</a>
                                                    </li>
                                                    <li><a href="portfolio_classic_3_columns.html"
                                                           class="d_block color_dark">3 columns</a></li>
                                                    <li><a href="portfolio_classic_3_columns_lsidebar.html"
                                                           class="d_block color_dark">3 columns with left sidebar</a>
                                                    </li>
                                                    <li><a href="portfolio_classic_4_columns.html"
                                                           class="d_block color_dark">4 columns</a></li>
                                                </ul>
                                            </li>
                                            <li class="container3d relative">
                                                <a href="portfolio_sortable_t_2_columns.html"
                                                   class="d_block color_dark relative">Sortable grid with text
                                                    <i class="fa fa-angle-right"></i>
                                                </a>
                                                <!--sub menu (third level)-->
                                                <ul class="sub_menu bg_light vr_list tr_all tr_xs_none trf_xs_none bs_xs_none d_xs_none">
                                                    <li><a href="portfolio_sortable_t_2_columns.html"
                                                           class="d_block color_dark">2 columns</a></li>
                                                    <li><a href="portfolio_sortable_t_2_columns_rsidebar.html"
                                                           class="d_block color_dark">2 columns with right sidebar</a>
                                                    </li>
                                                    <li><a href="portfolio_sortable_t_3_columns.html"
                                                           class="d_block color_dark">3 columns</a></li>
                                                    <li><a href="portfolio_sortable_t_3_columns_lsidebar.html"
                                                           class="d_block color_dark">3 columns with left sidebar</a>
                                                    </li>
                                                    <li><a href="portfolio_sortable_t_4_columns.html"
                                                           class="d_block color_dark">4 columns</a></li>
                                                </ul>
                                            </li>
                                            <li class="container3d relative">
                                                <a href="portfolio_sortable_wt_2_columns.html"
                                                   class="d_block color_dark relative">Sortable grid without text
                                                    <i class="fa fa-angle-right"></i>
                                                </a>
                                                <!--sub menu (third level)-->
                                                <ul class="sub_menu bg_light vr_list tr_all tr_xs_none trf_xs_none bs_xs_none d_xs_none">
                                                    <li><a href="portfolio_sortable_wt_2_columns.html"
                                                           class="d_block color_dark">2 columns</a></li>
                                                    <li><a href="portfolio_sortable_wt_2_columns_rsidebar.html"
                                                           class="d_block color_dark">2 columns with right sidebar</a>
                                                    </li>
                                                    <li><a href="portfolio_sortable_wt_3_columns.html"
                                                           class="d_block color_dark">3 columns</a></li>
                                                    <li><a href="portfolio_sortable_wt_3_columns_lsidebar.html"
                                                           class="d_block color_dark">3 columns with left sidebar</a>
                                                    </li>
                                                    <li><a href="portfolio_sortable_wt_4_columns.html"
                                                           class="d_block color_dark">4 columns</a></li>
                                                </ul>
                                            </li>
                                            <li class="container3d relative">
                                                <a href="portfolio_masonry_2_columns.html"
                                                   class="d_block color_dark relative">Sortable masonry
                                                    <i class="fa fa-angle-right"></i>
                                                </a>
                                                <!--sub menu (third level)-->
                                                <ul class="sub_menu bg_light vr_list tr_all tr_xs_none trf_xs_none bs_xs_none d_xs_none">
                                                    <li><a href="portfolio_masonry_2_columns.html"
                                                           class="d_block color_dark">2 columns</a></li>
                                                    <li><a href="portfolio_masonry_2_columns_rsidebar.html"
                                                           class="d_block color_dark">2 columns with right sidebar</a>
                                                    </li>
                                                    <li><a href="portfolio_masonry_3_columns.html"
                                                           class="d_block color_dark">3 columns</a></li>
                                                    <li><a href="portfolio_masonry_3_columns_lsidebar.html"
                                                           class="d_block color_dark">3 columns with left sidebar</a>
                                                    </li>
                                                    <li><a href="portfolio_masonry_4_columns.html"
                                                           class="d_block color_dark">4 columns</a></li>
                                                </ul>
                                            </li>
                                            <li class="container3d relative">
                                                <a href="portfolio_single_side_image_list.html"
                                                   class="d_block color_dark relative">Single project pages
                                                    <i class="fa fa-angle-right"></i>
                                                </a>
                                                <!--sub menu (third level)-->
                                                <ul class="sub_menu bg_light vr_list tr_all tr_xs_none trf_xs_none bs_xs_none d_xs_none">
                                                    <li><a href="portfolio_single_side_image_list.html"
                                                           class="d_block color_dark">Project with side image list</a>
                                                    </li>
                                                    <li><a href="portfolio_single_full_width_image_list.html"
                                                           class="d_block color_dark">Project with full width image
                                                            list</a></li>
                                                    <li><a href="portfolio_single_side_image_slider.html"
                                                           class="d_block color_dark">Project with side image slider</a>
                                                    </li>
                                                    <li><a href="portfolio_single_full_width_image_slider.html"
                                                           class="d_block color_dark">Project with full width image
                                                            slider</a></li>
                                                    <li><a href="portfolio_single_extended_image_slider.html"
                                                           class="d_block color_dark">Project with extended image
                                                            slider</a></li>
                                                    <li><a href="portfolio_single_side_video_list.html"
                                                           class="d_block color_dark">Project with side video list</a>
                                                    </li>
                                                    <li><a href="portfolio_single_full_width_video.html"
                                                           class="d_block color_dark">Project with full width video</a>
                                                    </li>
                                                </ul>
                                            </li>
                                        </ul>
                                    </li>
                                    <li class="container3d relative f_xs_none m_xs_bottom_5">
                                        <a class="color_dark fs_large relative r_xs_corners"
                                           href="blog_classic_1_column.html">Blog
                                            <i class="fa fa-angle-down d_inline_m"></i>
                                        </a>
                                        <!--sub menu-->
                                        <ul class="sub_menu r_xs_corners bg_light vr_list tr_all tr_xs_none trf_xs_none bs_xs_none d_xs_none">
                                            <li class="container3d relative">
                                                <a href="blog_classic_1_column.html"
                                                   class="d_block color_dark relative">Classic
                                                    <i class="fa fa-angle-right"></i>
                                                </a>
                                                <ul class="sub_menu bg_light vr_list tr_all tr_xs_none trf_xs_none bs_xs_none d_xs_none">
                                                    <li><a href="blog_classic_1_column.html" class="d_block color_dark">1
                                                            column</a></li>
                                                    <li><a href="blog_classic_1_column_right_sidebar.html"
                                                           class="d_block color_dark">1 column with right sidebar</a>
                                                    </li>
                                                </ul>
                                            </li>
                                            <li class="container3d relative">
                                                <a href="blog_grid_2_columns.html" class="d_block color_dark relative">Grid
                                                    <i class="fa fa-angle-right"></i>
                                                </a>
                                                <!--sub menu (third level)-->
                                                <ul class="sub_menu bg_light vr_list tr_all tr_xs_none trf_xs_none bs_xs_none d_xs_none">
                                                    <li><a href="blog_grid_2_columns.html" class="d_block color_dark">2
                                                            columns</a></li>
                                                    <li><a href="blog_grid_2_columns_left_sidebar.html"
                                                           class="d_block color_dark">2 columns with left sidebar</a>
                                                    </li>
                                                    <li><a href="blog_grid_3_columns.html" class="d_block color_dark">3
                                                            columns</a></li>
                                                    <li><a href="blog_grid_3_columns_right_sidebar.html"
                                                           class="d_block color_dark">3 columns with right sidebar</a>
                                                    </li>
                                                    <li><a href="blog_grid_4_columns.html" class="d_block color_dark">4
                                                            columns</a></li>
                                                </ul>
                                            </li>
                                            <li class="container3d relative">
                                                <a href="blog_masonry_2_columns.html"
                                                   class="d_block color_dark relative">Masonry
                                                    <i class="fa fa-angle-right"></i>
                                                </a>
                                                <!--sub menu (third level)-->
                                                <ul class="sub_menu bg_light vr_list tr_all tr_xs_none trf_xs_none bs_xs_none d_xs_none">
                                                    <li><a href="blog_masonry_2_columns.html"
                                                           class="d_block color_dark">2 columns</a></li>
                                                    <li><a href="blog_masonry_2_columns_right_sidebar.html"
                                                           class="d_block color_dark">2 columns with right sidebar</a>
                                                    </li>
                                                    <li><a href="blog_masonry_3_columns.html"
                                                           class="d_block color_dark">3 columns</a></li>
                                                    <li><a href="blog_masonry_3_columns_left_sidebar.html"
                                                           class="d_block color_dark">3 columns with left sidebar</a>
                                                    </li>
                                                    <li><a href="blog_masonry_4_columns.html"
                                                           class="d_block color_dark">4 columns</a></li>
                                                </ul>
                                            </li>
                                            <li class="container3d relative">
                                                <a href="blog_single_right_sidebar.html"
                                                   class="d_block color_dark relative">Single blog post
                                                    <i class="fa fa-angle-right"></i>
                                                </a>
                                                <!--sub menu (third level)-->
                                                <ul class="sub_menu bg_light vr_list tr_all tr_xs_none trf_xs_none bs_xs_none d_xs_none">
                                                    <li><a href="blog_single_right_sidebar.html"
                                                           class="d_block color_dark">Image post</a></li>
                                                    <li><a href="blog_single_image_slideshow_post.html"
                                                           class="d_block color_dark">Image slideshow post</a></li>
                                                    <li><a href="blog_single_video_post.html"
                                                           class="d_block color_dark">Video post</a></li>
                                                    <li><a href="blog_single_audio_post.html"
                                                           class="d_block color_dark">Audio post</a></li>
                                                    <li><a href="blog_single_blockquote_post.html"
                                                           class="d_block color_dark">Blockquote post</a></li>
                                                    <li><a href="blog_single_link_post.html" class="d_block color_dark">Link
                                                            post</a></li>
                                                    <li><a href="blog_single_full_width.html"
                                                           class="d_block color_dark">Full Width Post</a></li>
                                                </ul>
                                            </li>
                                        </ul>
                                    </li>
                                    <li class="container3d relative f_xs_none m_xs_bottom_5">
                                        <a class="color_dark fs_large relative r_xs_corners" href="#">Features
                                            <i class="fa fa-angle-down d_inline_m"></i>
                                        </a>
                                        <!--sub mega menu-->
                                        <div class="mega_menu_container r_xs_corners bs_xs_none bg_light shadow_1 tr_all tr_xs_none trf_xs_none d_xs_none">
                                            <div class="row">
                                                <div class="col-lg-2 col-md-3 col-sm-3">
                                                    <p class="color_dark tt_uppercase m_bottom_10 m_xs_top_10">
                                                        Layouts</p>
                                                    <!--sub menu-->
                                                    <ul class="sub_menu vr_list tr_all relative">
                                                        <li><a href="index.html" class="d_block color_dark">Business</a>
                                                        </li>
                                                        <li><a href="index_agency.html" class="d_block color_dark">Agency</a>
                                                        </li>
                                                        <li><a href="index_portfolio.html" class="d_block color_dark">Portfolio</a>
                                                        </li>
                                                        <li><a href="index_landing.html" class="d_block color_dark">Landing
                                                                page</a></li>
                                                        <li><a href="index_magazine.html" class="d_block color_dark">Magazine</a>
                                                        </li>
                                                        <li><a href="shop.html" class="d_block color_dark">Shop</a></li>
                                                    </ul>
                                                </div>
                                                <div class="col-lg-2 col-md-3 col-sm-3 relative">
                                                    <p class="color_dark tt_uppercase m_bottom_10 m_xs_top_10">
                                                        Sliders</p>
                                                    <!--sub menu-->
                                                    <ul class="sub_menu vr_list tr_all tr_xs_none relative">
                                                        <li><a href="index.html"
                                                               class="d_block color_dark">Revolution</a></li>
                                                        <li><a href="index_magazine.html" class="d_block color_dark">Flex</a>
                                                        </li>
                                                        <li><a href="shop.html" class="d_block color_dark">iosSlider</a>
                                                        </li>
                                                        <li><a href="index_portfolio.html" class="d_block color_dark">Layer</a>
                                                        </li>
                                                        <li><a href="index_video_slider.html"
                                                               class="d_block color_dark">Video Slider</a></li>
                                                        <li class="container3d relative">
                                                            <a href="index_boxed_static_video.html"
                                                               class="d_block color_dark relative">Static Content
                                                                <i class="fa fa-angle-right"></i>
                                                            </a>
                                                            <!--sub menu(third level)-->
                                                            <ul class="sub_menu vr_list bg_light tr_all tr_xs_none trf_xs_none bs_xs_none d_xs_none">
                                                                <li><a href="index_text_and_form.html"
                                                                       class="d_block color_dark">Text &amp; Form</a>
                                                                </li>
                                                                <li><a href="index_other_head_static_content.html"
                                                                       class="d_block color_dark">Event Countdown</a>
                                                                </li>
                                                                <li><a href="index_video_background.html"
                                                                       class="d_block color_dark">Video Background</a>
                                                                </li>
                                                                <li><a href="index_video_in_popup.html"
                                                                       class="d_block color_dark">Video in Popup
                                                                        Window</a></li>
                                                                <li><a href="index_static_image.html"
                                                                       class="d_block color_dark">Static Image</a></li>
                                                                <li><a href="index_boxed_static_video.html"
                                                                       class="d_block color_dark ">Static Video</a></li>
                                                            </ul>
                                                        </li>
                                                    </ul>
                                                </div>
                                                <div class="col-lg-2 col-md-3 col-sm-3">
                                                    <p class="color_dark tt_uppercase m_bottom_10 m_xs_top_10">
                                                        Headers</p>
                                                    <!--sub menu-->
                                                    <ul class="sub_menu vr_list tr_all relative">
                                                        <li><a href="index.html" class="d_block color_dark">Header 1</a>
                                                        </li>
                                                        <li><a href="index_agency.html" class="d_block color_dark">Header
                                                                2</a></li>
                                                        <li><a href="index_portfolio.html" class="d_block color_dark">Header
                                                                3</a></li>
                                                        <li><a href="index_landing.html" class="d_block color_dark">Header
                                                                4</a></li>
                                                        <li><a href="index_magazine.html" class="d_block color_dark">Header
                                                                5</a></li>
                                                        <li><a href="shop.html" class="d_block color_dark">Header 6</a>
                                                        </li>
                                                    </ul>
                                                </div>
                                                <div class="col-lg-2 col-md-3 col-sm-3">
                                                    <p class="color_dark tt_uppercase m_bottom_10 m_xs_top_10">
                                                        Footers</p>
                                                    <!--sub menu-->
                                                    <ul class="sub_menu vr_list tr_all relative">
                                                        <li><a href="index.html#footer" class="d_block color_dark">Footer
                                                                1</a></li>
                                                        <li><a href="index_agency.html#footer"
                                                               class="d_block color_dark">Footer 2</a></li>
                                                        <li><a href="index_portfolio.html#footer"
                                                               class="d_block color_dark">Footer 3</a></li>
                                                        <li><a href="index_landing.html#footer"
                                                               class="d_block color_dark">Footer 4</a></li>
                                                        <li><a href="index_magazine.html#footer"
                                                               class="d_block color_dark">Footer 5</a></li>
                                                        <li><a href="shop.html#footer" class="d_block color_dark">Footer
                                                                6</a></li>
                                                    </ul>
                                                </div>
                                                <div class="col-lg-4 col-md-4 d_md_none">
                                                    <p class="color_dark tt_uppercase m_bottom_10 m_xs_top_10">More
                                                        Features</p>

                                                    <div class="row">
                                                        <div class="col-lg-6 col-md-6 col-sm-6">
                                                            <ul class="vr_list">
                                                                <li class="relative"><i
                                                                            class="fa fa-check color_scheme"></i>Responsive
                                                                    design
                                                                </li>
                                                                <li class="relative"><i
                                                                            class="fa fa-check color_scheme"></i>Bootstrap
                                                                    3
                                                                </li>
                                                                <li class="relative"><i
                                                                            class="fa fa-check color_scheme"></i>Retina
                                                                    ready
                                                                </li>
                                                                <li class="relative"><i
                                                                            class="fa fa-check color_scheme"></i>Valid
                                                                    HTML code
                                                                </li>
                                                                <li class="relative"><i
                                                                            class="fa fa-check color_scheme"></i>Boxed
                                                                    &amp; wide versions
                                                                </li>
                                                            </ul>
                                                        </div>
                                                        <div class="col-lg-6 col-md-6 col-sm-6">
                                                            <ul class="vr_list">
                                                                <li class="relative"><i
                                                                            class="fa fa-check color_scheme"></i>Parallax
                                                                    effect
                                                                </li>
                                                                <li class="relative"><i
                                                                            class="fa fa-check color_scheme"></i>Side
                                                                    menu
                                                                </li>
                                                                <li class="relative"><i
                                                                            class="fa fa-check color_scheme"></i>Video
                                                                    Background
                                                                </li>
                                                                <li class="relative"><i
                                                                            class="fa fa-check color_scheme"></i>Iconic
                                                                    fonts
                                                                </li>
                                                                <li class="relative"><i
                                                                            class="fa fa-check color_scheme"></i>Plenty
                                                                    of elements
                                                                </li>
                                                                <li class="relative">PSD files included</li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="container3d relative f_xs_none m_xs_bottom_5">
                                        <a class="color_dark fs_large relative r_xs_corners"
                                           href="shortcodes_elements.html">Shortcodes
                                            <i class="fa fa-angle-down d_inline_m"></i>
                                        </a>
                                        <ul class="sub_menu r_xs_corners bg_light vr_list tr_all tr_xs_none trf_xs_none bs_xs_none d_xs_none">
                                            <li>
                                                <a href="shortcodes_elements.html" class="d_block color_dark relative">Elements</a>
                                            </li>
                                            <li>
                                                <a href="shortcodes_columns.html" class="d_block color_dark relative">Columns</a>
                                            </li>
                                            <li>
                                                <a href="shortcodes_typography.html"
                                                   class="d_block color_dark relative">Typography</a>
                                            </li>
                                        </ul>
                                    </li>
                                    <li class="container3d relative f_xs_none m_xs_bottom_5">
                                        <a class="color_dark fs_large relative r_xs_corners" href="shop.html">Shop
                                            <i class="fa fa-angle-down d_inline_m"></i>
                                        </a>
                                        <ul class="sub_menu r_xs_corners bg_light vr_list tr_all tr_xs_none trf_xs_none bs_xs_none d_xs_none">
                                            <li>
                                                <a href="shop.html" class="d_block color_dark relative">Front page</a>
                                            </li>
                                            <li>
                                                <a href="shop_category_v1.html" class="d_block color_dark relative">Category
                                                    page v1</a>
                                            </li>
                                            <li>
                                                <a href="shop_category_v2.html" class="d_block color_dark relative">Category
                                                    page v2</a>
                                            </li>
                                            <li>
                                                <a href="shop_product_page_v1.html" class="d_block color_dark relative">Product
                                                    page v1</a>
                                            </li>
                                            <li>
                                                <a href="shop_product_page_v2.html" class="d_block color_dark relative">Product
                                                    page v2</a>
                                            </li>
                                            <li>
                                                <a href="shop_cart.html" class="d_block color_dark relative">Shopping
                                                    Cart &amp; Checkout</a>
                                            </li>
                                            <li>
                                                <a href="shop_wishlist.html" class="d_block color_dark relative">Wishlist</a>
                                            </li>
                                            <li>
                                                <a href="shop_compare_products.html"
                                                   class="d_block color_dark relative">Compare products</a>
                                            </li>
                                            <li>
                                                <a href="shop_order_list.html" class="d_block color_dark relative">Orders
                                                    list</a>
                                            </li>
                                            <li>
                                                <a href="shop_order_information.html"
                                                   class="d_block color_dark relative">Order information</a>
                                            </li>
                                        </ul>
                                    </li>
                                </ul>
                            </nav>
                            <!--searchform button-->
                            <div class="relative d_inline_m search_buttons d_xs_none">
                                <button class="icon_wrap_size_2 circle color_grey_light_2 tr_all color_purple_hover">
                                    <i class="fa fa-close"></i></button>
                                <button class="icon_wrap_size_2 active circle color_grey_light_2 tr_all color_purple_hover">
                                    <i class="fa fa-search"></i></button>
                            </div>
                            <!--searchform-->
                            <form role="search"
                                  class="bg_light animate_ vc_child t_align_r fw_light tr_all trf_xs_none">
                                <input type="text" name="search" placeholder="Search" class="r_corners d_inline_m">
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </header>
    @if (Route::getCurrentRoute()->getPath() == "/")
        @if (isset($topcontent))
            @foreach ($topcontent as $tp)
            {!! $tp !!}
            @endforeach
        @endif
    @endif
    @if (isset($module))
        <section class="page_title translucent_bg_color_scheme image_fixed t_align_c relative wrapper">
            <div class="container">
                <h1 class="color_light fw_light m_bottom_5">{{ $module['SubTitle'] }}</h1>
                <!--breadcrumbs-->
                <ul class="hr_list d_inline_m breadcrumbs">
                    <li class="m_right_8 f_xs_none"><a href="{{ $module['URL'] or '#' }}"
                                                       class="color_grey_light_3 d_inline_m m_right_10">{{ $module['Title'] }}</a></li>
                </ul>

            </div>
        </section>
    @endif

    <!--content-->
    <div class="section_offset">
        <div class="container clearfix">
            <div class="row">
                @if((isset($sidebar_right)) and (count($sidebar_right)>0))
                    <section class="col-lg-9 col-md-9 col-sm-9 m_xs_bottom_30">
                        {!! $content or "Nothing to Say !"!!}
                    </section>


                    <aside class="col-lg-3 col-md-3 col-sm-3">
                        @foreach($sidebar_right as $sidebar)
                            <div class="panel panel-default ">
                                <div class="panel-heading">
                                    <h3 class="panel-title"><a data-toggle="collapse"
                                                               href="#collapse-{{$sidebar->widget_id}}"> {{$sidebar->widget_title}}</a></h3>
                                </div>
                                <div id="collapse-{{$sidebar->widget_id}}"
                                     class="panel-collapse collapse in">
                                <div class="panel-body">
                                {!! $sidebar !!}
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </aside>

                @else
                    <section class="col-lg-12 col-md-12 col-sm-12 m_xs_bottom_30">
                        {!! $content or "This page is empty !"!!}

                    </section>
                @endif

            </div>
        </div>
    </div>
    <hr class="divider_type_2">
    <!--footer-->
    <footer role="contentinfo" class="bg_light_3">
        <!--top part-->
        @if((isset($top_footer)) and (count($top_footer)>0))
        <section class="footer_top_part">
            <div class="container">
                <div class="row">
                    @foreach($top_footer as $tf)
                        <div class="col-lg-3 col-md-3 col-sm-3 m_bottom_30 m_xs_bottom_20">
                        {!! $tf !!}
                        </div>
                    @endforeach

                </div>
            </div>
        </section>
        @endif

        <section class="footer_bottom_part t_align_c color_grey bg_light_4 fw_light">
            @if((isset($bottom_footer)) and (count($bottom_footer)>0))
            @foreach($bottom_footer as $bf)
                    {!! $bf !!}
            @endforeach
            @endif
                <p>Powered by &copy; <a href="http://www.empsuite.com">EMPsuite.</a></p>

        </section>

    </footer>
</div>
<!--back to top button-->
<button id="back_to_top" class="circle icon_wrap_size_2 color_blue_hover color_grey_light_4 tr_all d_md_none">
    <i class="fa fa-angle-up fs_large"></i>
</button>
@include('sweet::alert')

<script src="{{ asset("/assets/theme/frontend/default/js/theme.plugins.js")}}"></script>
<script src="{{ asset("/assets/theme/frontend/default/js/theme.js")}}"></script>

</body>
</html>