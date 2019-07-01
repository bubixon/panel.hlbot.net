<div class="content-wrapper">
    <!-- START PAGE CONTENT-->
    <div class="page-heading">
        <h1 class="page-title">PaySafeCard Admin</h1>
    </div>
    <div class="page-content fade-in-up">
        <?php echo viewMessage(); ?>
        <div class="ibox">
            <div class="ibox-body">
                <table class="table table-striped table-bordered table-hover" id="example-table" cellspacing="0" width="100%">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>ID Konta</th>
                        <th>Pakiet</th>
                        <th>Kody PSC</th>
                        <th>Status</th>
                        <th>Data</th>
                        <th>Akcje</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($payments as $payment): ?>
                    <tr>
                        <td><?php echo $payment['id']; ?></td>
                        <td><?php echo $payment['userId']; ?></td>
                        <td><?php echo $payment['serviceId']; ?>/<?php echo $payment['price']; ?> PLN</td>
                        <td><?php echo $payment['code1']; ?> <?php echo $payment['code2']; ?> <?php echo $payment['code3']; ?></td>
                        <td class="text-<?php echo $payment['status'] == "new" ? "info" : ($payment['status'] == "ok" ? "success" : "danger"); ?>"><?php echo $payment['status'] == "new" ? "Płatność nowa" : ($payment['status'] == "ok" ? "Płatność zakończona (OK)" : "Płatność zakończona (BAD)"); ?></td>
                        <td><?php echo $payment['date']; ?></td>
                        <td>
                            <div class="btn-group m-b-10">
                                <a href="<?php echo base_url('/admin/paysafecard/accept/' . $payment['id']); ?>" role="button" class="btn btn-success"><i class="fas fa-check"></i> Zrealizowana Płatność</a>
                                <a href="<?php echo base_url('/admin/paysafecard/badCode/' . $payment['id']); ?>" role="button" class="btn btn-danger"><i class="fas fa-times-circle"></i> Błędny Kod</a>
                                <a href="<?php echo base_url('/admin/paysafecard/badFunds/' . $payment['id']); ?>" role="button" class="btn btn-warning"><i class="fas fa-hand-holding-usd"></i> Niewystarczające Środki</a>
                            </div>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
