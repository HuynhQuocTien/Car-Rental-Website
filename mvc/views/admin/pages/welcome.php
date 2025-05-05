<!-- Welcome Info Page -->
<div class="content">
  <!-- Welcome Section -->
  <div class="block block-rounded block-themed">
    <div class="block-header bg-primary-dark">
      <h3 class="block-title">Welcome!</h3>
    </div>
    <div class="block-content">
      <h2 class="h4 mb-1">Hello <span id="employee-name"><?php echo $_SESSION['FullName'] ?></span>!</h2>
      <p class="fs-sm text-muted">Wishing you an effective and enjoyable workday!</p>
    </div>
  </div>

  <!-- User Information Section -->
  <div class="row items-push">
    <div class="col-md-6 col-xl-4">
      <div class="block block-rounded text-center">
        <div class="block-content">
          <div class="item item-rounded bg-primary-light mx-auto my-3">
            <i class="fa fa-user fa-2x text-primary"></i>
          </div>
          <h4 class="fw-bold" id="user-name"><?php echo $_SESSION['FullName'] ?></h4>
          <p class="text-muted">Role: <span id="user-role"><?php echo $_SESSION['RoleName'] ?></span></p>
        </div>
      </div>
    </div>
    <div class="col-md-6 col-xl-4">
      <div class="block block-rounded text-center">
        <div class="block-content">
          <div class="item item-rounded bg-success-light mx-auto my-3">
            <i class="fa fa-envelope fa-2x text-success"></i>
          </div>
          <h4 class="fw-bold">Email</h4>
          <p class="text-muted" id="user-email"><?php echo $_SESSION['Email'] ?></p>
        </div>
      </div>
    </div>
    <div class="col-md-6 col-xl-4">
      <div class="block block-rounded text-center">
        <div class="block-content">
          <div class="item item-rounded bg-warning-light mx-auto my-3">
            <i class="fa fa-calendar-alt fa-2x text-warning"></i>
          </div>
          <h4 class="fw-bold">Join Date</h4>
          <p class="text-muted" id="user-join-date"><?php echo $_SESSION['CreatedAt'] ?></p>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- END Welcome Info Page -->
