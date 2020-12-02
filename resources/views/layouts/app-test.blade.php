
<!DOCTYPE html>
<html class="no-js css-menubar" lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta name="description" content="bootstrap admin template">
    <meta name="author" content="">
    
    <title>TELLO | School Management System</title>
    
    <link rel="apple-touch-icon" href="{{ asset('assets/images/apple-touch-icon.png') }}">
    <link rel="shortcut icon" href="{{ asset('assets/images/cbtpng.png') }}">
    

  <!-- Styles -->
  <link rel="stylesheet" href="{{ asset('css/app.css') }}">
  <!-- Stylesheets -->
  <link rel="stylesheet" href="{{ asset('assets/global/css/bootstrap.min.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/global/css/bootstrap-extend.min.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/css/site.min.css') }}">
    
  <!-- Plugins -->
  <link rel="stylesheet" href="{{ asset('assets/global/vendor/animsition/animsition.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/global/vendor/asscrollable/asScrollable.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/global/vendor/switchery/switchery.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/global/vendor/intro-js/introjs.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/global/vendor/slidepanel/slidePanel.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/global/vendor/jquery-mmenu/jquery-mmenu.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/global/vendor/flag-icon-css/flag-icon.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/global/vendor/chartist/chartist.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/global/vendor/jvectormap/jquery-jvectormap.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/global/vendor/chartist-plugin-tooltip/chartist-plugin-tooltip.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/examples/css/dashboard/v1.css') }}">
  
  
  <!-- Fonts -->
  <link rel="stylesheet" href="{{ asset('assets/global/fonts/font-awesome/font-awesome.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/global/fonts/weather-icons/weather-icons.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/global/fonts/web-icons/web-icons.min.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/global/fonts/brand-icons/brand-icons.min.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/global/fonts/material-design/material-design.min.css') }}">
  <link rel='stylesheet' href='http://fonts.googleapis.com/css?family=Roboto:300,400,500,300italic'>
  <link rel="stylesheet" href="{{ asset('assets/global/vendor/nprogress/nprogress.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/examples/css/advanced/animation.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/examples/css/widgets/data.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/global/vendor/toastr/toastr.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/examples/css/advanced/toastr.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/global/vendor/jquery-selective/jquery-selective.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/examples/css/apps/projects.css') }}">


  <link rel="stylesheet" href="{{ asset('assets/examples/css/pages/profile.css') }}">
  <!-- TIME CIRCLE -->
  <link rel="stylesheet" href="{{ asset('assets/css/timecircle.css') }}">
    <!--[if lt IE 9]>
    <script src="{{ asset('assets/global/vendor/html5shiv/html5shiv.min.js') }}"></script>
    <![endif]-->
    
    <!--[if lt IE 10]>
    <script src="{{ asset('assets/global/vendor/media-match/media.match.min.js') }}"></script>
    <script src="{{ asset('assets/global/vendor/respond/respond.min.js') }}"></script>
    <![endif]-->
    
    <!-- Scripts -->
    <script src="{{ asset('assets/global/vendor/breakpoints/breakpoints.js') }}"></script>
    <script>
      Breakpoints();
    </script>


<style>
  .block:hover
  {
    color: #3e8ef7;
  }


  .dashboard .card, .dashboard .panel 
  {
     /*height: -webkit-calc(100% - 30px); */
     /*height: calc(100% - 30px); */
     height: auto;
     margin-bottom: 30px;
  }


</style>
  </head>
  <body class="animsition site-navbar-small dashboard">
    <!--[if lt IE 8]>
        <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
    <![endif]-->


  

    <nav class="site-navbar navbar navbar-default navbar-fixed-top navbar-mega" role="navigation">
    
      <div class="navbar-header">
        <button type="button" class="navbar-toggler hamburger hamburger-close navbar-toggler-left hided"
          data-toggle="menubar">
          <span class="sr-only">Toggle navigation</span>
          <span class="hamburger-bar"></span>
        </button>
        <button type="button" class="navbar-toggler collapsed" data-target="#site-navbar-collapse"
          data-toggle="collapse">
          <i class="icon wb-more-horizontal" aria-hidden="true"></i>
        </button>
        <div class="navbar-brand navbar-brand-center site-gridmenu-toggle" data-toggle="gridmenu">
          <img class="navbar-brand-logo" src="{{ asset('assets/images/cbtpng.png') }}" title="Tello - School Management System" style="color: #fff">
          <span class="navbar-brand-text hidden-xs-down"> Tello </span>
        </div>
        <button type="button" class="navbar-toggler collapsed" data-target="#site-navbar-search"
          data-toggle="collapse">
          <span class="sr-only">Toggle Search</span>
          <i class="icon wb-search" aria-hidden="true"></i>
        </button>
      </div>
    
      <div class="navbar-container container-fluid">
        <!-- Navbar Collapse -->
        <div class="collapse navbar-collapse navbar-collapse-toolbar" id="site-navbar-collapse">
          <!-- Navbar Toolbar -->
          <ul class="nav navbar-toolbar">
            <li class="nav-item hidden-float" id="toggleMenubar">
              <a class="nav-link" data-toggle="menubar" href="#" role="button">
                <i class="icon hamburger hamburger-arrow-left">
                  <span class="sr-only">Toggle menubar</span>
                  <span class="hamburger-bar"></span>
                </i>
              </a>
            </li>
            <!-- <li class="nav-item hidden-sm-down" id="toggleFullscreen">
              <a class="nav-link icon icon-fullscreen" data-toggle="fullscreen" href="#" role="button">
                <span class="sr-only">Toggle fullscreen</span>
              </a>
            </li> -->
            <li class="nav-item hidden-float">
              <a class="nav-link icon wb-search" data-toggle="collapse" href="#" data-target="#site-navbar-search"
                role="button">
                <span class="sr-only">Toggle Search</span>
              </a>
            </li>
            <li class="nav-item dropdown dropdown-fw dropdown-mega">
              <a class="nav-link" data-toggle="dropdown" href="#" aria-expanded="false" data-animation="fade"
                role="button">Mega <i class="icon wb-chevron-down-mini" aria-hidden="true"></i></a>
              <div class="dropdown-menu" role="menu">
                <div class="mega-content">
                  <div class="row">
                    <div class="col-md-4">
                      <h5>UI Kit</h5>
                      <ul class="blocks-2">
                        <li class="mega-menu m-0">
                          <ul class="list-icons">
                            <li><i class="wb-chevron-right-mini" aria-hidden="true"></i>
                              <a
                                href="advanced/animation.html">Animation</a>
                            </li>
                            <li><i class="wb-chevron-right-mini" aria-hidden="true"></i>
                              <a
                                href="uikit/buttons.html">Buttons</a>
                            </li>
                            <li><i class="wb-chevron-right-mini" aria-hidden="true"></i>
                              <a
                                href="uikit/colors.html">Colors</a>
                            </li>
                            <li><i class="wb-chevron-right-mini" aria-hidden="true"></i>
                              <a
                                href="uikit/dropdowns.html">Dropdowns</a>
                            </li>
                            <li><i class="wb-chevron-right-mini" aria-hidden="true"></i>
                              <a
                                href="uikit/icons.html">Icons</a>
                            </li>
                            <li><i class="wb-chevron-right-mini" aria-hidden="true"></i>
                              <a
                                href="advanced/lightbox.html">Lightbox</a>
                            </li>
                          </ul>
                        </li>
                        <li class="mega-menu m-0">
                          <ul class="list-icons">
                            <li><i class="wb-chevron-right-mini" aria-hidden="true"></i>
                              <a
                                href="uikit/modals.html">Modals</a>
                            </li>
                            <li><i class="wb-chevron-right-mini" aria-hidden="true"></i>
                              <a
                                href="uikit/panel-structure.html">Panels</a>
                            </li>
                            <li><i class="wb-chevron-right-mini" aria-hidden="true"></i>
                              <a
                                href="structure/overlay.html">Overlay</a>
                            </li>
                            <li><i class="wb-chevron-right-mini" aria-hidden="true"></i>
                              <a
                                href="uikit/tooltip-popover.html ">Tooltips</a>
                            </li>
                            <li><i class="wb-chevron-right-mini" aria-hidden="true"></i>
                              <a
                                href="advanced/scrollable.html">Scrollable</a>
                            </li>
                            <li><i class="wb-chevron-right-mini" aria-hidden="true"></i>
                              <a
                                href="uikit/typography.html">Typography</a>
                            </li>
                          </ul>
                        </li>
                      </ul>
                    </div>
                    <div class="col-md-4">
                      <h5>Media
                        <span class="badge badge-pill badge-success">4</span>
                      </h5>
                      <ul class="blocks-3">
                        <li>
                          <a class="thumbnail m-0" href="javascript:void(0)">
                            <img class="w-full" src="{{ asset('assets/global/photos/placeholder.png') }}" alt="..." />
                          </a>
                        </li>
                        <li>
                          <a class="thumbnail m-0" href="javascript:void(0)">
                            <img class="w-full" src="{{ asset('assets/global/photos/placeholder.png') }}" alt="..." />
                          </a>
                        </li>
                        <li>
                          <a class="thumbnail m-0" href="javascript:void(0)">
                            <img class="w-full" src="{{ asset('assets/global/photos/placeholder.png') }}" alt="..." />
                          </a>
                        </li>
                        <li>
                          <a class="thumbnail m-0" href="javascript:void(0)">
                            <img class="w-full" src="{{ asset('assets/global/photos/placeholder.png') }}" alt="..." />
                          </a>
                        </li>
                        <li>
                          <a class="thumbnail m-0" href="javascript:void(0)">
                            <img class="w-full" src="{{ asset('assets/global/photos/placeholder.png') }}" alt="..." />
                          </a>
                        </li>
                        <li>
                          <a class="thumbnail m-0" href="javascript:void(0)">
                            <img class="w-full" src="{{ asset('assets/global/photos/placeholder.png') }}" alt="..." />
                          </a>
                        </li>
                      </ul>
                    </div>
                    <div class="col-md-4">
                      <h5 class="mb-0">Accordion</h5>
                      <!-- Accordion -->
                      <div class="panel-group panel-group-simple" id="siteMegaAccordion" aria-multiselectable="true"
                        role="tablist">
                        <div class="panel">
                          <div class="panel-heading" id="siteMegaAccordionHeadingOne" role="tab">
                            <a class="panel-title" data-toggle="collapse" href="#siteMegaCollapseOne" data-parent="#siteMegaAccordion"
                              aria-expanded="false" aria-controls="siteMegaCollapseOne">
                              Collapsible Group Item #1
                            </a>
                          </div>
                          <div class="panel-collapse collapse" id="siteMegaCollapseOne" aria-labelledby="siteMegaAccordionHeadingOne"
                            role="tabpanel">
                            <div class="panel-body">
                              De moveat laudatur vestra parum doloribus labitur sentire partes, eripuit praesenti
                              congressus ostendit alienae, voluptati ornateque accusamus
                              clamat reperietur convicia albucius.
                            </div>
                          </div>
                        </div>
                        <div class="panel">
                          <div class="panel-heading" id="siteMegaAccordionHeadingTwo" role="tab">
                            <a class="panel-title collapsed" data-toggle="collapse" href="#siteMegaCollapseTwo"
                              data-parent="#siteMegaAccordion" aria-expanded="false"
                              aria-controls="siteMegaCollapseTwo">
                              Collapsible Group Item #2
                            </a>
                          </div>
                          <div class="panel-collapse collapse" id="siteMegaCollapseTwo" aria-labelledby="siteMegaAccordionHeadingTwo"
                            role="tabpanel">
                            <div class="panel-body">
                              Praestabiliorem. Pellat excruciant legantur ullum leniter vacare foris voluptate
                              loco ignavi, credo videretur multoque choro fatemur mortis
                              animus adoptionem, bello statuat expediunt naturales.
                            </div>
                          </div>
                        </div>
    
                        <div class="panel">
                          <div class="panel-heading" id="siteMegaAccordionHeadingThree" role="tab">
                            <a class="panel-title collapsed" data-toggle="collapse" href="#siteMegaCollapseThree"
                              data-parent="#siteMegaAccordion" aria-expanded="false"
                              aria-controls="siteMegaCollapseThree">
                              Collapsible Group Item #3
                            </a>
                          </div>
                          <div class="panel-collapse collapse" id="siteMegaCollapseThree" aria-labelledby="siteMegaAccordionHeadingThree"
                            role="tabpanel">
                            <div class="panel-body">
                              Horum, antiquitate perciperet d conspectum locus obruamus animumque perspici probabis
                              suscipere. Desiderat magnum, contenta poena desiderant
                              concederetur menandri damna disputandum corporum.
                            </div>
                          </div>
                        </div>
                      </div>
                      <!-- End Accordion -->
                    </div>
                  </div>
                </div>
              </div>
            </li>
          </ul>
          <!-- End Navbar Toolbar -->
    
          <!-- Navbar Toolbar Right -->
          <ul class="nav navbar-toolbar navbar-right navbar-toolbar-right">
            <li class="nav-item dropdown" style="width: 60; padding: auto 0px">
              <a class="nav-link" data-toggle="dropdown" href="javascript:void(0)" data-animation="scale-up"
                aria-expanded="false" role="button">
                <span class="flag-icon flag-icon-us"></span>
              </a>
              <div class="dropdown-menu" role="menu">
                <a class="dropdown-item" href="javascript:void(0)" role="menuitem">
                  <span class="flag-icon flag-icon-gb"></span> English</a>
                <a class="dropdown-item" href="javascript:void(0)" role="menuitem">
                  <span class="flag-icon flag-icon-fr"></span> French</a>
                <a class="dropdown-item" href="javascript:void(0)" role="menuitem">
                  <span class="flag-icon flag-icon-cn"></span> Chinese</a>
                <a class="dropdown-item" href="javascript:void(0)" role="menuitem">
                  <span class="flag-icon flag-icon-de"></span> German</a>
                <a class="dropdown-item" href="javascript:void(0)" role="menuitem">
                  <span class="flag-icon flag-icon-nl"></span> Dutch</a>
              </div>
            </li>


            <li class="nav-item dropdown" style="width: 60; padding: auto 0px">
              <a class="nav-link navbar-avatar" data-toggle="dropdown" href="#" aria-expanded="false"
                data-animation="scale-up" role="button">
                <span class="avatar avatar-online">
                  <img src="{{ asset('assets/images/user1.png') }}" alt="...">
                  <i></i>
                </span>
              </a>
              <div class="dropdown-menu" role="menu">
                <a class="dropdown-item" href="javascript:void(0)" role="menuitem"><i class="icon wb-user" aria-hidden="true"></i> Profile</a>
                <a class="dropdown-item" href="javascript:void(0)" role="menuitem"><i class="icon wb-payment" aria-hidden="true"></i> Billing</a>
                <a class="dropdown-item" href="javascript:void(0)" role="menuitem"><i class="icon wb-settings" aria-hidden="true"></i> Settings</a>
                <div class="dropdown-divider" role="presentation"></div>
                <a class="dropdown-item" href="javascript:void(0)" role="menuitem"><i class="icon wb-power" aria-hidden="true"></i> Logout</a>
              </div>
            </li>


            <li class="nav-item dropdown" style="width: 60; padding: auto 0px">
              <a class="nav-link" data-toggle="dropdown" href="javascript:void(0)" title="Notifications"
                aria-expanded="false" data-animation="scale-up" role="button">
                <i class="icon wb-bell" aria-hidden="true"></i>
                <span class="badge badge-pill badge-danger up" style="margin: -15px; margin-left: 5px">5</span>
              </a>
              <div class="dropdown-menu dropdown-menu-right dropdown-menu-media" role="menu">
                <div class="dropdown-menu-header">
                  <h5>NOTIFICATIONS</h5>
                  <span class="badge badge-round badge-danger">New 5</span>
                </div>
    
                <div class="list-group">
                  <div data-role="container">
                    <div data-role="content">
                      <a class="list-group-item dropdown-item" href="javascript:void(0)" role="menuitem">
                        <div class="media">
                          <div class="pr-10">
                            <i class="icon wb-order bg-red-600 white icon-circle" aria-hidden="true"></i>
                          </div>
                          <div class="media-body">
                            <h6 class="media-heading">A new order has been placed</h6>
                            <time class="media-meta" datetime="2018-06-12T20:50:48+08:00">5 hours ago</time>
                          </div>
                        </div>
                      </a>
                    </div>
                  </div>
                </div>

                <div class="dropdown-menu-footer">
                  <a class="dropdown-menu-footer-btn" href="javascript:void(0)" role="button">
                    <i class="icon wb-settings" aria-hidden="true"></i>
                  </a>
                  <a class="dropdown-item" href="javascript:void(0)" role="menuitem">
                    All notifications
                  </a>
                </div>
              </div>
            </li>


            <li class="nav-item dropdown" style="width: 60; padding: auto 0px">
              <a class="nav-link" data-toggle="dropdown" href="javascript:void(0)" title="Messages"
                aria-expanded="false" data-animation="scale-up" role="button">
                <i class="icon wb-envelope" aria-hidden="true"></i>
                <span class="badge badge-pill badge-info up" style="margin: -15px; margin-left: 5px">3</span>
              </a>
              <div class="dropdown-menu dropdown-menu-right dropdown-menu-media" role="menu">
                <div class="dropdown-menu-header" role="presentation">
                  <h5>MESSAGES</h5>
                  <span class="badge badge-round badge-info">New 3</span>
                </div>
    
                <div class="list-group" role="presentation">
                  <div data-role="container">
                    <div data-role="content">
                      <a class="list-group-item" href="javascript:void(0)" role="menuitem">
                        <div class="media">
                          <div class="pr-10">
                            <span class="avatar avatar-sm avatar-online">
                              <img src="{{ asset('assets/global/portraits/2.jpg') }}" alt="..." />
                              <i></i>
                            </span>
                          </div>
                          <div class="media-body">
                            <h6 class="media-heading">Mary Adams</h6>
                            <div class="media-meta">
                              <time datetime="2018-06-17T20:22:05+08:00">30 minutes ago</time>
                            </div>
                            <div class="media-detail">Anyways, i would like just do it</div>
                          </div>
                        </div>
                      </a>
                    </div>
                  </div>
                </div>

                <div class="dropdown-menu-footer" role="presentation">
                  <a class="dropdown-menu-footer-btn" href="javascript:void(0)" role="button">
                    <i class="icon wb-settings" aria-hidden="true"></i>
                  </a>
                  <a class="dropdown-item" href="javascript:void(0)" role="menuitem">
                    See all messages
                  </a>
                </div>
              </div>
            </li>
            <li class="nav-item" id="toggleChat" style="width: 60; padding: auto 0px">
              <a class="nav-link" data-toggle="site-sidebar" href="javascript:void(0)" title="Chat"
                data-url="site-sidebar.tpl">
                <i class="icon wb-chat" aria-hidden="true"></i>
              </a>
            </li>
          </ul>
          <!-- End Navbar Toolbar Right -->
        </div>
        <!-- End Navbar Collapse -->


    
        <!-- Site Navbar Seach -->
        <div class="collapse navbar-search-overlap" id="site-navbar-search">
          <form role="search">
            <div class="form-group">
              <div class="input-search">
                <i class="input-search-icon wb-search" aria-hidden="true"></i>
                <input type="text" class="form-control" name="site-search" placeholder="Search...">
                <button type="button" class="input-search-close icon wb-close" data-target="#site-navbar-search"
                  data-toggle="collapse" aria-label="Close"></button>
              </div>
            </div>
          </form>
        </div>
        <!-- End Site Navbar Seach -->
      </div>

    </nav>



    <div class="site-menubar">
      <ul class="site-menu">
        <li class="site-menu-item has-sub">
          <a href="http://localhost:8000/">
              <i class="site-menu-icon icon fa-dashboard" aria-hidden="true"></i>  <span class="site-menu-title"> Dashboard </span>
              {{-- <span class="site-menu-arrow"></span> --}}
          </a>
        </li>

        <li class="site-menu-item has-sub">
          <a href="http://localhost:8000/sessions">
              <i class="site-menu-icon icon fa-institution" aria-hidden="true"></i> 
              <span class="site-menu-title"> Academic Session </span> 
          </a>
        </li>


        <li class="site-menu-item has-sub">
          <a href="javascript:void(0)">
              <i class="site-menu-icon wb-users" aria-hidden="true"></i>
              <span class="site-menu-title">Students & Staff</span>  <span class="site-menu-arrow"></span>
          </a>
          <ul class="site-menu-sub">
            <li class="site-menu-item">
              <a class="" href="http://localhost:8000/students">
                <span class="site-menu-title"> Students </span>
              </a>
            </li>
            <li class="site-menu-item">
              <a class="" href="http://localhost:8000/staff">
                <span class="site-menu-title"> Staff </span>
              </a>
            </li>
          </ul>
        </li>



        <li class="site-menu-item has-sub">
          <a href="http://localhost:8000/class">
              <i class="site-menu-icon icon fa-cubes" aria-hidden="true"></i> 
              <span class="site-menu-title"> Classes </span> 
          </a>
        </li>

        <li class="site-menu-item has-sub">
          <a href="http://localhost:8000/subjects">
              <i class="site-menu-icon wb-library" aria-hidden="true"></i> 
              <span class="site-menu-title"> Subjects </span> 
          </a>
        </li>

        <li class="site-menu-item has-sub">
          <a href="http://localhost:8000/questions">
              <i class="site-menu-icon icon fa-graduation-cap" aria-hidden="true"></i> 
              <span class="site-menu-title"> Questions </span>
          </a>
        </li>


        <li class="site-menu-item has-sub">
          <a href="javascript:void(0)">
              <i class="site-menu-icon wb-copy" aria-hidden="true"></i>
              <span class="site-menu-title">Exam Configuration</span>  <span class="site-menu-arrow"></span>
          </a>
          <ul class="site-menu-sub">
            <li class="site-menu-item">
              <a class="" href="http://localhost:8000/exam-setup">
                <span class="site-menu-title"> Setup Exams </span>
              </a>
            </li>
            <li class="site-menu-item">
              <a class="" href="http://localhost:8000/access">
                <span class="site-menu-title"> Exam Access </span>
              </a>
            </li>
            <li class="site-menu-item">
              <a class="" href="http://localhost:8000/gradings">
                <span class="site-menu-title"> Grading </span>
              </a>
            </li>
          </ul>
        </li>

        <li class="site-menu-item has-sub">
          <a href="javascript:void(0)">
              <i class="site-menu-icon fa-graduation-cap" aria-hidden="true"></i>
              <span class="site-menu-title">Results</span>  <span class="site-menu-arrow"></span>
          </a>
          <ul class="site-menu-sub">
            <li class="site-menu-item">
              <a class="" href="http://localhost:8000/check-result">
                <span class="site-menu-title">  Check Result </span>
              </a>
            </li>
            <li class="site-menu-item">
              <a class="" href="http://localhost:8000/promote-student">
                <span class="site-menu-title">  Promote Student </span>
              </a>
            </li>
          </ul>
        </li>

        <li class="site-menu-item has-sub">
          <a href="javascript:void(0)">
              <i class="site-menu-icon fa-money" aria-hidden="true"></i>
              <span class="site-menu-title">Finance</span>  <span class="site-menu-arrow"></span>
          </a>
          <ul class="site-menu-sub">
            <li class="site-menu-item">
              <a class="" href="http://localhost:8000/fees">
                <span class="site-menu-title"> Fees </span>
              </a>
            </li>
            <li class="site-menu-item">
              <a class="" href="http://localhost:8000/">
                <span class="site-menu-title"> Budget </span>
              </a>
            </li>
            <li class="site-menu-item">
              <a class="" href="http://localhost:8000/">
                <span class="site-menu-title"> Expense </span>
              </a>
            </li>
          </ul>
        </li>

        <li class="site-menu-item has-sub">
          <a href="javascript:void(0)">
              <i class="site-menu-icon wb-copy" aria-hidden="true"></i>
              <span class="site-menu-title">Profile</span>  <span class="site-menu-arrow"></span>
          </a>
          <ul class="site-menu-sub">
            <li class="site-menu-item">
              <a class="" href="http://localhost:8000/student-profile">
                <span class="site-menu-title"> Student Profile </span>
              </a>
            </li>
            <li class="site-menu-item">
              <a class="" href="http://localhost:8000/staff-profile">
                <span class="site-menu-title"> Staff Profile </span>
              </a>
            </li>
            <li class="site-menu-item">
              <a class="" href="http://localhost:8000/year-book">
                <span class="site-menu-title"> Year Book </span>
              </a>
            </li>
          </ul>
        </li>
        <li class="site-menu-item has-sub">
          <a href="{{route('access-exam')}}">
              <i class="site-menu-icon icon fa-graduation-cap" aria-hidden="true"></i> 
              <span class="site-menu-title"> Take Your Exam </span>
          </a>
        </li>

        



      </ul>

    </div>    




    <div class="site-gridmenu">
      <div>
        <div>
          <ul>
            <li>
              <a href="apps/mailbox/mailbox.html">
                <i class="icon wb-envelope"></i>
                <span>Mailbox</span>
              </a>
            </li>
            <li>
              <a href="apps/calendar/calendar.html">
                <i class="icon wb-calendar"></i>
                <span>Calendar</span>
              </a>
            </li>
            <li>
              <a href="apps/contacts/contacts.html">
                <i class="icon wb-user"></i>
                <span>Contacts</span>
              </a>
            </li>
            <li>
              <a href="apps/media/overview.html">
                <i class="icon wb-camera"></i>
                <span>Media</span>
              </a>
            </li>
            <li>
              <a href="apps/documents/categories.html">
                <i class="icon wb-order"></i>
                <span>Documents</span>
              </a>
            </li>
            <li>
              <a href="apps/projects/projects.html">
                <i class="icon wb-image"></i>
                <span>Project</span>
              </a>
            </li>
            <li>
              <a href="apps/forum/forum.html">
                <i class="icon wb-chat-group"></i>
                <span>Forum</span>
              </a>
            </li>
            <li>
              <a href="index.html">
                <i class="icon wb-dashboard"></i>
                <span>Dashboard</span>
              </a>
            </li>
          </ul>
        </div>
      </div>
    </div>

    <!-- Page -->
        


        @yield('content')




    <!-- End Page -->


    <!-- Footer -->
    <footer class="site-footer">
      <div class="site-footer-legal">© {{date('Y')}} <a href="#">Tello</a></div>
      <div class="site-footer-right">
        Powered By <i class="red-600 wb wb-heart"></i> by <a href="#">I-Clone</a>
      </div>
    </footer>




    <!-- Core  -->
    <script src="{{ asset('assets/global/vendor/babel-external-helpers/babel-external-helpers.js') }}"></script>
    <script src="{{ asset('assets/global/vendor/jquery/jquery.js') }}"></script>
    <script src="{{ asset('assets/global/vendor/popper-js/umd/popper.min.js') }}"></script>
    <script src="{{ asset('assets/global/vendor/bootstrap/bootstrap.js') }}"></script>
    <script src="{{ asset('assets/global/vendor/animsition/animsition.js') }}"></script>
    <script src="{{ asset('assets/global/vendor/mousewheel/jquery.mousewheel.js') }}"></script>
    <script src="{{ asset('assets/global/vendor/asscrollbar/jquery-asScrollbar.js') }}"></script>
    <script src="{{ asset('assets/global/vendor/asscrollable/jquery-asScrollable.js') }}"></script>

    <script src="{{ asset('js/app.js') }}"></script>
    
    <!-- Plugins -->
    <script src="{{ asset('assets/global/vendor/jquery-mmenu/jquery.mmenu.min.all.js') }}"></script>
    <script src="{{ asset('assets/global/vendor/switchery/switchery.js') }}"></script>
    <script src="{{ asset('assets/global/vendor/intro-js/intro.js') }}"></script>
    <script src="{{ asset('assets/global/vendor/screenfull/screenfull.js') }}"></script>
    <script src="{{ asset('assets/global/vendor/slidepanel/jquery-slidePanel.js') }}"></script>
    <script src="{{ asset('assets/global/vendor/skycons/skycons.js') }}"></script>
    {{-- <script src="{{ asset('assets/global/vendor/chartist/chartist.min.js') }}"></script> --}}
    {{-- <script src="{{ asset('assets/global/vendor/chartist-plugin-tooltip/chartist-plugin-tooltip.js') }}"></script> --}}
    <script src="{{ asset('assets/global/vendor/aspieprogress/jquery-asPieProgress.min.js') }}"></script>
    <script src="{{ asset('assets/global/vendor/jvectormap/jquery-jvectormap.min.js') }}"></script>
    <script src="{{ asset('assets/global/vendor/jvectormap/maps/jquery-jvectormap-au-mill-en.js') }}"></script>
    <script src="{{ asset('assets/global/vendor/matchheight/jquery.matchHeight-min.js') }}"></script>
    
    <!-- Scripts -->
    <script src="{{ asset('assets/global/js/Component.js') }}"></script>
    <script src="{{ asset('assets/global/js/Plugin.js') }}"></script>
    <script src="{{ asset('assets/global/js/Base.js') }}"></script>
    <script src="{{ asset('assets/global/js/Config.js') }}"></script>
    
    <script src="{{ asset('assets/js/Section/Menubar.js') }}"></script>
    <script src="{{ asset('assets/js/Section/Sidebar.js') }}"></script>
    <script src="{{ asset('assets/js/Section/PageAside.js') }}"></script>
    <script src="{{ asset('assets/js/Section/GridMenu.js') }}"></script>
    
    <!-- Config -->
    <script src="{{ asset('assets/global/js/config/colors.js') }}"></script>
    <script src="{{ asset('assets/js/config/tour.js') }}"></script>
    <script>Config.set('assets', '../assets');</script>
    
    <!-- Page -->
    <script src="{{ asset('assets/js/Site.js') }}"></script>
    <script src="{{ asset('assets/global/js/Plugin/asscrollable.js') }}"></script>
    <script src="{{ asset('assets/global/js/Plugin/slidepanel.js') }}"></script>
    <script src="{{ asset('assets/global/js/Plugin/switchery.js') }}"></script>
    <script src="{{ asset('assets/global/js/Plugin/matchheight.js') }}"></script>
    <script src="{{ asset('assets/global/js/Plugin/jvectormap.js') }}"></script>

    <script src="{{ asset('assets/examples/js/dashboard/v1.js') }}"></script>
    <script src="{{ asset('assets/global/js/Plugin/toastr.js') }}"></script>
    <script src="{{ asset('assets/global/vendor/toastr/toastr.js') }}"></script>
    

    <script src="{{ asset('assets/global/js/Plugin/animate-list.js') }}"></script>
    <script src="{{ asset('assets/global/js/Plugin/bootbox.js') }}"></script>
    <script src="{{ asset('assets/js/App/Projects.js') }}"></script>

    <script src="{{ asset('assets/examples/js/apps/projects.js') }}"></script>

    <script src="{{ asset('assets/global/js/Plugin/responsive-tabs.js') }}"></script>
    <script src="{{ asset('assets/global/js/Plugin/tabs.js') }}"></script>

    <!-- TIME CIRCLE -->
    <script src="{{ asset('assets/js/timecircle.js') }}"></script>

        @yield('script')
  </body>
</html>
