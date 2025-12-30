<!-- Modal Register -->
<div class="modal fade" id="modalRegister" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="modalRegisterLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title h4" id="modalRegisterLabel">Register Account</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="register_pelanggan_proses.php" method="post">
        <div class="modal-body px-4">
            <div class="input-group mb-2">
                <span class="input-group-text">
                  <i class="far fa-address-card"></i>
                </span>
                <input type="text" name="txtIDPelanggan" id="txtIDPelanggan" class="form-control" maxlength="17" placeholder="NIK KTP">
            </div>
            <div class="input-group mb-2">
                <span class="input-group-text">
                  <i class="fas fa-at"></i>
                </span>
                <input type="email" name="txtEmail" id="txtEmail" class="form-control" maxlength="50" placeholder="Email">
            </div>
            <div class="input-group mb-2">
                <span class="input-group-text">
                  <i class="fas fa-lock"></i>
                </span>
                <input type="password" name="txtPassword" id="txtPassword" class="form-control" maxlength="30" placeholder="Password">
            </div>
            <div class="input-group mb-2">
                <span class="input-group-text">
                  <i class="fas fa-user"></i>
                </span>
                <input type="text" name="txtNamaLengkap" id="txtNamaLengkap" class="form-control" maxlength="50" placeholder="Nama Lengkap">
            </div>

            <div class="input-group mb-2">
              <span class="input-group-text">
                <i class="fas fa-phone"></i>
              </span>
              <input type="text" name="txtNoTelepon" id="txtNoTelepon" class="form-control" maxlength="15" placeholder="6285712341234" value="62">
            </div>

            <div class="input-group mb-2">
                <span class="input-group-text">
                  <i class="far fa-calendar-alt"></i>
                </span>
              <input type="date" name="dtTanggalLahir" id="dtTanggalLahir" class="form-control">
            </div>
            <div class="input-group mb-2">
                <span class="input-group-text">
                  <i class="fas fa-map-marked fa-lg"></i>
                </span>
              <textarea name="txtAlamatLengkap" id="txtAlamatLengkap" class="form-control" cols="30" rows="3" maxlength="500" placeholder="Alamat Lengkap" style="resize:none;"></textarea>
            </div>
            <div class="input-group mb-2 d-flex mx-1">
                <span class="input-group-text">
                  <i class="fas fa-university"></i>
                </span>
              <select name="slNamaBank" id="slNamaBank" class="form-select">
                <?php 
                  $resultRekening = mysqli_query($connection, "SELECT * FROM tb_perusahaan");
                  if(mysqli_num_rows($resultRekening)){
                      while($fetchRekening = mysqli_fetch_array($resultRekening)){
                          $nama_bank = $fetchRekening['nama_bank_usaha'];
                          $no_rekening = $fetchRekening['nomor_rekening_usaha'];
                      
                ?>
                  <option value="<?php echo $nama_bank; ?>"><?php echo $nama_bank; ?></option>
                <?php 
                    }
                  }
                ?>
              </select>
              <input type="text" name="txtNoRekening" id="txtNoRekening" maxlength="20" class="form-control">
            </div>
            
            
        </div>
        <div class="modal-footer justify-content-center">
          <button type="submit" class="btn btn-primary px-5 align-items-center">
            <i class="fas fa-address-card fa-lg"></i>
            Register Account
          </button>
        </div>
      </form>
    </div>
  </div>
</div>
<!-- End Modal Register -->