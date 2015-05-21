<div id="main" class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
    <?php $this->renderFeedbackMessages(); ?>
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Overview Page</h1>
        </div>
    </div>
    <!--/.row-->

    <div class="row">
        <div class="col-xs-12 col-md-12 col-lg-12">
            <a class="btn btn-default" href="<?php echo URL; ?>item/nieuw" role="button">Nieuw item</a>
            <!--div class="table-responsive"-->
            <table id="grid" data-toggle="bootgrid" data-ajax="true" data-url="<?php echo URL; ?>data/overview"
                   class="table table-condensed table-hover table-striped">
                <thead>
                <tr>
                    <th data-column-id="id" data-identifier="true" data-type="numeric" data-align="left">ID</th>
                    <th data-column-id="name" data-order="asc" data-align="center" data-header-align="center">naam</th>
                    <th data-column-id="needed" data-type="numeric" data-order="asc" data-align="center"
                        data-header-align="center">benodigd
                    </th>
                    <th data-column-id="aanwezig" data-type="numeric" data-order="asc" data-align="center"
                        data-header-align="center">aanwezig
                    </th>
                    <th data-column-id="over" data-type="numeric" data-order="asc" data-align="center"
                        data-header-align="center">saldo
                    </th>
                    <th data-column-id="programma" data-css-class="cell" data-header-css-class="column"
                        data-filterable="true">programma
                    </th>
                    <th data-column-id="link" data-formatter="link" data-sortable="false">Link</th>
                </tr>
                </thead>
            </table>
            <!--/div-->
        </div>
    </div>
    <!--/.row-->
</div>
