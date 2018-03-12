<!--NavBar-->
<div class="navbar">
    <a href="#home">Home</a>
    <a href="log_out.php">Logout</a>

    <div class="dropdown">
        <button class="dropbtn">Reviewer
            <i class="fa fa-caret-down"></i>
        </button>
        <div class="dropdown-content">
            <a href="hr_dashboard.php">Add Reviewer</a>
            <a href="reviewer_list.php">View/Delete Reviewer</a>
        </div>
    </div>

    <div class="dropdown">
        <button class="dropbtn">Setting
            <i class="fa fa-caret-down"></i>
        </button>
        <div class="dropdown-content">
            <a href="edit_settings.php?settingId=1">Interviewer</a>
            <a href="edit_settings.php?settingId=2">The Campaigner</a>
            <a href="edit_settings.php?settingId=3">The Expert</a>
        </div>
    </div>

</div>