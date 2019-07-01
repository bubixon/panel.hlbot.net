<div class="content-wrapper">
    <!-- START PAGE CONTENT-->
    <div class="page-heading">
        <h1 class="page-title">Użytkownicy</h1>
    </div>
    <div class="page-content fade-in-up">
        <?php echo viewMessage(); ?>
        <div class="ibox">
            <div class="ibox-body">
                <table class="table table-striped table-bordered table-hover" id="example-table" cellspacing="0" width="100%">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>E-mail</th>
                        <th>Data Rejestracji</th>
                        <th>Status</th>
                        <th>Licencja do</th>
                        <th>Akcje</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($users as $user): ?>
                    <tr>
                        <td><?php echo $user['user_id']; ?></td>
                        <td><?php echo $user['email']; ?></td>
                        <td><?php echo $user['register_date']; ?></td>
                        <td class="text-<?php echo $user['status'] == "ok" ? "success" : "danger"; ?>"><?php echo $user['status'] == "ok" ? "OK" : "Zablokowany"; ?></td>
                        <td><?php echo $user['license_id'] > 0 ? $user['l_end_date'] : "Brak"; ?></td>
                        <td>
                            <div class="btn-group m-b-10">
                                <a href="<?php echo base_url('/admin/users/unblock/' . $user['user_id']); ?>" role="button" class="btn btn-success"><i class="fas fa-unlock-alt"></i> Odblokuj</a>
                                <a href="<?php echo base_url('/admin/users/block/' . $user['user_id']); ?>" role="button" class="btn btn-danger"><i class="fas fa-user-lock"></i> Zablokuj</a>
                                <a href="<?php echo base_url('/admin/users/dLicense/' . $user['user_id']); ?>" role="button" class="btn btn-info"><i class="fas fa-unlock-alt"></i> Usuń licencję</a>
                            </div>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
