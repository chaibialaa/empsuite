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
    <script src="{{ asset("/assets/theme/backend/default/bootstrap/js/bootstrap.js")}}"></script>
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
<div id="side_menu">
    <header class="m_bottom_30 d_table w_full">
        <!--logo-->
        <div class="d_table_cell half_column v_align_m">
            <a href="index.html">
                {!! $titre or 'EMPSuite' !!}
            </a>
        </div>
        <!--close sidemenu button-->
        <div class="d_table_cell half_column v_align_m t_align_r">
            <button class="fa fa-_wrap_size_2 circle color_grey_light_2 d_inline_m" id="close_side_menu">
                <i class="fa fa-cancel"></i>
            </button>
        </div>
    </header>
    <hr class="divider_type_4 m_bottom_20">
    <!--searchform-->
    <form role="search" class="m_bottom_20 relative type_2">
        <input type="text" placeholder="Search" class="r_corners fw_light bg_light w_full">
        <button class="color_grey_light color_purple_hover tr_all">
            <i class="fa fa-search"></i>
        </button>
    </form>
    <hr class="divider_type_4 m_bottom_25">
    <!--main menu-->
    <nav>
        <ul class="side_main_menu fw_light">
            <li class="has_sub_menu active m_bottom_10">
                <a href="index.html" class="d_block relative fs_large color_light_2 color_blue_hover">Home</a>
                <!--sub menu(second level)-->
                <ul class="m_top_10">
                    <li class="has_sub_menu m_bottom_10">
                        <a href="index.html" class="d_block relative color_light_2 color_blue_hover">Layouts</a>
                        <!--sub menu(third level)-->
                        <ul class="m_top_10 d_none">
                            <li class="m_bottom_10"><a href="index.html"
                                                       class="d_block relative color_light_2 color_blue_hover">Business</a>
                            </li>
                            <li class="m_bottom_10"><a href="index_agency.html"
                                                       class="d_block relative color_light_2 color_blue_hover">Agency</a>
                            </li>
                            <li class="m_bottom_10"><a href="index_portfolio.html"
                                                       class="d_block relative color_light_2 color_blue_hover">Portfolio</a>
                            </li>
                            <li class="m_bottom_10"><a href="index_landing.html"
                                                       class="d_block relative color_light_2 color_blue_hover">Landing
                                    Page</a></li>
                            <li class="m_bottom_10"><a href="index_magazine.html"
                                                       class="d_block relative color_light_2 color_blue_hover">Magazine</a>
                            </li>
                            <li><a href="shop.html" class="d_block relative color_light_2 color_blue_hover">Shop</a>
                            </li>
                        </ul>
                    </li>
                    <li class="has_sub_menu active">
                        <a href="index.html" class="d_block relative color_light_2 color_blue_hover">Sliders</a>
                        <!--sub menu(third level)-->
                        <ul class="m_top_10">
                            <li class="m_bottom_10"><a href="index.html"
                                                       class="d_block relative color_light_2 color_blue_hover">Revolution</a>
                            </li>
                            <li class="m_bottom_10"><a href="index_magazine.html"
                                                       class="d_block relative color_light_2 color_blue_hover">Flex</a>
                            </li>
                            <li class="m_bottom_10"><a href="shop.html"
                                                       class="d_block relative color_light_2 color_blue_hover">iosSlider</a>
                            </li>
                            <li class="m_bottom_10"><a href="index_portfolio.html"
                                                       class="d_block relative color_light_2 color_blue_hover">Layer</a>
                            </li>
                            <li class="m_bottom_10"><a href="index_video_slider.html"
                                                       class="d_block relative color_light_2 color_blue_hover">Video
                                    Slider</a></li>
                            <li class="has_sub_menu active">
                                <a href="index_boxed_static_video.html"
                                   class="d_block relative color_light_2 color_blue_hover">Static Content</a>
                                <!--sub menu(fourth level)-->
                                <ul class="m_top_10">
                                    <li class="m_bottom_10"><a href="index_text_and_form.html"
                                                               class="d_block relative color_light_2 color_blue_hover">Text
                                            &amp; Form</a></li>
                                    <li class="m_bottom_10"><a href="index_other_head_static_content.html"
                                                               class="d_block relative color_light_2 color_blue_hover">Event
                                            Countdown</a></li>
                                    <li class="m_bottom_10"><a href="index_video_background.html"
                                                               class="d_block relative color_light_2 color_blue_hover">Video
                                            Background</a></li>
                                    <li class="m_bottom_10"><a href="index_video_in_popup.html"
                                                               class="d_block relative color_light_2 color_blue_hover">Video
                                            in Popup Window</a></li>
                                    <li class="m_bottom_10"><a href="index_static_image.html"
                                                               class="d_block relative color_light_2 color_blue_hover">Static
                                            Image</a></li>
                                    <li><a href="index_boxed_static_video.html"
                                           class="d_block relative color_light_2 color_blue_hover">Static Video</a></li>
                                </ul>
                            </li>
                        </ul>
                    </li>
                </ul>
            </li>
            <li class="has_sub_menu m_bottom_10">
                <a href="pages_about.html" class="d_block relative fs_large color_light_2 color_blue_hover">Pages</a>
                <!--sub menu(second level)-->
                <ul class="d_none m_top_10">
                    <li class="m_bottom_10">
                        <a href="pages_about.html" class="d_block relative color_light_2 color_blue_hover">About us</a>
                    </li>
                    <li class="m_bottom_10">
                        <a href="pages_services.html"
                           class="d_block relative color_light_2 color_blue_hover">Services</a>
                    </li>
                    <li class="m_bottom_10">
                        <a href="pages_team.html" class="d_block relative color_light_2 color_blue_hover">Team</a>
                    </li>
                    <li class="m_bottom_10">
                        <a href="pages_process.html" class="d_block relative color_light_2 color_blue_hover">Process</a>
                    </li>
                    <li class="m_bottom_10">
                        <a href="pages_careers.html" class="d_block relative color_light_2 color_blue_hover">Careers</a>
                    </li>
                    <li class="m_bottom_10">
                        <a href="pages_faq.html" class="d_block relative color_light_2 color_blue_hover">FAQ</a>
                    </li>
                    <li class="m_bottom_10">
                        <a href="index_landing.html" class="d_block relative color_light_2 color_blue_hover">Landing
                            Page</a>
                    </li>
                    <li class="m_bottom_10">
                        <a href="pages_404.html" class="d_block relative color_light_2 color_blue_hover">404 Page</a>
                    </li>
                    <li class="m_bottom_10">
                        <a href="pages_coming_soon.html" class="d_block relative color_light_2 color_blue_hover">Coming
                            soon page</a>
                    </li>
                    <li class="m_bottom_10">
                        <a href="pages_sitemap.html" class="d_block relative color_light_2 color_blue_hover">Sitemap</a>
                    </li>
                    <li class="m_bottom_10">
                        <a href="pages_full_width.html" class="d_block relative color_light_2 color_blue_hover">Full
                            width text page</a>
                    </li>
                    <li class="m_bottom_10">
                        <a href="pages_right_sidebar.html" class="d_block relative color_light_2 color_blue_hover">Text
                            page with right sidebar</a>
                    </li>
                    <li class="m_bottom_10">
                        <a href="pages_left_sidebar.html" class="d_block relative color_light_2 color_blue_hover">Text
                            page with left sidebar</a>
                    </li>
                    <li>
                        <a href="pages_contact.html" class="d_block relative color_light_2 color_blue_hover">Contact
                            us</a>
                    </li>
                </ul>
            </li>
            <li class="has_sub_menu m_bottom_10">
                <a href="portfolio_classic_1_column.html"
                   class="d_block relative fs_large color_light_2 color_blue_hover">Portfolio</a>
                <!--sub menu(second level)-->
                <ul class="d_none m_top_10">
                    <li class="has_sub_menu m_bottom_10">
                        <a href="portfolio_classic_1_column.html"
                           class="d_block relative color_light_2 color_blue_hover">Classic</a>
                        <!--sub menu(third level)-->
                        <ul class="d_none m_top_10">
                            <li class="m_bottom_10"><a href="portfolio_classic_1_column.html"
                                                       class="d_block relative color_light_2 color_blue_hover">1
                                    column</a></li>
                            <li class="m_bottom_10"><a href="portfolio_classic_2_columns.html"
                                                       class="d_block relative color_light_2 color_blue_hover">2
                                    columns</a></li>
                            <li class="m_bottom_10"><a href="portfolio_classic_2_columns_rsidebar.html"
                                                       class="d_block relative color_light_2 color_blue_hover">2 columns
                                    with right sidebar</a></li>
                            <li class="m_bottom_10"><a href="portfolio_classic_3_columns.html"
                                                       class="d_block relative color_light_2 color_blue_hover">3
                                    columns</a></li>
                            <li class="m_bottom_10"><a href="portfolio_classic_3_columns_lsidebar.html"
                                                       class="d_block relative color_light_2 color_blue_hover">3 columns
                                    with left sidebar</a></li>
                            <li><a href="portfolio_classic_4_columns.html"
                                   class="d_block relative color_light_2 color_blue_hover">4 columns</a></li>
                        </ul>
                    </li>
                    <li class="has_sub_menu m_bottom_10">
                        <a href="portfolio_sortable_t_2_columns.html"
                           class="d_block relative color_light_2 color_blue_hover">Sortable grid with text</a>
                        <!--sub menu(third level)-->
                        <ul class="d_none m_top_10">
                            <li class="m_bottom_10"><a href="portfolio_sortable_t_2_columns.html"
                                                       class="d_block relative color_light_2 color_blue_hover">2
                                    columns</a></li>
                            <li class="m_bottom_10"><a href="portfolio_sortable_t_2_columns_rsidebar.html"
                                                       class="d_block relative color_light_2 color_blue_hover">2 columns
                                    with right sidebar</a></li>
                            <li class="m_bottom_10"><a href="portfolio_sortable_t_3_columns.html"
                                                       class="d_block relative color_light_2 color_blue_hover">3
                                    columns</a></li>
                            <li class="m_bottom_10"><a href="portfolio_sortable_t_3_columns_lsidebar.html"
                                                       class="d_block relative color_light_2 color_blue_hover">3 columns
                                    with left sidebar</a></li>
                            <li><a href="portfolio_sortable_t_4_columns.html"
                                   class="d_block relative color_light_2 color_blue_hover">4 columns</a></li>
                        </ul>
                    </li>
                    <li class="has_sub_menu m_bottom_10">
                        <a href="portfolio_sortable_wt_2_columns.html"
                           class="d_block relative color_light_2 color_blue_hover">Sortable grid without text</a>
                        <!--sub menu(third level)-->
                        <ul class="d_none m_top_10">
                            <li class="m_bottom_10"><a href="portfolio_sortable_wt_2_columns.html"
                                                       class="d_block relative color_light_2 color_blue_hover">2
                                    columns</a></li>
                            <li class="m_bottom_10"><a href="portfolio_sortable_wt_2_columns_rsidebar.html"
                                                       class="d_block relative color_light_2 color_blue_hover">2 columns
                                    with right sidebar</a></li>
                            <li class="m_bottom_10"><a href="portfolio_sortable_wt_3_columns.html"
                                                       class="d_block relative color_light_2 color_blue_hover">3
                                    columns</a></li>
                            <li class="m_bottom_10"><a href="portfolio_sortable_wt_3_columns_lsidebar.html"
                                                       class="d_block relative color_light_2 color_blue_hover">3 columns
                                    with left sidebar</a></li>
                            <li><a href="portfolio_sortable_wt_4_columns.html"
                                   class="d_block relative color_light_2 color_blue_hover">4 columns</a></li>
                        </ul>
                    </li>
                    <li class="has_sub_menu m_bottom_10">
                        <a href="portfolio_masonry_2_columns.html"
                           class="d_block relative color_light_2 color_blue_hover">Sortable masonry</a>
                        <!--sub menu(third level)-->
                        <ul class="d_none m_top_10">
                            <li class="m_bottom_10"><a href="portfolio_masonry_2_columns.html"
                                                       class="d_block relative color_light_2 color_blue_hover">2
                                    columns</a></li>
                            <li class="m_bottom_10"><a href="portfolio_masonry_2_columns_rsidebar.html"
                                                       class="d_block relative color_light_2 color_blue_hover">2 columns
                                    with right sidebar</a></li>
                            <li class="m_bottom_10"><a href="portfolio_masonry_3_columns.html"
                                                       class="d_block relative color_light_2 color_blue_hover">3
                                    columns</a></li>
                            <li class="m_bottom_10"><a href="portfolio_masonry_3_columns_lsidebar.html"
                                                       class="d_block relative color_light_2 color_blue_hover m_bottom_10">3
                                    columns with left sidebar</a></li>
                            <li><a href="portfolio_masonry_4_columns.html"
                                   class="d_block relative color_light_2 color_blue_hover">4 columns</a></li>
                        </ul>
                    </li>
                    <li class="has_sub_menu">
                        <a href="portfolio_single_side_image_list.html"
                           class="d_block relative color_light_2 color_blue_hover">Single project pages</a>
                        <!--sub menu(third level)-->
                        <ul class="d_none m_top_10">
                            <li class="m_bottom_10"><a href="portfolio_single_side_image_list.html"
                                                       class="d_block relative color_light_2 color_blue_hover">Project
                                    with side image list</a></li>
                            <li class="m_bottom_10"><a href="portfolio_single_full_width_image_list.html"
                                                       class="d_block relative color_light_2 color_blue_hover">Project
                                    with full width image list</a></li>
                            <li class="m_bottom_10"><a href="portfolio_single_side_image_slider.html"
                                                       class="d_block relative color_light_2 color_blue_hover">Project
                                    with side image slider</a></li>
                            <li class="m_bottom_10"><a href="portfolio_single_full_width_image_slider.html"
                                                       class="d_block relative color_light_2 color_blue_hover">Project
                                    with full width image slider</a></li>
                            <li class="m_bottom_10"><a href="portfolio_single_extended_image_slider.html"
                                                       class="d_block relative color_light_2 color_blue_hover">Project
                                    with extended image list</a></li>
                            <li class="m_bottom_10"><a href="portfolio_single_side_video_list.html"
                                                       class="d_block relative color_light_2 color_blue_hover">Project
                                    with side video list</a></li>
                            <li><a href="portfolio_single_full_width_video.html"
                                   class="d_block relative color_light_2 color_blue_hover">Project with full width video
                                    list</a></li>
                        </ul>
                    </li>
                </ul>
            </li>
            <li class="has_sub_menu m_bottom_10">
                <a href="blog_classic_1_column.html" class="d_block relative fs_large color_light_2 color_blue_hover">Blog</a>
                <!--sub menu(second level)-->
                <ul class="d_none m_top_10">
                    <li class="has_sub_menu m_bottom_10">
                        <a href="blog_classic_1_column.html" class="d_block relative color_light_2 color_blue_hover">Classic</a>
                        <!--sub menu(third level)-->
                        <ul class="d_none m_top_10">
                            <li class="m_bottom_10"><a href="blog_classic_1_column.html"
                                                       class="d_block relative color_light_2 color_blue_hover">1
                                    column</a></li>
                            <li><a href="portfolio_classic_2_columns.html"
                                   class="d_block relative color_light_2 color_blue_hover">1 Column with right
                                    sidebar</a></li>
                        </ul>
                    </li>
                    <li class="has_sub_menu m_bottom_10">
                        <a href="blog_grid_2_columns.html"
                           class="d_block relative color_light_2 color_blue_hover">Grid</a>
                        <!--sub menu(third level)-->
                        <ul class="d_none m_top_10">
                            <li class="m_bottom_10"><a href="blog_grid_2_columns.html"
                                                       class="d_block relative color_light_2 color_blue_hover">2
                                    columns</a></li>
                            <li class="m_bottom_10"><a href="blog_grid_2_columns_left_sidebar.html"
                                                       class="d_block relative color_light_2 color_blue_hover">2 columns
                                    with left sidebar</a></li>
                            <li class="m_bottom_10"><a href="blog_grid_3_columns.html"
                                                       class="d_block relative color_light_2 color_blue_hover">3
                                    columns</a></li>
                            <li class="m_bottom_10"><a href="blog_grid_3_columns_right_sidebar.html"
                                                       class="d_block relative color_light_2 color_blue_hover">3 columns
                                    with right sidebar</a></li>
                            <li><a href="blog_grid_4_columns.html"
                                   class="d_block relative color_light_2 color_blue_hover">4 columns</a></li>
                        </ul>
                    </li>
                    <li class="has_sub_menu m_bottom_10">
                        <a href="blog_masonry_2_columns.html" class="d_block relative color_light_2 color_blue_hover">Masonry</a>
                        <!--sub menu(third level)-->
                        <ul class="d_none m_top_10">
                            <li class="m_bottom_10"><a href="blog_masonry_2_columns.html"
                                                       class="d_block relative color_light_2 color_blue_hover">2
                                    columns</a></li>
                            <li class="m_bottom_10"><a href="blog_masonry_2_columns_right_sidebar.html"
                                                       class="d_block relative color_light_2 color_blue_hover">2 columns
                                    with right sidebar</a></li>
                            <li class="m_bottom_10"><a href="blog_masonry_3_columns.html"
                                                       class="d_block relative color_light_2 color_blue_hover">3
                                    columns</a></li>
                            <li class="m_bottom_10"><a href="blog_masonry_3_columns_left_sidebar.html"
                                                       class="d_block relative color_light_2 color_blue_hover">3 columns
                                    with left sidebar</a></li>
                            <li><a href="blog_masonry_4_columns.html"
                                   class="d_block relative color_light_2 color_blue_hover">4 columns</a></li>
                        </ul>
                    </li>
                    <li class="has_sub_menu">
                        <a href="blog_single_right_sidebar.html"
                           class="d_block relative color_light_2 color_blue_hover">Single blog post</a>
                        <!--sub menu(third level)-->
                        <ul class="d_none m_top_10">
                            <li class="m_bottom_10"><a href="blog_single_right_sidebar.html"
                                                       class="d_block relative color_light_2 color_blue_hover">Image
                                    post</a></li>
                            <li class="m_bottom_10"><a href="blog_single_image_slideshow_post.html"
                                                       class="d_block relative color_light_2 color_blue_hover">Image
                                    slideshow post</a></li>
                            <li class="m_bottom_10"><a href="blog_single_video_post.html"
                                                       class="d_block relative color_light_2 color_blue_hover">Video
                                    post</a></li>
                            <li class="m_bottom_10"><a href="blog_single_audio_post.html"
                                                       class="d_block relative color_light_2 color_blue_hover">Audio
                                    post</a></li>
                            <li class="m_bottom_10"><a href="blog_single_blockquote_post.html"
                                                       class="d_block relative color_light_2 color_blue_hover">Blockquote
                                    post</a></li>
                            <li class="m_bottom_10"><a href="blog_single_link_post.html"
                                                       class="d_block relative color_light_2 color_blue_hover">Link
                                    post</a></li>
                            <li><a href="blog_single_full_width.html"
                                   class="d_block relative color_light_2 color_blue_hover">Full Width Post</a></li>
                        </ul>
                    </li>
                </ul>
            </li>
            <li class="has_sub_menu m_bottom_10">
                <a href="#" class="d_block relative fs_large color_light_2 color_blue_hover">Features</a>
                <!--sub menu(second level)-->
                <ul class="d_none m_top_10">
                    <li class="has_sub_menu m_bottom_10">
                        <a href="index.html" class="d_block relative color_light_2 color_blue_hover">Layouts</a>
                        <!--sub menu(third level)-->
                        <ul class="d_none m_top_10">
                            <li class="m_bottom_10"><a href="index.html"
                                                       class="d_block relative color_light_2 color_blue_hover">Business</a>
                            </li>
                            <li><a href="index_agency.html" class="d_block relative color_light_2 color_blue_hover">Agency</a>
                            </li>
                            <li><a href="index_portfolio.html" class="d_block relative color_light_2 color_blue_hover">Portfolio</a>
                            </li>
                            <li><a href="index_landing.html" class="d_block relative color_light_2 color_blue_hover">Landing
                                    Page</a></li>
                            <li><a href="index_magazine.html" class="d_block relative color_light_2 color_blue_hover">Magazine</a>
                            </li>
                            <li><a href="shop.html" class="d_block relative color_light_2 color_blue_hover">Shop</a>
                            </li>
                        </ul>
                    </li>
                    <li class="has_sub_menu m_bottom_10">
                        <a href="index.html" class="d_block relative color_light_2 color_blue_hover">Sliders</a>
                        <!--sub menu(third level)-->
                        <ul class="d_none m_top_10">
                            <li class="m_bottom_10"><a href="index.html"
                                                       class="d_block relative color_light_2 color_blue_hover">Revolution</a>
                            </li>
                            <li><a href="index_agency.html"
                                   class="d_block relative color_light_2 color_blue_hover">Flex</a></li>
                            <li><a href="index_portfolio.html" class="d_block relative color_light_2 color_blue_hover">iosSlider</a>
                            </li>
                            <li><a href="index_landing.html" class="d_block relative color_light_2 color_blue_hover">Layer</a>
                            </li>
                            <li><a href="index_magazine.html" class="d_block relative color_light_2 color_blue_hover">Video
                                    Slider</a></li>
                            <li class="has_sub_menu active">
                                <a href="index_boxed_static_video.html"
                                   class="d_block relative color_light_2 color_blue_hover">Static Content</a>
                                <!--sub menu(fourth level)-->
                                <ul class="m_top_10">
                                    <li class="m_bottom_10"><a href="index_text_and_form.html"
                                                               class="d_block relative color_light_2 color_blue_hover">Text
                                            &amp; Form</a></li>
                                    <li class="m_bottom_10"><a href="index_other_head_static_content.html"
                                                               class="d_block relative color_light_2 color_blue_hover">Event
                                            Countdown</a></li>
                                    <li class="m_bottom_10"><a href="index_video_background.html"
                                                               class="d_block relative color_light_2 color_blue_hover">Video
                                            Background</a></li>
                                    <li class="m_bottom_10"><a href="index_video_in_popup.html"
                                                               class="d_block relative color_light_2 color_blue_hover">Video
                                            in Popup Window</a></li>
                                    <li class="m_bottom_10"><a href="index_static_image.html"
                                                               class="d_block relative color_light_2 color_blue_hover">Static
                                            Image</a></li>
                                    <li><a href="index_boxed_static_video.html"
                                           class="d_block relative color_light_2 color_blue_hover">Static Video</a></li>
                                </ul>
                            </li>
                        </ul>
                    </li>
                    <li class="has_sub_menu m_bottom_10">
                        <a href="index.html" class="d_block relative color_light_2 color_blue_hover">Headers</a>
                        <!--sub menu(third level)-->
                        <ul class="d_none m_top_10">
                            <li class="m_bottom_10"><a href="index.html"
                                                       class="d_block relative color_light_2 color_blue_hover">Header
                                    1</a></li>
                            <li class="m_bottom_10"><a href="index_agency.html"
                                                       class="d_block relative color_light_2 color_blue_hover">Header
                                    2</a></li>
                            <li class="m_bottom_10"><a href="index_portfolio.html"
                                                       class="d_block relative color_light_2 color_blue_hover">Header
                                    3</a></li>
                            <li class="m_bottom_10"><a href="index_landing.html"
                                                       class="d_block relative color_light_2 color_blue_hover">Header
                                    4</a></li>
                            <li class="m_bottom_10"><a href="index_magazine.html"
                                                       class="d_block relative color_light_2 color_blue_hover">Header
                                    5</a></li>
                            <li><a href="shop.html" class="d_block relative color_light_2 color_blue_hover">Header 6</a>
                            </li>
                        </ul>
                    </li>
                    <li class="has_sub_menu m_bottom_10">
                        <a href="index.html" class="d_block relative color_light_2 color_blue_hover">Footers</a>
                        <!--sub menu(third level)-->
                        <ul class="d_none m_top_10">
                            <li class="m_bottom_10"><a href="index.html"
                                                       class="d_block relative color_light_2 color_blue_hover">Footer
                                    1</a></li>
                            <li class="m_bottom_10"><a href="index_agency.html"
                                                       class="d_block relative color_light_2 color_blue_hover">Footer
                                    2</a></li>
                            <li class="m_bottom_10"><a href="index_portfolio.html"
                                                       class="d_block relative color_light_2 color_blue_hover">Footer
                                    3</a></li>
                            <li class="m_bottom_10"><a href="index_landing.html"
                                                       class="d_block relative color_light_2 color_blue_hover">Footer
                                    4</a></li>
                            <li class="m_bottom_10"><a href="index_magazine.html"
                                                       class="d_block relative color_light_2 color_blue_hover">Footer
                                    5</a></li>
                            <li><a href="shop.html" class="d_block relative color_light_2 color_blue_hover">Footer 6</a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </li>
            <li class="has_sub_menu m_bottom_10">
                <a href="shortcodes_elements.html" class="d_block relative fs_large color_light_2 color_blue_hover">Shortcodes</a>
                <!--sub menu(second level)-->
                <ul class="d_none m_top_10">
                    <li class="m_bottom_10"><a href="shortcodes_elements.html"
                                               class="d_block relative color_light_2 color_blue_hover">Elements</a></li>
                    <li class="m_bottom_10"><a href="shortcodes_columns.html"
                                               class="d_block relative color_light_2 color_blue_hover">Columns</a></li>
                    <li><a href="shortcodes_typography.html" class="d_block relative color_light_2 color_blue_hover">Typography</a>
                    </li>
                </ul>
            </li>
            <li class="has_sub_menu m_bottom_10">
                <a href="shop.html" class="d_block relative fs_large color_light_2 color_blue_hover">Shop</a>
                <!--sub menu(second level)-->
                <ul class="d_none m_top_10">
                    <li class="m_bottom_10"><a href="shop.html" class="d_block relative color_light_2 color_blue_hover">Front
                            Page</a></li>
                    <li class="m_bottom_10"><a href="shop_category_v1.html"
                                               class="d_block relative color_light_2 color_blue_hover">Category Page
                            v1</a></li>
                    <li class="m_bottom_10"><a href="shop_category_v2.html"
                                               class="d_block relative color_light_2 color_blue_hover">Category Page
                            v2</a></li>
                    <li class="m_bottom_10"><a href="shop_product_page_v1.html"
                                               class="d_block relative color_light_2 color_blue_hover">Product Page
                            v1</a></li>
                    <li class="m_bottom_10"><a href="shop_product_page_v2.html"
                                               class="d_block relative color_light_2 color_blue_hover">Product Page
                            v2</a></li>
                    <li class="m_bottom_10"><a href="shop_cart.html"
                                               class="d_block relative color_light_2 color_blue_hover">Shoping Cart
                            &amp; Checkout</a></li>
                    <li class="m_bottom_10"><a href="shop_wishlist.html"
                                               class="d_block relative color_light_2 color_blue_hover">Wishlist</a></li>
                    <li class="m_bottom_10"><a href="shop_compare_products.html"
                                               class="d_block relative color_light_2 color_blue_hover">Compare
                            products</a></li>
                    <li class="m_bottom_10"><a href="shop_order_list.html"
                                               class="d_block relative color_light_2 color_blue_hover">Orders list</a>
                    </li>
                    <li><a href="shop_order_information.html" class="d_block relative color_light_2 color_blue_hover">Order
                            information</a></li>
                </ul>
            </li>
        </ul>
    </nav>
</div>
<!--layout-->
<div class="wide_layout bg_light">
<!--MODAL LOGIN-->
        <div class="modal fade" id="login" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"
             style="display: none;">
            <div class="modal-dialog">
                <div class="loginmodal-container">
                    <h4>Login to Your Account</h4><br>

                    <form role="form" method="POST" action="/user/login">
                        {!! csrf_field() !!}
                        <input placeholder="Email" autofocus required type="email" name="email"
                               value="{{ old('email') }}"/>
                        <input placeholder="Password" required type="password" name="password" id="password"/>
                        <button type="submit" class="btn btn-default btn-block"><i class="fa fa-user"></i> Sign in
                        </button>
                        <a href="/user/social/google" type="submit" class="btn btn-danger btn-block"><i
                                    class="fa fa-google"></i> Sign in using Google</a>
                        <a href="/user/social/facebook" type="submit" class="btn btn-primary btn-block"
                           style="background-color: rgb(41, 93, 138); !important"><i class="fa fa-facebook-square"></i>
                            Sign in using Facebook
                        </a>
                    </form>

                    <div class="login-help">
                        <a href="/user/">Register</a> - <a href="/user/forgot">Forgot Password</a>
                    </div>
                </div>
            </div>
        </div>


    <header role="banner" class="relative">
        <span class="gradient_line"></span>
        <!--top part-->
        <section class="header_top_part">
            <div class="container">
                <div class="row">
                    <!--contact info-->
                    <div class="col-lg-3 col-md-3 col-sm-3 t_xs_align_c">
                        <ul class="hr_list fs_small color_grey_light">
                            <li class="m_right_20 f_xs_none m_xs_right_0 m_xs_bottom_5">
                                <span class="circle icon_wrap_size_1 d_inline_m m_right_8"><i
                                            class="fa fa-phone"></i></span>(123)-456-7890
                            </li>

                        </ul>
                    </div>
                    <!--social icons-->
                    <div class="col-lg-9 col-md-9 col-sm-9 t_align_r t_xs_align_c">
                        @if (!Auth::check())
                            <a class="" data-toggle="modal" data-target="#login">
                                Login <span class="circle icon_wrap_size_1 d_inline_m"><i class="fa fa-user"></i></span>
                            </a>
                        @else

                            <a href="/user/logout"><i class="fa fa-power-off danger"></i> Deconnexion</a>

                        @endif


                    </div>
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
                        <a href="index.html" class="d_inline_m m_xs_top_20 m_xs_bottom_20">
                            <h4> {!! $titre or 'EMPSuite' !!}</h4>
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
    @if (isset($topcontent))
        {!! $topcontent !!}
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
                            <div class="m_bottom_40 m_xs_bottom_30">
                                {!! $sidebar !!}
                            </div>
                        @endforeach
                    </aside>

                @else
                    <section class="col-lg-12 col-md-12 col-sm-12 m_xs_bottom_30">
                        {!! $content or "Nothing to Say !"!!}

                    </section>
                @endif

            </div>
        </div>
    </div>
    <hr class="divider_type_2">
    <!--footer-->
    <footer role="contentinfo" class="bg_light_3">
        <!--top part-->
        <section class="footer_top_part">
            <div class="container">
                <div class="row">
                    <!--about us-->
                    <div class="col-lg-4 col-md-4 col-sm-4 fw_light m_bottom_30">
                        <h5 class="color_dark m_bottom_20">Shortly About Us</h5>

                        <p>Vivamus eget nibh. Etiam cursus leo vel metus. Nulla facilisi. Aenean nec eros.
                            Vestibulum
                            ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia. Suspendisse
                            sollicitudin velit sed leo</p>
                    </div>
                    <!--contact info-->
                    <div class="col-lg-5 col-md-5 col-sm-5 m_bottom_30">
                        <h5 class="color_dark m_bottom_20 fw_light">Contact Us</h5>

                        <div class="row">
                            <ul class="col-lg-6 col-md-6 col-sm-6 fw_light w_break m_xs_bottom_8">
                                <li class="m_bottom_8">
                                    <div class="d_inline_m icon_wrap_size_1 color_pink circle m_right_10">
                                        <i class="fa fa-phone-1"></i>
                                    </div>
                                    (123)-456-7890
                                </li>
                                <li class="m_bottom_8">
                                    <div class="d_inline_m icon_wrap_size_1 color_pink circle m_right_10">
                                        <i class="fa fa-mail-alt"></i>
                                    </div>
                                    <a href="mailto:#" class="color_black color_pink_hover">info@companyname
                                        .com</a>
                                </li>
                                <li>
                                    <div class="d_inline_m icon_wrap_size_1 color_pink circle m_right_10">
                                        <i class="fa fa-skype-1"></i>
                                    </div>
                                    skype.name
                                </li>
                            </ul>
                            <ul class="col-lg-6 col-md-6 col-sm-6 vr_list_type_5">
                                <li class="m_bottom_15 fw_light relative">
                                    <div class="fa fa-_wrap_size_1 color_pink circle f_left">
                                        <i class="fa fa-location"></i>
                                    </div>
                                    8901 Marmora Road, Glasgow, D04 89GR.
                                </li>
                                <li>
                                    <a href="https://www.google.com/maps/place/%D0%9D%D1%8C%D1%8E-%D0%99%D0%BE%D1%80%D0%BA/@40.7056308,-73.9780035,11z/data=!3m1!4b1!4m2!3m1!1s0x89c24fa5d33f083b:0xc80b8f06e177fe62"
                                       target="_blank"
                                       class="button_type_2 color_dark r_corners tr_all color_pink_hover d_inline_m fs_medium t_md_align_c w_break">Open
                                        in Google Maps</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <!--social buttons-->
                    <div class="col-lg-3 col-md-3 col-sm-3 m_bottom_30 m_xs_bottom_20">
                        <h5 class="color_dark m_bottom_20 fw_light">Stay Connected</h5>
                        <ul class="hr_list social_icons">
                            <!--tooltip_container class is required-->
                            <li class="m_right_15 m_bottom_15 tooltip_container">
                                <!--tooltip-->
                                <span class="d_block r_corners color_default tooltip fs_small tr_all">Follow Us on Facebook</span>
                                <a href="#" class="d_block facebook icon_wrap_size_2 circle color_grey_light_2">
                                    <i class="fa fa-facebook fs_small"></i>
                                </a>
                            </li>
                            <li class="m_right_15 m_bottom_15 tooltip_container">
                                <!--tooltip-->
                                <span class="d_block r_corners color_default tooltip fs_small tr_all">Follow Us on Twitter</span>
                                <a href="#" class="d_block twitter icon_wrap_size_2 circle color_grey_light_2">
                                    <i class="fa fa-twitter fs_small"></i>
                                </a>
                            </li>
                            <li class="m_right_15 m_bottom_15 m_sm_right_0 tooltip_container m_xs_right_15">
                                <!--tooltip-->
                                <span class="d_block r_corners color_default tooltip fs_small tr_all">Google Plus</span>
                                <a href="#" class="d_block googleplus icon_wrap_size_2 circle color_grey_light_2">
                                    <i class="fa fa-gplus-1 fs_small"></i>
                                </a>
                            </li>
                            <li class="m_right_15 m_md_right_0 m_sm_right_15 m_bottom_15 tooltip_container">
                                <!--tooltip-->
                                <span class="d_block r_corners color_default tooltip fs_small tr_all">Pinterest</span>
                                <a href="#" class="d_block pinterest icon_wrap_size_2 circle color_grey_light_2">
                                    <i class="fa fa-pinterest fs_small"></i>
                                </a>
                            </li>
                            <li class="m_bottom_15 m_md_right_15 tooltip_container">
                                <!--tooltip-->
                                <span class="d_block r_corners color_default tooltip fs_small tr_all">Dribbble</span>
                                <a href="#" class="d_block dribbble icon_wrap_size_2 circle color_grey_light_2">
                                    <i class="fa fa-dribbble fs_small"></i>
                                </a>
                            </li>
                            <li class="m_right_15 m_bottom_15 tooltip_container m_sm_right_0 m_xs_right_15">
                                <!--tooltip-->
                                <span class="d_block r_corners color_default tooltip fs_small tr_all">Flickr</span>
                                <a href="#" class="d_block flickr icon_wrap_size_2 circle color_grey_light_2">
                                    <i class="fa fa-flickr-1 fs_small"></i>
                                </a>
                            </li>
                            <li class="m_right_15 m_bottom_15 tooltip_container">
                                <!--tooltip-->
                                <span class="d_block r_corners color_default tooltip fs_small tr_all">Youtube</span>
                                <a href="#" class="d_block youtube icon_wrap_size_2 circle color_grey_light_2">
                                    <i class="fa fa-youtube-play fs_small"></i>
                                </a>
                            </li>
                            <li class="m_right_15 m_bottom_15 tooltip_container">
                                <!--tooltip-->
                                <span class="d_block r_corners color_default tooltip fs_small tr_all">Vimeo</span>
                                <a href="#" class="d_block vimeo icon_wrap_size_2 circle color_grey_light_2">
                                    <i class="fa fa-vimeo fs_small"></i>
                                </a>
                            </li>
                            <li class="m_right_15 m_bottom_15 tooltip_container m_sm_right_0 m_xs_right_15">
                                <!--tooltip-->
                                <span class="d_block r_corners color_default tooltip fs_small tr_all">Instagram</span>
                                <a href="#" class="d_block instagram icon_wrap_size_2 circle color_grey_light_2">
                                    <i class="fa fa-instagramm fs_small"></i>
                                </a>
                            </li>
                            <li class="m_bottom_15 tooltip_container">
                                <!--tooltip-->
                                <span class="d_block r_corners color_default tooltip fs_small tr_all">LinkedIn</span>
                                <a href="#" class="d_block linkedin icon_wrap_size_2 circle color_grey_light_2">
                                    <i class="fa fa-linkedin-squared fs_small"></i>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </section>
        <!--bottom part-->
        <section class="footer_bottom_part t_align_c color_grey bg_light_4 fw_light">
            <p>&copy; 2014 illusion. All Rights Reserved.</p>
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