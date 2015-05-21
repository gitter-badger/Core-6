<script src="<?php echo URL; ?>js/jquery.js" type="text/javascript"></script>
<script src="<?php echo URL; ?>js/bootstrap.min.js" type="text/javascript"></script>
<script src="<?php echo URL; ?>js/smoothState.js" type="text/javascript"></script>
<script src="<?php echo URL; ?>js/smoothStateData.js" type="text/javascript"></script>
<!-- Bootgrid js -->
<script src="<?php echo URL; ?>js/jquery.bootgrid.js" type="text/javascript"></script>
<!-- Timeago js -->
<script src="<?php echo URL; ?>js/timeago.js" type="text/javascript"></script>
<script>
    !function ($) {
        $(document).on("click", "ul.nav li.parent > a > span.icon", function () {
            $(this).find('em:first').toggleClass("glyphicon-minus");
        });
        $(".sidebar span.icon").find('em:first').addClass("glyphicon-plus");
    }(window.jQuery);

    $(window).on('resize', function () {
        if ($(window).width() > 768) $('#sidebar-collapse').collapse('show')
    });
    $(window).on('resize', function () {
        if ($(window).width() <= 767) $('#sidebar-collapse').collapse('hide')
    })
</script>
<!-- timeago start functions -->
<script type="text/javascript">
    jQuery(document).ready(function () {
        jQuery("abbr.timeago").timeago();
    });
</script>

<script type="text/javascript">

    $("#grid").bootgrid();
</script>
</body>

</html>