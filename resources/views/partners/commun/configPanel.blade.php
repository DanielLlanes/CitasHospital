
<div class="chat-sidebar">
    <ul class="nav nav-tabs">
        <li class="nav-item">
            <a href="#quick_sidebar_tab_1" class="nav-link active tab-icon"  data-toggle="tab">Theme</a>
        </li>
        <li class="nav-item">
            <a href="#quick_sidebar_tab_2" class="nav-link tab-icon"  data-toggle="tab">Settings</a>
        </li>
    </ul>
    <div class="tab-content">
        <!-- Start Color Theme Sidebar -->
        <div class="tab-pane chat-sidebar-settings in show active animated shake" role="tabpanel" id="quick_sidebar_tab_1">
            <div class="chat-sidebar-slimscroll-style">
                <div class="theme-light-dark">
                    <h6>Sidebar Theme</h6>
                    <button type="button" data-theme="white" class="btn lightColor btn-outline btn-circle m-b-10 theme-button">Light Sidebar</button>
                    <button type="button" data-theme="dark" class="btn dark btn-outline btn-circle m-b-10 theme-button">Dark Sidebar</button>
                </div>
                <div class="theme-light-dark">
                    <h6>Sidebar Color</h6>
                    <ul class="list-unstyled">
                        <li class="complete">
                            <div class="theme-color sidebar-theme">
                                <a href="#" data-theme="white"><span class="head"></span><span class="cont"></span></a>
                                <a href="#" data-theme="dark"><span class="head"></span><span class="cont"></span></a>
                                <a href="#" data-theme="blue"><span class="head"></span><span class="cont"></span></a>
                                <a href="#" data-theme="indigo"><span class="head"></span><span class="cont"></span></a>
                                <a href="#" data-theme="cyan"><span class="head"></span><span class="cont"></span></a>
                                <a href="#" data-theme="green"><span class="head"></span><span class="cont"></span></a>
                                <a href="#" data-theme="red"><span class="head"></span><span class="cont"></span></a>
                            </div>
                        </li>
                    </ul>
                    <h6>Header Brand color</h6>
                    <ul class="list-unstyled">
                        <li class="theme-option">
                            <div class="theme-color logo-theme">
                                <a href="#" data-theme="logo-white"><span class="head"></span><span class="cont"></span></a>
                                <a href="#" data-theme="logo-dark"><span class="head"></span><span class="cont"></span></a>
                                <a href="#" data-theme="logo-blue"><span class="head"></span><span class="cont"></span></a>
                                <a href="#" data-theme="logo-indigo"><span class="head"></span><span class="cont"></span></a>
                                <a href="#" data-theme="logo-cyan"><span class="head"></span><span class="cont"></span></a>
                                <a href="#" data-theme="logo-green"><span class="head"></span><span class="cont"></span></a>
                                <a href="#" data-theme="logo-red"><span class="head"></span><span class="cont"></span></a>
                            </div>
                        </li>
                    </ul>
                    <h6>Header color</h6>
                    <ul class="list-unstyled">
                        <li class="theme-option">
                            <div class="theme-color header-theme">
                                <a href="#" data-theme="header-white"><span class="head"></span><span class="cont"></span></a>
                                <a href="#" data-theme="header-dark"><span class="head"></span><span class="cont"></span></a>
                                <a href="#" data-theme="header-blue"><span class="head"></span><span class="cont"></span></a>
                                <a href="#" data-theme="header-indigo"><span class="head"></span><span class="cont"></span></a>
                                <a href="#" data-theme="header-cyan"><span class="head"></span><span class="cont"></span></a>
                                <a href="#" data-theme="header-green"><span class="head"></span><span class="cont"></span></a>
                                <a href="#" data-theme="header-red"><span class="head"></span><span class="cont"></span></a>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <!-- End Color Theme Sidebar -->
        <!-- Start Setting Panel -->
        <div class="tab-pane chat-sidebar-settings animated slideInUp" id="quick_sidebar_tab_2">
            <div class="chat-sidebar-settings-list chat-sidebar-slimscroll-style">
                <div class="chat-header"><h5 class="list-heading">Layout Settings</h5></div>
                <div class="chatpane inner-content ">
                    <div class="settings-list">
                        <div class="setting-item">
                            <div class="setting-text">Sidebar Position</div>
                            <div class="setting-set">
                               <select class="sidebar-pos-option form-control input-inline input-sm input-small ">
                                    <option value="left" selected="selected">Left</option>
                                    <option value="right">Right</option>
                                </select>
                            </div>
                        </div>
                        <div class="setting-item">
                            <div class="setting-text">Header</div>
                            <div class="setting-set">
                               <select class="page-header-option form-control input-inline input-sm input-small ">
                                    <option value="fixed" selected="selected">Fixed</option>
                                    <option value="default">Default</option>
                                </select>
                            </div>
                        </div>

                        <div class="setting-item">
                            <div class="setting-text">Footer</div>
                            <div class="setting-set">
                               <select class="page-footer-option form-control input-inline input-sm input-small ">
                                    <option value="fixed">Fixed</option>
                                    <option value="default" selected="selected">Default</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="chat-header"><h5 class="list-heading">Account Settings</h5></div>
                    <div class="settings-list">
                        <div class="setting-item">
                            <div class="setting-text">Notifications</div>
                            <div class="setting-set">
                                <div class="switch">
                                    <label class = "mdl-switch mdl-js-switch mdl-js-ripple-effect"
                                      for = "switch-1">
                                      <input type = "checkbox" id = "switch-1"
                                         class = "mdl-switch__input" checked>
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="setting-item">
                            <div class="setting-text">Show Online</div>
                            <div class="setting-set">
                                <div class="switch">
                                    <label class = "mdl-switch mdl-js-switch mdl-js-ripple-effect"
                                      for = "switch-7">
                                      <input type = "checkbox" id = "switch-7"
                                         class = "mdl-switch__input" checked>
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="setting-item">
                            <div class="setting-text">Status</div>
                            <div class="setting-set">
                                <div class="switch">
                                    <label class = "mdl-switch mdl-js-switch mdl-js-ripple-effect"
                                      for = "switch-2">
                                      <input type = "checkbox" id = "switch-2"
                                         class = "mdl-switch__input" checked>
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="setting-item">
                            <div class="setting-text">2 Steps Verification</div>
                            <div class="setting-set">
                                <div class="switch">
                                    <label class = "mdl-switch mdl-js-switch mdl-js-ripple-effect"
                                      for = "switch-3">
                                      <input type = "checkbox" id = "switch-3"
                                         class = "mdl-switch__input" checked>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="chat-header"><h5 class="list-heading">General Settings</h5></div>
                    <div class="settings-list">
                        <div class="setting-item">
                            <div class="setting-text">Location</div>
                            <div class="setting-set">
                                <div class="switch">
                                    <label class = "mdl-switch mdl-js-switch mdl-js-ripple-effect"
                                      for = "switch-4">
                                      <input type = "checkbox" id = "switch-4"
                                         class = "mdl-switch__input" checked>
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="setting-item">
                            <div class="setting-text">Save Histry</div>
                            <div class="setting-set">
                                <div class="switch">
                                    <label class = "mdl-switch mdl-js-switch mdl-js-ripple-effect"
                                      for = "switch-5">
                                      <input type = "checkbox" id = "switch-5"
                                         class = "mdl-switch__input" checked>
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="setting-item">
                            <div class="setting-text">Auto Updates</div>
                            <div class="setting-set">
                                <div class="switch">
                                    <label class = "mdl-switch mdl-js-switch mdl-js-ripple-effect"
                                      for = "switch-6">
                                      <input type = "checkbox" id = "switch-6"
                                         class = "mdl-switch__input" checked>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
