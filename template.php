<!doctype html>
<html lang="en">

<?php include "head.php" ?>

<body>

<!-- Loading starts -->
<div id="loading-wrapper">
    <div class="spinner-border" role="status">
        <span class="sr-only">Loading...</span>
    </div>
</div>
<!-- Loading ends -->


<!-- Page wrapper start -->
<div class="page-wrapper">

    <!-- Sidebar wrapper start -->
    <?php include "sidebar.php" ?>
    <!-- Sidebar wrapper end -->

    <!-- Page content start  -->
    <div class="page-content">

        <!-- Header start -->
        <?php include "header.php" ?>
        <!-- Header end -->

        <!-- Main container start -->
        <div class="main-container">

            <!-- Row start -->
            <div class="row gutters">
                <div class="col-xl-3 col-lg-3 col-md-12 col-sm-12 col-12">
                    <div class="card h-100">
                        <div class="card-body">
                            <div class="account-settings">
                                <div class="user-profile">
                                    <div class="user-avatar">
                                        <img src="img/user.png" alt="Le Rouge Admin" />
                                    </div>
                                    <h5 class="user-name">Zyan Ferris</h5>
                                    <h6 class="user-email">zyanferris@LeRouge.com</h6>
                                </div>
                                <div class="list-group">
                                    <a href="contacts.html" class="list-group-item">Contacts</a>
                                    <a href="chat.html" class="list-group-item">Chat</a>
                                    <a href="tasks.html" class="list-group-item">Tasks</a>
                                    <a href="documents.html" class="list-group-item">Documents</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-9 col-lg-9 col-md-12 col-sm-12 col-12">
                    <div class="card h-100">
                        <div class="card-header">
                            <div class="card-title">Update Profile</div>
                        </div>
                        <div class="card-body">
                            <div class="row gutters">
                                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                    <div class="form-group">
                                        <label for="fullName">Full Name</label>
                                        <input type="text" class="form-control" id="fullName" placeholder="Enter full name">
                                    </div>
                                    <div class="form-group">
                                        <label for="eMail">Email</label>
                                        <input type="email" class="form-control" id="eMail" placeholder="Enter email ID">
                                    </div>
                                    <div class="form-group">
                                        <label for="phone">Phone</label>
                                        <input type="text" class="form-control" id="phone" placeholder="Enter phone number">
                                    </div>
                                    <div class="form-group">
                                        <label for="website">Website URL</label>
                                        <input type="url" class="form-control" id="website" placeholder="Website url">
                                    </div>
                                </div>
                                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                    <div class="form-group">
                                        <label for="addRess">Address</label>
                                        <input type="text" class="form-control" id="addRess" placeholder="Enter Address">
                                    </div>
                                    <div class="form-group">
                                        <label for="ciTy">City</label>
                                        <input type="name" class="form-control" id="ciTy" placeholder="Enter City">
                                    </div>
                                    <div class="form-group">
                                        <label for="sTate">State</label>
                                        <input type="text" class="form-control" id="sTate" placeholder="Enter State">
                                    </div>
                                    <div class="form-group">
                                        <label for="zIp">ZIP</label>
                                        <input type="number" class="form-control" id="zIp" placeholder="Website ZIP">
                                    </div>
                                </div>
                                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                    <div class="text-right">
                                        <button type="button" id="submit" name="submit" class="btn btn-white">Cancel</button>
                                        <button type="button" id="submit" name="submit" class="btn btn-primary">Submit Form</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Row end -->

        </div>
        <!-- Main container end -->

    </div>
    <!-- Page content end -->

</div>
<!-- Page wrapper end -->

<?php include "foot.php" ?>

</body>

</html>