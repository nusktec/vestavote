<!doctype html>
<html lang="en">
<?php session_start();
$_SESSION['title'] = "My Application" ?>
<?php include "head.php" ?>
<?php
//dump if login
$contest = models::getContestant(func::checkAuthOkay()['contestant']['xid']);
$company = models::getCompany(func::checkAuthOkay()['contestant']['xcid']);
$auth = models::getAuth(func::checkAuthOkay()['auth']['aid']);
$votes = models::getVotes(func::checkAuthOkay()['contestant']['xcode']);
//convert to json
?>
<script>
    var _contest = <?php echo json_encode($contest) ?>;
    var _company = <?php echo json_encode($company) ?>;
    var _auth = <?php echo json_encode($auth) ?>;
</script>
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
    <div class="page-content" id="app">

        <!-- Header start -->
        <?php include "header.php" ?>
        <!-- Header end -->

        <!-- Main container start -->
        <div class="main-container">

            <?php if (!func::checkAuthOkay()) { ?>
                <!-- Row start -->
                <div class="row gutters text-center justify-content-center">

                    <div class="col-xl-4 col-lg-12 col-md-12 col-sm-12">
                        <div class="card text-center">
                            <div class="card-header">
                                <div class="card-title">
                                    <i class="icon-vpn_key" style="font-size: 30px" v-if="!auth.clogo"></i>
                                    <img :src="auth.clogo" v-if="auth.clogo" style="width: 60px"/>
                                </div>
                            </div>
                            <div v-if="!success" class="card-body">
                                <h5 class="card-title">Contestant Portal</h5>
                                <p class="card-text">Please provide your registered Auth.PIN to proceed</p>
                                <p class="card-text text-danger">Kindly ignore this message if payment was
                                    successful</p>
                                <div class="form-group">
                                    <input v-model="pin" type="text" class="form-control" placeholder="Enter Auth.PIN">
                                </div>
                                <button :disabled="loading" @click="payAuth" href="#" class="btn btn-primary">Proceed to
                                    application
                                </button>
                            </div>

                            <div style="display: none" :style="{display: success?'block':'none'}" v-if="success"
                                 class="card-body justify-content-start">
                                <h5 class="card-title">Welcome Back</h5>
                                <p class="card-text">Please complete your registration below</p>
                                <h5>Application Form</h5>
                                <div class="form-group">
                                    <input disabled="disabled" :value="auth.ctitle" type="text" class="form-control"
                                           placeholder="Form Type">
                                </div>
                                <div class="form-group">
                                    <input disabled="disabled" :value="auth.aphone" type="text"
                                           class="form-control"
                                           placeholder="Phone No.">
                                </div>
                                <div class="form-group">
                                    <input disabled="disabled" :value="auth.aname" type="text" class="form-control"
                                           placeholder="Full Name">
                                </div>
                                <div class="form-group">
                                    <input v-model="data.xemail" type="email" class="form-control"
                                           placeholder="Email">
                                </div>
                                <div class="form-group justify-content-start">
                                    <select v-model="data.xextra" class="form-control"
                                            @change="extraCall($event, $event.target.selectedIndex)">
                                        <option selected value="">-Choose Form Type-</option>
                                        <option v-for="(i,k) in extra" :value="i.title">{{i.title}}</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <h4>Pay {{money.format(parseInt(auth.aamount) + parseInt(data.xamount))}}</h4>
                                </div>
                                <button v-if="data.xextra.length>0 && data.xemail.length>0" :disabled="loading"
                                        @click="payNow" href="#"
                                        class="btn btn-primary">
                                    Submit | {{data.xextra}}
                                </button>
                            </div>

                        </div>
                    </div>

                </div>
                <!-- Row end -->
            <?php } ?>

            <?php if (func::checkAuthOkay()) { ?>
                <!-- Row start -->
                <div class="row gutters">
                    <div class="col-xl-3 col-lg-3 col-md-12 col-sm-12 col-12">
                        <div class="card h-100">
                            <div class="card-body">
                                <div class="account-settings">
                                    <div class="user-profile">
                                        <div class="user-avatar">
                                            <img style="object-fit: cover"
                                                 :src="(parseInt(u.ximage)===1?'uploads/'+u.xcid+'/'+u.xcode+'.jpg?'+randNum():'uploads/placeholder.jpg?'+randNum())"
                                                 alt="Contestant Profile"/>
                                        </div>
                                        <h5 class="user-name">{{u.xname}}</h5>
                                        <h6 class="user-email mb-1">{{(u.xemail)?u.xemail:'No Email'}}</h6>
                                        <input class="d-none" style="display: none;" name="filedp" id="filedp"
                                               accept="image/*" type="file"/>
                                        <button :disabled="loading" class="btn btn-sm btn-rounded btn-primary"
                                                onclick="doUploadDp()">{{uploading}}
                                        </button>
                                    </div>
                                    <small class="m-1" style="color: red;">Your Voting Code</small>
                                    <div class="list-group">
                                        <?php if ($contest['xnick'] !== null) { ?>
                                            <a @click="copyText(c.ccode+'/VOTE/'+u.xcode+'/'+c.csess)"
                                               style="cursor: pointer" class="list-group-item align-content-center">
                                                <i class="icon-copy"></i> <strong>{{c.ccode+'/VOTE/'+u.xcode+'/'+c.csess}}</strong>
                                            </a>
                                        <?php } ?>
                                        <?php if ($contest['xnick'] === null) { ?>
                                            <a @click="$.notify('Update nickname to see voting code', 'error')"
                                               style="cursor: pointer" class="list-group-item align-content-center">
                                                <i class="icon-copy"></i> <strong>*************</strong>
                                            </a>
                                        <?php } ?>
                                        <a v-if="c.csocial_what!==null" target="_blank" :href="c.csocial_what"
                                           class="list-group-item align-content-center"><i class="icon-phone"></i>
                                            WhatApp Group</a>
                                        <a v-if="c.csocial_fb!==null" target="_blank" :href="c.csocial_fb"
                                           class="list-group-item align-content-center"><i
                                                    class="icon-facebook"></i> Facebook</a>
                                        <a v-if="c.csocial_tw!==null" target="_blank" :href="c.csocial_tw"
                                           class="list-group-item align-content-center"><i
                                                    class="icon-twitter"></i> Twitter</a>
                                        <a v-if="c.csocial_ins!==null" target="_blank" :href="c.csocial_ins"
                                           class="list-group-item align-content-center"><i
                                                    class="icon-instagram"></i> Instagram</a>
                                        <a onclick="logOut()" href="#" class="list-group-item danger"
                                           style="background-color: #f53838; color: white"><i class="icon-log-out"></i>
                                            Logout</a>
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
                                            <br/>
                                            <small style="color: red;">Names cannot be changed, contact us otherwise
                                            </small>
                                            <input disabled="disabled" :value="u.xname" type="text" class="form-control"
                                                   id="fullName"
                                                   placeholder="Enter full name">
                                        </div>
                                        <div class="form-group">
                                            <label for="eMail2">Nickname</label>
                                            <input v-model="u.xnick" type="text" class="form-control" id="eMail2"
                                                   placeholder="Enter nickname" required="required">
                                        </div>
                                        <div class="form-group">
                                            <label for="eMail">Email</label>
                                            <input v-model="u.xemail" type="email" class="form-control" id="eMail"
                                                   placeholder="Enter email ID" required="required">
                                        </div>
                                        <div class="form-group">
                                            <label for="phone">Phone</label>
                                            <input disabled="disabled" :value="u.xphone" type="text"
                                                   class="form-control" id="phone"
                                                   placeholder="Enter phone number">
                                        </div>
                                        <div class="form-group">
                                            <label for="xquali">Qualification</label>
                                            <select id="xquali" v-model="u.xquali" class="form-control">
                                                <option :value="null" selected>--Choose--</option>
                                                <option value="SSCE">SSCE</option>
                                                <option value="ND">ND</option>
                                                <option value="HND">HND</option>
                                                <option value="DEGREE">DEGREE</option>
                                                <option value="MSC">MSC</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="website3">Date Of Birth</label>
                                            <input type="url" v-model="u.xdob" class="form-control" id="website3"
                                                   placeholder="Date Of Birth" required="required">
                                        </div>
                                        <div class="form-group">
                                            <label for="website">Social Link</label>
                                            <input type="url" v-model="u.xsocial" class="form-control" id="website"
                                                   placeholder="Social url" required="required">
                                        </div>
                                    </div>
                                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                        <div class="form-group">
                                            <label for="addRess">Address</label>
                                            <input v-model="u.xaddress" type="text" class="form-control" id="addRess"
                                                   placeholder="Enter Address">
                                        </div>
                                        <div class="form-group">
                                            <label for="ciTy">City</label>
                                            <input v-model="u.xcity" type="text" class="form-control" id="ciTy"
                                                   placeholder="Enter City">
                                        </div>
                                        <div class="form-group">
                                            <label for="sTate">State</label>
                                            <input v-model="u.xstate" type="text" class="form-control" id="sTate"
                                                   placeholder="Enter State">
                                        </div>
                                        <div class="form-group">
                                            <label for="zIp">Ref No.</label>
                                            <input disabled="disabled" :value="u.xcode+'/'+a.acode" type="text"
                                                   class="form-control" id="zIp"
                                                   placeholder="Ref. No">
                                        </div>
                                        <div class="col-12">
                                            <div class="info-stats4">
                                                <div class="info-icon">
                                                    <i class="icon-eye1"></i>
                                                </div>
                                                <div class="sale-num">
                                                    <h3><?php echo number_format(count($votes)) ?></h3>
                                                    <p>Total Vote</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                        <div class="text-right">
                                            <a href="status" type="button" id="submit" name="submit" class="btn btn-white">Public
                                                Status
                                            </a>
                                            <button @click="updateInfo" type="button" id="submit" name="submit"
                                                    class="btn btn-primary">
                                                Update Info
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Row end -->
            <?php } ?>
        </div>
        <!-- Main container end -->

    </div>
    <!-- Page content end -->

</div>
<!-- Page wrapper end -->

<?php include "foot.php" ?>
<script>
    //logout
    function logOut() {
        swal("Are you sure ?", "You want to logout from your application ?", {buttons: {cancel: 'No', yes: true}})
            .then(function (res) {
                if (res) {
                    window.location.href = BASE_URL + "/logout";
                }
            });
    }
    //copy to clipboard
    function copyToClipboard(text) {
        var input = document.createElement('textarea');
        input.innerHTML = text;
        document.body.appendChild(input);
        input.select();
        var result = document.execCommand('copy');
        document.body.removeChild(input);
        $.notify(text + " Copied !", "success");
        return result;
    }
    function randNum() {
        return Math.floor(Math.random() * 9999 + 1)
    };
    var money = new Intl.NumberFormat('en-US', {
        style: 'currency',
        currency: 'NGN'
    });
    var vue = new Vue({
        el: '#app',
        data: {
            uploading: 'Upload Image',
            u: _contest,
            a: _auth,
            c: _company,
            loading: false,
            pin: '',
            data: {xname: '', xemail: '', xphone: '', xextra: '', xamount: 0},
            extra: [],
            auth: {},
            success: false
        },
        methods: {
            payAuth: _tempAuth,
            extraCall: function (event, selectedIndex) {
                var child = vue.extra[selectedIndex - 1];
                vue.data.xamount = child.amount;
            },
            payNow: payWithPaystack,
            copyText: copyToClipboard,
            updateInfo: _updateInfo
        }
    });
    //update functions
    function _updateInfo() {
        $.notify("Updating your info...", "info");
        axios.post('api/web-api/update-info', vue.u).then(function (res) {
            var d = res.data;
            if (res.data.status) window.location.reload();
        })
    }
    //more function
    function _tempAuth() {
        if (this.pin < 1) {
            return;
        }
        if (this.pin.length < 10) {
            swal("Bad PIN Format", "Pin number format is bad", "error");
            return;
        }
        axios.post('api/web-api/auth-pin', {pin: this.pin}).then(function (res) {
            var data = res.data;
            var auth = data.data.auth;
            var contest = data.data.contestant;
            if (!data.status) {
                swal("Invalid PIN", data.msg, "error");
                return;
            }
            //registration completed
            if (contest !== null && Object.keys(contest).length > 0 && parseInt(auth.astatus) === 1) {
                //login to page
                window.location.reload();
                return;
            }
            //do auto login
            if (parseInt(auth.astatus) === 1 && auth.amethod != 'unpaid') {
                vue.data = contest;
                return;
            }
            //assign data
            vue.auth = auth;
            vue.extra = JSON.parse(auth.cextra);
            vue.success = true;
        }).catch(function (err) {
            //RDX295531599381656
            swal("Bad Network", "Unable to login at the moment", "error");
        });
    }

    //pay with paystack
    function payWithPaystack() {
        //check compulsory fileds
        if (vue.auth.aamount === '' && vue.data.xemail === '') {
            swal("Field is missing...", "Please check the compulsory field(s) and try again", "info");
            return;
        }
        //put useful
        vue.data.xphone = vue.auth.aphone;
        vue.data.xname = vue.auth.aname;
        //run paystack handler
        var handler = PaystackPop.setup({
            key: 'pk_test_e424008abf7de5e5c6221c5a33f82ab514b11cd7',
            amount: (parseInt(vue.auth.aamount) + parseInt(vue.data.xamount)) * 100,
            currency: "NGN",
            email: vue.data.xemail,
            ref: '' + Math.floor((Math.random() * 1000000000) + 1), // generates a pseudo-unique reference. Please replace with a reference you generated. Or remove the line entirely so our API will generate one for you
            metadata: {
                custom_fields: [{
                    pin: vue.pin,
                    extra: vue.data
                }]
            },
            callback: function (response) {
                swal("Payment Successful", "The page will be automatically reloaded, kindly re-enter your PIN to verify and continue", "success");
                setTimeout(function () {
                    window.location.reload();
                }, 2000);
            },
            onClose: function () {
                swal("Payment Was Canceled", "You can also retry or contact us for help", "error");
            }
        });
        handler.openIframe();
    }
</script>
<script src="js/fol.js"></script>
</body>

</html>