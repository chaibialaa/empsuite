@if (count($notices)>0)
<style>
    .croped-container {

        height: 488px;
        overflow: hidden;
    }
    .croped-container img {
        width: 100%;
        margin: -25% 0 -25% 0 ;
    }

</style>
<section>
    <div class="container">
        <!--slider-->
        <div class="wrapper">
            <div style="animation-delay: 600ms;" class="flex_container f_left f_md_none wrapper appear-animation fadeInLeft appear-animation-visible" data-appear-animation="fadeInLeft" data-appear-animation-delay="600">
                <div style="height: 500px;" class="flexslider">
                    <ul class="slides">
                        @foreach($notices as $notice)
                        <li class="flex-active-slide" style="width: 100%; float: left; margin-right: -100%; position: relative; display: block; z-index: 2; opacity: 1;">
                            <div class="croped-container">
                            <img draggable="false" src="{{ $notice->thumbpath }}" alt="">
                            </div>
                            <div class="fs_caption r_corners wrapper d_xs_none">
                                <header class="bg_light">
                                    <ul class="dotted_list color_grey_light_2 article_stats">

                                        <li class="m_right_15 relative d_inline_m">
                                            <a href="#" class="fs_small color_grey">
                                                <i class="fa fa-pencil-square-o"></i><i> {{$notice->nom}}</i>
                                            </a>
                                        </li>
                                        <li class="relative d_inline_m">
                                            <a href="{{ url('/').'/notice/'.$notice->title_cat}}" class="fs_small color_grey">
                                            <i class="fa fa-archive"></i> <i>{{$notice->title_cat}}</i></a>
                                            </a>

                                        </li>
                                    </ul>
                                </header>
                                <h3 class="color_dark fw_light m_bottom_12">{{ $notice->title }}</h3>
                                @if (strlen(strip_tags($notice->content))>140)
                                <p class="m_bottom_12 fs_medium">

                                        {{
                                        $stringCut = substr(strip_tags($notice->content), 0, 140),

                                        $notice->content = substr($stringCut, 0, strrpos($stringCut, ' '))
                                        }} ...
                                         </p>
                                <a href="{{ url('/').'/notice/'.$notice->title_cat.'/'.$notice->id.'/'.$notice->link  }}" class="color_purple d_inline_b color_pink_hover d_block m_right_20 fw_light">
												<span class="d_inline_m m_right_5 icon_wrap_size_0 circle color_grey_light tr_all">
													<i class="fa fa-angle-right"></i>
												</span>
                                    {{ trans('common.read_more') }}
                                </a>
                                    @else
                                    <p class="m_bottom_12 fs_medium">
                                    {{ strip_tags($notice->content) }}
                                    </p>
                                    @endif
                                <a href="{{ url('/').'/notice/'.$notice->title_cat.'/'.$notice->id.'/'.$notice->link  }}" class="color_purple d_inline_b color_pink_hover d_block m_right_20 fw_light">
												<span class="d_inline_m m_right_5 icon_wrap_size_0 circle color_grey_light tr_all">
													<i class="fa fa-angle-right"></i>
												</span>
                                    {{ trans('common.read_more') }}</a>
                            </div>
                        </li>
                        @endforeach
                    </ul>
                    <ul class="flex-direction-nav"><li><a class="flex-prev color_light icon icon_wrap_size_3 circle tr_all" href="#"></a></li><li><a class="flex-next color_light icon icon_wrap_size_3 circle tr_all" href="#"></a></li></ul></div>
            </div>
            <div style="animation-delay: 800ms;" class="thumbnails_container f_md_none f_right bg_light_2 md_wrapper appear-animation fadeInLeft appear-animation-visible" data-appear-animation="fadeInLeft" data-appear-animation-delay="800">
                <ul>
                    @foreach($notices as $notice)
                    <li class="tr_all f_md_left t_md_align_c f_xs_none t_xs_align_l">
                        <article class="clearfix">
                            <div class="col-xs-5 d_block r_corners wrapper f_left  f_sm_none m_sm_bottom_10 d_sm_inline_b d_xs_block f_xs_left m_xs_bottom_0">
                                <img class="img-thumbnail" src="{{ $notice->thumbpath }}" alt="">
                            </div>
                            <p class="color_dark d_block lh_medium m_bottom_5 tr_all"><b>{{ $notice->title }}</b></p>
                            <ul class="dotted_list color_grey_light_2 article_stats">
                                
                                <li class="m_right_15 relative d_inline_m">
												<span class="fs_small color_grey">
													<i>{{$notice->created_at}}</i>
												</span>
                                </li>
                                <li class="m_right_15 relative d_inline_m">
                                    <span class="fs_small color_grey"><i>{{$notice->title_cat}}</i></span>,

                                </li>
                            </ul>
                        </article>
                    </li>
                    @endforeach

                </ul>
            </div>
        </div>
    </div>
</section>
    @endif