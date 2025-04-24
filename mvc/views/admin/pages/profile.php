<body>
  <!-- Page Container -->
  <!--
    Available classes for #page-container:

    GENERIC

      'remember-theme'                            Remembers active color theme and dark mode between pages using localStorage when set through
                                                  - Theme helper buttons [data-toggle="theme"],
                                                  - Layout helper buttons [data-toggle="layout" data-action="dark_mode_[on/off/toggle]"]
                                                  - ..and/or Dashmix.layout('dark_mode_[on/off/toggle]')

    SIDEBAR & SIDE OVERLAY

      'sidebar-r'                                 Right Sidebar and left Side Overlay (default is left Sidebar and right Side Overlay)
      'sidebar-mini'                              Mini hoverable Sidebar (screen width > 991px)
      'sidebar-o'                                 Visible Sidebar by default (screen width > 991px)
      'sidebar-o-xs'                              Visible Sidebar by default (screen width < 992px)
      'sidebar-dark'                              Dark themed sidebar

      'side-overlay-hover'                        Hoverable Side Overlay (screen width > 991px)
      'side-overlay-o'                            Visible Side Overlay by default

      'enable-page-overlay'                       Enables a visible clickable Page Overlay (closes Side Overlay on click) when Side Overlay opens

      'side-scroll'                               Enables custom scrolling on Sidebar and Side Overlay instead of native scrolling (screen width > 991px)

    HEADER

      ''                                          Static Header if no class is added
      'page-header-fixed'                         Fixed Header


    FOOTER

      ''                                          Static Footer if no class is added
      'page-footer-fixed'                         Fixed Footer (please have in mind that the footer has a specific height when is fixed)

    HEADER STYLE

      ''                                          Classic Header style if no class is added
      'page-header-dark'                          Dark themed Header
      'page-header-glass'                         Light themed Header with transparency by default
                                                  (absolute position, perfect for light images underneath - solid light background on scroll if the Header is also set as fixed)
      'page-header-glass page-header-dark'         Dark themed Header with transparency by default
                                                  (absolute position, perfect for dark images underneath - solid dark background on scroll if the Header is also set as fixed)

    MAIN CONTENT LAYOUT

      ''                                          Full width Main Content if no class is added
      'main-content-boxed'                        Full width Main Content with a specific maximum width (screen width > 1200px)
      'main-content-narrow'                       Full width Main Content with a percentage width (screen width > 1200px)

    DARK MODE

      'sidebar-dark page-header-dark dark-mode'   Enable dark mode (light sidebar/header is not supported with dark mode)
  -->
  <div id="page-container">
    <!-- Side Overlay-->
    <aside id="side-overlay">
      <!-- Side Header -->
      <div class="bg-image" style="background-image: url('assets/media/various/bg_side_overlay_header.jpg');">
      </div>
      <!-- END Side Header -->

      <!-- Side Content -->
      <div class="content-side">
        <!-- Side Overlay Tabs -->
        <div class="block block-transparent pull-x pull-t mb-0">
          <ul class="nav nav-tabs nav-tabs-block nav-justified" role="tablist">
            <li class="nav-item" role="presentation">
              <button class="nav-link active" id="so-settings-tab" data-bs-toggle="tab" data-bs-target="#so-settings" role="tab" aria-controls="so-settings" aria-selected="true">
                <i class="fa fa-fw fa-cog"></i>
              </button>
            </li>
            <li class="nav-item" role="presentation">
              <button class="nav-link" id="so-people-tab" data-bs-toggle="tab" data-bs-target="#so-people" role="tab" aria-controls="so-people" aria-selected="false">
                <i class="far fa-fw fa-user-circle"></i>
              </button>
            </li>
            <li class="nav-item" role="presentation">
              <button class="nav-link" id="so-profile-tab" data-bs-toggle="tab" data-bs-target="#so-profile" role="tab" aria-controls="so-profile" aria-selected="false">
                <i class="far fa-fw fa-edit"></i>
              </button>
            </li>
          </ul>
          <div class="block-content tab-content overflow-hidden">
            <!-- Settings Tab -->
            <div class="tab-pane pull-x fade fade-up show active" id="so-settings" role="tabpanel" aria-labelledby="so-settings-tab" tabindex="0">
              <div class="block mb-0">
                <!-- Color Themes -->
                <!-- Toggle Themes functionality initialized in Template._uiHandleTheme() -->
                <div class="block-content block-content-sm block-content-full bg-body">
                  <span class="text-uppercase fs-sm fw-bold">Color Themes</span>
                </div>
                <div class="block-content block-content-full">
                  <div class="row g-sm text-center">
                    <div class="col-4 mb-1">
                      <a class="d-block py-3 text-white fs-sm fw-semibold bg-default" data-toggle="theme" data-theme="default" href="#">
                        Default
                      </a>
                    </div>
                    <div class="col-4 mb-1">
                      <a class="d-block py-3 text-white fs-sm fw-semibold bg-xwork" data-toggle="theme" data-theme="assets/css/themes/xwork.min.css" href="#">
                        xWork
                      </a>
                    </div>
                    <div class="col-4 mb-1">
                      <a class="d-block py-3 text-white fs-sm fw-semibold bg-xmodern" data-toggle="theme" data-theme="assets/css/themes/xmodern.min.css" href="#">
                        xModern
                      </a>
                    </div>
                    <div class="col-4 mb-1">
                      <a class="d-block py-3 text-white fs-sm fw-semibold bg-xeco" data-toggle="theme" data-theme="assets/css/themes/xeco.min.css" href="#">
                        xEco
                      </a>
                    </div>
                    <div class="col-4 mb-1">
                      <a class="d-block py-3 text-white fs-sm fw-semibold bg-xsmooth" data-toggle="theme" data-theme="assets/css/themes/xsmooth.min.css" href="#">
                        xSmooth
                      </a>
                    </div>
                    <div class="col-4 mb-1">
                      <a class="d-block py-3 text-white fs-sm fw-semibold bg-xinspire" data-toggle="theme" data-theme="assets/css/themes/xinspire.min.css" href="#">
                        xInspire
                      </a>
                    </div>
                    <div class="col-4 mb-1">
                      <a class="d-block py-3 text-white fs-sm fw-semibold bg-xdream" data-toggle="theme" data-theme="assets/css/themes/xdream.min.css" href="#">
                        xDream
                      </a>
                    </div>
                    <div class="col-4 mb-1">
                      <a class="d-block py-3 text-white fs-sm fw-semibold bg-xpro" data-toggle="theme" data-theme="assets/css/themes/xpro.min.css" href="#">
                        xPro
                      </a>
                    </div>
                    <div class="col-4 mb-1">
                      <a class="d-block py-3 text-white fs-sm fw-semibold bg-xplay" data-toggle="theme" data-theme="assets/css/themes/xplay.min.css" href="#">
                        xPlay
                      </a>
                    </div>
                    <div class="col-12">
                      <a class="d-block py-3 bg-body-dark fw-semibold text-dark" href="be_ui_color_themes.html">All Color Themes</a>
                    </div>
                  </div>
                </div>
                <!-- END Color Themes -->

                <!-- Sidebar -->
                <div class="block-content block-content-sm block-content-full bg-body">
                  <span class="text-uppercase fs-sm fw-bold">Sidebar</span>
                </div>
                <div class="block-content block-content-full">
                  <div class="row g-sm text-center">
                    <div class="col-6 mb-1">
                      <a class="d-block py-3 bg-body-dark fw-semibold text-dark" data-toggle="layout" data-action="sidebar_style_dark" href="javascript:void(0)">Dark</a>
                    </div>
                    <div class="col-6 mb-1">
                      <a class="d-block py-3 bg-body-dark fw-semibold text-dark" data-toggle="layout" data-action="sidebar_style_light" href="javascript:void(0)">Light</a>
                    </div>
                  </div>
                </div>
                <!-- END Sidebar -->

                <!-- Header -->
                <div class="block-content block-content-sm block-content-full bg-body">
                  <span class="text-uppercase fs-sm fw-bold">Header</span>
                </div>
                <div class="block-content block-content-full">
                  <div class="row g-sm text-center mb-2">
                    <div class="col-6 mb-1">
                      <a class="d-block py-3 bg-body-dark fw-semibold text-dark" data-toggle="layout" data-action="header_style_dark" href="javascript:void(0)">Dark</a>
                    </div>
                    <div class="col-6 mb-1">
                      <a class="d-block py-3 bg-body-dark fw-semibold text-dark" data-toggle="layout" data-action="header_style_light" href="javascript:void(0)">Light</a>
                    </div>
                    <div class="col-6 mb-1">
                      <a class="d-block py-3 bg-body-dark fw-semibold text-dark" data-toggle="layout" data-action="header_mode_fixed" href="javascript:void(0)">Fixed</a>
                    </div>
                    <div class="col-6 mb-1">
                      <a class="d-block py-3 bg-body-dark fw-semibold text-dark" data-toggle="layout" data-action="header_mode_static" href="javascript:void(0)">Static</a>
                    </div>
                  </div>
                </div>
                <!-- END Header -->

                <!-- Content -->
                <div class="block-content block-content-sm block-content-full bg-body">
                  <span class="text-uppercase fs-sm fw-bold">Content</span>
                </div>
                <div class="block-content block-content-full">
                  <div class="row g-sm text-center">
                    <div class="col-6 mb-1">
                      <a class="d-block py-3 bg-body-dark fw-semibold text-dark" data-toggle="layout" data-action="content_layout_boxed" href="javascript:void(0)">Boxed</a>
                    </div>
                    <div class="col-6 mb-1">
                      <a class="d-block py-3 bg-body-dark fw-semibold text-dark" data-toggle="layout" data-action="content_layout_narrow" href="javascript:void(0)">Narrow</a>
                    </div>
                    <div class="col-12 mb-1">
                      <a class="d-block py-3 bg-body-dark fw-semibold text-dark" data-toggle="layout" data-action="content_layout_full_width" href="javascript:void(0)">Full Width</a>
                    </div>
                  </div>
                </div>
                <!-- END Content -->

                <!-- Layout API -->
                <div class="block-content block-content-full border-top">
                  <a class="btn w-100 btn-alt-primary" href="be_layout_api.html">
                    <i class="fa fa-fw fa-flask me-1"></i> Layout API
                  </a>
                </div>
                <!-- END Layout API -->
              </div>
            </div>
            <!-- END Settings Tab -->

            <!-- People -->
            <div class="tab-pane pull-x fade fade-up" id="so-people" role="tabpanel" aria-labelledby="so-people-tab" tabindex="0">
              <div class="block mb-0">
                <!-- Online -->
                <div class="block-content block-content-sm block-content-full bg-body">
                  <span class="text-uppercase fs-sm fw-bold">Online</span>
                </div>
                <div class="block-content">
                  <ul class="nav-items">
                    <li>
                      <a class="d-flex py-2" href="be_pages_generic_profile.html">
                        <div class="flex-shrink-0 mx-3 overlay-container">
                          <img class="img-avatar img-avatar48" src="assets/media/avatars/avatar8.jpg" alt="">
                          <span class="overlay-item item item-tiny item-circle border border-2 border-white bg-success"></span>
                        </div>
                        <div class="flex-grow-1">
                          <div class="fw-semibold">Alice Moore</div>
                          <div class="fs-sm text-muted">Photographer</div>
                        </div>
                      </a>
                    </li>
                    <li>
                      <a class="d-flex py-2" href="be_pages_generic_profile.html">
                        <div class="flex-shrink-0 mx-3 overlay-container">
                          <img class="img-avatar img-avatar48" src="assets/media/avatars/avatar11.jpg" alt="">
                          <span class="overlay-item item item-tiny item-circle border border-2 border-white bg-success"></span>
                        </div>
                        <div class="flex-grow-1">
                          <div class="fw-semibold">Thomas Riley</div>
                          <div class="fw-normal fs-sm text-muted">Web Designer</div>
                        </div>
                      </a>
                    </li>
                    <li>
                      <a class="d-flex py-2" href="be_pages_generic_profile.html">
                        <div class="flex-shrink-0 mx-3 overlay-container">
                          <img class="img-avatar img-avatar48" src="assets/media/avatars/avatar7.jpg" alt="">
                          <span class="overlay-item item item-tiny item-circle border border-2 border-white bg-success"></span>
                        </div>
                        <div class="flex-grow-1">
                          <div class="fw-semibold">Melissa Rice</div>
                          <div class="fw-normal fs-sm text-muted">Web Developer</div>
                        </div>
                      </a>
                    </li>
                  </ul>
                </div>
                <!-- Online -->

                <!-- Busy -->
                <div class="block-content block-content-sm block-content-full bg-body">
                  <span class="text-uppercase fs-sm fw-bold">Busy</span>
                </div>
                <div class="block-content">
                  <ul class="nav-items">
                    <li>
                      <a class="d-flex py-2" href="be_pages_generic_profile.html">
                        <div class="flex-shrink-0 mx-3 overlay-container">
                          <img class="img-avatar img-avatar48" src="assets/media/avatars/avatar4.jpg" alt="">
                          <span class="overlay-item item item-tiny item-circle border border-2 border-white bg-danger"></span>
                        </div>
                        <div class="flex-grow-1">
                          <div class="fw-semibold">Susan Day</div>
                          <div class="fw-normal fs-sm text-muted">UI Designer</div>
                        </div>
                      </a>
                    </li>
                  </ul>
                </div>
                <!-- END Busy -->

                <!-- Away -->
                <div class="block-content block-content-sm block-content-full bg-body">
                  <span class="text-uppercase fs-sm fw-bold">Away</span>
                </div>
                <div class="block-content">
                  <ul class="nav-items">
                    <li>
                      <a class="d-flex py-2" href="be_pages_generic_profile.html">
                        <div class="flex-shrink-0 mx-3 overlay-container">
                          <img class="img-avatar img-avatar48" src="assets/media/avatars/avatar16.jpg" alt="">
                          <span class="overlay-item item item-tiny item-circle border border-2 border-white bg-warning"></span>
                        </div>
                        <div class="flex-grow-1">
                          <div class="fw-semibold">Jeffrey Shaw</div>
                          <div class="fw-normal fs-sm text-muted">Copywriter</div>
                        </div>
                      </a>
                    </li>
                    <li>
                      <a class="d-flex py-2" href="be_pages_generic_profile.html">
                        <div class="flex-shrink-0 mx-3 overlay-container">
                          <img class="img-avatar img-avatar48" src="assets/media/avatars/avatar7.jpg" alt="">
                          <span class="overlay-item item item-tiny item-circle border border-2 border-white bg-warning"></span>
                        </div>
                        <div class="flex-grow-1">
                          <div class="fw-semibold">Amanda Powell</div>
                          <div class="fw-normal fs-sm text-muted">Writer</div>
                        </div>
                      </a>
                    </li>
                  </ul>
                </div>
                <!-- END Away -->

                <!-- Offline -->
                <div class="block-content block-content-sm block-content-full bg-body">
                  <span class="text-uppercase fs-sm fw-bold">Offline</span>
                </div>
                <div class="block-content">
                  <ul class="nav-items">
                    <li>
                      <a class="d-flex py-2" href="be_pages_generic_profile.html">
                        <div class="flex-shrink-0 mx-3 overlay-container">
                          <img class="img-avatar img-avatar48" src="assets/media/avatars/avatar15.jpg" alt="">
                          <span class="overlay-item item item-tiny item-circle border border-2 border-white bg-muted"></span>
                        </div>
                        <div class="flex-grow-1">
                          <div class="fw-semibold">Carl Wells</div>
                          <div class="fw-normal fs-sm text-muted">Teacher</div>
                        </div>
                      </a>
                    </li>
                    <li>
                      <a class="d-flex py-2" href="be_pages_generic_profile.html">
                        <div class="flex-shrink-0 mx-3 overlay-container">
                          <img class="img-avatar img-avatar48" src="assets/media/avatars/avatar5.jpg" alt="">
                          <span class="overlay-item item item-tiny item-circle border border-2 border-white bg-muted"></span>
                        </div>
                        <div class="flex-grow-1">
                          <div class="fw-semibold">Megan Fuller</div>
                          <div class="fw-normal fs-sm text-muted">Photographer</div>
                        </div>
                      </a>
                    </li>
                    <li>
                      <a class="d-flex py-2" href="be_pages_generic_profile.html">
                        <div class="flex-shrink-0 mx-3 overlay-container">
                          <img class="img-avatar img-avatar48" src="assets/media/avatars/avatar1.jpg" alt="">
                          <span class="overlay-item item item-tiny item-circle border border-2 border-white bg-muted"></span>
                        </div>
                        <div class="flex-grow-1">
                          <div class="fw-semibold">Sara Fields</div>
                          <div class="fw-normal fs-sm text-muted">Front-end Developer</div>
                        </div>
                      </a>
                    </li>
                    <li>
                      <a class="d-flex py-2" href="be_pages_generic_profile.html">
                        <div class="flex-shrink-0 mx-3 overlay-container">
                          <img class="img-avatar img-avatar48" src="assets/media/avatars/avatar11.jpg" alt="">
                          <span class="overlay-item item item-tiny item-circle border border-2 border-white bg-muted"></span>
                        </div>
                        <div class="flex-grow-1">
                          <div class="fw-semibold">Justin Hunt</div>
                          <div class="fw-normal fs-sm text-muted">UX Specialist</div>
                        </div>
                      </a>
                    </li>
                  </ul>
                </div>
                <!-- END Offline -->

                <!-- Add People -->
                <div class="block-content block-content-full border-top">
                  <a class="btn w-100 btn-alt-primary" href="javascript:void(0)">
                    <i class="fa fa-fw fa-plus me-1 opacity-50"></i> Add People
                  </a>
                </div>
                <!-- END Add People -->
              </div>
            </div>
            <!-- END People -->

            <!-- Profile -->
            <div class="tab-pane pull-x fade fade-up" id="so-profile" role="tabpanel" aria-labelledby="so-profile-tab" tabindex="0">
              <form action="be_pages_dashboard.html" method="POST" onsubmit="return false;">
                <div class="block mb-0">
                  <!-- Personal -->
                  <div class="block-content block-content-sm block-content-full bg-body">
                    <span class="text-uppercase fs-sm fw-bold">Personal</span>
                  </div>
                  <div class="block-content block-content-full">
                    <div class="mb-4">
                      <label class="form-label">Username</label>
                      <input type="text" readonly class="form-control" id="so-profile-username-static" value="Admin">
                    </div>
                    <div class="mb-4">
                      <label class="form-label" for="so-profile-name">Name</label>
                      <input type="text" class="form-control" id="so-profile-name" name="so-profile-name" value="George Taylor">
                    </div>
                    <div class="mb-4">
                      <label class="form-label" for="so-profile-email">Email</label>
                      <input type="email" class="form-control" id="so-profile-email" name="so-profile-email" value="g.taylor@example.com">
                    </div>
                  </div>
                  <!-- END Personal -->

                  <!-- Password Update -->
                  <div class="block-content block-content-sm block-content-full bg-body">
                    <span class="text-uppercase fs-sm fw-bold">Password Update</span>
                  </div>
                  <div class="block-content block-content-full">
                    <div class="mb-4">
                      <label class="form-label" for="so-profile-password">Current Password</label>
                      <input type="password" class="form-control" id="so-profile-password" name="so-profile-password">
                    </div>
                    <div class="mb-4">
                      <label class="form-label" for="so-profile-new-password">New Password</label>
                      <input type="password" class="form-control" id="so-profile-new-password" name="so-profile-new-password">
                    </div>
                    <div class="mb-4">
                      <label class="form-label" for="so-profile-new-password-confirm">Confirm New Password</label>
                      <input type="password" class="form-control" id="so-profile-new-password-confirm" name="so-profile-new-password-confirm">
                    </div>
                  </div>
                  <!-- END Password Update -->

                  <!-- Options -->
                  <div class="block-content block-content-sm block-content-full bg-body">
                    <span class="text-uppercase fs-sm fw-bold">Options</span>
                  </div>
                  <div class="block-content">
                    <div class="form-check">
                      <input class="form-check-input" type="checkbox" value="" id="so-settings-status" name="so-settings-status">
                      <label class="form-check-label fw-semibold" for="so-settings-status">Online Status</label>
                    </div>
                    <p class="text-muted fs-sm">
                      Make your online status visible to other users of your app
                    </p>
                    <div class="form-check">
                      <input class="form-check-input" type="checkbox" value="" id="so-settings-notifications" name="so-settings-notifications">
                      <label class="form-check-label fw-semibold" for="so-settings-notifications">Notifications</label>
                    </div>
                    <p class="text-muted fs-sm">
                      Receive desktop notifications regarding your projects and sales
                    </p>
                    <div class="form-check">
                      <input class="form-check-input" type="checkbox" value="" id="so-settings-updates" name="so-settings-updates">
                      <label class="form-check-label fw-semibold" for="so-settings-updates">Auto Updates</label>
                    </div>
                    <p class="text-muted fs-sm">
                      If enabled, we will keep all your applications and servers up to date with the most recent features automatically
                    </p>
                  </div>
                  <!-- END Options -->

                  <!-- Submit -->
                  <div class="block-content block-content-full border-top">
                    <button type="submit" class="btn w-100 btn-alt-primary">
                      <i class="fa fa-fw fa-save me-1 opacity-50"></i> Save
                    </button>
                  </div>
                  <!-- END Submit -->
                </div>
              </form>
            </div>
            <!-- END Profile -->
          </div>
        </div>
        <!-- END Side Overlay Tabs -->
      </div>
      <!-- END Side Content -->
    </aside>
    <!-- END Side Overlay -->




    <!-- Main Container -->
    <main id="main-container">
      <!-- Page Content -->
      <div class="content content-full content-boxed">
        <!-- Hero -->
        <div style="padding-top: 2rem;"  class="rounded border push">

          <div  class="px-4 py-3 bg-body-extra-light d-flex flex-column flex-md-row align-items-center">
            <a class="d-block img-link mt-n5" href="">
              <img class="img-avatar img-avatar128 img-avatar-thumb" src="assets/media/avatars/avatar13.jpg" alt="">
            </a>
            <div class="ms-3 flex-grow-1 text-center text-md-start my-3 my-md-0">
              <h1 class="fs-4 fw-bold mb-1"><?php echo $data["UserProfile"]["AccountDetail"]["Username"] ?></h1>
              <h2 class="fs-sm fw-medium text-muted mb-0">
                Welcome <?php echo $data["UserProfile"]["AccountDetail"]["Username"] ?>
              </h2>
            </div>
            <!-- <div class="space-x-1">
              <a href="be_pages_generic_profile_v2.html" class="btn btn-sm btn-alt-secondary space-x-1">
                <i class="fa fa-arrow-left opacity-50"></i>
                <span>Back to Profile</span>
              </a>
            </div> -->
          </div>
        </div>
        <!-- END Hero -->

        <!-- Edit Account -->
        <div class="block block-bordered block-rounded">
          <ul class="nav nav-tabs nav-tabs-alt" role="tablist">
            <li class="nav-item">
              <button class="nav-link space-x-1 active" id="account-profile-tab" data-bs-toggle="tab" data-bs-target="#account-profile" role="tab" aria-controls="account-profile" aria-selected="true">
                <i class="fa fa-user-circle d-sm-none"></i>
                <span class="d-none d-sm-inline">Profile</span>
              </button>
            </li>
            <li class="nav-item">
              <button class="nav-link space-x-1" id="account-password-tab" data-bs-toggle="tab" data-bs-target="#account-password" role="tab" aria-controls="account-password" aria-selected="false">
                <i class="fa fa-asterisk d-sm-none"></i>
                <span class="d-none d-sm-inline">Password</span>
              </button>
            </li>
            <li class="nav-item">
              <button class="nav-link space-x-1" id="account-connections-tab" data-bs-toggle="tab" data-bs-target="#account-connections" role="tab" aria-controls="account-connections" aria-selected="false">
                <i class="fa fa-share-alt d-sm-none"></i>
                <span class="d-none d-sm-inline">Connections</span>
              </button>
            </li>
            <!-- <li class="nav-item">
              <button class="nav-link space-x-1" id="account-billing-tab" data-bs-toggle="tab" data-bs-target="#account-billing" role="tab" aria-controls="account-billing" aria-selected="false">
                <i class="fa fa-credit-card d-sm-none"></i>
                <span class="d-none d-sm-inline">Billing</span>
              </button>
            </li> -->
          </ul>
          <div class="block-content tab-content">
            <div class="tab-pane active" id="account-profile" role="tabpanel" aria-labelledby="account-profile-tab" tabindex="0">
              <div class="row push p-sm-2 p-lg-4">
                <div class="offset-xl-1 col-xl-4 order-xl-1">
                  <p class="bg-body-light p-4 rounded-3 text-muted fs-sm">
                    Your account’s vital info. Your username will be publicly visible.
                  </p>
                </div>
                <div class="col-xl-6 order-xl-0">
                  <form action="be_pages_generic_profile_v2_edit.html" method="POST" enctype="multipart/form-data" onsubmit="return false;">
                    <div class="mb-4">
                      <label class="form-label" for="dm-profile-edit-username">Username</label>
                      <input type="text" class="form-control" id="dm-profile-edit-username" name="dm-profile-edit-username" placeholder="Enter your username.." value="<?php echo $data["UserProfile"]["AccountDetail"]["Username"]; ?>">
                    </div>
                    <div class="mb-4">
                      <label class="form-label" for="dm-profile-edit-name">Name</label>
                      <input type="text" class="form-control" id="dm-profile-edit-name" name="dm-profile-edit-name" placeholder="Enter your name.." value="<?php echo $data["UserProfile"]["UserDetail"]["FullName"]; ?>">
                    </div>
                    <div class="mb-4">
                      <label class="form-label" for="dm-profile-edit-email">Email Address</label>
                      <input type="email" class="form-control" id="dm-profile-edit-email" name="dm-profile-edit-email" placeholder="Enter your email.." value="<?php echo $data["UserProfile"]["AccountDetail"]["Email"]; ?>">
                    </div>
                    <div class="mb-4">
                      <label class="form-label" for="dm-profile-edit-job-title">Phone Number</label>
                      <input type="text" class="form-control" id="dm-profile-edit-job-title" name="dm-profile-edit-job-title" placeholder="Add your job title.." value="<?php echo $data["UserProfile"]["UserDetail"]["PhoneNumber"]; ?>">
                    </div>
                    <div class="mb-4">
                      <label class="form-label" for="dm-profile-edit-company">Date Of Birth</label>
                      <input type="text" class="form-control" id="dm-profile-edit-company" name="dm-profile-edit-company" value="<?php echo $data["UserProfile"]["UserDetail"]["DateOfBirth"]; ?>" readonly>
                    </div>
                    <div class="mb-4">
                      <label class="form-label" for="dm-profile-edit-company">ID Card</label>
                      <input type="text" class="form-control" id="dm-profile-edit-company" name="dm-profile-edit-company" value="<?php echo $data["UserProfile"]["UserDetail"]["IdentityCard"]; ?>" readonly>
                    </div>
                    <div class="mb-4">
                      <div class="row">
                        <div class="col-auto">
                          <div>
                            <label for="">Male</label>
                            <input type="radio" class="form-check-input" name="sex" value="Male" 
                              <?php if ($data["UserProfile"]["UserDetail"]["Sex"] == 0) echo "checked"; ?> disabled>
                          </div>
                        </div>
                        <div class="col-auto">
                          <div>
                            <label for="">Female</label>
                            <input type="radio" class="form-check-input" name="sex" value="Female" 
                              <?php if ($data["UserProfile"]["UserDetail"]["Sex"] == 1) echo "checked"; ?> disabled>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="mb-4">
                      <label class="form-label">Your Avatar</label>
                      <div class="push">
                        <img class="img-avatar" src="https://res.cloudinary.com/dapudsvwl/image/upload/v1744802442/sdh1er6okrxz39xpr8vp.jpg" alt="">
                      </div>
                      <label class="form-label" for="dm-profile-edit-avatar">Choose a new avatar</label>
                      <input class="form-control" type="file" id="dm-profile-edit-avatar">
                    </div>
                    <button type="submit" class="btn btn-alt-primary">
                      <i class="fa fa-check-circle opacity-50 me-1"></i> Update Profile
                    </button>
                  </form>
                </div>
              </div>
            </div>
            <div class="tab-pane" id="account-password" role="tabpanel" aria-labelledby="account-password-tab" tabindex="0">
              <div class="row push p-sm-2 p-lg-4">
                <div class="offset-xl-1 col-xl-4 order-xl-1">
                  <p class="bg-body-light p-4 rounded-3 text-muted fs-sm">
                    Changing your sign in password is an easy way to keep your account secure.
                  </p>
                </div>
                <div class="col-xl-6 order-xl-0">
                  <form action="be_pages_generic_profile_v2_edit.html" method="POST" onsubmit="return false;">
                    <div class="mb-4">
                      <label class="form-label" for="dm-profile-edit-password">Current Password</label>
                      <input type="password" class="form-control" id="dm-profile-edit-password" name="dm-profile-edit-password">
                    </div>
                    <div class="row mb-4">
                      <div class="col-12">
                        <label class="form-label" for="dm-profile-edit-password-new">New Password</label>
                        <input type="password" class="form-control" id="dm-profile-edit-password-new" name="dm-profile-edit-password-new">
                      </div>
                    </div>
                    <div class="row mb-4">
                      <div class="col-12">
                        <label class="form-label" for="dm-profile-edit-password-new-confirm">Confirm New Password</label>
                        <input type="password" class="form-control" id="dm-profile-edit-password-new-confirm" name="dm-profile-edit-password-new-confirm">
                      </div>
                    </div>
                    <button type="submit" class="btn btn-alt-primary">
                      <i class="fa fa-check-circle opacity-50 me-1"></i> Update Password
                    </button>
                  </form>
                </div>
              </div>
            </div>
            <div class="tab-pane" id="account-connections" role="tabpanel" aria-labelledby="account-connections-tab" tabindex="0">
              <div class="row push p-sm-2 p-lg-4">
                <div class="offset-xl-1 col-xl-4 order-xl-1">
                  <p class="bg-body-light p-4 rounded-3 text-muted fs-sm">
                    You can connect your account to third party networks to get extra features.
                  </p>
                </div>
                <div class="col-xl-6 order-xl-0">
                  <form action="be_pages_generic_profile_v2_edit.html" method="POST" onsubmit="return false;">
                    <div class="row mb-4">
                      <div class="col-sm-10 col-lg-8">
                        <a class="btn w-100 btn-alt-danger text-start" href="javascript:void(0)">
                          <i class="fab fa-fw fa-google opacity-50 me-1"></i> Connect to Google
                        </a>
                      </div>
                    </div>
                    <div class="row mb-4">
                      <div class="col-sm-10 col-lg-8">
                        <a class="btn w-100 btn-alt-info text-start" href="javascript:void(0)">
                          <i class="fab fa-fw fa-twitter opacity-50 me-1"></i> Connect to Twitter
                        </a>
                      </div>
                    </div>
                    <div class="row mb-4">
                      <div class="col-sm-10 col-lg-8">
                        <a class="btn w-100 btn-alt-primary bg-white d-flex align-items-center justify-content-between" href="javascript:void(0)">
                          <span>
                            <i class="fab fa-fw fa-facebook me-1"></i> John Doe
                          </span>
                          <i class="fa fa-fw fa-check me-1"></i>
                        </a>
                      </div>
                      <div class="mt-2">
                        <a class="btn btn-sm btn-alt-secondary rounded-pill" href="javascript:void(0)">
                          <i class="fa fa-fw fa-pencil-alt opacity-50 me-1"></i> Edit Facebook Connection
                        </a>
                      </div>
                    </div>
                    <div class="row mb-4">
                      <div class="col-sm-10 col-lg-8">
                        <a class="btn w-100 btn-alt-warning bg-white d-flex align-items-center justify-content-between" href="javascript:void(0)">
                          <span>
                            <i class="fab fa-fw fa-instagram me-1"></i> @john_doe
                          </span>
                          <i class="fa fa-fw fa-check me-1"></i>
                        </a>
                      </div>
                      <div class="mt-2">
                        <a class="btn btn-sm btn-alt-secondary rounded-pill" href="javascript:void(0)">
                          <i class="fa fa-fw fa-pencil-alt opacity-50 me-1"></i> Edit Instagram Connection
                        </a>
                      </div>
                    </div>
                    <button type="submit" class="btn btn-alt-primary">
                      <i class="fa fa-check-circle opacity-50 me-1"></i> Update Connections
                    </button>
                  </form>
                </div>
              </div>
            </div>
            <div class="tab-pane" id="account-billing" role="tabpanel" aria-labelledby="account-billing-tab" tabindex="0">
              <div class="row push p-sm-2 p-lg-4">
                <div class="offset-xl-1 col-xl-4 order-xl-1">
                  <p class="bg-body-light p-4 rounded-3 text-muted fs-sm">
                    Your billing information is never shown to other users and only used for creating your invoices.
                  </p>
                </div>
                <div class="col-xl-6 order-xl-0">
                  <form action="be_pages_generic_profile_v2_edit.html" method="POST" onsubmit="return false;">
                    <!-- <div class="mb-4">
                      <label class="form-label" for="dm-profile-edit-company-name">Total Amount</label>
                      <input type="text" class="form-control" id="dm-profile-edit-company-name" name="dm-profile-edit-company-name"
                      value="<?php echo $data["UserProfile"]["UserDetail"]["TotalAmount"] ?>"
                      >
                    </div>
                    <div class="row mb-4">
                      <div class="col-6">
                        <label class="form-label" for="dm-profile-edit-firstname">Total Ordered</label>
                        <input type="text" class="form-control" id="dm-profile-edit-firstname" name="dm-profile-edit-firstname"
                        value="<?php echo $data["UserProfile"]["UserDetail"]["TotalOrdered"] ?>"
                        >
                      </div>
                      <div class="col-6">
                        <label class="form-label" for="dm-profile-edit-lastname">Total Fine</label>
                        <input type="text" class="form-control" id="dm-profile-edit-lastname" name="dm-profile-edit-lastname"
                        value="<?php echo $data["UserProfile"]["UserDetail"]["TotalFine"] ?>"
                        >
                      </div>
                    </div> -->
                    <!-- <div class="mb-4">
                      <label class="form-label" for="dm-profile-edit-street-1">Street Address 1</label>
                      <input type="text" class="form-control" id="dm-profile-edit-street-1" name="dm-profile-edit-street-1">
                    </div>
                    <div class="mb-4">
                      <label class="form-label" for="dm-profile-edit-street-2">Street Address 2</label>
                      <input type="text" class="form-control" id="dm-profile-edit-street-2" name="dm-profile-edit-street-2">
                    </div>
                    <div class="mb-4">
                      <label class="form-label" for="dm-profile-edit-city">City</label>
                      <input type="text" class="form-control" id="dm-profile-edit-city" name="dm-profile-edit-city">
                    </div>
                    <div class="mb-4">
                      <label class="form-label" for="dm-profile-edit-postal">Postal code</label>
                      <input type="text" class="form-control" id="dm-profile-edit-postal" name="dm-profile-edit-postal">
                    </div>
                    <div class="mb-4">
                      <label class="form-label" for="dm-profile-edit-vat">VAT Number</label>
                      <input type="text" class="form-control" id="dm-profile-edit-vat" name="dm-profile-edit-vat" value="EA00000000" disabled>
                    </div>
                    <button type="submit" class="btn btn-alt-primary">
                      <i class="fa fa-check-circle opacity-50 me-1"></i> Update Billing
                    </button> -->
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- END Edit Account -->
      </div>
      <!-- END Page Content -->
    </main>
    <!-- END Main Container -->

    <!-- Footer -->
    <!-- END Footer -->
  </div>
  <!-- END Page Container -->

  <!--
    Dashmix JS

    Core libraries and functionality
    webpack is putting everything together at assets/_js/main/app.js
  -->
  <script src="assets/js/dashmix.app.min.js"></script>
</body>