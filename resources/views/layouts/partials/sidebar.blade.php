<aside class="left-sidebar mt-1">
    <!-- Sidebar scroll-->
    <div class="scroll-sidebar">
        <!-- User profile -->
        <div
            class="user-profile position-relative"
            style="
              background: url({{ asset('src/assets/images/background/user-info.jpg') }})
                no-repeat;
            "
        >
            <!-- User profile image -->
            <div class="profile-img">
                <img
                    src="{{ asset('src/assets/images/users/profile.png') }}"
                    alt="user"
                    class="w-100"
                />
            </div>
            <!-- User profile text-->
            <div class="profile-text pt-1 dropdown">
                <a
                    href="#"
                    class="
                  w-100
                  text-white
                  d-block
                  position-relative
                "
                    id="dropdownMenuLink"
                >{{ Session::get('username') }}</a
                >
            </div>
        </div>
        <!-- End User profile text-->
        <!-- Sidebar navigation-->
        <nav class="sidebar-nav">
            <ul id="sidebarnav">
                <li class="nav-small-cap">
                    <i class="mdi mdi-dots-horizontal"></i>
                    <span class="hide-menu">Menu</span>
                </li>
                @if( Session::get('role') != env('ROLE_ADMIN'))

                    <li class="sidebar-item">
                        <a
                            class="sidebar-link waves-effect waves-dark sidebar-link"
                            href="{{ route('home') }}"
                            aria-expanded="false"
                        >
                            <i class="mdi mdi-gauge"></i>
                            <span class="hide-menu">Accueil </span>
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a
                            class="sidebar-link waves-effect waves-dark sidebar-link"
                            href="{{ route('getOffers') }}"
                            aria-expanded="false"
                        ><i class="mdi mdi-calendar"></i
                            ><span class="hide-menu">Offre de
                                @if(Session::get('role') == env('ROLE_CARRIER'))
                                    frets
                                @elseif(Session::get('role') == env('ROLE_SHIPPER'))
                                    transports
                                @endif
                            </span></a
                        >
                    </li>
                    <li class="sidebar-item">
                        <a
                            class="sidebar-link has-arrow waves-effect waves-dark"
                            href="javascript:void(0)"
                            aria-expanded="false"
                        ><i class="mdi mdi-inbox-arrow-down"></i
                            ><span class="hide-menu">Mes offres de
                                @if(Session::get('role') == env('ROLE_CARRIER'))
                                    transports
                                @elseif(Session::get('role') == env('ROLE_SHIPPER'))
                                    frets
                                @endif
                            </span></a
                        >
                        <ul aria-expanded="false" class="collapse first-level">
                            <li class="sidebar-item">
                                <a href="{{ route('getOffersReceived') }}" class="sidebar-link"
                                ><i class="mdi mdi-email"></i
                                    ><span class="hide-menu"> Reçu </span></a
                                >
                            </li>
                            <li class="sidebar-item">
                                <a href="{{ route('getOffersNotReceived') }}" class="sidebar-link"
                                ><i class="mdi mdi-email-alert"></i
                                    ><span class="hide-menu"> Non reçu</span></a
                                >
                            </li>
                        </ul>
                    </li>
                    <li class="sidebar-item">
                        <a
                            class="sidebar-link waves-effect waves-dark sidebar-link"
                            href="{{ route('getOffersApply') }}"
                            aria-expanded="false"
                        ><i class="mdi mdi-comment-processing-outline"></i
                            ><span class="hide-menu">
                                Mes offres de
                                @if(Session::get('role') == env('ROLE_CARRIER'))
                                    frets
                                @elseif(Session::get('role') == env('ROLE_SHIPPER'))
                                    transports
                                @endif
                            </span></a
                        >
                    </li>
                    <li class="sidebar-item">
                        <a
                            class="sidebar-link waves-effect waves-dark sidebar-link"
                            href="app-contacts.html"
                            aria-expanded="false"
                        ><i class="mdi mdi-account-box"></i
                            ><span class="hide-menu">Contrat</span></a
                        >
                    </li>
                    <li class="sidebar-item">
                        <a
                            class="sidebar-link has-arrow waves-effect waves-dark"
                            href="javascript:void(0)"
                            aria-expanded="false"
                        ><i class="mdi mdi-inbox-arrow-down"></i
                            ><span class="hide-menu">Utilisateur</span></a
                        >
                        <ul aria-expanded="false" class="collapse first-level">
                            <li class="sidebar-item">
                                <a href="{{ route('getUsersValide') }}" class="sidebar-link"
                                ><i class="mdi mdi-email"></i
                                    ><span class="hide-menu"> Validé </span></a
                                >
                            </li>
                            <li class="sidebar-item">
                                <a href="inbox-email-detail.html" class="sidebar-link"
                                ><i class="mdi mdi-email-alert"></i
                                    ><span class="hide-menu"> En attente </span></a
                                >
                            </li>
                            <li class="sidebar-item">
                                <a href="inbox-email-compose.html" class="sidebar-link"
                                ><i class="mdi mdi-email-secure"></i
                                    ><span class="hide-menu"> Email Compose </span></a
                                >
                            </li>
                        </ul>
                    </li>
                @else
                    <li class="sidebar-item">
                        <a
                            class="sidebar-link waves-effect waves-dark sidebar-link"
                            href=""
                            aria-expanded="false"
                        >
                            <i class="mdi mdi-gauge"></i>
                            <span class="hide-menu">Accueil </span>
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a
                            class="sidebar-link waves-effect waves-dark sidebar-link"
                            href="app-calendar.html"
                            aria-expanded="false"
                        ><i class="mdi mdi-calendar"></i
                            ><span class="hide-menu">Offre de transport</span></a
                        >
                    </li>
                    <li class="sidebar-item">
                        <a
                            class="sidebar-link has-arrow waves-effect waves-dark"
                            href="javascript:void(0)"
                            aria-expanded="false"
                        ><i class="mdi mdi-inbox-arrow-down"></i
                            ><span class="hide-menu">Mes offres de fret</span></a
                        >
                        <ul aria-expanded="false" class="collapse first-level">
                            <li class="sidebar-item">
                                <a href="inbox-email.html" class="sidebar-link"
                                ><i class="mdi mdi-email"></i
                                    ><span class="hide-menu"> Email </span></a
                                >
                            </li>
                            <li class="sidebar-item">
                                <a href="inbox-email-detail.html" class="sidebar-link"
                                ><i class="mdi mdi-email-alert"></i
                                    ><span class="hide-menu"> Email Detail </span></a
                                >
                            </li>
                            <li class="sidebar-item">
                                <a href="inbox-email-compose.html" class="sidebar-link"
                                ><i class="mdi mdi-email-secure"></i
                                    ><span class="hide-menu"> Email Compose </span></a
                                >
                            </li>
                        </ul>
                    </li>
                    <li class="sidebar-item">
                        <a
                            class="sidebar-link waves-effect waves-dark sidebar-link"
                            href="app-chats.html"
                            aria-expanded="false"
                        ><i class="mdi mdi-comment-processing-outline"></i
                            ><span class="hide-menu">Mes offres de transports</span></a
                        >
                    </li>
                    <li class="sidebar-item">
                        <a
                            class="sidebar-link waves-effect waves-dark sidebar-link"
                            href="app-contacts.html"
                            aria-expanded="false"
                        ><i class="mdi mdi-account-box"></i
                            ><span class="hide-menu">Contrat</span></a
                        >
                    </li>
                @endif
            </ul>
        </nav>
        <!-- End Sidebar navigation -->
    </div>
    <!-- End Sidebar scroll-->
    <!-- Bottom points-->
    <div class="sidebar-footer">
        <!-- item-->
        <a
            href=""
            class="link"
            data-bs-toggle="tooltip"
            data-bs-placement="top"
            title="Settings"
        ><i class="ti-settings"></i
            ></a>
        <!-- item-->
        <a
            href=""
            class="link"
            data-bs-toggle="tooltip"
            data-bs-placement="top"
            title="Logout"
        ><i class="mdi mdi-power"></i
            ></a>
    </div>
    <!-- End Bottom points-->
</aside>
