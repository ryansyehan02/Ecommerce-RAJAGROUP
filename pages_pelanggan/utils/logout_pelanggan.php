<!-- Modal Login -->
<div class="modal fade" id="modalAccountLogout" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="modalLogoutLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title h4" id="modalLogoutLabel">Logout</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body px-4">
          <p>Are You Sure You Want To Logout?</p>
      </div>
      <div class="modal-footer">
        <form action="utils/logout_pelanggan_proses.php" method="post">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
          <button type="submit" class="btn btn-primary">
            <i class="fas fa-sign-out"></i>
            Logout
          </button>
        </form>
      </div>
    </div>
  </div>
</div>
<!-- End Modal Login -->