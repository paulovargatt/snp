
<div class="page-wrapper">
    <div class="page-header navbar navbar-fixed-top  blue-oleo ">
        <div class="page-header-inner ">
            <div class="page-logo">
                <a onclick="GetLastSnip()">
                    <img src="img/coding.png" width="40px" alt="GoCode" class="logo-default" /> </a>
                <div class="menu-toggler sidebar-toggler">
                    <span></span>
                </div>
            </div>
            <form style="width: 246px; position: absolute;top: 7px;    left: 246px;">
                <div class="form-group">
                    <div class="input-group select2-bootstrap-append">
                        <select id="multi-append" name="snip_list[]" id="snp" data-id="id" class="form-control select2">
                        </select>
                    </div>
                </div>
            </form>

            <a href="javascript:;" class="menu-toggler responsive-toggler" data-toggle="collapse" data-target=".navbar-collapse">
                <span></span>
            </a>


            <div class="top-menu">

                <ul class="nav navbar-nav pull-right">
                    <div id="preloader" class="spinner" style="display: none;">
                            <div class="bounce1" style="border-radius: 50%!important;"></div>
                            <div class="bounce2" style="border-radius: 50%!important;"></div>
                            <div class="bounce3" style="border-radius: 50%!important;"></div>
                    </div>

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
            <div class="page-sidebar navbar-collapse collapse"> <br> <br>
                <ul class="page-sidebar-menu  page-header-fixed " data-keep-expanded="false" data-auto-scroll="true" data-slide-speed="200" style="padding-top: 20px">
                    <br><br><div style="margin-top: 11px"></div>
                    </li>
                </ul>
                <a class="btn btn-xs btn-success" id="paginate"> Carregar +</a>
            </div>