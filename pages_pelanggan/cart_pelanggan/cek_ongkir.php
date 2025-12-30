<?php 
  include "../../module/conn.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Mari Belajar Coding</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- <link rel="stylesheet" href="asset/bootstrap-3.3.7/dist/css/bootstrap.min.css"> -->
  <!-- <link rel="stylesheet" href="asset/select2-4.0.6-rc.1/dist/css/select2.min.css"> -->
  <script src="jquery-3.3.1.min.js"></script>
  <!-- <script src="asset/bootstrap-3.3.7/dist/js/bootstrap.min.js"></script> -->
  <script src="select2.min.js"></script>   
  <!-- <script src="asset/select2-4.0.6-rc.1/dist/js/i18n/id.js"></script>    -->
  <script src="cek_ongkir_app.js"></script>
</head>
<body>

  <div class="row border border-2 rounded-3 mb-3">

    <div class="row mb-3 mx-1">
      <div class="col-12 py-2 text-center">
        <h4 class="h4 text-primary border-bottom border-primary py-2">Cek Ongkir</h4>
      </div>
    </div>


    <form id="ongkir" method="POST">

      <!-- <div class="row mb-3 justify-content-center">
        <label for="kota_asal" class="col-4 col-form-label">Kota Asal : </label>
        <div class="col-8">
          <select class="form-select" id="kota_asal" name="kota_asal" required="">
          </select>
        </div>
      </div> -->

      <div class="row mb-3 justify-content-center">
        <label class="col-4 col-form-label">Kota Tujuan : </label>
        <div class="col-8">          
          <select class="form-select" id="kota_tujuan" name="kota_tujuan" title="Pilih Kota Tempat Tinggal Anda">
            <option></option>
          </select>
        </div>
      </div>

      <div class="mb-3 form-floating justify-content-center">
        <textarea name="txtAlamatLengkap" id="txtAlamatLengkap" cols="10" rows="1" class="form-control" required oninvalid="this.setCustomValidity('Alamat Tidak Boleh Kosong');" style="resize:none; height:120px;" placeholder="Nama Jalan Lengkap, Kecamatan, Kelurahan, Kode POS"><?php echo $fetchAlamatPelanggan['alamat_lengkap']; ?></textarea>
        <label for="txtAlamatLengkap" class="">Alamat Lengkap : </label>
      </div>



      <div class="row mb-3 justify-content-center">
        <label class="col-4 col-form-label">Kurir : </label>
        <div class="col-8">          
          <select class="form-select" id="kurir" name="kurir" required oninvalid="this.setCustomValidity('Pilih Jasa Kurir Pengiriman');">
            <option value="jne">JNE</option>
            <option value="tiki">TIKI</option>
            <option value="pos">POS INDONESIA</option>
          </select>
        </div>
      </div>


      <div class="row mb-3 justify-content-center">
        <label class="col-4 col-form-label">Berat (Kg) : </label>
        <div class="col-8">          
          <input type="text" class="form-control" id="berat" name="berat" readonly="" value="<?php echo $berat_keranjang; ?>">
        </div>
      </div>


      <div class="row mb-3 justify-content-end">        
        <div class="col-12 d-grid">
          <button type="submit" class="btn btn-outline-primary" name="btnCekOngkir" onclick="javascript:funcGetDataOngkir();">
          <i class="fas fa-sync"></i>
            Cek Ongkir
          </button>
        </div>
      </div>

    </form>
    <div class="col-12" id="response_ongkir">      
    </div>
  </div>

</body>
</html>
