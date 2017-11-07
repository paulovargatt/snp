
<div class="page-wrapper">
    <div class="page-header navbar navbar-fixed-top  blue-oleo ">
        <div class="page-header-inner ">
            <div class="page-logo">
                <a href="index.html">
                    <img src="img/coding.png" width="40px" alt="logo" class="logo-default" /> </a>
                <div class="menu-toggler sidebar-toggler">
                    <span></span>
                </div>
            </div>
            <a href="javascript:;" class="menu-toggler responsive-toggler" data-toggle="collapse" data-target=".navbar-collapse">
                <span></span>
            </a>
            <div class="top-menu">
                <ul class="nav navbar-nav pull-right">

                    <li class="dropdown dropdown-user">
                        <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
                            <span class="username username-hide-on-mobile">{{ ucwords(Auth::user()->name) }}  </span>
                        </a>
                    </li>
                    <!-- END USER LOGIN DROPDOWN -->
                    <li class="dropdown dropdown-quick-sidebar-toggler">
                        <a href="javascript:;" class="dropdown-toggle">
                            <a href="{{url('sair')}}"  style="top: -29px;color: #dedede;"><i class="icon-logout"></i></a>
                        </a>
                    </li>

                </ul>
            </div>
        </div>
    </div>

    <div class="page-container">
        <div class="page-sidebar-wrapper">
            <div class="page-sidebar navbar-collapse collapse">
                <ul class="page-sidebar-menu  page-header-fixed " data-keep-expanded="false" data-auto-scroll="true" data-slide-speed="200" style="padding-top: 20px">
                    <li class="sidebar-toggler-wrapper hide">
                        <div class="sidebar-toggler">
                            <span></span>
                        </div>
                    </li>
                    <br>
                    <li class="sidebar-search-wrapper">
                        <form class="sidebar-search  " action="../admin_1/page_general_search_3.html" method="POST">
                            <a href="javascript:;" class="remove">
                                <i class="icon-close"></i>
                            </a>
                            <div class="input-group">
                                <form>
                                    <div class="form-group">
                                        <select id="snip_list" name="snip_list[]" id="snp" data-id="id" class="form-control select2-allow-clear">

                                        </select>
                                    </div>
                                </form>
                                <span class="input-group-btn">
                                            <a href="javascript:;" class="btn submit">
                                                <i class="icon-magnifier"></i>
                                            </a>
                                        </span>
                            </div>
                        </form>
                        <!-- END RESPONSIVE QUICK SEARCH FORM -->
                    </li>

                    @foreach ($snpMenu as $snip)
                    <li class="nav-item">
                        <a href="javascript:;" class=""  id="snp" data-id="{{$snip->id}}">
                            <i class="fa fa-code"></i>
                            <span class="title">{{$snip->title}}</span>
                        </a>
                    </li>
                    @endforeach
                    </li>
                </ul>
            </div>