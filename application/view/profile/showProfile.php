<div id="main" class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
    <?php $this->renderFeedbackMessages(); ?>
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">ProfileController/showProfile/:id</h1>
        </div>
    </div>
    <!--/.row-->

    <div class="row">
        <div class="col-xs-12 col-md-12 col-lg-12">
            <h3>What happens here ?</h3>

            <div>This controller/action/view shows all public information about a certain user.</div>

            <?php if ($this->user) { ?>
                <div>
                    <table class="overview-table">
                        <thead>
                        <tr>
                            <td>Id</td>
                            <td>Avatar</td>
                            <td>Username</td>
                            <td>User's email</td>
                            <td>Activated ?</td>
                        </tr>
                        </thead>
                        <tbody>
                        <tr class="<?= ($this->user->user_active == 0 ? 'inactive' : 'active'); ?>">
                            <td><?= $this->user->user_id; ?></td>
                            <td class="avatar">
                                <?php if (isset($this->user->user_avatar_link)) { ?>
                                    <img src="<?= $this->user->user_avatar_link; ?>"/>
                                <?php } ?>
                            </td>
                            <td><?= $this->user->user_name; ?></td>
                            <td><?= $this->user->user_email; ?></td>
                            <td><?= ($this->user->user_active == 0 ? 'No' : 'Yes'); ?></td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            <?php } ?>

        </div>
    </div>
    <!--/.row-->
</div>

