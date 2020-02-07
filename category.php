<?php
    include_once 'connectdb.php';
    session_start();
    include_once 'header.php';

if(isset($_POST['btnsave'])){
    $category=$_POST['txtcategory'];
    if(empty($category)){
        $error='<script type="text/javascript">
                jQuery(function validation(){
                    swal({
                        title: "Field is Empty",
                        text: "Please fill field.",
                        icon: "error",
                        button: "Ok",
});
        });
            </script>';
        echo $error;
    }
    
    if(!isset($error)){
        $insert=$pdo->prepare("insert into tbl_category(category) values(:category)");
        $insert->bindParam(':category',$category);
        if($insert->execute()){
            echo '<script type="text/javascript">
                jQuery(function validation(){
                    swal({
                        title: "Good Job!",
                        text: "Your Category is Added.",
                        icon: "success",
                        button: "Ok",
});
        });
            </script>';
        }else{
             echo '<script type="text/javascript">
                jQuery(function validation(){
                    swal({
                        title: "Error",
                        text: "Query Fail.",
                        icon: "error",
                        button: "Ok",
});
        });
            </script>';
        }
    }
}
?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Category
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
               <div class="box box-warning">
            <div class="box-header with-border">
                <h3 class="box-title">Category Form</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form role="form" action="" method="post">
                <div class="box-body">
                    <div class="col-md-4">

                        <div class="form-group">
                            <label>Category</label>
                            <input type="text" class="form-control" name="txtcategory" placeholder="Enter Category">
                        </div>
                        <button type="submit" name="btnsave" class="btn btn-warning">Save</button>

                    </div>
                    <div class="col-md-8">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>CATEGORY</th>
                                    <th>EDIT</th>
                                    <th>DELETE</th>
                                </tr>
                            </thead>
                            <tbody>
                                
                               <tr>
                               
                               </tr>
                           
                        
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
 