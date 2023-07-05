<? 
include_once("classes/config.php");
include_once("classes/secure.php");
$id = trim($_REQUEST['id']);
if ($id=="") die("Invalid parameters");
if (!is_numeric($id)) die("Invalid parameters");

$action = trim($_REQUEST['action']);
if ($action=="update") {
    $error=0;
    $PackageType = trim($_POST['PackageType']);
    $PackageTitle = trim($_POST['PackageTitle']);
    $Days = trim($_POST['Days']);
    $Nights = trim($_POST['Nights']);
    $Price = trim($_POST['Price']);
    $Destinations = trim($_POST['Destinations']);
    $Overview = trim($_POST['Overview']);
    $Inclusions = trim($_POST['Inclusions']);
    $Exclusions = trim($_POST['Exclusions']);
    $CoverImage = trim($_POST['CoverImage']);
    // $Facilities = trim($_POST['Facilities']);
    $FixedDeparture = trim($_POST['FixedDeparture']);
    $Terms = trim($_POST['Terms']);
    $Status = trim($_POST['Status']);
    $Image1 = trim($_POST['Image1']);
    $Image2 = trim($_POST['Image2']);
    $Image3 = trim($_POST['Image3']);
    $Image4 = trim($_POST['Image4']);
    $Image5 = trim($_POST['Image5']);
    $allowTypes = array('jpg', 'jpeg');

    for ($i=0;$i<=count($_POST['Facilities']);$i++) {
        if (trim($_POST['Facilities'][$i])!="") { 
            $FacilitiesValues .= $_POST['Facilities'][$i] . ",";
        }
    }
    $FacilitiesValues = rtrim($FacilitiesValues,",");

    if ($PackageType=="") {
        $errornote = "<li>Select package type</li>";
        $error=1;
    }
    if ($PackageTitle=="") {
        $errornote .= "<li>Enter holiday package title</li>";
        $error=1;
    }
    if ($Days=="") {
        $errornote .= "<li>Select duration in days</li>";
        $error=1;
    }
    if ($Nights=="") {
        $errornote .= "<li>Select duration in nights</li>";
        $error=1;
    }
    if ($FixedDeparture=="") {
        $errornote .= "<li>Enter Fixed Departure Date</li>";
        $error=1;
    }
    if ($Price=="") {
        $errornote .= "<li>Enter pricing in INR</li>";
        $error=1;
    }
    if ($Destinations=="") {
        $errornote .= "<li>Enter destinations included in this package</li>";
        $error=1;
    }

    if (!$_FILES["CoverImage"]["name"]=="") { 
        $fileType = pathinfo(basename($_FILES["CoverImage"]["name"]), PATHINFO_EXTENSION); 
        if(!in_array($fileType, $allowTypes)){ 
            $error=1;
            $errornote .= "<li>The format of cover image is invalid</li>";         
        }else {
            $CoverImageUpload=1;
        }
    }

    if ($_FILES["Image1"]["name"]!="") { 
        $fileType = pathinfo(basename($_FILES["Image1"]["name"]), PATHINFO_EXTENSION); 
        if(!in_array($fileType, $allowTypes)){ 
            $error=1;
            $errornote .= "<li>The format of cover image(1) is invalid</li>";         
        }else {
            $ImageUpload1=1;
        }
    }
    if ($_FILES["Image2"]["name"]!="") { 
        $fileType = pathinfo(basename($_FILES["Image2"]["name"]), PATHINFO_EXTENSION); 
        if(!in_array($fileType, $allowTypes)){ 
            $error=1;
            $errornote .= "<li>The format of cover image(2) is invalid</li>";         
        }else {
            $ImageUpload2=1;
        }
    }
    if ($_FILES["Image3"]["name"]!="") { 
        $fileType = pathinfo(basename($_FILES["Image3"]["name"]), PATHINFO_EXTENSION); 
        if(!in_array($fileType, $allowTypes)){ 
            $error=1;
            $errornote .= "<li>The format of cover image(3) is invalid</li>";         
        }else {
            $ImageUpload3=1;
        }
    }
    if ($_FILES["Image4"]["name"]!="") { 
        $fileType = pathinfo(basename($_FILES["Image4"]["name"]), PATHINFO_EXTENSION); 
        if(!in_array($fileType, $allowTypes)){ 
            $error=1;
            $errornote .= "<li>The format of cover image(4) is invalid</li>";         
        }else {
            $ImageUpload4=1;
        }
    }
    if ($_FILES["Image5"]["name"]!="") { 
        $fileType = pathinfo(basename($_FILES["Image5"]["name"]), PATHINFO_EXTENSION); 
        if(!in_array($fileType, $allowTypes)){ 
            $error=1;
            $errornote .= "<li>The format of cover image(5) is invalid</li>";         
        }else {
            $ImageUpload5=1;
        }
    }

    if ($error=="1") {
        $message = '<div class="alert alert-danger">There was a validation error in your submission.</div>';
    }else {

        if ($CoverImageUpload=="1") {
            $fileType = pathinfo(basename($_FILES["CoverImage"]["name"]), PATHINFO_EXTENSION); 
            $randomnumber=rand(1000000000000, 9000000000000);	
            $image_new_name = $randomnumber . "_coverimage." . $fileType;
            $target_path = "../lib/coverimage/" . $image_new_name; 
            $CoverImageUploadName = $image_new_name;
            move_uploaded_file($_FILES["CoverImage"]["tmp_name"],$target_path);
        }
        if ($ImageUpload1=="1") {
            $fileType = pathinfo(basename($_FILES["Image1"]["name"]), PATHINFO_EXTENSION); 
            $randomnumber=rand(1000000000000, 9000000000000);	
            $image_new_name = $randomnumber . "_image." . $fileType;
            $target_path = "../lib/packageimages/" . $image_new_name; 
            $Image1Name = $image_new_name;
            move_uploaded_file($_FILES["Image1"]["tmp_name"],$target_path);
        }
        if ($ImageUpload2=="1") {
            $fileType = pathinfo(basename($_FILES["Image2"]["name"]), PATHINFO_EXTENSION); 
            $randomnumber=rand(1000000000000, 9000000000000);	
            $image_new_name = $randomnumber . "_image." . $fileType;
            $target_path = "../lib/packageimages/" . $image_new_name; 
            $Image2Name = $image_new_name;
            move_uploaded_file($_FILES["Image2"]["tmp_name"],$target_path);
        }
        if ($ImageUpload3=="1") {
            $fileType = pathinfo(basename($_FILES["Image3"]["name"]), PATHINFO_EXTENSION); 
            $randomnumber=rand(1000000000000, 9000000000000);	
            $image_new_name = $randomnumber . "_image." . $fileType;
            $target_path = "../lib/packageimages/" . $image_new_name; 
            $Image3Name = $image_new_name;
            move_uploaded_file($_FILES["Image3"]["tmp_name"],$target_path);
        }
        if ($ImageUpload4=="1") {
            $fileType = pathinfo(basename($_FILES["Image4"]["name"]), PATHINFO_EXTENSION); 
            $randomnumber=rand(1000000000000, 9000000000000);	
            $image_new_name = $randomnumber . "_image." . $fileType;
            $target_path = "../lib/packageimages/" . $image_new_name; 
            $Image4Name = $image_new_name;
            move_uploaded_file($_FILES["Image4"]["tmp_name"],$target_path);
        }
        if ($ImageUpload5=="1") {
            $fileType = pathinfo(basename($_FILES["Image5"]["name"]), PATHINFO_EXTENSION); 
            $randomnumber=rand(1000000000000, 9000000000000);	
            $image_new_name = $randomnumber . "_image." . $fileType;
            $target_path = "../lib/packageimages/" . $image_new_name; 
            $Image5Name = $image_new_name;
            move_uploaded_file($_FILES["Image5"]["tmp_name"],$target_path);
        }

        $sql = "update packages set ";
        $sql .= "PackageType='".mysqli_real_escape_string($con,$PackageType)."', ";
        $sql .= "PackageTitle='".mysqli_real_escape_string($con,$PackageTitle)."', ";
        $sql .= "Days='".mysqli_real_escape_string($con,$Days)."', ";
        $sql .= "Nights='".mysqli_real_escape_string($con,$Nights)."', ";
        $sql .= "Price='".mysqli_real_escape_string($con,$Price)."', ";
        $sql .= "Destinations='".mysqli_real_escape_string($con,$Destinations)."', ";
        $sql .= "Overview='".mysqli_real_escape_string($con,$Overview)."', ";
        $sql .= "Inclusions='".mysqli_real_escape_string($con,$Inclusions)."', ";
        $sql .= "Exclusions='".mysqli_real_escape_string($con,$Exclusions)."', ";
        if ($CoverImageUploadName!="") {
            $sql .= "CoverImage='".mysqli_real_escape_string($con,$CoverImageUploadName)."', ";
        }
        if ($Image1Name!="") { $sql .= "Image1='".mysqli_real_escape_string($con,$Image1Name)."', ";}
        if ($Image2Name!="") { $sql .= "Image2='".mysqli_real_escape_string($con,$Image2Name)."', ";}
        if ($Image3Name!="") { $sql .= "Image3='".mysqli_real_escape_string($con,$Image3Name)."', ";}
        if ($Image4Name!="") { $sql .= "Image4='".mysqli_real_escape_string($con,$Image4Name)."', ";}
        if ($Image5Name!="") { $sql .= "Image5='".mysqli_real_escape_string($con,$Image5Name)."', ";}
        $sql .= "Terms='".mysqli_real_escape_string($con,$Terms)."', ";
        $sql .= "UpdatedOn='".date("Y-m-d H:i:s")."', ";
        $sql .= "FixedDeparture='".mysqli_real_escape_string($con,$FixedDeparture)."', ";
        $sql .= "Facilities='".mysqli_real_escape_string($con,$FacilitiesValues)."',  Status=1 where PackageId='".mysqli_real_escape_string($con,$id)."'";


        if (!mysqli_query($con,$sql)) {
            $message = '<div class="alert alert-danger">There was a problem with your submission.</div>';
        }else {
            $message = '<div class="alert alert-success">Package has been successfully published.</div>';
            header("location: edit-package?result=success&id=" . $id);
            die();
        }
        
    }
}

$rsq = mysqli_query($con,"select * from packages where PackageId='".mysqli_real_escape_string($con,$id)."'");
if (mysqli_num_rows($rsq)==0) die("Invalid record");
$rs = mysqli_fetch_array($rsq);
$Facilities = explode(",",$rs['Facilities']);
$FixedDeparture = explode(",",$rs['FixedDeparture']);

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>Edit Holiday Package - <?=PROJECT_TITLE?></title>
    <link href="assets/libs/summernote/summernote-bs4.css" rel="stylesheet" />
    <link href="assets/libs/dropzone/dropzone.min.css" rel="stylesheet" type="text/css" />

        <!-- <link type="text/css" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" > -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css">

        <link type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tagsinput/0.8.0/bootstrap-tagsinput.css" rel="stylesheet"/>

        <!-- datepicker -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.8.0/css/bootstrap-datepicker.min.css" integrity="sha512-x2MVs84VwuTYP0I99+3A4LWPZ9g+zT4got7diQzWB4bijVsfwhNZU2ithpKaq6wTuHeLhqJICjqE6HffNlYO7w==" crossorigin="anonymous" referrerpolicy="no-referrer" />

        <link href="assets/libs/summernote/summernote-bs4.css" rel="stylesheet" />
        <link href="assets/libs/dropzone/dropzone.min.css" rel="stylesheet" type="text/css" />
        <link href="assets/libs/dropzone/dropzone.min.css" rel="stylesheet" type="text/css" />
        <? include_once("includes/style.php"); ?>

        <style>
            .bootstrap-tagsinput .tag {background-color: #00acc1;padding: 1px 5px; }
        
        </style>

</head>

<body>
    
    <!-- Begin page -->
    <div id="wrapper">
        
        <!-- Topbar Start -->
        <? include_once("includes/header.php"); ?>
        <!-- end Topbar -->
        <? include_once("includes/navigation.php"); ?>
        


        <div class="content-page">
            <div class="content">

                <div class="row">
                    <div class="col-12">
                        <div class="page-title-box">
                            <div class="page-title-right">
                                <a href="packages" class="btn btn-primary waves-effect waves-light">List Packages</a>
                            </div>
                            <h4 class="page-title">Holiday Packages</h4>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="text-primary">Edit Package</h4>
                                <hr>

                                <? if ($_REQUEST['result']=="success") { ?> 
                                    <div class="alert alert-success">Holiday package has been successfully updated.</div>
                                <? } ?> 
                                <? if ($error=="1") { ?> 
                                    <div class="alert alert-danger"><?=$errornote?></div>
                                <? }else { ?> 
                                    <div><?=$message?></div>
                                <? } ?> 
                                
                                <form class="form-horizontal" action="<?=$_SERVER['PHP_SELF']?>?action=update&id=<?=$id?>" method="post" enctype="multipart/form-data">
                                    <div class="form-group row">
                                        <label class="col-lg-2 col-form-label" for="PackageType">Package Type *</label>
                                        <div class="col-lg-10">
                                            <select name="PackageType" id="PackageType" class="form-control" required>
                                                <option value="">Select...</option>
                                                <option value="Domestic" <? if ($rs['PackageType']=="D") echo " selected";?>>Domestic</option>
                                                <option value="International" <? if ($rs['PackageType']=="I") echo " selected";?>>International</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-lg-2 col-form-label" for="PackageTitle">Holiday Package Title *</label>
                                        <div class="col-lg-10">
                                            <input type="text" class="form-control" name="PackageTitle" id="PackageTitle" placeholder="Eg. Singapore, Malaysia 5 night 6 days all inclusive" value="<?=$rs['PackageTitle']?>" required>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-lg-2 col-form-label bg-light" for="Destinations">Destinations: *  <br>
                                    <small>You can also add multiple destinations by separating them with commas.</small></label>
                                        <div class="col-lg-10">
                                            <input type="text" class="form-control"name="Destinations" id="Destinations" value="<?=$rs['Destinations']?>"  placeholder="Eg. Singapore, Malaysia" required>
                                            
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-lg-2 col-form-label" for="Price">(₹) Price Per Person *</label>
                                        <div class="col-lg-10">
                                            <input type="text" class="form-control allow_decimal" name="Price" id="Price" placeholder="" value="<?=$rs['Price']?>" maxlength="10" required>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-lg-2 col-form-label" for="example-password">Duration *</label>
                                        <div class="col-lg-2">
                                            <select class="form-control" name="Days" required>
                                                <option value="">Days.. </option>
                                                <? for ($i=1;$i<=30;$i++) { ?>
                                                <option value="<?=$i?>" <? if ($rs['Days']==$i) echo " selected";?>><?=$i?></option>
                                                <? } ?>
                                            </select>
                                        </div>
                                        <div class="col-lg-2">
                                            <select class="form-control" name="Nights" required>
                                                <option value="">Nights.. </option>
                                                <? for ($i=1;$i<=30;$i++) { ?>
                                                <option value="<?=$i?>" <? if ($rs['Nights']==$i) echo " selected";?>><?=$i?></option>
                                                <? } ?>
                                            </select>
                                        </div>
                                    </div>

                                     <!-- FixedDeparture -->
                                     <!-- <div class="form-group row">
                                        <label class="col-lg-2 col-form-label" for="FixedDeparture">FixedDeparture *</label>
                                        <div class="col-lg-10">
                                            <input type="text" class="form-control" name="FixedDeparture" id="FixedDeparture" placeholder="Dates" required style="cursor: pointer;">
                                        </div>
                                    </div> -->

                                    <!-- FixedDeparture -->
                                    <div class="form-group row">
                                        <label class="col-lg-2 col-form-label" for="FixedDeparture">FixedDeparture *</label>
                                        <div class="col-lg-10">
                                            <input type="text" class="form-control datess" name="FixedDeparture" id="FixedDeparture" placeholder="Dates" required autocomplete="off" value="<?=$rs['FixedDeparture']?>">
                                        </div>
                                    </div>
                                    
                                       

                                    <div class="form-group row">
                                        <label class="col-lg-2 col-form-label" for="example-placeholder">Facilities  </label>
                                        <div class="col-lg-10">
                                            <label><input type="checkbox" name="Facilities[]" value="Flights" <? if (in_array("Flights", $Facilities)) {echo "checked";} ?>> Flights </label><br>
                                            <label><input type="checkbox"  name="Facilities[]" value="Hotels" <? if (in_array("Hotels", $Facilities)) {echo "checked";} ?>> Hotels</label> <br>
                                            <label><input type="checkbox"  name="Facilities[]" value="Food" <? if (in_array("Food", $Facilities)) {echo "checked";} ?>> Food</label> <br>
                                            <label><input type="checkbox"  name="Facilities[]" value="Transfers" <? if (in_array("Transfers", $Facilities)) {echo "checked";} ?>> Transfers</label> <br>
                                            <label><input type="checkbox"  name="Facilities[]" value="Activities" <? if (in_array("Activities", $Facilities)) {echo "checked";} ?>> Activities </label>
                                        </div>
                                    </div>


                                    <div class="form-group row mb-2">
                                        <label class="col-lg-2 col-form-label bg-light">Cover Image: *<br><small>A jpg or jpeg file less than 5 MB can be uploaded.</small></label>
                                        <div class="col-lg-10">
                                            <div><a target="_blank" href="../lib/coverimage/<?=$rs['CoverImage']?>"><img src="../lib/coverimage/<?=$rs['CoverImage']?>" width="120" class="mb-2"/></a></div>
                                            <div class="input-group">
                                                <div class="custom-file">
                                                    <input type="file" class="form-control" name="CoverImage">
                                                </div>
                                            </div>
                                        </div>
                                        
                                    </div>    
                                    
                                    <div class="form-group row mb-2">
                                        <label class="col-lg-2 col-form-label bg-light">Display Images:<br><small>A jpg or jpeg file less than 5 MB can be uploaded.</small></label>
                                        <div class="col-lg-2">
                                            <div class="badge badge-secondary">Image 1</div>
                                            <? if ($rs['Image1']!="") { ?>
                                            <div><a target="_blank" href="../lib/packageimages/<?=$rs['Image1']?>"><img src="../lib/packageimages/<?=$rs['Image1']?>" width="120" class="mb-2"/></a></div>
                                            <? } ?>
                                            <div class="input-group">                                                
                                                <div class="custom-file">
                                                    <input type="file" class="form-control"  name="Image1">
                                                </div>
                                            </div>                                            
                                        </div>

                                        <div class="col-lg-2">
                                            <div class="badge badge-secondary">Image2</div>
                                             <? if ($rs['Image2']!="") { ?>
                                            <div><a target="_blank" href="../lib/packageimages/<?=$rs['Image2']?>"><img src="../lib/packageimages/<?=$rs['Image2']?>" width="120" class="mb-2"/></a></div>
                                            <? } ?>
                                            <div class="input-group">                                                
                                                <div class="custom-file">
                                                    <input type="file" class="form-control"  name="Image2">
                                                </div>
                                            </div>                                            
                                        </div>

                                        <div class="col-lg-2">
                                            <div class="badge badge-secondary">Image 3</div>
                                             <? if ($rs['Image3']!="") { ?>
                                            <div><a target="_blank" href="../lib/packageimages/<?=$rs['Image3']?>"><img src="../lib/packageimages/<?=$rs['Image3']?>" width="120" class="mb-2"/></a></div>
                                            <? } ?>
                                            <div class="input-group">                                                
                                                <div class="custom-file">
                                                    <input type="file" class="form-control" name="Image3">
                                                </div>
                                            </div>                                            
                                        </div>

                                        <div class="col-lg-2">
                                            <div class="badge badge-secondary">Image 4</div>
                                             <? if ($rs['Image4']!="") { ?>
                                            <div><a target="_blank" href="../lib/packageimages/<?=$rs['Image4']?>"><img src="../lib/packageimages/<?=$rs['Image4']?>" width="120" class="mb-2"/></a></div>
                                            <? } ?>
                                            <div class="input-group">                                                
                                                <div class="custom-file">
                                                    <input type="file" class="form-control" name="Image4">
                                                </div>
                                            </div>                                            
                                        </div>

                                        <div class="col-lg-2">
                                            <div class="badge badge-secondary">Image 5</div>
                                             <? if ($rs['Image5']!="") { ?>
                                            <div><a target="_blank" href="../lib/packageimages/<?=$rs['Image5']?>"><img src="../lib/packageimages/<?=$rs['Image5']?>" width="120" class="mb-2"/></a></div>
                                            <? } ?>
                                            <div class="input-group">                                                
                                                <div class="custom-file">
                                                    <input type="file" class="form-control"  name="Image5">
                                                </div>
                                            </div>                                            
                                        </div>
                                    </div>    

                                    <div class="form-group row">
                                        <label class="col-lg-2 col-form-label" for="Overview">Overview *</label>
                                        <div class="col-lg-10">
                                            <textarea id="overview" class="form-control" name="Overview" required><?=$rs['Overview']?></textarea>
                                        </div>
                                    </div>


                                    <div class="form-group row">
                                        <label class="col-lg-2 col-form-label" for="inclusions">Inclusions *</label>
                                        <div class="col-lg-10">
                                            <textarea id="inclusions" class="form-control" name="Inclusions" required><?=$rs['Inclusions']?></textarea>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-lg-2 col-form-label" for="exclusions">Exclusions</label>
                                        <div class="col-lg-10">
                                            <textarea id="exclusions" class="form-control" name="Exclusions"><?=$rs['Exclusions']?></textarea>
                                        </div>
                                    </div>
                                   
                                  

                                    <div class="form-group row mb-2">
                                        <label class="col-lg-2 col-form-label">Terms & Conditions</label>
                                        <div class="col-lg-10">
                                           <textarea class="form-control" name="Terms"><?=$rs['Terms']?></textarea>
                                        </div>
                                    </div>


                                    <div class="page-title-right mt-4">
                                        <input type="submit" class="btn btn-primary waves-effect waves-light" value="Submit Package">
                                    </div>

                                </form>

                            </div> <!-- end card-box -->
                        </div> <!-- end card-->
                    </div><!-- end col -->
                </div>

             
            </div> 


            <? include_once("includes/footer.php"); ?>

        </div>

    </div>

    <div class="rightbar-overlay"></div>
    <script src="assets/js/vendor.min.js"></script>
    <script src="assets/libs/summernote/summernote-bs4.min.js"></script>
    <script src="assets/libs/dropzone/dropzone.min.js"></script>
    <script>
        $(document).ready(function () {
        $("#overview").summernote({ height: 250, minHeight: null, maxHeight: null, focus: !1 }), 
        $("#inclusions").summernote({ height: 250, minHeight: null, maxHeight: null, focus: !1 }), 
        $("#exclusions").summernote({ height: 250, minHeight: null, maxHeight: null, focus: !1 });
    });

    </script>        
    <script src="assets/js/app.min.js"></script>   
    <script>
        $(".allow_decimal").on("input", function(evt) {
        var self = $(this);
        self.val(self.val().replace(/[^0-9\.]/g, ''));
        if ((evt.which != 46 || self.val().indexOf('.') != -1) && (evt.which < 48 || evt.which > 57)) 
        {
            evt.preventDefault();
        }
        });
        </script>


    <script src="https://code.jquery.com/jquery-2.2.4.min.js" integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44=" crossorigin="anonymous"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tagsinput/0.8.0/bootstrap-tagsinput.min.js" crossorigin="anonymous"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.8.0/js/bootstrap-datepicker.min.js" referrerpolicy="no-referrer"></script>
    

    <script>
        $(function () {
            $("#FixedDeparture").datepicker({
                format: 'dd-MM-yyyy',
                inline: true,
                lang: 'en',
                // step: 5,
                multidate: 5,
                todayHighlight: true,
                closeOnDateSelect: true
            });
            
        });
    
    </script>


</body>


</html>