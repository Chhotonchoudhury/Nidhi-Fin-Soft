<!-- Sidebar wrapper start -->
<nav class="sidebar-wrapper">

    <!-- Sidebar content start -->
    <div class="sidebar-tabs">

        <!-- Tabs nav start -->
        <div class="nav" role="tablist" aria-orientation="vertical">
            <a href="#" class="logo">
                <img src="{{ asset('assetsDashboard/img/logo.png') }}" alt="Uni Pro Admin">
            </a>

            <a class="nav-link {{ request()->routeIs('dashboard') || request()->routeIs('company*') || request()->routeIs('saving*') || request()->routeIs('fd*') ? 'active' : '' }}"
                data-bs-toggle="tab" role="tab" aria-controls="tab-dashboard" href="#tab-dashboard"
                aria-selected="false">
                <i class="icon-home2"></i>
                <span class="nav-link-text">Masters</span>
            </a>

            <a class="nav-link {{ request()->routeIs('member*') || request()->routeIs('employees*') || request()->routeIs('agent*') ? 'active' : '' }}"
                data-bs-toggle="tab" role="tab" aria-controls="tab-members" href="#tab-members" aria-selected="false">
                <i class="icon-users"></i>
                <span class="nav-link-text">Patners</span>
            </a>

            <a class="nav-link settings" id="settings-tab" data-bs-toggle="tab" href="#tab-settings" role="tab"
                aria-controls="tab-authentication" aria-selected="false">
                <i class="icon-settings1"></i>
                <span class="nav-link-text">Settings</span>
            </a>


        </div>
        <!-- Tabs nav end -->

        <!-- Tabs content start -->
        <div class="tab-content">

            <!-- Chat tab -->
            <div class="tab-pane fade {{ request()->routeIs('dashboard') || request()->routeIs('company*') || request()->routeIs('saving*')  || request()->routeIs('fd*') ? 'show active' : '' }}"
                id="tab-dashboard" role="tabpanel" aria-labelledby="dashboard-tab">
                <!-- Here you can put content for the dashboard (which can be empty or just a placeholder if needed) -->
                <div class="tab-pane-header">
                    Masters
                </div>
                <div class="sidebarMenuScroll">
                    <div class="sidebar-menu">
                        <ul>
                            <li>
                                <a href="{{ route('dashboard') }}" @if(request()->routeIs('dashboard'))
                                    class="current-page" @endif><span class="icon-grid me-1"></span> Dashboard</a>
                            </li>

                            <li>
                                <a href="{{ route('company.view') }}" @if(request()->routeIs('company.view'))
                                    class="current-page" @endif> <span class="icon-domain me-1"></span>
                                    Company</a>
                            </li>


                            <li>
                                <a href="{{ route('company.branch') }}" @if(request()->routeIs('company.branch'))
                                    class="current-page" @endif><span class="icon-clear_all me-1"></span>
                                    Branches</a>
                            </li>
                        </ul>

                        <ul>

                            <li class="list-heading">Accounts Plans</li>

                            <li>
                                <a href="{{ route('saving.index') }}" @if(request()->routeIs('saving.index'))
                                    class="current-page" @endif><span class="icon-clear_all me-1"></span>
                                    Savings Plan</a>
                            </li>


                            <li>
                                <a href="{{ route('fd.index') }}" @if(request()->routeIs('fd.index'))
                                    class="current-page" @endif><span class="icon-clear_all me-1"></span>
                                    FD Plan</a>
                            </li>
                        </ul>
                    </div>
                </div>

                <!-- Sidebar actions starts -->
                <div class="sidebar-actions">
                    <div class="support-tile">
                        <i class="icon-headphones"></i> 24/7 Support
                    </div>
                </div>
                <!-- Sidebar actions ends -->

            </div>

            <div class="tab-pane fade {{request()->routeIs('member*') || request()->routeIs('employees*') || request()->routeIs('agent*') ? 'show active' : '' }}"
                id="tab-members" role="tabpanel" aria-labelledby="dashboard-tab">
                <!-- Here you can put content for the dashboard (which can be empty or just a placeholder if needed) -->
                <div class="tab-pane-header">
                    Member / Patners
                </div>
                <div class="sidebarMenuScroll">
                    <div class="sidebar-menu">

                        <ul>
                            <li>
                                <a href="{{ route('member.index') }}" @if(request()->routeIs('member.index'))
                                    class="current-page" @endif><span class="icon-users me-1"></span> Members</a>
                            </li>

                            <li>
                                <a href="{{ route('agent.index') }}" @if(request()->routeIs('agent.index'))
                                    class="current-page" @endif><span class="icon-briefcase me-1"></span> Agents</a>
                            </li>

                            <li>
                                <a href="{{ route('employees.index') }}" @if(request()->routeIs('employees.index'))
                                    class="current-page" @endif><span class="icon-user me-1"></span> Empolyees</a>
                            </li>
                        </ul>


                    </div>
                </div>

                <!-- Sidebar actions starts -->
                <div class="sidebar-actions">
                    <div class="support-tile">
                        <i class="icon-headphones"></i> 24/7 Support
                    </div>
                </div>
                <!-- Sidebar actions ends -->

            </div>
            <!-- Pages tab -->
            {{-- <div class="tab-pane fade {{ request()->routeIs('company*') ? 'show active' : '' }}" id="tab-product"
                role="tabpanel" aria-labelledby="product-tab">

                <!-- Tab content header start -->
                <div class="tab-pane-header">
                    Masters
                </div>
                <!-- Tab content header end -->

                <!-- Sidebar menu starts -->
                <div class="sidebarMenuScroll">
                    <div class="sidebar-menu">

                    </div>
                </div>
                <!-- Sidebar menu ends -->

                <!-- Sidebar actions starts -->
                <div class="sidebar-actions">
                    <div class="support-tile">
                        <i class="icon-headphones"></i> 24/7 Support
                    </div>
                </div>
                <!-- Sidebar actions ends -->

            </div> --}}

            <!-- Settings tab -->
            <div class="tab-pane fade" id="tab-settings" role="tabpanel" aria-labelledby="settings-tab">

                <!-- Tab content header start -->
                <div class="tab-pane-header">
                    Settings
                </div>
                <!-- Tab content header end -->

                <!-- Settings start -->
                <div class="sidebarMenuScroll">
                    <div class="sidebar-settings">
                        <div class="accordion" id="settingsAccordion">
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="genInfo">
                                    <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#genCollapse" aria-expanded="true" aria-controls="genCollapse">
                                        General Info
                                    </button>
                                </h2>
                                <div id="genCollapse" class="accordion-collapse collapse show" aria-labelledby="genInfo"
                                    data-bs-parent="#settingsAccordion">
                                    <div class="accordion-body">
                                        <div class="field-wrapper">
                                            <input type="text" value="Jeivxezer Lopexz" />
                                            <div class="field-placeholder">Full Name</div>
                                        </div>

                                        <div class="field-wrapper">
                                            <input type="email" value="jeivxezer-lopexz@email.com" />
                                            <div class="field-placeholder">Email</div>
                                        </div>

                                        <div class="field-wrapper">
                                            <input type="text" value="0 0000 00000" />
                                            <div class="field-placeholder">Contact</div>
                                        </div>
                                        <div class="field-wrapper m-0">
                                            <button class="btn btn-primary stripes-btn">Save</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="chngPwd">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#chngPwdCollapse" aria-expanded="false"
                                        aria-controls="chngPwdCollapse">
                                        Change Password
                                    </button>
                                </h2>
                                <div id="chngPwdCollapse" class="accordion-collapse collapse" aria-labelledby="chngPwd"
                                    data-bs-parent="#settingsAccordion">
                                    <div class="accordion-body">
                                        <div class="field-wrapper">
                                            <input type="text" value="">
                                            <div class="field-placeholder">Current Password</div>
                                        </div>
                                        <div class="field-wrapper">
                                            <input type="password" value="">
                                            <div class="field-placeholder">New Password</div>
                                        </div>
                                        <div class="field-wrapper">
                                            <input type="password" value="">
                                            <div class="field-placeholder">Confirm Password</div>
                                        </div>
                                        <div class="field-wrapper m-0">
                                            <button class="btn btn-primary stripes-btn">Save</button>
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="sidebarNotifications">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#notiCollapse" aria-expanded="false"
                                        aria-controls="notiCollapse">
                                        Notifications
                                    </button>
                                </h2>
                                <div id="notiCollapse" class="accordion-collapse collapse"
                                    aria-labelledby="sidebarNotifications" data-bs-parent="#settingsAccordion">
                                    <div class="accordion-body">
                                        <div class="list-group m-0">
                                            <div class="noti-container">
                                                <div class="noti-block">
                                                    <div>Alerts</div>
                                                    <div class="form-switch">
                                                        <input class="form-check-input" type="checkbox" id="showAlertss"
                                                            checked>
                                                        <label class="form-check-label" for="showAlertss"></label>
                                                    </div>
                                                </div>
                                                <div class="noti-block">
                                                    <div>Enable Sound</div>
                                                    <div class="form-switch">
                                                        <input class="form-check-input" type="checkbox"
                                                            id="soundEnable">
                                                        <label class="form-check-label" for="soundEnable"></label>
                                                    </div>
                                                </div>
                                                <div class="noti-block">
                                                    <div>Allow Chat</div>
                                                    <div class="form-switch">
                                                        <input class="form-check-input" type="checkbox" id="allowChat">
                                                        <label class="form-check-label" for="allowChat"></label>
                                                    </div>
                                                </div>
                                                <div class="noti-block">
                                                    <div>Desktop Messages</div>
                                                    <div class="form-switch">
                                                        <input class="form-check-input" type="checkbox"
                                                            id="desktopMessages">
                                                        <label class="form-check-label" for="desktopMessages"></label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Settings end -->

                <!-- Sidebar actions starts -->
                <div class="sidebar-actions">
                    <div class="support-tile blue">
                        <a href="account-settings.html" class="btn btn-light m-auto">Advance Settings</a>
                    </div>
                </div>
                <!-- Sidebar actions ends -->
            </div>

        </div>
        <!-- Tabs content end -->

    </div>
    <!-- Sidebar content end -->

</nav>
<!-- Sidebar wrapper end -->