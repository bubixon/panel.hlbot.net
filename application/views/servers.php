<div class="content-wrapper">
    <!-- START PAGE CONTENT-->
    <div class="page-heading">
        <h1 class="page-title">Lista Serwerów</h1>
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="index.html"><i class="la la-home font-20"></i></a>
            </li>
        </ol>
    </div>
    <div class="page-content fade-in-up">
        <div class="ibox">
            <div class="ibox-head">
                <div class="ibox-title">Lista przedstawia serwery wspierane przez hlbota</div>
            </div>
            <div class="ibox-body">
                <table class="table table-striped table-bordered table-hover" id="example-table" cellspacing="0" width="100%">
                    <thead>
                    <tr>
                        <th>Nazwa</th>
                        <th>Link do strony</th>
                        <th>Status</th>
                        <th>Dodano</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach($servers as $server) : ?>
                    <tr>
                        <td><?php echo $server['server_name']; ?></td>
                        <td><a href="<?php echo $server['server_url']; ?>"><?php echo $server['server_url']; ?></a></td>
                        <?php if ($server['server_status'] == "on") : ?>
                        <td><p class="text-success"><i class="fas fa-sync fa-spin"></i> Działa</p></td>
                        <?php elseif ($server['server_status'] == "off") : ?>
                        <td><p class="text-danger"><i class="fas fa-spinner fa-pulse"></i> Nie Działa</p></td>
                        <?php elseif ($server['server_status'] == "tec") : ?>
                        <td><p class="text-warning"><i class="fas fa-cog fa-spin"></i> Prace Techniczne</p></td>
                        <?php endif; ?>
                        <td><?php echo $server['date']; ?></td>
                    </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
