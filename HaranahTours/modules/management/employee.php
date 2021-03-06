<?php
  include '../../db.php';
  include 'head.php';
  include 'sidebar.php';
  include 'header.php';

  if(isset($_GET['numres'])) {
    $numres = $_GET['numres'];
  } else {
    $numres = 15;
  }

  if(isset($_GET['page'])) {
    $pageno = $_GET['page'];
  } else {
    $pageno = 1;
  }

?>
<div class="container-fluid pagePadding">
  <div class="row">
    <div class="col-md-6">
      <h1 class="display-4"> 
        Employee List 
        <button class="btn btn-outline-primary btn-circle" data-toggle="modal" data-target="#addEmployee"> <i class="fa fa-plus"> </i> </button>
      </h1>
    </div>
    <div class="col-md-6">
      <form>
        <div class="input-group">
          <input type="text" class="form-control form-control-sm" placeholder="Search..." />
          <span class="input-group-btn">
            <button class="btn btn-primary btn-sm">
              <i class="fa fa-search"> </i>
            </button>
          </span>
        </div>
      </form>
    </div>
  </div>

  <!-- ADD NEW EMPLOYEE PHP -->
  <?php

  if(isset($_POST['add'])) {
    if((isset($_POST['lastname']) || isset($_POST['firstname']) || isset($_POST['email']) || isset($_POST['mobile']))) {
      $lastname =mysqli_real_escape_string($connect,$_POST['lastname']);
      $firstname = mysqli_real_escape_string($connect,$_POST['firstname']);
      $email = mysqli_real_escape_string($connect,$_POST['email']);
      $mobile = mysqli_real_escape_string($connect,$_POST['mobile']);
      $department = $_POST['department'];
      $status = 'active';
      $password = substr($department, 0, 2) . substr($lastname, 0, 2) . substr($firstname, 0 , 2) . substr($mobile, -3);

      $check = mysqli_query($connect, "SELECT * from user WHERE email='$email'");
      if(mysqli_num_rows($check) == 0){
        $insert = mysqli_query($connect,"INSERT INTO user (last_name, first_name, department, email, password, contact_no, status) VALUES ('$lastname','$firstname','$department','$email','$password','$mobile','$status')"); 
      ?>
        <div class="alert alert-success" role="alert">
          <button type="button" class="close" data-dismiss="alert" aria-hidden="true"> <i class="fa fa-times fa-sm"> </i></button>
            <strong><span class = "fa fa-check-circle"></span> Success!</strong> You have successfully added a new user. The default password for this user is: <strong> <?php echo $password; ?> </strong>
        </div>
      <?php } else { ?>
        <div class="alert alert-warning alert-dismissable">
          <button type="button" class="close" data-dismiss="alert" aria-hidden="true"><i class="fa fa-times close"> </i></button>
          <span class="fa fa-exclamation-circle space"></span>
          <strong>Warning!</strong> The user you are adding <strong> already exists in the database. </strong>
        </div>
      <?php 
      }
    }
  }
   
  ?>

  <!-- FILTERS -->
  <div class="row">
    <div class="col">
      <div class="card card-body" id="filter">
        <form>
          <div class="row">
            <div class="col-md-1">
              <span class="col-form-label col-form-label-sm" style="letter-spacing: 5px;"> FILTERS: </span>
            </div>
            <div class="col-md-2 text-right">
              <label class="col-form-label col-form-label-sm"> <strong> Department: </strong> </label>
            </div>
            <div class="col-md-2">
              <select class="form-control form-control-sm">
                <option value="default"> All </option>
                <option value="sales"> Sales </option>
                <option value="tours"> Tours </option>
                <option value="transportation"> Transportation </option>
                <option value="accounting"> Accounting </option>
                <option value="management"> Management </option>
              </select>
            </div>
            <div class="col-md-2 text-right">
              <label class="col-form-label col-form-label-sm"> <strong> Account Status: </strong> </label>
            </div>
            <div class="col-md-2">
              <select class="form-control form-control-sm">
                <option value="default"> All </option>
                <option value="active"> Active </option>
                <option value="offline"> Offline </option>
                <option value="disabled"> Disabled </option>
              </select>
            </div>
            <div class="col-md-2 text-right">
              <label class="col-form-label col-form-label-sm"> <strong> Results Per Page: </strong> </label>
            </div>
            <div class="col-md-1">
              <select class="form-control form-control-sm" name="numres">
                <option value="15"> 15 </option>
                <option value="30"> 30 </option>
                <option value="50"> 50 </option>
                <option value="100"> 100 </option>
              </select>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>

  <!-- PAGINATION -->
  <?php
    $querycounter = "SELECT user_id FROM user";
    $resultcounter = mysqli_query($connect, $querycounter);
    $totalrows = mysqli_num_rows($resultcounter);

    $query = "SELECT user_id, last_name, first_name, department, email, contact_no, status FROM user LIMIT $numres"; //LIMIT FILTER!!!!!
    $result = mysqli_query($connect, $query);
    $numrows = mysqli_num_rows($result);

    $startres = $numres * ($pageno - 1);
    $startres++;
    $endres = $numres + $startres;
    if($endres > $totalrows) {
      $endres = $totalrows;
    }

    $totalpage = round($totalrows/$numres);
    if($totalpage==0) {
      $totalpage = 1;
    }

  ?>
  <div class="row">
    <div class="col">
      <p class="results"> Showing <?php echo $startres . " to " . $endres; ?> of <?php echo $totalrows; ?>  results </p>
    </div>
    <?php if($totalpage > 1) { ?>
      <div class="col justify-content-end" id="pagination">
        <p class="text-right">
          <?php for($i=0; $i < $totalpage; $i++) { ?>
            <a href="?pageno=$i" class="number <?php if($i==$pageno) { echo 'active'; } ?>" > <?php echo $i + 1; ?> </a> <!-- DI PA FINAL -->
          <?php } ?>
          <a href="#" class="btn btn-primary btn-sm"> <i class="fa fa-caret-right"> </i> </a>
        </p>
      </div>
    <?php } ?>
  </div>

  <!-- TABLE -->
  <div class="row">
    <div class="col">
      <table class="table table-bordered table-hover table-sm">
        <thead class="thead-dark">
          <tr>
            <th class="align-middle">
              <div class="btn-group-vertical">
                  <input title="Sort by Ascending" class="btn arrowSort" type="submit" value="▲">
                  <input title="Sort by Descending" class="btn arrowSort" type="submit" value="▼">
              </div>
                No.
            </th>
            <th class="align-middle"> 
              <div class="btn-group-vertical">
                  <input title="Sort by Ascending" class="btn arrowSort" type="submit" value="▲">
                  <input title="Sort by Descending" class="btn arrowSort" type="submit" value="▼">
              </div>
              Name 
            </th>
            <th class="align-middle"> 
              <div class="btn-group-vertical">
                  <input title="Sort by Ascending" class="btn arrowSort" type="submit" value="▲">
                  <input title="Sort by Descending" class="btn arrowSort" type="submit" value="▼">
              </div>
              Department
            </th>
            <th class="align-middle"> Email </th>
            <th class="align-middle"> Contact Number </th>
            <th class="align-middle">
              <div class="btn-group-vertical">
                  <input title="Sort by Ascending" class="btn arrowSort" type="submit" value="▲">
                  <input title="Sort by Descending" class="btn arrowSort" type="submit" value="▼">
              </div>
              Status
            </th>
            <th class="text-center align-middle"> Details</th>
          </tr>
        </thead>
        <tbody>
          <?php 
            $counter=0;
            while($row = mysqli_fetch_assoc($result)){ 
              $name = ucfirst($row['last_name']) . ", " . ucfirst($row['first_name']);
              $department = ucfirst($row['department']);
              $email = $row['email'];
              $contact_no = $row['contact_no'];
              $status = ucfirst($row['status']);
              $counter++;
          ?>
          <tr>
            <td class="text-center align-middle"> <?php echo $counter; ?> </td>
            <td class="align-middle">
              <img class="profilePicture" src="../../img/kristine.png" style="margin: 0 1em;" />  <!-- HOW TO ADD USER PICTURE???? -->
              <?php echo $name; ?> 
            </td>
            <td class="align-middle"> <?php echo $department; ?> </td>
            <td class="align-middle"> <?php echo $email; ?> </td>
            <td class="align-middle"> <?php echo $contact_no; ?> </td>
            <td class="text-center align-middle">
              <?php if($status == 'Active') { ?>
                <span class="green-status">Active</span>
              <?php } else { ?>
                <span class="gray-status">Offline</span>
              <?php } ?>
            </td>
            <td class="text-center align-middle">
              <button class="btn btn-primary btn-circle btn-sm" data-toggle="modal" data-target="#userprofile_<?php echo $row['user_id']; ?>"> 
                <i class="fa fa-search"> </i> 
              </button>
            </td>
          </tr>

<!-- USER PROFILE MODAL -->

<div class="modal fade" id="userprofile_<?php echo $row['user_id']; ?>" tabindex="-1" role="dialog" aria-labelledby="userprofile_<?php echo $row['user_id']; ?>" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="userprofile_<?php echo $row['user_id']; ?>"> Employee Profile </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form role="form" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
        <div class="modal-body">
          <fieldset>
            <legend> Employee Details </legend>
            <div class="row">
              <div class="col-4 text-center">
                <img class="img-fluid img-thumbnail" src="../../img/kristine.png"/>
                <a href="employee_disable.php" class="btn btn-danger btn-xs"> Disable Account </a> 
              </div>
              <div class="col-8">
                <label class="col-form-label col-form-label-sm"> Name: </label> <strong><?php echo $name; ?></strong> <br>
                <label class="col-form-label col-form-label-sm"> Email: </label> <strong><?php echo $email; ?></strong> <br>
                <label class="col-form-label col-form-label-sm"> Contact No: </label> <strong><?php echo $contact_no; ?></strong> <br> 
                <label class="col-form-label col-form-label-sm"> Department: </label> <strong><?php echo $department; ?></strong> <br>
                <label class="col-form-label col-form-label-sm"> Status: </label> <strong><?php echo $status; ?></strong> <br>
                <label class="col-form-label col-form-label-sm"> Last Online: </label> <strong><?php echo $status; ?></strong> <!-- idadagdag sa database -->   
              </div>
            </div>
          </fieldset>
          <fieldset>
            <legend> Latest Activity </legend>
          </fieldset>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-outline-secondary btn-sm" data-dismiss="modal">Cancel</button>
          <input type="submit" value="Add New Employee" name="add" class="btn btn-primary btn-sm" />
        </div>
      </form>
    </div>
  </div>
</div>

<!-- END OF USER PROFILE MODAL -->
          <?php } ?>
        </tbody>
      </table>
    </div>
  </div>
</div>





<!-- ADD NEW EMPLOYEE MODAL -->
<div class="modal fade" id="addEmployee" tabindex="-1" role="dialog" aria-labelledby="addEmployee" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="addEmployee">Add New Employee</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form role="form" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
      <div class="modal-body">
          <div class="row">
            <div class="col">
              <label class="col-form-label col-form-label-sm"> Employee Name: </label>
            </div>
          </div>
          <div class="form-group row">
            <div class="col-md-6">
              <input type="text" class="form-control form-control-sm" placeholder="Last Name" name="lastname">
            </div>
            <div class="col-md-6">
              <input type="text" class="form-control form-control-sm" placeholder="First Name" name="firstname">
            </div>
          </div>
          <div class="row">
            <div class="col">
                <label class="col-form-label col-form-label-sm"> Employee Email Address: </label>
            </div>
          </div>
          <div class="row">
            <div class="col">
              <div class="input-group">
                <span class="input-group-addon"> <i class="fa fa-envelope"> </i> </span> 
                <input type="email" class="form-control form-control-sm text-right" placeholder="@haranahtours.com.ph" name="email">
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-6">
              <label class="col-form-label col-form-label-sm"> Employee Contact No. </label>
            </div>
            <div class="col-md-6">
              <label class="col-form-label col-form-label-sm"> Select Employee Department </label>
            </div>
          </div>
          <div class="row">           
            <div class="col-md-6">
              <div class="input-group">
                <span class="input-group-addon"> <i class="fa fa-mobile"> </i> </span>
                <input type="text" class="form-control form-control-sm" placeholder="Mobile" name="mobile">
              </div>
            </div>
            <div class="col-md-6">
              <div class="input-group">
                <span class="input-group-addon"> <i class="fa fa-briefcase"> </i> </span>
                <select class="form-control form-control-sm text-center" name="department">
                  <option value="default"> Choose . . . </option>
                  <option value="sales"> Sales </option>
                  <option value="tours"> Reservation for Tours </option>
                  <option value="transportation"> Reservation for Transportation </option>
                  <option value="accounting"> Accounting </option>
                  <option value="management"> Management </option>
                </select>
              </div>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-outline-secondary btn-sm" data-dismiss="modal">Cancel</button>
          <input type="submit" value="Add New Employee" name="add" class="btn btn-primary btn-sm" />
        </div>
      </form>
    </div>
  </div>
</div>


<?php include 'footer.php'; ?>