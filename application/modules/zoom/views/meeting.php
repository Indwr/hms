<!DOCTYPE html>
<head>
    <base href="<?php echo base_url(); ?>">
    <title><?php echo 'Live Zoom Meeting'; ?> - <?php echo $this->db->get('settings')->row()->system_vendor;?></title>
    <meta charset="utf-8" />
    <link type="text/css" rel="stylesheet" href="https://source.zoom.us/1.7.7/css/bootstrap.css" />
    <link type="text/css" rel="stylesheet" href="https://source.zoom.us/1.7.7/css/react-select.css" />
    <meta name="format-detection" content="telephone=no">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
	<!-- Favicon --> 
    <link rel="shortcut icon" href="<?php echo $this->db->get('settings')->row()->favicon;?>">
</head>
<body>

    <?php
    $meeting_details = $this->db->get_where('meeting', array('id' => $live_id))->row();
    $topic = $meeting_details->topic;
    $doctor = $meeting_details->doctorname;
    $patient = $meeting_details->patientname;
    
    $settings = $this->settings_model->getSettings();
    $hospital = $settings->system_vendor;
    ?>

    <nav id="nav-tool" class="navbar navbar-inverse navbar-fixed-top">
        <div class="container">
            <div class="navbar-header">
                <h4><i class="fa fa-chromecast"></i> <?php echo 'Live Zoom Meeting with ' . $doctor; ?> </h4>
            </div>
            <div class="navbar-form navbar-right">
                <?php if ($this->ion_auth->in_group('Patient')) { ?>
                    <h5><i class="far fa-user-circle" style=""></i> <?php echo lang('doctor'); ?> : <?php echo $doctor; ?></h5>
                <?php } ?>
                <?php if ($this->ion_auth->in_group('Staff')) { ?>
                    <h5><i class="far fa-user-circle" style=""></i> <?php echo lang('patient'); ?> : <?php echo $patient; ?>  </h5>
                <?php } ?>
            </div>
        </div>
    </nav>

    <style type="text/css">
        body {
            padding-top: 50px;
        }
        .navbar-inverse {
            background-color: #313131;
            border-color: #404142;
        }
        .navbar-header h4 {
            margin: 0;
            padding: 15px 15px;
            color: #c4c2c2;
        }
        .navbar-right h5 {
            margin: 0;
            padding: 9px 5px;
            color: #c4c2c2;
        }
        .navbar-inverse .navbar-collapse, .navbar-inverse .navbar-form{
            border-color: transparent;
        }
    </style>




    <!-- import ZoomMtg dependencies -->
    <script src="https://source.zoom.us/1.7.7/lib/vendor/react.min.js"></script>
    <script src="https://source.zoom.us/1.7.7/lib/vendor/react-dom.min.js"></script>
    <script src="https://source.zoom.us/1.7.7/lib/vendor/redux.min.js"></script>
    <script src="https://source.zoom.us/1.7.7/lib/vendor/redux-thunk.min.js"></script>
    <script src="https://source.zoom.us/1.7.7/lib/vendor/jquery.min.js"></script>
    <script src="https://source.zoom.us/1.7.7/lib/vendor/lodash.min.js"></script>

    <!-- import ZoomMtg -->
    <script src="https://source.zoom.us/zoom-meeting-1.7.7.min.js"></script>
    <script>
        ZoomMtg.preLoadWasm();
        ZoomMtg.prepareJssdk();
        var meetConfig = {
            apiKey: "<?php echo $api_key ?>",
            apiSecret: "<?php echo $api_secret ?>",
            meetingNumber: <?php echo $meeting_id ?>,
            userName: "<?php echo $this->ion_auth->user()->row()->username; ?>",
            passWord: "<?php echo $meeting_password ?>",
            leaveUrl: "<?php echo base_url(); ?>zoom/meeting",
            role: 1
        };
        var signature = ZoomMtg.generateSignature({
            meetingNumber: meetConfig.meetingNumber,
            apiKey: meetConfig.apiKey,
            apiSecret: meetConfig.apiSecret,
            role: meetConfig.role,
            success: function (res) {
                console.log(res.result);
            }
        });
        ZoomMtg.init({
            leaveUrl: meetConfig.leaveUrl,
            isSupportAV: true,
            success: function () {
                ZoomMtg.join(
                        {
                            meetingNumber: meetConfig.meetingNumber,
                            userName: meetConfig.userName,
                            signature: signature,
                            apiKey: meetConfig.apiKey,
                            passWord: meetConfig.passWord,
                            success: function (res) {
                                $('#nav-tool').hide();
                            },
                            error: function (res) {
                                console.log(res);
                            }
                        }
                );
            },
            error: function (res) {
                console.log(res);
            }
        });
    </script>
</body>
</html>
