<!-- Modal Login -->
<div class="modal fade" id="modalLogin" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="modalLoginLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title h4" id="modalLoginLabel">Sign In</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="login_pelanggan_proses.php" method="post">
        <div class="modal-body px-4">
            <?php 
                if(isset($_GET['pesan'])){
            ?>
                <label for="txtEmail" class="text-danger text-center">
                    <?php echo $_GET['pesan']; ?>
                </label>
            <?php
                }
            ?>
            <div class="mb-3">
                <input type="email" name="txtEmail" id="txtEmail" class="form-control" placeholder="Email">
            </div>
            <div class="mb-3">
                <input type="password" name="txtPassword" id="txtPassword" class="form-control" placeholder="Password">
            </div>
            <div class="mb-3">
                <input type="checkbox" name="chkRememberPassword" id="chkRememberPassword" class="form-check-input">
                <label for="chkRememberPassword">Remember</label>
                <a href="" class="link-primary text-decoration-none float-end">Forgot Password?</a>
            </div>
            <div class="d-grid">
                <button type="submit" class="btn btn-primary">Sign In</button>
            </div>
        </div>
        <div class="modal-footer justify-content-center">
            Don't Have An Account?
            <a href="" class="link-primary text-decoration-none" data-bs-toggle="modal" data-bs-target="#modalRegister">Sign Up</a>
        </div>
      </form>
    </div>
  </div>
</div>
<!-- End Modal Login -->