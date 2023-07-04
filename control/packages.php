<? 
include_once("classes/config.php");
include_once("classes/secure.php");

if ($_REQUEST['action']=="delete") {
    $id = trim($_REQUEST['id']);
    if (is_numeric($id)) {
        $sql = "delete from packages where PackageId='".mysqli_real_escape_string($con,$id)."'";
        if (!mysqli_query($con,$sql)) {
            $message = '<div class="alert alert-danger">Sorry, there was a technical error.</div>';
        }else{
            $message = '<div class="alert alert-success">Record has been successfuly deleted.</div>';
        }
    }
}

$rsq = mysqli_query($con,"select * from packages");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>List of holiday packages - <?=PROJECT_TITLE?></title>
    <link href="assets/libs/datatables/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css" />
    <link href="assets/libs/datatables/responsive.bootstrap4.min.css" rel="stylesheet" type="text/css" />
    <link href="assets/libs/datatables/buttons.bootstrap4.min.css" rel="stylesheet" type="text/css" />
    <link href="assets/libs/datatables/select.bootstrap4.min.css" rel="stylesheet" type="text/css" />
    <? include_once("includes/style.php"); ?>
</head>

<body>

    <!-- Begin page -->
    <div id="wrapper">

        <!-- Topbar Start -->
        <? include_once("includes/header.php"); ?>
        <!-- end Topbar -->

        <!-- ========== Left Sidebar Start ========== -->
       <? include_once("includes/navigation.php"); ?>
        <!-- Left Sidebar End -->

        <!-- ============================================================== -->
        <!-- Start Page Content here -->
        <!-- ============================================================== -->

        <div class="content-page">
            <div class="content">

                <!-- Start Content-->
                <div class="container-fluid">

                    <!-- start page title -->
                    <div class="row">
                        <div class="col-12">
                            <div class="page-title-box">
                                <div class="page-title-right">
                                  <a href="add-package" class="btn btn-primary waves-effect waves-light">Add Packages</a>
                                </div>
                                <h4 class="page-title">List Holiday Packages</h4>
                            </div>
                        </div>
                    </div>
                    <!-- end page title -->
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">
                                    <div><?=$message?></div>
                                    <table id="basic-datatable" class="table ">
                                        <thead>
                                            <tr>
                                                <th>PackageType</th>
                                                <th>PackageTitle</th>                                               
                                                <th>Duration</th>
                                                 <th>Price</th>
                                                <th>Destinations</th>
                                                <th>CreatedOn</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <? while ($row = mysqli_fetch_array($rsq)) { ?>
                                            <tr>
                                                <td><? if ($row['PackageType']=="D") {echo "Domestic";}else{echo "International";}?></td>
                                                <td><?=$row['PackageTitle']?></td>                                                
                                                <td><?=$row['Nights']?>N/<?=$row['Days']?>D </td>
                                                <td><?=$row['Price']?></td>
                                                <td><?=$row['Destinations']?></td>
                                                <td><?=$row['CreatedOn']?></td>
                                                <td>
                                                   <div class="btn-group dropdown">
                                                        <a href="javascript: void(0);" class="dropdown-toggle arrow-none btn btn-light btn-sm" data-toggle="dropdown" aria-expanded="false"><i class="mdi mdi-dots-horizontal"></i></a>
                                                        <div class="dropdown-menu dropdown-menu-right">
                                                            <a class="dropdown-item" href="edit-package?id=<?=$row['PackageId']?>"><i class="mdi mdi-pencil mr-1 text-muted"></i>Edit Package</a>
                                                            <a class="dropdown-item" href="javascript:deleteme(<?=$row['PackageId']?>);"><i class="mdi mdi-delete mr-1 text-muted"></i>Remove</a>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                            <? } ?>
                                        </tbody>
                                    </table>

                                </div> <!-- end card body-->
                            </div> <!-- end card -->
                        </div><!-- end col-->
                    </div>
                    <!-- end row-->



                </div> <!-- container-fluid -->

            </div> <!-- content -->



            <!-- Footer Start -->
            <? include_once("includes/footer.php"); ?>
            <!-- end Footer -->

        </div>

        <!-- ============================================================== -->
        <!-- End Page content -->
        <!-- ============================================================== -->


    </div>
    <!-- END wrapper -->

    <!-- Right bar overlay-->
    <div class="rightbar-overlay"></div>

    <!-- Vendor js -->
    <script src="assets/js/vendor.min.js"></script>

    <!-- datatable js -->
    <script src="assets/libs/datatables/jquery.dataTables.min.js"></script>
    <script src="assets/libs/datatables/dataTables.bootstrap4.min.js"></script>
    <script src="assets/libs/datatables/dataTables.responsive.min.js"></script>
    <script src="assets/libs/datatables/responsive.bootstrap4.min.js"></script>

    <script src="assets/libs/datatables/dataTables.buttons.min.js"></script>
    <script src="assets/libs/datatables/buttons.bootstrap4.min.js"></script>
    <script src="assets/libs/datatables/buttons.html5.min.js"></script>
    <script src="assets/libs/datatables/buttons.flash.min.js"></script>
    <script src="assets/libs/datatables/buttons.print.min.js"></script>

    <script src="assets/libs/datatables/dataTables.keyTable.min.js"></script>
    <script src="assets/libs/datatables/dataTables.select.min.js"></script>

    <!-- Datatables init -->
    <!--<script src="assets/js/pages/datatables.init.js"></script>-->

    <!-- App js -->
    <script src="assets/js/app.min.js"></script>
    
    <script>
        $(document).ready(function () {
            $('#basic-datatable').DataTable({
                order: [[0, 'asc']],
            });
        });

        function deleteme(val) {
            if (val!="") {
                if (confirm("Are you sure you want to delete this record?")) { 
                    location.href="<?=$_SERVER['PHP_SELF']?>?action=delete&id=" + val;
                }
            }
        }
</script>

</body>

</html>