
<div class="header">
  <a href="#default" class="logo">Loyola High School</a>
  <div class="header-right">
    
  </div>
</div>
<div class="wrapper">
        <aside id="sidebar">
            <div class="d-flex">
                <button class="toggle-btn" type="button">
                    <i class="lni lni-grid-alt"></i>
                </button>
                <div class="sidebar-logo">
                    <a href="#">Admin</a>
                </div>
            </div>
            <ul class="sidebar-nav">
                <li class="sidebar-item">
                    <a href="../admin/index.php" class="sidebar-link">
                        <i class="lni lni-home"></i>
                        <span>Dashboard</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a href="../admin/schoolyear.php" class="sidebar-link">
                        <i class="lni lni-database"></i>
                        <span>School Year</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a href="#" class="sidebar-link collapsed has-dropdown" data-bs-toggle="collapse"
                        data-bs-target="#auth" aria-expanded="false" aria-controls="auth">
                        <i class="lni lni-users"></i>
                        <span>Student</span>
                    </a>
                    <ul id="auth" class="sidebar-dropdown list-unstyled collapse" data-bs-parent="#sidebar">
                        <li class="sidebar-item">
                            <a href="../admin/addStudent.php" class="sidebar-link">Add Student</a>
                        </li>
                        <li class="sidebar-item">
                            <a href="../admin/viewStudent.php" class="sidebar-link">View Student</a>
                        </li>
                    </ul>
                </li>
                
                <li class="sidebar-item">
                    <a href="#" class="sidebar-link collapsed has-dropdown" data-bs-toggle="collapse"
                        data-bs-target="#multi" aria-expanded="false" aria-controls="multi">
                        <i class="lni lni-agenda"></i>
                        <span>Section</span>
                    </a>
                    <ul id="multi" class="sidebar-dropdown list-unstyled collapse" data-bs-parent="#sidebar">
                    <li class="sidebar-item">
                            <a href="../admin/addSection.php" class="sidebar-link">Add Section</a>
                        </li>
                        <li class="sidebar-item">
                            <a href="../admin/viewSection.php" class="sidebar-link">View Section</a>
                        </li>
                        <li class="sidebar-item">
                            <a href="../admin/assignAdviser.php" class="sidebar-link">Assign Adviser</a>
                        </li>
                    </ul>
                </li>

                <li class="sidebar-item">
                    <a href="#" class="sidebar-link collapsed has-dropdown" data-bs-toggle="collapse"
                        data-bs-target="#subject" aria-expanded="false" aria-controls="subject">
                        <i class="lni lni-library"></i>
                        <span>Subject</span>
                    </a>
                    <ul id="subject" class="sidebar-dropdown list-unstyled collapse" data-bs-parent="#sidebar">
                    <li class="sidebar-item">
                            <a href="../admin/addSubject.php" class="sidebar-link">Add Subject</a>
                        </li>
                        <li class="sidebar-item">
                            <a href="../admin/viewSubject.php" class="sidebar-link">View Subject</a>
                        </li>
                    </ul>
                </li>

                <li class="sidebar-item">
                    <a href="../admin/calendar.php" class="sidebar-link">
                        <i class="lni lni-calendar"></i>
                        <span>Calendar</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a href="#" class="sidebar-link">
                        <i class="lni lni-pencil"></i>
                        <span>Records</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a href="#" class="sidebar-link">
                        <i class="lni lni-user"></i>
                        <span>Teachers</span>
                    </a>
                </li>
                <li class="sidebar-item">
                <a href="#" class="sidebar-link collapsed has-dropdown" data-bs-toggle="collapse"
                        data-bs-target="#faculty" aria-expanded="false" aria-controls="faculty">
                        <i class="lni lni-network"></i>
                        <span>Faculty</span>
                    </a>
                    <ul id="faculty" class="sidebar-dropdown list-unstyled collapse" data-bs-parent="#sidebar">
                    <li class="sidebar-item">
                            <a href="../admin/addFaculty.php" class="sidebar-link">Add Faculty</a>
                        </li>
                        <li class="sidebar-item">
                            <a href="../admin/viewFaculty.php" class="sidebar-link">View Faculty</a>
                        </li>
                        <li class="sidebar-item">
                            <a href="../admin/subjectHandled.php" class="sidebar-link">Subject Handled</a>
                        </li>
                    </ul>
                </li>
            </ul>
            <div class="sidebar-footer">
                <a href="adminSettings.php" class="sidebar-link">
                    <i class="lni lni-cog"></i>
                    <span>Settings</span>
                </a>
            </div>
            <div class="sidebar-footer">
                <a href="../admin/logout.php" class="sidebar-link">
                    <i class="lni lni-exit"></i>
                    <span>Logout</span>
                </a>
            </div>
        </aside>
            

    
