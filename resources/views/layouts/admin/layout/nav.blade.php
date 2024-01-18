<header class="topbar">
    <nav class="navbar top-navbar navbar-expand-md navbar-dark">
        <div class="navbar-header">
            <!-- This is for the sidebar toggle which is visible on mobile only -->
            <a
                class="nav-toggler waves-effect waves-light d-block d-md-none"
                href="javascript:void(0)"
            ><i class="ti-menu ti-close"></i
                ></a>
            <!-- ============================================================== -->
            <!-- Logo -->
            <!-- ============================================================== -->
            <a class="navbar-brand" href="">
                <!-- Logo icon -->
                <b class="logo-icon">
                    <!--You can put here icon as well // <i class="wi wi-sunset"></i> //-->
                    <!-- Dark Logo icon -->
                    <img
                        src="{{ asset('src/assets/images/logo-icon.png') }}"
                        alt="homepage"
                        class="dark-logo"
                    />
                    <!-- Light Logo icon -->
                    <img
                        src="{{ asset('src/assets/images/logo-light-icon.png') }}"
                        alt="homepage"
                        class="light-logo"
                    />
                </b>
                <!--End Logo icon -->
                <!-- Logo text -->
                <span class="logo-text">
                <!-- dark Logo text -->
                <img
                    src="{{ asset('src/assets/images/logo-text.png') }}"
                    alt="homepage"
                    class="dark-logo"
                />
                    <!-- Light Logo text -->
                <img
                    src="{{ asset('src/assets/images/logo-light-text.png') }}"
                    class="light-logo"
                    alt="homepage"
                />
              </span>
            </a>
            <!-- ============================================================== -->
            <!-- End Logo -->
            <!-- ============================================================== -->
            <!-- ============================================================== -->
            <!-- Toggle which is visible on mobile only -->
            <!-- ============================================================== -->
            <a
                class="topbartoggler d-block d-md-none waves-effect waves-light"
                href="javascript:void(0)"
                data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent"
                aria-expanded="false"
                aria-label="Toggle navigation"
            ><i class="ti-more"></i
                ></a>
        </div>
        <!-- ============================================================== -->
        <!-- End Logo -->
        <!-- ============================================================== -->
        <div class="navbar-collapse collapse" id="navbarSupportedContent">
            <!-- ============================================================== -->
            <!-- toggle and nav items -->
            <!-- ============================================================== -->
            <ul class="navbar-nav me-auto">
                <!-- This is  -->
                <li class="nav-item">
                    <a
                        class="
                    nav-link
                    sidebartoggler
                    d-none d-md-block
                    waves-effect waves-dark
                  "
                        href="javascript:void(0)"
                    ><i class="ti-menu"></i
                        ></a>
                </li>
                <!-- ============================================================== -->
                <!-- Search -->
                <!-- ============================================================== -->
{{--                <li class="nav-item d-none d-md-block search-box">--}}
{{--                    <a--}}
{{--                        class="nav-link d-none d-md-block waves-effect waves-dark"--}}
{{--                        href="javascript:void(0)"--}}
{{--                    ><i class="ti-search"></i--}}
{{--                        ></a>--}}
{{--                    <form class="app-search">--}}
{{--                        <input--}}
{{--                            type="text"--}}
{{--                            class="form-control"--}}
{{--                            placeholder="Search & enter"--}}
{{--                        />--}}
{{--                        <a class="srh-btn"><i class="ti-close"></i></a>--}}
{{--                    </form>--}}
{{--                </li>--}}
                <!-- ============================================================== -->
                <!-- Mega Menu -->
                <!-- ============================================================== -->
{{--                <li class="nav-item dropdown mega-dropdown">--}}
{{--                    <a--}}
{{--                        class="nav-link dropdown-toggle waves-effect waves-dark"--}}
{{--                        href="#"--}}
{{--                        data-bs-toggle="dropdown"--}}
{{--                        aria-haspopup="true"--}}
{{--                        aria-expanded="false"--}}
{{--                    ><i class="mdi mdi-view-grid"></i--}}
{{--                        ></a>--}}
{{--                    <div class="dropdown-menu dropdown-menu-animate-up">--}}
{{--                        <div class="mega-dropdown-menu row">--}}
{{--                            <div class="col-lg-3 col-xl-2 mb-4">--}}
{{--                                <h4 class="mb-3">CAROUSEL</h4>--}}
{{--                                <!-- CAROUSEL -->--}}
{{--                                <div--}}
{{--                                    id="carouselExampleControls"--}}
{{--                                    class="carousel slide carousel-dark"--}}
{{--                                    data-bs-ride="carousel"--}}
{{--                                >--}}
{{--                                    <div class="carousel-inner">--}}
{{--                                        <div class="carousel-item active">--}}
{{--                                            <img--}}
{{--                                                class="d-block img-fluid"--}}
{{--                                                src="../../assets/images/big/img1.jpg"--}}
{{--                                                alt="First slide"--}}
{{--                                            />--}}
{{--                                        </div>--}}
{{--                                        <div class="carousel-item">--}}
{{--                                            <img--}}
{{--                                                class="d-block img-fluid"--}}
{{--                                                src="../../assets/images/big/img2.jpg"--}}
{{--                                                alt="Second slide"--}}
{{--                                            />--}}
{{--                                        </div>--}}
{{--                                        <div class="carousel-item">--}}
{{--                                            <img--}}
{{--                                                class="d-block img-fluid"--}}
{{--                                                src="../../assets/images/big/img3.jpg"--}}
{{--                                                alt="Third slide"--}}
{{--                                            />--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                    <a--}}
{{--                                        class="carousel-control-prev"--}}
{{--                                        href="#carouselExampleControls"--}}
{{--                                        role="button"--}}
{{--                                        data-bs-slide="prev"--}}
{{--                                    >--}}
{{--                          <span--}}
{{--                              class="carousel-control-prev-icon"--}}
{{--                              aria-hidden="true"--}}
{{--                          ></span>--}}
{{--                                        <span class="visually-hidden">Previous</span>--}}
{{--                                    </a>--}}
{{--                                    <a--}}
{{--                                        class="carousel-control-next"--}}
{{--                                        href="#carouselExampleControls"--}}
{{--                                        role="button"--}}
{{--                                        data-bs-slide="next"--}}
{{--                                    >--}}
{{--                          <span--}}
{{--                              class="carousel-control-next-icon"--}}
{{--                              aria-hidden="true"--}}
{{--                          ></span>--}}
{{--                                        <span class="visually-hidden">Next</span>--}}
{{--                                    </a>--}}
{{--                                </div>--}}
{{--                                <!-- End CAROUSEL -->--}}
{{--                            </div>--}}
{{--                            <div class="col-lg-3 mb-4">--}}
{{--                                <h4 class="mb-3">ACCORDION</h4>--}}
{{--                                <!-- Accordian -->--}}
{{--                                <div--}}
{{--                                    class="accordion accordion-flush"--}}
{{--                                    id="accordionFlushExample"--}}
{{--                                >--}}
{{--                                    <div class="accordion-item">--}}
{{--                                        <h2 class="accordion-header" id="flush-headingOne">--}}
{{--                                            <button--}}
{{--                                                class="accordion-button collapsed"--}}
{{--                                                type="button"--}}
{{--                                                data-bs-toggle="collapse"--}}
{{--                                                data-bs-target="#flush-collapseOne"--}}
{{--                                                aria-expanded="false"--}}
{{--                                                aria-controls="flush-collapseOne"--}}
{{--                                            >--}}
{{--                                                Accordion Item #1--}}
{{--                                            </button>--}}
{{--                                        </h2>--}}
{{--                                        <div--}}
{{--                                            id="flush-collapseOne"--}}
{{--                                            class="accordion-collapse collapse"--}}
{{--                                            aria-labelledby="flush-headingOne"--}}
{{--                                            data-bs-parent="#accordionFlushExample"--}}
{{--                                        >--}}
{{--                                            <div class="accordion-body">--}}
{{--                                                Anim pariatur cliche reprehenderit, enim eiusmod--}}
{{--                                                high life accusamus terry richardson ad squid.--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                    <div class="accordion-item">--}}
{{--                                        <h2 class="accordion-header" id="flush-headingTwo">--}}
{{--                                            <button--}}
{{--                                                class="accordion-button collapsed"--}}
{{--                                                type="button"--}}
{{--                                                data-bs-toggle="collapse"--}}
{{--                                                data-bs-target="#flush-collapseTwo"--}}
{{--                                                aria-expanded="false"--}}
{{--                                                aria-controls="flush-collapseTwo"--}}
{{--                                            >--}}
{{--                                                Accordion Item #2--}}
{{--                                            </button>--}}
{{--                                        </h2>--}}
{{--                                        <div--}}
{{--                                            id="flush-collapseTwo"--}}
{{--                                            class="accordion-collapse collapse"--}}
{{--                                            aria-labelledby="flush-headingTwo"--}}
{{--                                            data-bs-parent="#accordionFlushExample"--}}
{{--                                        >--}}
{{--                                            <div class="accordion-body">--}}
{{--                                                Anim pariatur cliche reprehenderit, enim eiusmod--}}
{{--                                                high life accusamus terry richardson ad squid.--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                    <div class="accordion-item">--}}
{{--                                        <h2 class="accordion-header" id="flush-headingThree">--}}
{{--                                            <button--}}
{{--                                                class="accordion-button collapsed"--}}
{{--                                                type="button"--}}
{{--                                                data-bs-toggle="collapse"--}}
{{--                                                data-bs-target="#flush-collapseThree"--}}
{{--                                                aria-expanded="false"--}}
{{--                                                aria-controls="flush-collapseThree"--}}
{{--                                            >--}}
{{--                                                Accordion Item #3--}}
{{--                                            </button>--}}
{{--                                        </h2>--}}
{{--                                        <div--}}
{{--                                            id="flush-collapseThree"--}}
{{--                                            class="accordion-collapse collapse"--}}
{{--                                            aria-labelledby="flush-headingThree"--}}
{{--                                            data-bs-parent="#accordionFlushExample"--}}
{{--                                        >--}}
{{--                                            <div class="accordion-body">--}}
{{--                                                Anim pariatur cliche reprehenderit, enim eiusmod--}}
{{--                                                high life accusamus terry richardson ad squid.--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                            <div class="col-lg-3 mb-4">--}}
{{--                                <h4 class="mb-3">CONTACT US</h4>--}}
{{--                                <!-- Contact -->--}}
{{--                                <form>--}}
{{--                                    <div class="mb-3 form-floating">--}}
{{--                                        <input--}}
{{--                                            type="text"--}}
{{--                                            class="form-control"--}}
{{--                                            id="exampleInputname1"--}}
{{--                                            placeholder="Enter Name"--}}
{{--                                        />--}}
{{--                                        <label>Enter Name</label>--}}
{{--                                    </div>--}}
{{--                                    <div class="mb-3 form-floating">--}}
{{--                                        <input--}}
{{--                                            type="email"--}}
{{--                                            class="form-control"--}}
{{--                                            placeholder="Enter email"--}}
{{--                                        />--}}
{{--                                        <label>Enter Email address</label>--}}
{{--                                    </div>--}}
{{--                                    <div class="mb-3 form-floating">--}}
{{--                          <textarea--}}
{{--                              class="form-control"--}}
{{--                              id="exampleTextarea"--}}
{{--                              rows="3"--}}
{{--                              placeholder="Message"--}}
{{--                          ></textarea>--}}
{{--                                        <label>Enter Message</label>--}}
{{--                                    </div>--}}
{{--                                    <button--}}
{{--                                        type="submit"--}}
{{--                                        class="btn px-4 rounded-pill btn-info"--}}
{{--                                    >--}}
{{--                                        Submit--}}
{{--                                    </button>--}}
{{--                                </form>--}}
{{--                            </div>--}}
{{--                            <div class="col-lg-3 col-xlg-4 mb-4">--}}
{{--                                <h4 class="mb-3">List style</h4>--}}
{{--                                <!-- List style -->--}}
{{--                                <ul class="list-style-none">--}}
{{--                                    <li>--}}
{{--                                        <a href="#" class="font-weight-medium"--}}
{{--                                        ><i--}}
{{--                                                data-feather="check-circle"--}}
{{--                                                class="feather-sm text-success me-2"--}}
{{--                                            ></i>--}}
{{--                                            You can give link</a--}}
{{--                                        >--}}
{{--                                    </li>--}}
{{--                                    <li>--}}
{{--                                        <a href="#" class="font-weight-medium"--}}
{{--                                        ><i--}}
{{--                                                data-feather="check-circle"--}}
{{--                                                class="feather-sm text-success me-2"--}}
{{--                                            ></i>--}}
{{--                                            Give link</a--}}
{{--                                        >--}}
{{--                                    </li>--}}
{{--                                    <li>--}}
{{--                                        <a href="#" class="font-weight-medium"--}}
{{--                                        ><i--}}
{{--                                                data-feather="check-circle"--}}
{{--                                                class="feather-sm text-success me-2"--}}
{{--                                            ></i>--}}
{{--                                            Another Give link</a--}}
{{--                                        >--}}
{{--                                    </li>--}}
{{--                                    <li>--}}
{{--                                        <a href="#" class="font-weight-medium"--}}
{{--                                        ><i--}}
{{--                                                data-feather="check-circle"--}}
{{--                                                class="feather-sm text-success me-2"--}}
{{--                                            ></i>--}}
{{--                                            Forth link</a--}}
{{--                                        >--}}
{{--                                    </li>--}}
{{--                                    <li>--}}
{{--                                        <a href="#" class="font-weight-medium"--}}
{{--                                        ><i--}}
{{--                                                data-feather="check-circle"--}}
{{--                                                class="feather-sm text-success me-2"--}}
{{--                                            ></i>--}}
{{--                                            Another fifth link</a--}}
{{--                                        >--}}
{{--                                    </li>--}}
{{--                                </ul>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </li>--}}
                <!-- ============================================================== -->
                <!-- End Mega Menu -->
                <!-- ============================================================== -->
            </ul>
            <!-- ============================================================== -->
            <!-- Right side toggle and nav items -->
            <!-- ============================================================== -->
            <ul class="navbar-nav">
                <!-- ============================================================== -->
                <!-- Comment -->
                <!-- ============================================================== -->
{{--                <li class="nav-item dropdown">--}}
{{--                    <a--}}
{{--                        class="nav-link dropdown-toggle waves-effect waves-dark"--}}
{{--                        href="#"--}}
{{--                        data-bs-toggle="dropdown"--}}
{{--                        aria-haspopup="true"--}}
{{--                        aria-expanded="false"--}}
{{--                    >--}}
{{--                        <i class="mdi mdi-message"></i>--}}
{{--                        <div class="notify">--}}
{{--                            <span class="heartbit"></span> <span class="point"></span>--}}
{{--                        </div>--}}
{{--                    </a>--}}
{{--                    <div--}}
{{--                        class="--}}
{{--                    dropdown-menu dropdown-menu-end--}}
{{--                    mailbox--}}
{{--                    dropdown-menu-animate-up--}}
{{--                  "--}}
{{--                    >--}}
{{--                        <ul class="list-style-none">--}}
{{--                            <li>--}}
{{--                                <div class="border-bottom rounded-top py-3 px-4">--}}
{{--                                    <div class="mb-0 font-weight-medium fs-4">--}}
{{--                                        Notifications--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </li>--}}
{{--                            <li>--}}
{{--                                <div--}}
{{--                                    class="message-center notifications position-relative"--}}
{{--                                    style="height: 230px"--}}
{{--                                >--}}
{{--                                    <!-- Message -->--}}
{{--                                    <a--}}
{{--                                        href="javascript:void(0)"--}}
{{--                                        class="--}}
{{--                            message-item--}}
{{--                            d-flex--}}
{{--                            align-items-center--}}
{{--                            border-bottom--}}
{{--                            px-3--}}
{{--                            py-2--}}
{{--                          "--}}
{{--                                    >--}}
{{--                          <span--}}
{{--                              class="btn btn-light-danger text-danger btn-circle"--}}
{{--                          >--}}
{{--                            <i--}}
{{--                                data-feather="link"--}}
{{--                                class="feather-sm fill-white"--}}
{{--                            ></i>--}}
{{--                          </span>--}}
{{--                                        <div class="w-75 d-inline-block v-middle ps-3">--}}
{{--                                            <h5 class="message-title mb-0 mt-1 fs-3 fw-bold">--}}
{{--                                                Luanch Admin--}}
{{--                                            </h5>--}}
{{--                                            <span--}}
{{--                                                class="--}}
{{--                                fs-2--}}
{{--                                text-nowrap--}}
{{--                                d-block--}}
{{--                                time--}}
{{--                                text-truncate--}}
{{--                                fw-normal--}}
{{--                                text-muted--}}
{{--                                mt-1--}}
{{--                              "--}}
{{--                                            >Just see the my new admin!</span--}}
{{--                                            >--}}
{{--                                            <span--}}
{{--                                                class="--}}
{{--                                fs-2--}}
{{--                                text-nowrap--}}
{{--                                d-block--}}
{{--                                subtext--}}
{{--                                text-muted--}}
{{--                              "--}}
{{--                                            >9:30 AM</span--}}
{{--                                            >--}}
{{--                                        </div>--}}
{{--                                    </a>--}}
{{--                                    <!-- Message -->--}}
{{--                                    <a--}}
{{--                                        href="javascript:void(0)"--}}
{{--                                        class="--}}
{{--                            message-item--}}
{{--                            d-flex--}}
{{--                            align-items-center--}}
{{--                            border-bottom--}}
{{--                            px-3--}}
{{--                            py-2--}}
{{--                          "--}}
{{--                                    >--}}
{{--                          <span--}}
{{--                              class="--}}
{{--                              btn btn-light-success--}}
{{--                              text-success--}}
{{--                              btn-circle--}}
{{--                            "--}}
{{--                          >--}}
{{--                            <i--}}
{{--                                data-feather="calendar"--}}
{{--                                class="feather-sm fill-white"--}}
{{--                            ></i>--}}
{{--                          </span>--}}
{{--                                        <div class="w-75 d-inline-block v-middle ps-3">--}}
{{--                                            <h5 class="message-title mb-0 mt-1 fs-3 fw-bold">--}}
{{--                                                Event today--}}
{{--                                            </h5>--}}
{{--                                            <span--}}
{{--                                                class="--}}
{{--                                fs-2--}}
{{--                                text-nowrap--}}
{{--                                d-block--}}
{{--                                time--}}
{{--                                text-truncate--}}
{{--                                fw-normal--}}
{{--                                text-muted--}}
{{--                                mt-1--}}
{{--                              "--}}
{{--                                            >Just a reminder that you have event</span--}}
{{--                                            >--}}
{{--                                            <span--}}
{{--                                                class="--}}
{{--                                fs-2--}}
{{--                                text-nowrap--}}
{{--                                d-block--}}
{{--                                subtext--}}
{{--                                text-muted--}}
{{--                              "--}}
{{--                                            >9:10 AM</span--}}
{{--                                            >--}}
{{--                                        </div>--}}
{{--                                    </a>--}}
{{--                                    <!-- Message -->--}}
{{--                                    <a--}}
{{--                                        href="javascript:void(0)"--}}
{{--                                        class="--}}
{{--                            message-item--}}
{{--                            d-flex--}}
{{--                            align-items-center--}}
{{--                            border-bottom--}}
{{--                            px-3--}}
{{--                            py-2--}}
{{--                          "--}}
{{--                                    >--}}
{{--                          <span class="btn btn-light-info text-info btn-circle">--}}
{{--                            <i--}}
{{--                                data-feather="settings"--}}
{{--                                class="feather-sm fill-white"--}}
{{--                            ></i>--}}
{{--                          </span>--}}
{{--                                        <div class="w-75 d-inline-block v-middle ps-3">--}}
{{--                                            <h5 class="message-title mb-0 mt-1 fs-3 fw-bold">--}}
{{--                                                Settings--}}
{{--                                            </h5>--}}
{{--                                            <span--}}
{{--                                                class="--}}
{{--                                fs-2--}}
{{--                                text-nowrap--}}
{{--                                d-block--}}
{{--                                time--}}
{{--                                text-truncate--}}
{{--                                fw-normal--}}
{{--                                text-muted--}}
{{--                                mt-1--}}
{{--                              "--}}
{{--                                            >You can customize this template as you want</span--}}
{{--                                            >--}}
{{--                                            <span--}}
{{--                                                class="--}}
{{--                                fs-2--}}
{{--                                text-nowrap--}}
{{--                                d-block--}}
{{--                                subtext--}}
{{--                                text-muted--}}
{{--                              "--}}
{{--                                            >9:08 AM</span--}}
{{--                                            >--}}
{{--                                        </div>--}}
{{--                                    </a>--}}
{{--                                    <!-- Message -->--}}
{{--                                    <a--}}
{{--                                        href="javascript:void(0)"--}}
{{--                                        class="--}}
{{--                            message-item--}}
{{--                            d-flex--}}
{{--                            align-items-center--}}
{{--                            border-bottom--}}
{{--                            px-3--}}
{{--                            py-2--}}
{{--                          "--}}
{{--                                    >--}}
{{--                          <span--}}
{{--                              class="--}}
{{--                              btn btn-light-primary--}}
{{--                              text-primary--}}
{{--                              btn-circle--}}
{{--                            "--}}
{{--                          >--}}
{{--                            <i--}}
{{--                                data-feather="users"--}}
{{--                                class="feather-sm fill-white"--}}
{{--                            ></i>--}}
{{--                          </span>--}}
{{--                                        <div class="w-75 d-inline-block v-middle ps-3">--}}
{{--                                            <h5 class="message-title mb-0 mt-1 fs-3 fw-bold">--}}
{{--                                                Pavan kumar--}}
{{--                                            </h5>--}}
{{--                                            <span--}}
{{--                                                class="--}}
{{--                                fs-2--}}
{{--                                text-nowrap--}}
{{--                                d-block--}}
{{--                                time--}}
{{--                                text-truncate--}}
{{--                                fw-normal--}}
{{--                                text-muted--}}
{{--                                mt-1--}}
{{--                              "--}}
{{--                                            >Just see the my admin!</span--}}
{{--                                            >--}}
{{--                                            <span--}}
{{--                                                class="--}}
{{--                                fs-2--}}
{{--                                text-nowrap--}}
{{--                                d-block--}}
{{--                                subtext--}}
{{--                                text-muted--}}
{{--                              "--}}
{{--                                            >9:02 AM</span--}}
{{--                                            >--}}
{{--                                        </div>--}}
{{--                                    </a>--}}
{{--                                </div>--}}
{{--                            </li>--}}
{{--                            <li>--}}
{{--                                <a--}}
{{--                                    class="nav-link border-top text-center text-dark pt-3"--}}
{{--                                    href="javascript:void(0);"--}}
{{--                                >--}}
{{--                                    <strong>Check all notifications</strong>--}}
{{--                                    <i class="fa fa-angle-right"></i>--}}
{{--                                </a>--}}
{{--                            </li>--}}
{{--                        </ul>--}}
{{--                    </div>--}}
{{--                </li>--}}
                <!-- ============================================================== -->
                <!-- End Comment -->
                <!-- ============================================================== -->
                <!-- ============================================================== -->
                <!-- Messages -->
                <!-- ============================================================== -->
                <!--li class="nav-item dropdown">
                    <button class="mt-3 btn btn btn-rounded btn-light-info " id="btn-publier-offre" data-bs-toggle="modal" data-bs-target="#publier-offre" >
                        Publier une offre
                    </button>

                </li-->
                <li class="nav-item dropdown">
                    <a
                        class="nav-link dropdown-toggle waves-effect waves-dark"
                        href="#"
                        id="2"
                        data-bs-toggle="dropdown"
                        aria-haspopup="true"
                        aria-expanded="false"
                    >
                        <i class="mdi mdi-email"></i>
                        <div class="notify">
                            <span class="heartbit"></span> <span class="point"></span>
                        </div>
                    </a>
                    <div
                        class="
                    dropdown-menu
                    mailbox
                    dropdown-menu-end dropdown-menu-animate-up
                  "
                        aria-labelledby="2"
                    >
                        <ul class="list-style-none">
                            <li>
                                <div class="border-bottom rounded-top py-3 px-4">
                                    <div class="mb-0 font-weight-medium fs-4">
                                        Vous avez des notifications
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div id="notif"
                                     class="message-center message-body position-relative"
                                     style="height: 230px"
                                >
                                    <!-- Message -->
                                </div>
                            </li>
                            <li>
                                <a
                                    class="nav-link border-top text-center text-dark pt-3"
                                    href="{{ route('displayNotifications') }}"
                                >
                                    <b>Voir toutes les notifications</b> <i class="fa fa-angle-right"></i>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                <!-- ============================================================== -->
                <!-- End Messages -->
                <!-- ============================================================== -->
                <!-- ============================================================== -->
                <!-- Profile -->
                <!-- ============================================================== -->
                <li class="nav-item dropdown">
                    <a
                        class="nav-link dropdown-toggle waves-effect waves-dark"
                        href="#"
                        data-bs-toggle="dropdown"
                        aria-haspopup="true"
                        aria-expanded="false"
                    >
                        <img
                            src="{{ asset('src/assets/images/users/1.jpg') }}"
                            alt="user"
                            width="30"
                            class="profile-pic rounded-circle"
                        />
                    </a>
                    <div
                        class="
                    dropdown-menu dropdown-menu-end
                    user-dd
                    animated
                    flipInY
                  "
                    >
                        <div
                            class="
                      d-flex
                      no-block
                      align-items-center
                      p-3
                      bg-info
                      text-white
                      mb-2
                    "
                        >
                            <div class="">
                                <img
                                    src="{{ asset('src/assets/images/users/1.jpg') }}"
                                    alt="user"
                                    class="rounded-circle"
                                    width="60"
                                />
                            </div>
                            <div class="ms-2">
                                <h4 class="mb-0 text-white">
                                    <p class="mb-0">
                                        @if(Session::has('username'))
                                            <p>{{ Session::get('role') }}</p>
                                            @if(Session::has('email'))
                                                <p>{{ Session::get('email') }}</p>
                                            @endif
                                        @endif
                                    </p>
                                </h4>
                            </div>
                        </div>
                        <a class="dropdown-item" href="{{ route('admin.profile.affichage') }}" style="color: black;"
                        ><i
                                data-feather="user"
                                class="feather-sm text-info me-1 ms-1"
                            ></i>
                              Profile</a
                        >
                        <div class="dropdown-divider"></div>
                        <div class="dropdown-divider"></div>
{{--                        <form action="{{ route('logout') }}" method="GET">--}}
{{--                            @csrf--}}
                            <a class="dropdown-item" href="{{ route('logout') }}"
                            >
                            <button type="submit" style="text-decoration: none; color: black; border: none; background: none;">
                                <i
                                data-feather="log-out"
                                class="feather-sm text-danger me-1 ms-1"
                                ></i>
                                Déconnexion
                            </button>
                        </a>
{{--                        </form>--}}

                    </div>
                </li>
                <!-- ============================================================== -->
                <!-- Language -->
                <!-- ============================================================== -->

            </ul>

        </div>
    </nav>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        $('#logoutBtn').on('click', function(e) {
            e.preventDefault();
            $.ajax({
                url: '{{ route("logout") }}',
                type: 'POST',
                data: {
                    "_token": "{{ csrf_token() }}"
                },
                success: function(data) {
                    // Rediriger vers la page de connexion après déconnexion
                    window.location.href = '{{ route("login") }}';
                },
                error: function(error) {
                    console.log(error);
                    // Gérer les erreurs ici
                }
            });
        });
    });
</script>

</header>
