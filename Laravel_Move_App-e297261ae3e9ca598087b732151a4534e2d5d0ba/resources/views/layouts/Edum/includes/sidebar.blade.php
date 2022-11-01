<div class="dlabnav" style="top: 60px">
    <div class="dlabnav-scroll">
        <ul class="metismenu" id="menu">
            <li class="{{ request()->routeIs('admin.home') ? 'mm-active' : '' }} ">
                <a class="ai-icon d-flex justify-content-between align-items-center"  href="/" aria-expanded="false">
                    <span>
                    <span>
                        <svg style="width:24px;height:24px" viewBox="0 0 24 24">
                            <path fill="currentColor" d="M13,3V9H21V3M13,21H21V11H13M3,21H11V15H3M3,13H11V3H3V13Z" />
                        </svg>
                    </span>
                    <span class="nav-text mx-2">Home</span>
                    </span>
                </a>
            </li>
            <li class="{{ request()->routeIs('admin.role.index') ? 'mm-active' : '' }} ">
                <a class="ai-icon d-flex justify-content-between align-items-center"  href="{{route('admin.roles.index') }}" aria-expanded="false">
                    <span>
                    <span>
                        <svg style="width:24px;height:24px" viewBox="0 0 24 24">
                            <path fill="currentColor" d="M13,3V9H21V3M13,21H21V11H13M3,21H11V15H3M3,13H11V3H3V13Z" />
                        </svg>
                    </span>
                    <span class="nav-text mx-2">Roles</span>
                    </span>
                </a>
            </li>
            <li class="{{ request()->routeIs('admin.admin.index') ? 'mm-active' : '' }} ">
                <a class="ai-icon d-flex justify-content-between align-items-center"  href="{{route('admin.admin.index') }}" aria-expanded="false">
                    <span>
                    <span>
                        <svg style="width:24px;height:24px" viewBox="0 0 24 24">
                            <path fill="currentColor" d="M13,3V9H21V3M13,21H21V11H13M3,21H11V15H3M3,13H11V3H3V13Z" />
                        </svg>
                    </span>
                    <span class="nav-text mx-2"> Admin</span>
                    </span>
                </a>
            </li>
            <li class="{{ request()->routeIs('admin.user.index') ? 'mm-active' : '' }} ">
                <a class="ai-icon d-flex justify-content-between align-items-center"  href="{{route('admin.user.index') }}" aria-expanded="false">
                    <span>
                    <span>
                        <svg style="width:24px;height:24px" viewBox="0 0 24 24">
                            <path fill="currentColor" d="M13,3V9H21V3M13,21H21V11H13M3,21H11V15H3M3,13H11V3H3V13Z" />
                        </svg>
                    </span>
                    <span class="nav-text mx-2"> Users</span>
                    </span>
                </a>
            </li>
            <li class="{{ request()->routeIs('admin.setting') ? 'mm-active' : '' }} ">
                <a class="ai-icon d-flex justify-content-between align-items-center"  href="{{route('admin.setting') }}" aria-expanded="false">
                    <span>
                    <span>
                        <svg style="width:24px;height:24px" viewBox="0 0 24 24">
                            <path fill="currentColor" d="M13,3V9H21V3M13,21H21V11H13M3,21H11V15H3M3,13H11V3H3V13Z" />
                        </svg>
                    </span>
                    <span class="nav-text mx-2"> Setting </span>
                    </span>
                </a>
            </li>
            </ul>
    </div>
</div>
