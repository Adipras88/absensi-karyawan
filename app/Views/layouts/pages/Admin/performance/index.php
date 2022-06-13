<?= $this->extend('layouts/app') ?>

<?= $this->section('content') ?>
<div class="container-fluid">
    <div class="d-sm-flex flex-column mb-4">
        <h1 class="h3 mb-3 text-gray-800">Performance Employee</h1>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/admin/dashboard">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Performances
                </li>
            </ol>
        </nav>
    </div>

    <?php if (session()->getFlashData('success_performance')) : ?>
        <div class="alert alert-success" role="alert">
            <?php echo session("success_performance") ?>
        </div>
    <?php endif; ?>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped" id="table">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Employee</th>
                            <th>Description Performance Employee</th>
                            <th>Score</th>
                            <th>Date Created</th>
                            <th>Action</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php $i = 1; ?>
                        <?php foreach ($performance as $p) : ?>
                            <tr>
                                <td><?= $i++ ?></td>
                                <td><?= $p['fullname'] ?></td>
                                <td><?= $p['description'] ?></td>
                                <td><?= $p['score'] ?></td>
                                <td><?= date_format(date_create($p['created_at']), 'd M Y H:i') ?></td>
                                <td>
                                    <a class="btn btn-info btn-sm" href="<?php echo base_url(); ?>/admin/performance/edit/<?= $p['performanceId'] ?>"><i class="bi bi-pencil-square"></i></a>
                                    <a class="btn btn-warning btn-sm" href="<?= base_url(); ?>/admin/performance/detail/<?= $p['performanceId'] ?>"><i class="bi bi-eye-fill"></i></a>
                                    <button class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#deleteModal<?= $p['performanceId'] ?>"><i class="bi bi-trash-fill"></i></button>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Modal Delete -->
    <?php foreach ($performance as $p) : ?>
        <div class="modal fade" id="deleteModal<?= $p['performanceId'] ?>" data-bs-backdrop="static" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-body text-center">
                        <h3>Are you sure?</h3>
                        Do you really delete this data?
                        </br>
                        <div class="pt-3">
                            <button type="button" class="btn btn-secondary m-2" data-bs-dismiss="modal">No</button>
                            <form class="d-inline" method="post" action="<?= base_url(); ?>/admin/performance/delete/<?= $p['performanceId'] ?>">
                                <?= csrf_field() ?>
                                <input type="hidden" name="_method" value="DELETE">
                                <button type="submit" class="btn btn-danger m-2">Yes</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
</div>
<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script type="text/javascript">
    $(document).ready(function() {
        $('#table').DataTable({
            // "dom": 'QBflrtip',
            "dom": `Q
                <'row mt-3'
                    <'col-sm-12 col-md-4'l>
                    <'col-sm-12 col-md-8'
                        <'row'
                            <'col-sm-12 col-md-9'f>
                            <'col-sm-12 col-md-3'B>
                        >
                    >
                >
                ` +
                "<'row'<'col-sm-12'tr>>" +
                "<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>",
            "responsive": true,
            "paging": true,
            "ordering": true,
            "info": true,
            "buttons": [
                'excel',
                {
                    text: 'Create',
                    action: function(e, dt, node, config) {
                        window.location.href = '/admin/performance/create'
                    }
                }
            ]
        });
    });

    $(".alert").fadeTo(2000, 500).slideUp(500, function() {
        $(".alert").slideUp(500);
    });
</script>
<?= $this->endSection() ?>