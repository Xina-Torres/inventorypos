<?php
    include_once 'connectdb.php';
    session_start();
    include_once 'header.php';

    if(isset($_POST['btnsave'])){
        $username=$_POST['txtname'];
        $useremail=$_POST['txtemail'];
        $password=$_POST['txtpassword'];
        $userrole=$_POST['txtselect_option'];
//        echo $username."==".$useremail."==".$password."==".$userrole;
        $insert=$pdo->prepare("insert into tbl_user(username, useremail, password, role)values(:name,:email,:pass,:role)");
        
        $insert->bindParam(':name',$username);
        $insert->bindParam(':email',$useremail);
        $insert->bindParam(':pass',$password);
        $insert->bindParam(':role',$userrole);
        
        if($insert->execute()){
            echo 'Registration successful';
        }else{
            echo 'Registration failed.';
        }
    }
?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Registration
     <!--   <small>Optional description</small>-->
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Level</a></li>
        <li class="active">Here</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content container-fluid">

      <!--------------------------
        | Your Page Content Here |
        -------------------------->
          <!-- general form elements -->
          <div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title">Registration Form</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form role="form" action="" method="post">
              <div class="box-body">
              <div class="col-md-4">
              
                <div class="form-group">
                  <label>Name</label>
                  <input type="text" class="form-control" name="txtname" placeholder="Enter Name">
                </div>
                <div class="form-group">
                  <label>Email</label>
                  <input type="email" class="form-control" name="txtemail" placeholder="Enter Email">
                </div>
                
                             <div class="form-group">
                  <label>Password</label>
                  <input type="password" class="form-control" name="txtpassword" placeholder="Enter Password">
                </div>
                  <div class="form-group">
                  <label>Role</label>
                  <select class="form-control" name="txtselect_option">
                   <option value="" disabled selected>Select Role</option>
                    <option>User</option>
                    <option>Admin</option>
                    
                  </select>
                </div>
                <button type="submit" name="btnsave" class="btn btn-info">Save</button>

              </div>
               <div class="col-md-8">
                   <table class="table table-striped">
                       <thead>
                       <tr>
                        <th>#</th>
                        <th>NAME</th>
                        <th>EMAIL</th>
                        <th>PASSWORD</th>
                        <th>ROLE</th>
                         <th>DELETE</th>
                        </tr>
                       </thead>
                       <tbody>
                           <?php  
                           $select=$pdo->prepare("select * from tbl_user order by userid desc");
                           $select->execute();
                           
                           while($row=$select->fetch(PDO::FETCH_OBJ)){
                               echo'
                               <tr>
                               <td>'.$row->userid.'</td>
                               <td>'.$row->username.'</td>
                               <td>'.$row->useremail.'</td>
                               <td>'.$row->password.'</td>
                               <td>'.$row->role.'</td>
                               </tr>';
                           }
                           ?>
                       </tbody>
                   </table>
               </div>

              </div>
              <!-- /.box-body -->

              <div class="box-footer">
                
              </div>
            </form>
          </div>

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
<?php
   include_once 'footer.php';
?>
 