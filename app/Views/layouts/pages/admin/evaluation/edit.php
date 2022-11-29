<?= $this->extend("layouts/app") ?>
<?= $this->section("content") ?>
<div class="container-fluid">

  <div class="d-sm-flex flex-column mb-4">
    <h1 class="h3 mb-3 text-gray-800">Evaluation</h1>

    <nav aria-label="breadcrumb">
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="/admin/dashboard">Home</a></li>
        <li class="breadcrumb-item"><a href="/admin/evaluation">Evaluation</a></li>
        <li class="breadcrumb-item active" aria-current="page">Edit
        </li>
      </ol>
    </nav>
  </div>

  <div class="card shadow mb-4">
    <div class="card-header d-flex align-items-center justify-content-between py-3">
      <h5 class="card-title mb-0 text-gray-900">Edit Evaluation</h5>
    </div>

    <div class="card-body mt-2">
      <form action="<?php echo base_url(); ?>/admin/evaluation/edit/submit/<?= $evaluation['evaluationId'] ?>" method="post">
        <?= csrf_field(); ?>

        <div class="col-12">
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label for="user" class="form-label">User <span style="color: red">*</span></label>
                <input disabled name="fullname" class="form-control" id="fullname" value="<?= $evaluation['fullname'] ?>">
                <input type="hidden" name="userId" value="<?= $evaluation['user_id'] ?>">
              </div>
            </div>
          </div>
        </div>

        <div class="col-12 mt-4">
          <div class="row">
            <div class="col-md-6">
              <div class="card">
                <div class="card-header">A. PERILAKU KERJA (40%)</div>
                <div class="card-body">
                  <div class="mt-3 row">
                    <label for="disiplin" class="col-sm-4 col-form-label">Disiplin</label>
                    <div class="col-sm-6">
                      <input readonly name="disiplin" type="number" min="0" max="10" class="form-control" id="disiplin" value="<?= $evaluation['disiplin'] ?>">
                    </div>
                  </div>
                  <div class="mt-3 row">
                    <label for="loyalitas" class="col-sm-4 col-form-label">Loyalitas</label>
                    <div class="col-sm-6">
                      <input name="loyalitas" type="text" min="0" max="100" class="form-control numberonly" id="loyalitas" value="<?= $evaluation['loyalitas'] ?>">
                    </div>
                  </div>
                  <div class="mt-3 row">
                    <label for="kerjasama" class="col-sm-4 col-form-label">Kerja Sama</label>
                    <div class="col-sm-6">
                      <input name="kerjasama" type="text" min="0" max="100" class="form-control numberonly" id="kerjasama" value="<?= $evaluation['kerjasama'] ?>">
                    </div>
                  </div>
                  <div class="mt-3 row">
                    <label for="perilaku" class="col-sm-4 col-form-label">Perilaku</label>
                    <div class="col-sm-6">
                      <input name="perilaku" type="text" min="0" max="100" class="form-control numberonly" id="perilaku" value="<?= $evaluation['perilaku'] ?>">
                    </div>
                  </div>
                  <div class="mt-5 row">
                    <label for="total" class="col-sm-4 col-form-label">Total</label>
                    <div class="col-sm-6">
                      <input readonly name="total_sikap" type="number" class="form-control" id="total" value="<?= $evaluation['total_sikap'] ?>">
                    </div>
                  </div>
                  <div class="mt-2 row">
                    <label for="total" class="col-sm-4 col-form-label font-bold">SCORE 40%</label>
                    <div class="col-sm-6">
                      <input readonly name="total_percentage_sikap" type="number" class="form-control" id="total_percentage_sikap" value="<?= $evaluation['total_percentage_sikap'] ?>">
                    </div>
                  </div>
                </div>
              </div>
              <button type="button" class="btn btn-info" onclick="onSubmitResultWork()">Check Nilai</button>
              <button id="submit" type="submit" class="btn btn-primary disabled">Save</button>
            </div>

            <div class="col-md-6">
              <div class="card">
                <div class="card-header">B. HASIL PEKERJAAN (60%)</div>
                <div class="card-body">
                  <?php foreach ($job_result as $key => $value) : ?>
                    <div class="multiple-form">
                      <div id="after-add-more" class="control-group mt-3 row">
                        <div class="col-sm-6">
                          <select disabled style="width: 100%" id="job_id" name="job_id[]" class="form-select" id="basicSelect">
                            <option value="">--please select--</option>
                            <?php foreach ($job as $j) : ?>
                              <option value="<?= $job_result[$key]['job_id'] ?>" selected><?= $job_result[$key]['type_of_work'] ?></option>
                            <?php endforeach; ?>
                          </select>
                        </div>
                        <div class="col-sm-6">
                          <input id="type" name="value_job_type[]" type="number" min="0" max="100" class="form-control" value="<?= $job_result[$key]['job_score'] ?>">
                          <div class="type-invalid-feedback" style="color: #dc3545; font-size: 12px"></div>
                        </div>
                      </div>
                    </div>
                  <?php endforeach; ?>

                  <div class="row" style="padding-top: 3rem">
                    <label for="total" class="col-sm-6 col-form-label">Total</label>
                    <div class="col-sm-6">
                      <input readonly name="total_working_result" class="form-control" id="total_working" value="<?= $evaluation['total_working_result'] ?>">
                    </div>
                  </div>
                  <div class="mt-2 row">
                    <label for="total" class="col-sm-6 col-form-label font-bold">SCORE 60%</label>
                    <div class="col-sm-6">
                      <input readonly name="total_percentage_working_result" class="form-control" id="total_percentage_working_result" value="<?= $evaluation['total_percentage_working_result'] ?>">
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="col-12 mt-2">
          <div class="mt-3 row">
            <label for="totalNilai" class="col-sm-2 col-form-label">Total Nilai (A+B)</label>
            <div class="col-sm-3">
              <input readonly name="totalNilai" type="number" class="form-control" id="totalNilai" value="<?= $evaluation['total'] ?>">
            </div>
          </div>
        </div>

        <div class="col-12 mt-2">
          <div class="mt-3 row">
            <label for="totalNilai" class="col-sm-2 col-form-label">Predikat</label>
            <div class="col-sm-3">
              <input readonly name="predikat" class="form-control" id="predikat" value="<?= $evaluation['predikat'] ?>">
            </div>
          </div>
        </div>

        <div class="float-end pt-3">
          <a type="button" class="btn btn-secondary" href="/admin/evaluation">Back</a>
        </div>

      </form>
    </div>
  </div>
</div>
<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script>
  $(document).ready(function() {

    // saat button remove di click control group akan didelete
    $("body").on("click", "#remove", function() {
      $(this).parents(".control-group").remove();
    });


  });

  function onSubmitResultWork() {
    $('#submit').removeClass('disabled');

    // THE FIRST FORM
    let disiplin = document.getElementById('disiplin').value;
    let loyalitas = document.getElementById('loyalitas').value;
    let kerjasama = document.getElementById('kerjasama').value;
    let perilaku = document.getElementById('perilaku').value;

    let total;
    total = Number(disiplin) + Number(loyalitas) + Number(kerjasama) + Number(perilaku);
    document.getElementById("total").value = (total / 4).toFixed(0);
    document.getElementById("total_percentage_sikap").value = (40 / 100 * document.getElementById("total").value).toFixed(0);


    // THE SECOND FORM
    const arrOfNum = [];
    // let values = $('input[name^=value_job_type]').map(function(idx, elem) {
    //   return Number($(elem).val());
    // }).get();

    // values.forEach(str => {
    //   arrOfNum.push(Number(str));
    // });

    // const totalWorking = arrOfNum.reduce((acc, curr) => acc + curr);

    let totalWorking = 0;
    $("input[name='value_job_type[]']").each(function() {
      $(this).val($(this).val());
      totalWorking = totalWorking + parseInt($(this).val(), 10);
    });

    console.log(totalWorking);
    // const totalWorking = arrOfNum.reduce((acc, curr) => acc + curr);
    let sum = $(".multiple-form").length;
    console.log("Total " + totalWorking);
    console.log("Total " + (sum));
    let totalPercentageWorking = (60 / 100) * (totalWorking / sum);

    $("#total_working").val(totalWorking);
    $("#total_percentage_working_result").val(totalPercentageWorking.toFixed(0));
    let percentageWorking = document.getElementById("total_percentage_working_result").value;
    let percentageSikap = document.getElementById("total_percentage_sikap").value;

    const res = Number(percentageSikap) + Number(percentageWorking);
    document.getElementById("totalNilai").value = res;

    if (res) {
      if (res >= 90) {
        document.getElementById("predikat").value = 'SANGAT BAIK'
      } else if (res >= 75) {
        document.getElementById("predikat").value = 'BAIK'
      } else if (res >= 60) {
        document.getElementById("predikat").value = 'CUKUP'
      } else if (res < 60) {
        document.getElementById("predikat").value = 'KURANG'
      }
    }
  };

  let maximum = new RegExp('^[1-9][0-9]?$|^100$');

  $("#disiplin").change(function() {
    let disiplin = document.getElementById('disiplin').value;
    if (!maximum.test(disiplin)) {
      $(this).addClass('is-invalid');
      $('.disiplin-invalid-feedback').text("Max 100!");
    } else {
      $(this).removeClass('is-invalid')
      $('.disiplin-invalid-feedback').remove();
    }
  })

  $("#loyalitas").change(function() {
    let loyalitas = document.getElementById('loyalitas').value;
    if (!maximum.test(loyalitas)) {
      $(this).addClass('is-invalid');
      $('.loyalitas-invalid-feedback').text("Max 100!");
    } else {
      $(this).removeClass('is-invalid');
      $('.loyalitas-invalid-feedback').remove();
    }
  })

  $("#kerjasama").change(function() {
    let kerjasama = document.getElementById('kerjasama').value;
    if (!maximum.test(kerjasama)) {
      $(this).addClass('is-invalid');
      $('.kerjasama-invalid-feedback').text("Max 100!");
    } else {
      $(this).removeClass('is-invalid');
      $('.kerjasama-invalid-feedback').remove();
    }
  })

  $("#perilaku").change(function() {
    let perilaku = document.getElementById('perilaku').value;
    if (!maximum.test(perilaku)) {
      $(this).addClass('is-invalid');
      $('.perilaku-invalid-feedback').text("Max 100!")
    } else {
      $(this).removeClass('is-invalid')
      $('.perilaku-invalid-feedback').remove()
    }
  })

  $("#type").change(function() {
    let type = document.getElementById('type').value;
    if (!maximum.test(type)) {
      $(this).addClass('is-invalid');
      $('.type-invalid-feedback').text("Max 100!");
    } else {
      $(this).removeClass('is-invalid')
      $('.type-invalid-feedback').remove();
    }
  })

  // Number only and max 100
  $('.numberonly').keypress(function(e) {

    var charCode = (e.which) ? e.which : event.keyCode

    if (String.fromCharCode(charCode).match(/[^0-9]/g))

      return false;

  });
</script>
<?= $this->endSection() ?>