<div class="sidebar-menu">
    <ul class="menu">
        <li class="sidebar-title">Menu</li>
        <li class="sidebar-item <?php if ($page == 'dashboard') {echo 'active';} ?>">
            <a href="/admin/dashboard" class='sidebar-link'>
                <i class="bi bi-grid-fill"></i>
                <span>Dashboard</span>
            </a>
        </li>

        <li class="sidebar-item <?php if ($page == 'employee') {echo 'active';} ?>">
            <a href="/admin/employee" class='sidebar-link'>
                <i class="bi bi-people"></i>
                <span>Employee</span>
            </a>
        </li>

        <li class="sidebar-item <?php if ($page == 'attedance') {echo 'active';} ?>">
            <a href="/admin/attedance" class='sidebar-link'>
                <i class="bi bi-list-check"></i>
                <span>Attendance</span>
            </a>
        </li>

        <li class="sidebar-item <?php if ($page == 'job') {echo 'active';} ?>">
            <a href="/admin/job" class='sidebar-link'>
                <i class="bi bi-journal-text"></i>
                <span>Job</span>
            </a>
        </li>
    </ul>
</div>