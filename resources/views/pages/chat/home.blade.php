@extends('layouts.app')

@section('content')
        <div class="chat-application">
            <!-- -------------------------------------------------------------- -->
            <!-- Left Part  -->
            <!-- -------------------------------------------------------------- -->
            <div class="left-part bg-white fixed-left-part user-chat-box">
                <!-- Mobile toggle button -->
                <a
                    class="
                ti-menu ti-close
                btn btn-success
                show-left-part
                d-block d-md-none
              "
                    href="javascript:void(0)"
                ></a>
                <!-- Mobile toggle button -->
                <div class="p-3">
                    <h4>Messagerie</h4>
                </div>
                <div class="scrollable position-relative" style="height: 100%">
                    <div class="p-3 border-bottom">
{{--                        <h5 class="card-title">Rechercher un contact</h5>--}}
                        <form>
                            <div class="searchbar">
                                <input
                                    class="form-control"
                                    type="text"
                                    placeholder="Rechercher un contact"
                                />
                            </div>
                        </form>
                    </div>
                    <ul class="mailbox list-style-none app-chat">
                        <li>
                            <div class="message-center chat-scroll chat-users">
                                <a
                                    href="javascript:void(0)"
                                    class="
                                        chat-user
                                        message-item
                                        align-items-center
                                        border-bottom
                                        px-3
                                        ps-2
                                      "
                                    id="chat_user_1"
                                    data-user-id="1"
                                >
                                    <span class="user-img position-relative d-inline-block">
                                        <img
                                            src="src/assets/images/users/1.jpg"
                                            alt="user"
                                            class="rounded-circle w-100"
                                        />
                                        <span
                                            class="
                                            profile-status
                                            online
                                            rounded-circle
                                            pull-right
                                          "
                                        ></span>
                                  </span>
                                    <div class="mail-contnet w-75 d-inline-block v-middle ps-3">
                                        <h5
                                            class="message-title mb-0 mt-1 fs-3 fw-bold"
                                            data-username="Pavan kumar"
                                        >
                                            Pavan kumar
                                        </h5>
                                        <span
                                            class="
                                                fs-2
                                                text-nowrap
                                                d-block
                                                time
                                                text-truncate
                                                fw-normal
                                                text-muted
                                                mt-1
                                              "
                                        >Just see the my admin!</span
                                        >
                                        <span
                                            class="fs-2 text-nowrap d-block subtext text-muted"
                                        >9:30 AM</span
                                        >
                                    </div>
                                </a>
                                <!-- Message -->
                                <a
                                    href="javascript:void(0)"
                                    class="
                        chat-user
                        message-item
                        align-items-center
                        border-bottom
                        px-3
                        ps-2
                      "
                                    id="chat_user_2"
                                    data-user-id="2"
                                >
                      <span class="user-img position-relative d-inline-block">
                        <img
                            src="src/assets/images/users/2.jpg"
                            alt="user"
                            class="rounded-circle w-100"
                        />
                        <span
                            class="profile-status busy rounded-circle pull-right"
                        ></span>
                      </span>
                                    <div
                                        class="mail-contnet w-75 d-inline-block v-middle ps-3"
                                    >
                                        <h5
                                            class="message-title mb-0 mt-1 fs-3 fw-bold"
                                            data-username="Sonu Nigam"
                                        >
                                            Sonu Nigam
                                        </h5>
                                        <span
                                            class="
                            fs-2
                            text-nowrap
                            d-block
                            time
                            text-truncate
                            fw-normal
                            text-muted
                            mt-1
                          "
                                        >I've sung a song! See you at</span
                                        >
                                        <span
                                            class="fs-2 text-nowrap d-block subtext text-muted"
                                        >9:10 AM</span
                                        >
                                    </div>
                                </a>
                                <!-- Message -->
                                <a
                                    href="javascript:void(0)"
                                    class="
                        chat-user
                        message-item
                        align-items-center
                        border-bottom
                        px-3
                        ps-2
                      "
                                    id="chat_user_3"
                                    data-user-id="3"
                                >
                      <span class="user-img position-relative d-inline-block">
                        <img
                            src="src/assets/images/users/3.jpg"
                            alt="user"
                            class="rounded-circle w-100"
                        />
                        <span
                            class="profile-status away rounded-circle pull-right"
                        ></span>
                      </span>
                                    <div
                                        class="mail-contnet w-75 d-inline-block v-middle ps-3"
                                    >
                                        <h5
                                            class="message-title mb-0 mt-1 fs-3 fw-bold"
                                            data-username="Arijit Sinh"
                                        >
                                            Arijit Sinh
                                        </h5>
                                        <span
                                            class="
                            fs-2
                            text-nowrap
                            d-block
                            time
                            text-truncate
                            fw-normal
                            text-muted
                            mt-1
                          "
                                        >I am a singer!</span
                                        >
                                        <span
                                            class="fs-2 text-nowrap d-block subtext text-muted"
                                        >9:08 AM</span
                                        >
                                    </div>
                                </a>
                                <!-- Message -->
                                <a
                                    href="javascript:void(0)"
                                    class="
                        chat-user
                        message-item
                        align-items-center
                        border-bottom
                        px-3
                        ps-2
                      "
                                    id="chat_user_4"
                                    data-user-id="4"
                                >
                      <span class="user-img position-relative d-inline-block">
                        <img
                            src="src/assets/images/users/4.jpg"
                            alt="user"
                            class="rounded-circle w-100"
                        />
                        <span
                            class="
                            profile-status
                            offline
                            rounded-circle
                            pull-right
                          "
                        ></span>
                      </span>
                                    <div
                                        class="mail-contnet w-75 d-inline-block v-middle ps-3"
                                    >
                                        <h5
                                            class="message-title mb-0 mt-1 fs-3 fw-bold"
                                            data-username="Nirav Joshi"
                                        >
                                            Nirav Joshi
                                        </h5>
                                        <span
                                            class="
                            fs-2
                            text-nowrap
                            d-block
                            time
                            text-truncate
                            fw-normal
                            text-muted
                            mt-1
                          "
                                        >Just see the my admin!</span
                                        >
                                        <span
                                            class="fs-2 text-nowrap d-block subtext text-muted"
                                        >9:02 AM</span
                                        >
                                    </div>
                                </a>
                                <!-- Message -->
                                <!-- Message -->
                                <a
                                    href="javascript:void(0)"
                                    class="
                        chat-user
                        message-item
                        align-items-center
                        border-bottom
                        px-3
                        ps-2
                      "
                                    id="chat_user_5"
                                    data-user-id="5"
                                >
                      <span class="user-img position-relative d-inline-block">
                        <img
                            src="src/assets/images/users/5.jpg"
                            alt="user"
                            class="rounded-circle w-100"
                        />
                        <span
                            class="
                            profile-status
                            offline
                            rounded-circle
                            pull-right
                          "
                        ></span>
                      </span>
                                    <div
                                        class="mail-contnet w-75 d-inline-block v-middle ps-3"
                                    >
                                        <h5
                                            class="message-title mb-0 mt-1 fs-3 fw-bold"
                                            data-username="Sunil Joshi"
                                        >
                                            Sunil Joshi
                                        </h5>
                                        <span
                                            class="
                            fs-2
                            text-nowrap
                            d-block
                            time
                            text-truncate
                            fw-normal
                            text-muted
                            mt-1
                          "
                                        >Just see the my admin!</span
                                        >
                                        <span
                                            class="fs-2 text-nowrap d-block subtext text-muted"
                                        >9:02 AM</span
                                        >
                                    </div>
                                </a>
                                <!-- Message -->
                                <!-- Message -->
                                <a
                                    href="javascript:void(0)"
                                    class="
                        chat-user
                        message-item
                        align-items-center
                        border-bottom
                        px-3
                        ps-2
                      "
                                    id="chat_user_6"
                                    data-user-id="6"
                                >
                      <span class="user-img position-relative d-inline-block">
                        <img
                            src="src/assets/images/users/6.jpg"
                            alt="user"
                            class="rounded-circle w-100"
                        />
                        <span
                            class="
                            profile-status
                            offline
                            rounded-circle
                            pull-right
                          "
                        ></span>
                      </span>
                                    <div
                                        class="mail-contnet w-75 d-inline-block v-middle ps-3"
                                    >
                                        <h5
                                            class="message-title mb-0 mt-1 fs-3 fw-bold"
                                            data-username="Akshay Kumar"
                                        >
                                            Akshay Kumar
                                        </h5>
                                        <span
                                            class="
                            fs-2
                            text-nowrap
                            d-block
                            time
                            text-truncate
                            fw-normal
                            text-muted
                            mt-1
                          "
                                        >Just see the my admin!</span
                                        >
                                        <span
                                            class="fs-2 text-nowrap d-block subtext text-muted"
                                        >9:02 AM</span
                                        >
                                    </div>
                                </a>
                                <!-- Message -->
                                <!-- Message -->
                                <a
                                    href="javascript:void(0)"
                                    class="
                        chat-user
                        message-item
                        align-items-center
                        border-bottom
                        px-3
                        ps-2
                      "
                                    id="chat_user_7"
                                    data-user-id="7"
                                >
                      <span class="user-img position-relative d-inline-block">
                        <img
                            src="src/assets/images/users/7.jpg"
                            alt="user"
                            class="rounded-circle w-100"
                        />
                        <span
                            class="
                            profile-status
                            offline
                            rounded-circle
                            pull-right
                          "
                        ></span>
                      </span>
                                    <div
                                        class="mail-contnet w-75 d-inline-block v-middle ps-3"
                                    >
                                        <h5
                                            class="message-title mb-0 mt-1 fs-3 fw-bold"
                                            data-username="Pavan kumar"
                                        >
                                            Pavan kumar
                                        </h5>
                                        <span
                                            class="
                            fs-2
                            text-nowrap
                            d-block
                            time
                            text-truncate
                            fw-normal
                            text-muted
                            mt-1
                          "
                                        >Just see the my admin!</span
                                        >
                                        <span
                                            class="fs-2 text-nowrap d-block subtext text-muted"
                                        >9:02 AM</span
                                        >
                                    </div>
                                </a>
                                <!-- Message -->
                                <!-- Message -->
                                <a
                                    href="javascript:void(0)"
                                    class="
                                    chat-user
                                    message-item
                                    align-items-center
                                    border-bottom
                                    px-3
                                    ps-2
                                  "
                                id="chat_user_8"
                                data-user-id="8"
                                >
                                        <span class="user-img position-relative d-inline-block">
                                            <img
                                                src="src/assets/images/users/8.jpg"
                                                alt="user"
                                                class="rounded-circle w-100"
                                            />
                                            <span
                                                class="
                                                profile-status
                                                offline
                                                rounded-circle
                                                pull-right
                                              "
                                            ></span>
                                        </span>
                                        <div
                                            class="mail-contnet w-75 d-inline-block v-middle ps-3"
                                        >
                                            <h5
                                                class="message-title mb-0 mt-1 fs-3 fw-bold"
                                                data-username="Varun Dhavan"
                                            >
                                                Varun Dhavan
                                            </h5>
                                            <span
                                                class="
                                                fs-2
                                                text-nowrap
                                                d-block
                                                time
                                                text-truncate
                                                fw-normal
                                                text-muted
                                                mt-1
                                              "
                                            >Just see the my admin!</span
                                            >
                                            <span
                                                class="fs-2 text-nowrap d-block subtext text-muted"
                                            >9:02 AM</span
                                            >
                                        </div>
                                </a>


                                <a
                                    href="javascript:void(0)"
                                    class="
                                    chat-user
                                    message-item
                                    align-items-center
                                    border-bottom
                                    px-3
                                    ps-2
                                  "
                                    id="chat_user_8"
                                    data-user-id="8"
                                >
                                        <span class="user-img position-relative d-inline-block">
                                            <img
                                                src="src/assets/images/users/8.jpg"
                                                alt="user"
                                                class="rounded-circle w-100"
                                            />
                                            <span
                                                class="
                                                profile-status
                                                offline
                                                rounded-circle
                                                pull-right
                                              "
                                            ></span>
                                        </span>
                                    <div
                                        class="mail-contnet w-75 d-inline-block v-middle ps-3"
                                    >
                                        <h5
                                            class="message-title mb-0 mt-1 fs-3 fw-bold"
                                            data-username="Varun Dhavan"
                                        >
                                            Varun Dhavan
                                        </h5>
                                        <span
                                            class="
                                                fs-2
                                                text-nowrap
                                                d-block
                                                time
                                                text-truncate
                                                fw-normal
                                                text-muted
                                                mt-1
                                              "
                                        >Just see the my admin!</span
                                        >
                                        <span
                                            class="fs-2 text-nowrap d-block subtext text-muted"
                                        >9:02 AM</span
                                        >
                                    </div>
                                </a>



                                <!-- Message -->
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
            <!-- -------------------------------------------------------------- -->
            <!-- End Left Part  -->
            <!-- -------------------------------------------------------------- -->
            <!-- -------------------------------------------------------------- -->
            <!-- Right Part  Mail Compose -->
            <!-- -------------------------------------------------------------- -->
            <div class="right-part chat-container">
                <div class="chat-box-inner-part">
                    <div class="chat-not-selected">
                        <div class="text-center">
                  <span class="display-5 text-info"
                  ><i data-feather="message-square" class="feather-xl"></i
                      ></span>
                            <h5 class="font-weight-medium">Ouvrir une discusion sur une offre dans la liste</h5>
                        </div>
                    </div>
                    <div class="card chatting-box mb-0">
                        <div class="card-body">
                            <div class="chat-meta-user pb-3 border-bottom">
                                <div class="current-chat-user-name">
                                      <span>
                                            <img
                                                src="src/assets/images/users/1.jpg"
                                                alt="dynamic-image"
                                                class="rounded-circle"
                                                width="45"
                                            />
                                            <span class="name fw-bold ms-2"></span>
                                      </span>
                                </div>
                            </div>
                            <!-- <h4 class="card-title">Chat Messages</h4> -->
                            <div
                                class="chat-box scrollable"
                                style="height: calc(100vh - 300px)"
                            >
                                <!--User 1 -->
                                <ul class="chat-list chat" data-user-id="1">
                                    <!--chat Row -->
                                    <li class="mt-4">
                                        <div class="chat-img d-inline-block align-top">
                                            <img
                                                src="src/assets/images/users/1.jpg"
                                                alt="user"
                                                class="rounded-circle"
                                            />
                                        </div>
                                        <div class="chat-content ps-3 d-inline-block">
                                            <h5 class="text-muted fs-3 font-weight-medium">
                                                James Anderson
                                            </h5>
                                            <div
                                                class="
                                                  box
                                                  mb-2
                                                  d-inline-block
                                                  text-dark
                                                  message
                                                  font-weight-medium
                                                  fs-3
                                                  bg-light-info
                                                "
                                            >
                                                Lorem Ipsum is simply dummy text of the printing &
                                                type setting industry.
                                            </div>
                                        </div>
                                        <div
                                            class="
                                                chat-time
                                                d-inline-block
                                                text-end
                                                fs-2
                                                font-weight-medium
                                              "
                                        >
                                            10:56 am
                                        </div>
                                    </li>
                                    <!--chat Row -->
                                    <li class="mt-4">
                                        <div class="chat-img d-inline-block align-top">
                                            <img
                                                src="src/assets/images/users/2.jpg"
                                                alt="user"
                                                class="rounded-circle"
                                            />
                                        </div>
                                        <div class="chat-content ps-3 d-inline-block">
                                            <h5 class="text-muted fs-3 font-weight-medium">
                                                Bianca Doe
                                            </h5>
                                            <div
                                                class="
                              box
                              mb-2
                              d-inline-block
                              text-dark
                              font-weight-medium
                              message
                              fs-3
                              bg-light-success
                            "
                                            >
                                                It’s Great opportunity to work.
                                            </div>
                                        </div>
                                        <div
                                            class="
                            chat-time
                            d-inline-block
                            text-end
                            fs-2
                            font-weight-medium
                          "
                                        >
                                            10:57 am
                                        </div>
                                    </li>
                                    <!--chat Row -->
                                    <li class="odd mt-4">
                                        <div class="chat-content ps-3 d-inline-block text-end">
                                            <div
                                                class="
                              box
                              mb-2
                              d-inline-block
                              text-dark
                              message
                              font-weight-medium
                              fs-3
                              bg-light-inverse
                            "
                                            >
                                                I would love to join the team.
                                            </div>
                                            <br />
                                        </div>
                                        <div
                                            class="
                            chat-time
                            d-inline-block
                            text-end
                            fs-2
                            font-weight-medium
                          "
                                        >
                                            10:58 am
                                        </div>
                                    </li>
                                    <!--chat Row -->
                                    <li class="odd mt-4">
                                        <div class="chat-content ps-3 d-inline-block text-end">
                                            <div
                                                class="
                              box
                              mb-2
                              d-inline-block
                              text-dark
                              message
                              font-weight-medium
                              fs-3
                              bg-light-inverse
                            "
                                            >
                                                Whats budget of the new project.
                                            </div>
                                            <br />
                                        </div>
                                        <div
                                            class="
                            chat-time
                            d-inline-block
                            text-end
                            fs-2
                            font-weight-medium
                          "
                                        >
                                            10:59 am
                                        </div>
                                    </li>
                                    <!--chat Row -->
                                    <li class="mt-4">
                                        <div class="chat-img d-inline-block align-top">
                                            <img
                                                src="src/assets/images/users/3.jpg"
                                                alt="user"
                                                class="rounded-circle"
                                            />
                                        </div>
                                        <div class="chat-content ps-3 d-inline-block">
                                            <h5 class="text-muted fs-3 font-weight-medium">
                                                Angelina Rhodes
                                            </h5>
                                            <div
                                                class="
                              box
                              mb-2
                              d-inline-block
                              text-dark
                              message
                              font-weight-medium
                              fs-3
                              bg-light-primary
                            "
                                            >
                                                Well we have good budget for the project
                                            </div>
                                        </div>
                                        <div
                                            class="
                            chat-time
                            d-inline-block
                            text-end
                            fs-2
                            font-weight-medium
                          "
                                        >
                                            11:00 am
                                        </div>
                                    </li>
                                    <!--chat Row -->
                                </ul>
                                <!--User 2 -->
                                <ul class="chat-list chat" data-user-id="2">
                                    <!--chat Row -->
                                    <li class="mt-4">
                                        <div class="chat-img d-inline-block align-top">
                                            <img
                                                src="src/assets/images/users/1.jpg"
                                                alt="user"
                                                class="rounded-circle"
                                            />
                                        </div>
                                        <div class="chat-content ps-3 d-inline-block">
                                            <h5 class="text-muted fs-3 font-weight-medium">
                                                James Anderson
                                            </h5>
                                            <div
                                                class="
                              box
                              mb-2
                              d-inline-block
                              text-dark
                              message
                              font-weight-medium
                              fs-3
                              bg-light-info
                            "
                                            >
                                                Lorem Ipsum is simply dummy text of the printing &
                                                type setting industry.
                                            </div>
                                        </div>
                                        <div
                                            class="
                            chat-time
                            d-inline-block
                            text-end
                            fs-2
                            font-weight-medium
                          "
                                        >
                                            10:56 am
                                        </div>
                                    </li>
                                    <!--chat Row -->
                                    <li class="mt-4">
                                        <div class="chat-img d-inline-block align-top">
                                            <img
                                                src="src/assets/images/users/2.jpg"
                                                alt="user"
                                                class="rounded-circle"
                                            />
                                        </div>
                                        <div class="chat-content ps-3 d-inline-block">
                                            <h5 class="text-muted fs-3 font-weight-medium">
                                                Bianca Doe
                                            </h5>
                                            <div
                                                class="
                              box
                              mb-2
                              d-inline-block
                              text-dark
                              font-weight-medium
                              message
                              fs-3
                              bg-light-success
                            "
                                            >
                                                It’s Great opportunity to work.
                                            </div>
                                        </div>
                                        <div
                                            class="
                            chat-time
                            d-inline-block
                            text-end
                            fs-2
                            font-weight-medium
                          "
                                        >
                                            10:57 am
                                        </div>
                                    </li>
                                    <!--chat Row -->
                                    <li class="odd mt-4">
                                        <div class="chat-content ps-3 d-inline-block text-end">
                                            <div
                                                class="
                              box
                              mb-2
                              d-inline-block
                              text-dark
                              message
                              font-weight-medium
                              fs-3
                              bg-light-inverse
                            "
                                            >
                                                I would love to join the team.
                                            </div>
                                            <br />
                                        </div>
                                        <div
                                            class="
                            chat-time
                            d-inline-block
                            text-end
                            fs-2
                            font-weight-medium
                          "
                                        >
                                            10:58 am
                                        </div>
                                    </li>
                                    <!--chat Row -->
                                    <li class="odd mt-4">
                                        <div class="chat-content ps-3 d-inline-block text-end">
                                            <div
                                                class="
                              box
                              mb-2
                              d-inline-block
                              text-dark
                              message
                              font-weight-medium
                              fs-3
                              bg-light-inverse
                            "
                                            >
                                                Whats budget of the new project.
                                            </div>
                                            <br />
                                        </div>
                                        <div
                                            class="
                            chat-time
                            d-inline-block
                            text-end
                            fs-2
                            font-weight-medium
                          "
                                        >
                                            10:59 am
                                        </div>
                                    </li>
                                    <!--chat Row -->
                                    <li class="mt-4">
                                        <div class="chat-img d-inline-block align-top">
                                            <img
                                                src="src/assets/images/users/3.jpg"
                                                alt="user"
                                                class="rounded-circle"
                                            />
                                        </div>
                                        <div class="chat-content ps-3 d-inline-block">
                                            <h5 class="text-muted fs-3 font-weight-medium">
                                                Angelina Rhodes
                                            </h5>
                                            <div
                                                class="
                              box
                              mb-2
                              d-inline-block
                              text-dark
                              message
                              font-weight-medium
                              fs-3
                              bg-light-primary
                            "
                                            >
                                                Well we have good budget for the project
                                            </div>
                                        </div>
                                        <div
                                            class="
                            chat-time
                            d-inline-block
                            text-end
                            fs-2
                            font-weight-medium
                          "
                                        >
                                            11:00 am
                                        </div>
                                    </li>
                                    <!--chat Row -->
                                </ul>
                                <!--User 3 -->
                                <ul class="chat-list chat" data-user-id="3">
                                    <!--chat Row -->
                                    <li class="mt-4">
                                        <div class="chat-img d-inline-block align-top">
                                            <img
                                                src="src/assets/images/users/1.jpg"
                                                alt="user"
                                                class="rounded-circle"
                                            />
                                        </div>
                                        <div class="chat-content ps-3 d-inline-block">
                                            <h5 class="text-muted fs-3 font-weight-medium">
                                                James Anderson
                                            </h5>
                                            <div
                                                class="
                              box
                              mb-2
                              d-inline-block
                              text-dark
                              message
                              font-weight-medium
                              fs-3
                              bg-light-info
                            "
                                            >
                                                Lorem Ipsum is simply dummy text of the printing &
                                                type setting industry.
                                            </div>
                                        </div>
                                        <div
                                            class="
                            chat-time
                            d-inline-block
                            text-end
                            fs-2
                            font-weight-medium
                          "
                                        >
                                            10:56 am
                                        </div>
                                    </li>
                                    <!--chat Row -->
                                    <li class="mt-4">
                                        <div class="chat-img d-inline-block align-top">
                                            <img
                                                src="src/assets/images/users/2.jpg"
                                                alt="user"
                                                class="rounded-circle"
                                            />
                                        </div>
                                        <div class="chat-content ps-3 d-inline-block">
                                            <h5 class="text-muted fs-3 font-weight-medium">
                                                Bianca Doe
                                            </h5>
                                            <div
                                                class="
                              box
                              mb-2
                              d-inline-block
                              text-dark
                              font-weight-medium
                              message
                              fs-3
                              bg-light-success
                            "
                                            >
                                                It’s Great opportunity to work.
                                            </div>
                                        </div>
                                        <div
                                            class="
                            chat-time
                            d-inline-block
                            text-end
                            fs-2
                            font-weight-medium
                          "
                                        >
                                            10:57 am
                                        </div>
                                    </li>
                                    <!--chat Row -->
                                    <li class="odd mt-4">
                                        <div class="chat-content ps-3 d-inline-block text-end">
                                            <div
                                                class="
                              box
                              mb-2
                              d-inline-block
                              text-dark
                              message
                              font-weight-medium
                              fs-3
                              bg-light-inverse
                            "
                                            >
                                                I would love to join the team.
                                            </div>
                                            <br />
                                        </div>
                                        <div
                                            class="
                            chat-time
                            d-inline-block
                            text-end
                            fs-2
                            font-weight-medium
                          "
                                        >
                                            10:58 am
                                        </div>
                                    </li>
                                    <!--chat Row -->
                                    <li class="odd mt-4">
                                        <div class="chat-content ps-3 d-inline-block text-end">
                                            <div
                                                class="
                              box
                              mb-2
                              d-inline-block
                              text-dark
                              message
                              font-weight-medium
                              fs-3
                              bg-light-inverse
                            "
                                            >
                                                Whats budget of the new project.
                                            </div>
                                            <br />
                                        </div>
                                        <div
                                            class="
                            chat-time
                            d-inline-block
                            text-end
                            fs-2
                            font-weight-medium
                          "
                                        >
                                            10:59 am
                                        </div>
                                    </li>
                                    <!--chat Row -->
                                    <li class="mt-4">
                                        <div class="chat-img d-inline-block align-top">
                                            <img
                                                src="src/assets/images/users/3.jpg"
                                                alt="user"
                                                class="rounded-circle"
                                            />
                                        </div>
                                        <div class="chat-content ps-3 d-inline-block">
                                            <h5 class="text-muted fs-3 font-weight-medium">
                                                Angelina Rhodes
                                            </h5>
                                            <div
                                                class="
                              box
                              mb-2
                              d-inline-block
                              text-dark
                              message
                              font-weight-medium
                              fs-3
                              bg-light-primary
                            "
                                            >
                                                Well we have good budget for the project
                                            </div>
                                        </div>
                                        <div
                                            class="
                            chat-time
                            d-inline-block
                            text-end
                            fs-2
                            font-weight-medium
                          "
                                        >
                                            11:00 am
                                        </div>
                                    </li>
                                    <!--chat Row -->
                                </ul>
                                <!--User 4 -->
                                <ul class="chat-list chat" data-user-id="4">
                                    <!--chat Row -->
                                    <li class="mt-4">
                                        <div class="chat-img d-inline-block align-top">
                                            <img
                                                src="src/assets/images/users/1.jpg"
                                                alt="user"
                                                class="rounded-circle"
                                            />
                                        </div>
                                        <div class="chat-content ps-3 d-inline-block">
                                            <h5 class="text-muted fs-3 font-weight-medium">
                                                James Anderson
                                            </h5>
                                            <div
                                                class="
                              box
                              mb-2
                              d-inline-block
                              text-dark
                              message
                              font-weight-medium
                              fs-3
                              bg-light-info
                            "
                                            >
                                                Lorem Ipsum is simply dummy text of the printing &
                                                type setting industry.
                                            </div>
                                        </div>
                                        <div
                                            class="
                            chat-time
                            d-inline-block
                            text-end
                            fs-2
                            font-weight-medium
                          "
                                        >
                                            10:56 am
                                        </div>
                                    </li>
                                    <!--chat Row -->
                                    <li class="mt-4">
                                        <div class="chat-img d-inline-block align-top">
                                            <img
                                                src="src/assets/images/users/2.jpg"
                                                alt="user"
                                                class="rounded-circle"
                                            />
                                        </div>
                                        <div class="chat-content ps-3 d-inline-block">
                                            <h5 class="text-muted fs-3 font-weight-medium">
                                                Bianca Doe
                                            </h5>
                                            <div
                                                class="
                              box
                              mb-2
                              d-inline-block
                              text-dark
                              font-weight-medium
                              message
                              fs-3
                              bg-light-success
                            "
                                            >
                                                It’s Great opportunity to work.
                                            </div>
                                        </div>
                                        <div
                                            class="
                            chat-time
                            d-inline-block
                            text-end
                            fs-2
                            font-weight-medium
                          "
                                        >
                                            10:57 am
                                        </div>
                                    </li>
                                    <!--chat Row -->
                                    <li class="odd mt-4">
                                        <div class="chat-content ps-3 d-inline-block text-end">
                                            <div
                                                class="
                              box
                              mb-2
                              d-inline-block
                              text-dark
                              message
                              font-weight-medium
                              fs-3
                              bg-light-inverse
                            "
                                            >
                                                I would love to join the team.
                                            </div>
                                            <br />
                                        </div>
                                        <div
                                            class="
                            chat-time
                            d-inline-block
                            text-end
                            fs-2
                            font-weight-medium
                          "
                                        >
                                            10:58 am
                                        </div>
                                    </li>
                                    <!--chat Row -->
                                    <li class="odd mt-4">
                                        <div class="chat-content ps-3 d-inline-block text-end">
                                            <div
                                                class="
                              box
                              mb-2
                              d-inline-block
                              text-dark
                              message
                              font-weight-medium
                              fs-3
                              bg-light-inverse
                            "
                                            >
                                                Whats budget of the new project.
                                            </div>
                                            <br />
                                        </div>
                                        <div
                                            class="
                            chat-time
                            d-inline-block
                            text-end
                            fs-2
                            font-weight-medium
                          "
                                        >
                                            10:59 am
                                        </div>
                                    </li>
                                    <!--chat Row -->
                                    <li class="mt-4">
                                        <div class="chat-img d-inline-block align-top">
                                            <img
                                                src="src/assets/images/users/3.jpg"
                                                alt="user"
                                                class="rounded-circle"
                                            />
                                        </div>
                                        <div class="chat-content ps-3 d-inline-block">
                                            <h5 class="text-muted fs-3 font-weight-medium">
                                                Angelina Rhodes
                                            </h5>
                                            <div
                                                class="
                              box
                              mb-2
                              d-inline-block
                              text-dark
                              message
                              font-weight-medium
                              fs-3
                              bg-light-primary
                            "
                                            >
                                                Well we have good budget for the project
                                            </div>
                                        </div>
                                        <div
                                            class="
                            chat-time
                            d-inline-block
                            text-end
                            fs-2
                            font-weight-medium
                          "
                                        >
                                            11:00 am
                                        </div>
                                    </li>
                                    <!--chat Row -->
                                </ul>
                                <!--User 5 -->
                                <ul class="chat-list chat" data-user-id="5">
                                    <!--chat Row -->
                                    <li class="mt-4">
                                        <div class="chat-img d-inline-block align-top">
                                            <img
                                                src="src/assets/images/users/1.jpg"
                                                alt="user"
                                                class="rounded-circle"
                                            />
                                        </div>
                                        <div class="chat-content ps-3 d-inline-block">
                                            <h5 class="text-muted fs-3 font-weight-medium">
                                                James Anderson
                                            </h5>
                                            <div
                                                class="
                              box
                              mb-2
                              d-inline-block
                              text-dark
                              message
                              font-weight-medium
                              fs-3
                              bg-light-info
                            "
                                            >
                                                Lorem Ipsum is simply dummy text of the printing &
                                                type setting industry.
                                            </div>
                                        </div>
                                        <div
                                            class="
                            chat-time
                            d-inline-block
                            text-end
                            fs-2
                            font-weight-medium
                          "
                                        >
                                            10:56 am
                                        </div>
                                    </li>
                                    <!--chat Row -->
                                    <li class="mt-4">
                                        <div class="chat-img d-inline-block align-top">
                                            <img
                                                src="src/assets/images/users/2.jpg"
                                                alt="user"
                                                class="rounded-circle"
                                            />
                                        </div>
                                        <div class="chat-content ps-3 d-inline-block">
                                            <h5 class="text-muted fs-3 font-weight-medium">
                                                Bianca Doe
                                            </h5>
                                            <div
                                                class="
                              box
                              mb-2
                              d-inline-block
                              text-dark
                              font-weight-medium
                              message
                              fs-3
                              bg-light-success
                            "
                                            >
                                                It’s Great opportunity to work.
                                            </div>
                                        </div>
                                        <div
                                            class="
                            chat-time
                            d-inline-block
                            text-end
                            fs-2
                            font-weight-medium
                          "
                                        >
                                            10:57 am
                                        </div>
                                    </li>
                                    <!--chat Row -->
                                    <li class="odd mt-4">
                                        <div class="chat-content ps-3 d-inline-block text-end">
                                            <div
                                                class="
                              box
                              mb-2
                              d-inline-block
                              text-dark
                              message
                              font-weight-medium
                              fs-3
                              bg-light-inverse
                            "
                                            >
                                                I would love to join the team.
                                            </div>
                                            <br />
                                        </div>
                                        <div
                                            class="
                            chat-time
                            d-inline-block
                            text-end
                            fs-2
                            font-weight-medium
                          "
                                        >
                                            10:58 am
                                        </div>
                                    </li>
                                    <!--chat Row -->
                                    <li class="odd mt-4">
                                        <div class="chat-content ps-3 d-inline-block text-end">
                                            <div
                                                class="
                              box
                              mb-2
                              d-inline-block
                              text-dark
                              message
                              font-weight-medium
                              fs-3
                              bg-light-inverse
                            "
                                            >
                                                Whats budget of the new project.
                                            </div>
                                            <br />
                                        </div>
                                        <div
                                            class="
                            chat-time
                            d-inline-block
                            text-end
                            fs-2
                            font-weight-medium
                          "
                                        >
                                            10:59 am
                                        </div>
                                    </li>
                                    <!--chat Row -->
                                    <li class="mt-4">
                                        <div class="chat-img d-inline-block align-top">
                                            <img
                                                src="src/assets/images/users/3.jpg"
                                                alt="user"
                                                class="rounded-circle"
                                            />
                                        </div>
                                        <div class="chat-content ps-3 d-inline-block">
                                            <h5 class="text-muted fs-3 font-weight-medium">
                                                Angelina Rhodes
                                            </h5>
                                            <div
                                                class="
                              box
                              mb-2
                              d-inline-block
                              text-dark
                              message
                              font-weight-medium
                              fs-3
                              bg-light-primary
                            "
                                            >
                                                Well we have good budget for the project
                                            </div>
                                        </div>
                                        <div
                                            class="
                            chat-time
                            d-inline-block
                            text-end
                            fs-2
                            font-weight-medium
                          "
                                        >
                                            11:00 am
                                        </div>
                                    </li>
                                    <!--chat Row -->
                                </ul>
                                <!--User 6 -->
                                <ul class="chat-list chat" data-user-id="6">
                                    <!--chat Row -->
                                    <li class="mt-4">
                                        <div class="chat-img d-inline-block align-top">
                                            <img
                                                src="src/assets/images/users/1.jpg"
                                                alt="user"
                                                class="rounded-circle"
                                            />
                                        </div>
                                        <div class="chat-content ps-3 d-inline-block">
                                            <h5 class="text-muted fs-3 font-weight-medium">
                                                James Anderson
                                            </h5>
                                            <div
                                                class="
                              box
                              mb-2
                              d-inline-block
                              text-dark
                              message
                              font-weight-medium
                              fs-3
                              bg-light-info
                            "
                                            >
                                                Lorem Ipsum is simply dummy text of the printing &
                                                type setting industry.
                                            </div>
                                        </div>
                                        <div
                                            class="
                            chat-time
                            d-inline-block
                            text-end
                            fs-2
                            font-weight-medium
                          "
                                        >
                                            10:56 am
                                        </div>
                                    </li>
                                    <!--chat Row -->
                                    <li class="mt-4">
                                        <div class="chat-img d-inline-block align-top">
                                            <img
                                                src="src/assets/images/users/2.jpg"
                                                alt="user"
                                                class="rounded-circle"
                                            />
                                        </div>
                                        <div class="chat-content ps-3 d-inline-block">
                                            <h5 class="text-muted fs-3 font-weight-medium">
                                                Bianca Doe
                                            </h5>
                                            <div
                                                class="
                              box
                              mb-2
                              d-inline-block
                              text-dark
                              font-weight-medium
                              message
                              fs-3
                              bg-light-success
                            "
                                            >
                                                It’s Great opportunity to work.
                                            </div>
                                        </div>
                                        <div
                                            class="
                            chat-time
                            d-inline-block
                            text-end
                            fs-2
                            font-weight-medium
                          "
                                        >
                                            10:57 am
                                        </div>
                                    </li>
                                    <!--chat Row -->
                                    <li class="odd mt-4">
                                        <div class="chat-content ps-3 d-inline-block text-end">
                                            <div
                                                class="
                              box
                              mb-2
                              d-inline-block
                              text-dark
                              message
                              font-weight-medium
                              fs-3
                              bg-light-inverse
                            "
                                            >
                                                I would love to join the team.
                                            </div>
                                            <br />
                                        </div>
                                        <div
                                            class="
                            chat-time
                            d-inline-block
                            text-end
                            fs-2
                            font-weight-medium
                          "
                                        >
                                            10:58 am
                                        </div>
                                    </li>
                                    <!--chat Row -->
                                    <li class="odd mt-4">
                                        <div class="chat-content ps-3 d-inline-block text-end">
                                            <div
                                                class="
                              box
                              mb-2
                              d-inline-block
                              text-dark
                              message
                              font-weight-medium
                              fs-3
                              bg-light-inverse
                            "
                                            >
                                                Whats budget of the new project.
                                            </div>
                                            <br />
                                        </div>
                                        <div
                                            class="
                            chat-time
                            d-inline-block
                            text-end
                            fs-2
                            font-weight-medium
                          "
                                        >
                                            10:59 am
                                        </div>
                                    </li>
                                    <!--chat Row -->
                                    <li class="mt-4">
                                        <div class="chat-img d-inline-block align-top">
                                            <img
                                                src="src/assets/images/users/3.jpg"
                                                alt="user"
                                                class="rounded-circle"
                                            />
                                        </div>
                                        <div class="chat-content ps-3 d-inline-block">
                                            <h5 class="text-muted fs-3 font-weight-medium">
                                                Angelina Rhodes
                                            </h5>
                                            <div
                                                class="
                              box
                              mb-2
                              d-inline-block
                              text-dark
                              message
                              font-weight-medium
                              fs-3
                              bg-light-primary
                            "
                                            >
                                                Well we have good budget for the project
                                            </div>
                                        </div>
                                        <div
                                            class="
                            chat-time
                            d-inline-block
                            text-end
                            fs-2
                            font-weight-medium
                          "
                                        >
                                            11:00 am
                                        </div>
                                    </li>
                                    <!--chat Row -->
                                </ul>
                                <!--User 7 -->
                                <ul class="chat-list chat" data-user-id="7">
                                    <!--chat Row -->
                                    <li class="mt-4">
                                        <div class="chat-img d-inline-block align-top">
                                            <img
                                                src="src/assets/images/users/1.jpg"
                                                alt="user"
                                                class="rounded-circle"
                                            />
                                        </div>
                                        <div class="chat-content ps-3 d-inline-block">
                                            <h5 class="text-muted fs-3 font-weight-medium">
                                                James Anderson
                                            </h5>
                                            <div
                                                class="
                              box
                              mb-2
                              d-inline-block
                              text-dark
                              message
                              font-weight-medium
                              fs-3
                              bg-light-info
                            "
                                            >
                                                Lorem Ipsum is simply dummy text of the printing &
                                                type setting industry.
                                            </div>
                                        </div>
                                        <div
                                            class="
                            chat-time
                            d-inline-block
                            text-end
                            fs-2
                            font-weight-medium
                          "
                                        >
                                            10:56 am
                                        </div>
                                    </li>
                                    <!--chat Row -->
                                    <li class="mt-4">
                                        <div class="chat-img d-inline-block align-top">
                                            <img
                                                src="src/assets/images/users/2.jpg"
                                                alt="user"
                                                class="rounded-circle"
                                            />
                                        </div>
                                        <div class="chat-content ps-3 d-inline-block">
                                            <h5 class="text-muted fs-3 font-weight-medium">
                                                Bianca Doe
                                            </h5>
                                            <div
                                                class="
                              box
                              mb-2
                              d-inline-block
                              text-dark
                              font-weight-medium
                              message
                              fs-3
                              bg-light-success
                            "
                                            >
                                                It’s Great opportunity to work.
                                            </div>
                                        </div>
                                        <div
                                            class="
                            chat-time
                            d-inline-block
                            text-end
                            fs-2
                            font-weight-medium
                          "
                                        >
                                            10:57 am
                                        </div>
                                    </li>
                                    <!--chat Row -->
                                    <li class="odd mt-4">
                                        <div class="chat-content ps-3 d-inline-block text-end">
                                            <div
                                                class="
                              box
                              mb-2
                              d-inline-block
                              text-dark
                              message
                              font-weight-medium
                              fs-3
                              bg-light-inverse
                            "
                                            >
                                                I would love to join the team.
                                            </div>
                                            <br />
                                        </div>
                                        <div
                                            class="
                            chat-time
                            d-inline-block
                            text-end
                            fs-2
                            font-weight-medium
                          "
                                        >
                                            10:58 am
                                        </div>
                                    </li>
                                    <!--chat Row -->
                                    <li class="odd mt-4">
                                        <div class="chat-content ps-3 d-inline-block text-end">
                                            <div
                                                class="
                              box
                              mb-2
                              d-inline-block
                              text-dark
                              message
                              font-weight-medium
                              fs-3
                              bg-light-inverse
                            "
                                            >
                                                Whats budget of the new project.
                                            </div>
                                            <br />
                                        </div>
                                        <div
                                            class="
                            chat-time
                            d-inline-block
                            text-end
                            fs-2
                            font-weight-medium
                          "
                                        >
                                            10:59 am
                                        </div>
                                    </li>
                                    <!--chat Row -->
                                    <li class="mt-4">
                                        <div class="chat-img d-inline-block align-top">
                                            <img
                                                src="src/assets/images/users/3.jpg"
                                                alt="user"
                                                class="rounded-circle"
                                            />
                                        </div>
                                        <div class="chat-content ps-3 d-inline-block">
                                            <h5 class="text-muted fs-3 font-weight-medium">
                                                Angelina Rhodes
                                            </h5>
                                            <div
                                                class="
                              box
                              mb-2
                              d-inline-block
                              text-dark
                              message
                              font-weight-medium
                              fs-3
                              bg-light-primary
                            "
                                            >
                                                Well we have good budget for the project
                                            </div>
                                        </div>
                                        <div
                                            class="
                            chat-time
                            d-inline-block
                            text-end
                            fs-2
                            font-weight-medium
                          "
                                        >
                                            11:00 am
                                        </div>
                                    </li>
                                    <!--chat Row -->
                                </ul>
                                <!--User 8 -->
                                <ul class="chat-list chat" data-user-id="8">
                                    <!--chat Row -->
                                    <li class="mt-4">
                                        <div class="chat-img d-inline-block align-top">
                                            <img
                                                src="src/assets/images/users/1.jpg"
                                                alt="user"
                                                class="rounded-circle"
                                            />
                                        </div>
                                        <div class="chat-content ps-3 d-inline-block">
                                            <h5 class="text-muted fs-3 font-weight-medium">
                                                James Anderson
                                            </h5>
                                            <div
                                                class="
                              box
                              mb-2
                              d-inline-block
                              text-dark
                              message
                              font-weight-medium
                              fs-3
                              bg-light-info
                            "
                                            >
                                                Lorem Ipsum is simply dummy text of the printing &
                                                type setting industry.
                                            </div>
                                        </div>
                                        <div
                                            class="
                            chat-time
                            d-inline-block
                            text-end
                            fs-2
                            font-weight-medium
                          "
                                        >
                                            10:56 am
                                        </div>
                                    </li>
                                    <!--chat Row -->
                                    <li class="mt-4">
                                        <div class="chat-img d-inline-block align-top">
                                            <img
                                                src="src/assets/images/users/2.jpg"
                                                alt="user"
                                                class="rounded-circle"
                                            />
                                        </div>
                                        <div class="chat-content ps-3 d-inline-block">
                                            <h5 class="text-muted fs-3 font-weight-medium">
                                                Bianca Doe
                                            </h5>
                                            <div
                                                class="
                              box
                              mb-2
                              d-inline-block
                              text-dark
                              font-weight-medium
                              message
                              fs-3
                              bg-light-success
                            "
                                            >
                                                It’s Great opportunity to work.
                                            </div>
                                        </div>
                                        <div
                                            class="
                            chat-time
                            d-inline-block
                            text-end
                            fs-2
                            font-weight-medium
                          "
                                        >
                                            10:57 am
                                        </div>
                                    </li>
                                    <!--chat Row -->
                                    <li class="odd mt-4">
                                        <div class="chat-content ps-3 d-inline-block text-end">
                                            <div
                                                class="
                              box
                              mb-2
                              d-inline-block
                              text-dark
                              message
                              font-weight-medium
                              fs-3
                              bg-light-inverse
                            "
                                            >
                                                I would love to join the team.
                                            </div>
                                            <br />
                                        </div>
                                        <div
                                            class="
                            chat-time
                            d-inline-block
                            text-end
                            fs-2
                            font-weight-medium
                          "
                                        >
                                            10:58 am
                                        </div>
                                    </li>
                                    <!--chat Row -->
                                    <li class="odd mt-4">
                                        <div class="chat-content ps-3 d-inline-block text-end">
                                            <div
                                                class="
                              box
                              mb-2
                              d-inline-block
                              text-dark
                              message
                              font-weight-medium
                              fs-3
                              bg-light-inverse
                            "
                                            >
                                                Whats budget of the new project.
                                            </div>
                                            <br />
                                        </div>
                                        <div
                                            class="
                            chat-time
                            d-inline-block
                            text-end
                            fs-2
                            font-weight-medium
                          "
                                        >
                                            10:59 am
                                        </div>
                                    </li>
                                    <!--chat Row -->
                                    <li class="mt-4">
                                        <div class="chat-img d-inline-block align-top">
                                            <img
                                                src="src/assets/images/users/3.jpg"
                                                alt="user"
                                                class="rounded-circle"
                                            />
                                        </div>
                                        <div class="chat-content ps-3 d-inline-block">
                                            <h5 class="text-muted fs-3 font-weight-medium">
                                                Angelina Rhodes
                                            </h5>
                                            <div
                                                class="
                              box
                              mb-2
                              d-inline-block
                              text-dark
                              message
                              font-weight-medium
                              fs-3
                              bg-light-primary
                            "
                                            >
                                                Well we have good budget for the project
                                            </div>
                                        </div>
                                        <div
                                            class="
                            chat-time
                            d-inline-block
                            text-end
                            fs-2
                            font-weight-medium
                          "
                                        >
                                            11:00 am
                                        </div>
                                    </li>
                                    <!--chat Row -->
                                </ul>
                            </div>
                        </div>
                        <div
                            class="
                                card-body
                                border-top border-bottom
                                chat-send-message-footer
                              "
                        >
                            <div class="row">
                                <div class="col-12">
                                    <div class="input-field mt-0 mb-0">
                                        <input
                                            id="textarea1"
                                            placeholder="Entrer votre message"
                                            class="message-type-box form-control border-0"
                                            type="text"
                                        />
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="chat-windows"></div>
@endsection


@section('script')
<script src="src/dist/js/pages/chat/chat.js"></script>
@endsection
