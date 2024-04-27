<main id="main" class="main">

    <div class="pagetitle">
      <h1>Users</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.html">Home</a></li>
          <li class="breadcrumb-item">User</li>
          <li class="breadcrumb-item active">List</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section">
      <div class="row">
        <div class="col-lg-12">

          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Users</h5>
              <!-- Table with stripped rows -->
              <table class="table datatable">
                <thead>
                  <tr>
                    <th>
                      <b>#</b>
                    </th>
                    <th>Username</th>
                    <th>Email</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  <?php foreach($users as $key=>$user): ?>
                  <tr>
                    <td><?= $key+1; ?></td>
                    <td><?= $user->username; ?></td>
                    <td><?= $user->email; ?></td>
                    <td>
                        <a href="<?= url('user-edit?user_id='.$user->id)?>" class="btn btn-sm btn-dark"><i class="bi bi-pencil-square"></i></a>
                        <a href="<?= url('user-delete?user_id='.$user->id)?>" class="btn btn-sm btn-danger"><i class="bi bi-x-square-fill"></i></a>
                    </td>
                  </tr>
                  <?php endforeach;?>
                </tbody>
              </table>
              <!-- End Table with stripped rows -->

            </div>
          </div>

        </div>
      </div>
    </section>

  </main><!-- End #main -->