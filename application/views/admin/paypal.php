<div class="content-wrapper">
    <!-- START PAGE CONTENT-->
    <div class="page-heading">
        <h1 class="page-title">PayPal - Log</h1>
    </div>
    <div class="page-content fade-in-up">
        <div class="ibox">
            <div class="ibox-body">
                <table class="table table-striped table-bordered table-hover" id="example-table" cellspacing="0" width="100%">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>UserId</th>
                        <th>Kwota</th>
                        <th>Status</th>
                        <th>Data</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($payments as $payment) : ?>
                    <tr>
                        <td><?php echo $payment['id']; ?></td>
                        <td><?php echo $payment['userId']; ?></td>
                        <td><?php echo $payment['price']; ?></td>
                        <td class="text-<?php echo $payment['status'] == "ok" ? 'success' : ($payment['status'] == "new" ? "info" : "danger"); ?>"><?php echo $payment['status'] == "ok" ? 'Zakończona' : ($payment['status'] == "new" ? "Nowa" : "Błąd"); ?></td>
                        <td><?php echo $payment['date']; ?></td>
                    </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
