<!DOCTYPE html>
<html>
<head>
    <?php if(Config::get('CASTLE_ENABLED')) { ?>
        <script type="text/javascript">
            (function (e, t, n, r) {
                function i(e, n) {
                    e = t.createElement("script");
                    e.async = 1;
                    e.src = r;
                    n = t.getElementsByTagName("script")[0];
                    n.parentNode.insertBefore(e, n)
                }

                e[n] = e[n] || function () {
                    (e[n].q = e[n].q || []).push(arguments)
                };
                e.attachEvent ? e.attachEvent("onload", i) : e.addEventListener("load", i, false)
            })(window, document, "_castle", "//d2t77mnxyo7adj.cloudfront.net/v1/c.js");
            _castle('setAccount', '<?php echo Config::get('CASTLE_ID'); ?>');
            <?php if(Session::get('user_logged_in')) { ?>
            _castle('setUser', {
                id: <?php echo Session::get('user_id'); ?>, // required
                name: '<?php echo Session::get('user_name'); ?>', // optional
                email: '<?php echo Session::get('user_email')?>' // optional
            });
            <?php } ?>
            _castle('trackPageview');
        </script>
    <?php } ?>
</head>