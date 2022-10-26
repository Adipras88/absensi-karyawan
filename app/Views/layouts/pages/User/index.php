<?= $this->extend('layouts/base_employee') ?>

<?= $this->section('content') ?>
    <section>
        <div class="text-center">
            <h3 class="greeting"></h3>
            <?php if ($isLoggedIn) : ?>
                <span style="background-color: green; color: white; padding: 4px; border-radius: 10px">You are absent today, Enjoy your work!</span>
            <?php else : ?>
                <span style="background-color: red; color: white; padding: 4px; border-radius: 10px">You are not absent today!</span>
            <?php endif; ?>
        </div>
    </section>

<?php if (session()->getFlashData('index')) : ?>
    <div class="alert alert-success" role="alert">
        <?php echo session("index") ?>
    </div>
<?php endif; ?>

    <section class="mt-4">
        <div class="row">
            <div class="col">
                <a class="card card-menu stretched-link text-decoration-none" href="/user/absent">
                    <div class="card-body text-center">
                        <div class="column justify-content-center">
                            <i class="bi bi-box-arrow-in-right mt-1 mr-3"
                               style="font-size: 32px; color: #6610f2"></i>
                            <h5 class="title text-center m-0 pt-3" style="color: #5e5e5e">Check In</h5>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col">
                <a class="card card-menu stretched-link text-decoration-none" href="/user/report">
                    <div class="card-body text-center">
                        <div class="column justify-content-center">
                            <i class="bi bi-box-arrow-left mt-1 mr-3" style="font-size: 32px; color: #6610f2"></i>
                            <h5 class="title text-center m-0 pt-3" style="color: #5e5e5e">Check Out</h5>
                        </div>
                    </div>
                </a>
            </div>
        </div>

        <div class="row mt-4">
            <div class="col">
                <a class="card card-menu stretched-link text-decoration-none" href="/user/report/list">
                    <div class="card-body text-center">
                        <div class="column justify-content-center">
                            <i class="bi bi-list-task mt-1 mr-3" style="font-size: 32px; color: #6610f2"></i>
                            <h5 class="title text-center m-0 pt-3" style="color: #5e5e5e">Daily Report</h5>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col">
                <a class="card card-menu stretched-link text-decoration-none" href="/user/profile">
                    <div class="card-body text-center">
                        <div class="column justify-content-center">
                            <i class="bi bi-file-person mt-1 mr-3" style="font-size: 32px; color: #6610f2"></i>
                            <h5 class="title text-center m-0 pt-3" style="color: #5e5e5e">Profile</h5>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </section>

    <script>
        $(document).ready(function () {
            function dateTime() {
                var ndate = new Date();
                var hours = ndate.getHours();
                var message = hours < 12 ? `Good Morning, <?= session()->get('fullname') ?>` : hours < 18 ? `Good Afternoon, <?= session()->get('fullname') ?>` : `Good Evening, <?= session()->get('fullname') ?>`;
                $(".greeting").text(message);
            }

            setInterval(dateTime, 100);
        });

        $(".alert").fadeTo(2000, 500).slideUp(500, function () {
            $(".alert").slideUp(500);
        });
    </script>
<?= $this->endSection() ?>