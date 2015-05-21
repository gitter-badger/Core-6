<div id="main" class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
    <?php $this->renderFeedbackMessages(); ?>
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Dashboard</h1>
        </div>
    </div>
    <!--/.row-->

    <div class="row">
        <div class="col-xs-12 col-md-12 col-lg-12">
            <div class="row row-eq-height">
                <div class="col-md-4">
                    <div class="panel panel-blue" style="height:100%">
                        <div class="panel-heading dark-overlay">
                            The database:
                        </div>
                        <div class="panel-body">
                            <table style="text-align: center; width: 100%;">
                                <tr>
                                    <th>Category's</th>
                                    <th>Totale hoeveelheid</th>
                                    <th>Status</th>
                                </tr>
                                <tr>
                                    <td>items</td>
                                    <td><?php echo $this->item_count; ?></td>
                                    <td><?php if ($this->item_count <= 0) { ?>
                                            <span class='label label-danger'><i class='fa fa-exclamation-triangle'></i></span>
                                        <?php } else { ?>
                                            <span class='label label-success'><i class='fa fa-check'></i></span>
                                        <?php } ?>
                                    </td>

                                </tr>
                                <tr>
                                    <td>status</td>
                                    <td><?php echo $this->status_count; ?></td>
                                    <td><?php if ($this->status_count < $this->item_count) { ?>
                                            <span class='label label-danger'><i class='fa fa-exclamation-triangle'></i></span>
                                        <?php } else { ?>
                                            <span class='label label-success'><i class='fa fa-check'></i></span>
                                        <?php } ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td>location</td>
                                    <td><?php echo $this->location_count; ?></td>
                                    <td><?php if ($this->location_count < $this->item_count) { ?>
                                            <span class='label label-danger'><i class='fa fa-exclamation-triangle'></i></span>
                                        <?php } else { ?>
                                            <span class='label label-success'><i class='fa fa-check'></i></span>
                                        <?php } ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td>utilization</td>
                                    <td><?php echo $this->utilization_count; ?></td>
                                    <td><?php if ($this->utilization_count < $this->item_count) { ?>
                                            <span class='label label-danger'><i class='fa fa-exclamation-triangle'></i></span>
                                        <?php } else { ?>
                                            <span class='label label-success'><i class='fa fa-check'></i></span>
                                        <?php } ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td>count</td>
                                    <td><?php echo $this->count_count; ?></td>
                                    <td><?php if ($this->count_count < $this->item_count) { ?>
                                            <span class='label label-danger'><i class='fa fa-exclamation-triangle'></i></span>
                                        <?php } else { ?>
                                            <span class='label label-success'><i class='fa fa-check'></i></span>
                                        <?php } ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td>leveranciers</td>
                                    <td><?php echo $this->lev_count; ?></td>
                                    <td><?php if ($this->lev_count < $this->item_count) { ?>
                                            <span class='label label-danger'><i class='fa fa-exclamation-triangle'></i></span>
                                        <?php } else { ?>
                                            <span class='label label-success'><i class='fa fa-check'></i></span>
                                        <?php } ?>
                                    </td>
                                </tr>

                            </table>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="panel panel-blue" style="height:100%">
                        <div class="panel-heading dark-overlay">
                            Quick links:
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <form id="lookup_id" class="form-inline" action="<?php echo URL; ?>search"
                                      method="post">
                                    <div class="form-group">
                                        <div class="col-md-12">
                                            <label for="item_id">Lookup item (id)</label>
                                            <input style="width:65%" type="number" class="form-control" id="item_id"
                                                   placeholder="1">
                                            <button type="submit" class="btn btn-default">Go <i
                                                    class="fa fa-angle-double-right"></i></button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="row">
                                <form id="lookup_name" class="form-inline" action="<?php echo URL; ?>search"
                                      method="post">
                                    <div class="form-group">
                                        <div class="col-md-12">
                                            <label for="item_name">Lookup item (name)</label>
                                            <input style="width:65%" type="text" class="form-control" id="item_name"
                                                   placeholder="pen">
                                            <button type="submit" class="btn btn-default">Go <i
                                                    class="fa fa-angle-double-right"></i></button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="row" style="text-align:center; margin-top: 5%;">
                                <a style="width:80%;" class="btn btn-default" href="<?php echo URL ?>item/nieuw"
                                   role="button">Nieuw item</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="panel panel-blue" style="height:100%;">
                        <div class="panel-heading dark-overlay"><span class="glyphicon glyphicon-check"></span>Log</div>
                        <div class="panel-body">
                            <ul class="todo-list">
                                <?php foreach (LogModel::getLog(5) as $key => $value) { ?>
                                    <li class="todo-list-item">
                                        <div class="pull-left">
                                            <a href="<?php echo URL; ?>profile/showprofile/<?php echo $value['user_id']; ?>">
                                                <i class="fa fa-user"></i>
                                                <?php echo UserModel::getUsernameById($value['user_id']); ?>
                                            </a>
                                        </div>
                                        <div class="text" style="margin-left:15%;">
                                            <?php if ($value['action'] == "debug") { ?>
                                                Did some debug testing.
                                            <?php } elseif ($value['action'] == "create_item") { ?>
                                                Created a item.
                                            <?php } elseif ($value['action'] == "recount") { ?>
                                                Did a recount on a item.
                                            <?php } elseif ($value['action'] == "delete_item") { ?>
                                                Deleted a item.
                                            <?php } elseif ($value['action'] == "update_item") { ?>
                                                Updated a item.
                                            <?php } ?>
                                        </div>
                                        <div class="pull-right action-buttons">
                                            <a href="<?php echo URL; ?>log/focus/<?php echo $value['ENTRY_ID']; ?>">
                                                <abbr class="timeago" title="<?php echo $value['ENTRY_ID']; ?>"></abbr>
                                            </a>
                                        </div>
                                    </li>
                                <?php } ?>
                            </ul>
                        </div>
                        <!-- end panel -->
                    </div>
                    <!--/.col-->
                </div>
            </div>
            <div class="row" style="margin-top:2%;">
                <div class="col-md-12">
                    <div class="panel panel-teal">
                        <div class="panel-heading dark-overlay">Something has to go here. but i dont know what!</div>
                        <div class="panel-body">
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque ut ante in sapien
                                blandit luctus sed ut lacus. Phasellus urna est, faucibus nec ultrices placerat, feugiat
                                et ligula. Donec vestibulum magna a dui pharetra molestie. Fusce et dui urna.</p>

                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque ut ante in sapien
                                blandit luctus sed ut lacus. Phasellus urna est, faucibus nec ultrices placerat, feugiat
                                et ligula. Donec vestibulum magna a dui pharetra molestie. Fusce et dui urna.</p>
                        </div>
                    </div>
                </div>
                <!--/.col-->
            </div>
        </div>
    </div>
    <!--/.row-->
</div>



