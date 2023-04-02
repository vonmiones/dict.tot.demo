<?php if(isset($_POST['id'])):?>
<?php 
    global $config;
    $rid = $_REQUEST['id'];
    require_once "../../config.php";

    $servername = $config["dbhost"];
    $port = $config["dbport"];
    $username = $config["dbuser"];
    $password = $config["dbpass"];
    $dbname = $config["dbname"];

    $conn =  new mysqli($servername, $username, $password, $dbname, $port);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    
    $sql = "SELECT * FROM demoentity";
    $sql .= " WHERE id = $rid";

    $result = $conn->query($sql);

    $data = array();
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $data[] = $row;;
        }
    } else {
        $result = "0 results";
    }
    $conn->close();
$data = $data[0];
$id = $data['id'];
$fname = $data['fname'];
$mname = $data['mname'];
$lname = $data['lname'];
$suffix = $data['suffix'];
$sex = $data['sex'];
$civilstatus = $data['civilstatus'];
$birthdate = $data['birthdate'];
$height = $data['height'];
$weight = $data['weight'];
$bloodtype = $data['bloodtype'];
$barangay = $data['barangay'];
$citymun = $data['citymun'];
$province = $data['province'];
$email = $data['email'];
$contactno = $data['contactno'];
$contactno2 = $data['contactno2'];
$isvaccinated = $data['isvaccinated'];
$vaccinedetails = $data['vaccinedetails'];
$disease = $data['disease'];
$symptoms = $data['symptoms'];
$medicationdetails = $data['medicationdetails'];
$recommendation = $data['recommendation'];
$dtcreated = $data['dtcreated'];
$dtupdate = $data['dtupdate'];
$remarks = $data['remarks'];
$datastatus = $data['datastatus'];
$temp = $data['temp'];
$coviddiagnosed = $data['coviddiagnosed'];
$covidencounter = $data['covidencounter'];
$country = $data['country'];
?>
<script>
$("input[name=fname]").val("<?= $fname;?>");
$("input[name=mname]").val("<?= $mname;?>");
$("input[name=lname]").val("<?= $lname;?>");
<?php if($suffix != ""):?>
    $("select[name^=suffix] option[value=<?= $suffix;?>]").attr('selected', "selected");
<?php endif;?>
$("select[name^=sex] option[value=<?= $sex;?>]").attr('selected', "selected");
$("input[name=civilstatus]").val("<?= $civilstatus;?>");
$("input[name=birthdate]").val("<?= $birthdate;?>");
$("input[name=height]").val("<?= $height;?>");
$("input[name=weight]").val("<?= $weight;?>");
$("input[name=bloodtype]").val("<?= $bloodtype;?>");
$("input[name=barangay]").val("<?= $barangay;?>");
$("input[name=citymun]").val("<?= $citymun;?>");
$("input[name=province]").val("<?= $province;?>");
$("input[name=email]").val("<?= $email;?>");
$("input[name=contactno]").val("<?= $contactno;?>");
$("input[name=contactno2]").val("<?= $contactno2;?>");
$("input[name=isvaccinated]:eq(<?= $isvaccinated;?>)").attr('checked', "checked");
$("input[name=vaccinedetails]").val("<?= $vaccinedetails;?>");
$("input[name=disease]").val("<?= $disease;?>");
$("input[name=symptoms]").val("<?= $symptoms;?>");
$("input[name=medicationdetails]").val("<?= $medicationdetails;?>");
$("input[name=recommendation]").val("<?= $recommendation;?>");
$("input[name=dtcreated]").val("<?= $dtcreated;?>");
$("input[name=dtupdate]").val("<?= $dtupdate;?>");
$("input[name=remarks]").val("<?= $remarks;?>");
$("input[name=datastatus]").val("<?= $datastatus;?>");
$("input[name=temp]").val("<?= $temp;?>");
$("select[name^=coviddiagnosed] option[value=<?= $coviddiagnosed;?>]").attr('selected', "selected");
$("select[name^=covidencounter] option[value=<?= $covidencounter;?>]").attr('selected', "selected");
$("input[name=country]").val("<?= $country;?>");
</script>
<?php endif;?>

<div class="content-wrapper">
    <div class="form-header">
    </div>
    <div class="form-container">
        <form id="healthInformationForm" class="needs-validation" novalidate>
            <div class="form-wrapper">
                <div class="form-floating">
                    <input name="fname" required type="text" class="form-control" id="txbFirstName" placeholder="First Name">
                    <label for="txbFirstName">First Name</label>
                </div>
                <div class="form-floating">
                    <input name="mname" required type="text" class="form-control" id="txbMiddleName" placeholder="Middle Name">
                    <label for="txbMiddleName">Middle Name</label>
                </div>
                <div class="form-floating">
                    <input name="lname" required type="text" class="form-control" id="txbLastName" placeholder="Last Name">
                    <label for="txbLastName">Last Name</label>
                </div>
                <div class="form-floating">
                    <select name="suffix" required class="form-select" id="selectSex" aria-label="Suffix Options">
                        <option></option>
                        <option value="1">Senior</option>
                        <option value="2">Junior</option>
                        <option value="3">III</option>
                        <option value="4">IV</option>
                        <option value="5">V</option>
                        <option value="6">VI</option>
                        <option value="7">VII</option>
                        <option value="8">VIII</option>
                        <option value="9">IX</option>
                        <option value="10">X</option>
                    </select>
                    <label for="floatingSelect">Suffix</label>
                </div>
            </div>
            <div class="form-wrapper">
                <div class="form-floating" style="flex-grow: 1;">
                    <select name="sex" required class="form-select" id="selectSex" aria-label="Sex Options">
                        <option value="m">Male</option>
                        <option value="f">Female</option>
                    </select>
                    <label for="floatingSelect">Sex</label>
                </div>
                <div class="form-floating" style="flex-grow: 1;">
                    <select name="civilstatus" required class="form-select" id="selectSex" aria-label="Civil Status Options">
                        <option value="1">Single</option>
                        <option value="2">Married</option>
                        <option value="3">Widow</option>
                        <option value="4">Separated</option>
                        <option value="5">Divorsed</option>
                    </select>
                    <label for="floatingSelect">Civil Status</label>
                </div>
                <div class="form-floating">
                    <input name="birthdate" required type="date" class="form-control" id="txbBirthday" placeholder="Birthday">
                    <label for="txbBirthday">Birthday</label>
                </div>               
            </div>
            <div class="form-wrapper">
                <div class="form-floating" >
                    <input name="height" required type="number" class="form-control" id="txbHeight" placeholder="Height">
                    <label for="txbHeight">Height<sup>(<i> cm </i>)</sup> </label>
                </div>
                <div class="form-floating" >
                    <input name="weight" required type="number" class="form-control" id="txbWeight" placeholder="Weight">
                    <label for="txbWeight">Weight<sup>(<i> kilo </i>)</sup></label>
                </div>
                <div class="form-floating" style="flex-grow: 1;">
                    <select name="bloodtype" required class="form-select" id="selectSex" aria-label="Blood Type Options">
                        <option value="op">O+</option>
                        <option value="om">O-</option>
                        <option value="ap">A+</option>
                        <option value="am">A-</option>
                        <option value="bp">B+</option>
                        <option value="bm">B-</option>
                        <option value="abp">AB+</option>
                        <option value="abm">AB-</option>
                    </select>
                    <label for="floatingSelect">Blood Type</label>
                </div> 
            </div>
            <div>Contact Information</div>
            <!-- <div class="form-wrapper">
                <div class="form-floating" style="flex-grow: 1;">
                    <input name="barangay" required type="text" class="form-control" id="txbAddress" placeholder="Address">
                    <label for="txbAddress">Barangay</label>
                </div>
                <div class="form-floating" style="flex-grow: 1;">
                    <input name="citymun" required type="text" class="form-control" id="txbAddress" placeholder="Address">
                    <label for="txbAddress">City / Municipality</label>
                </div>
                <div class="form-floating" style="flex-grow: 1;">
                    <input name="province" required type="text" class="form-control" id="txbAddress" placeholder="Address">
                    <label for="txbAddress">Province</label>
                </div>
            </div> -->
            <div class="form-wrapper">
                <div class="form-floating" style="flex-grow: 1;">
                    <select name="coviddiagnosed" required class="form-select" id="selectCOVID-19Diagnosed" aria-label="COVID-19 Diagnosed Options">
                        <option value="0">No</option>
                        <option value="1">Yes</option>
                    </select>
                    <label for="floatingSelect">COVID-19 Diagnosed</label>
                </div>
                <div class="form-floating" style="flex-grow: 1;">
                    <select name="covidencounter" required class="form-select" id="selectCOVID-19Encounter" aria-label="COVID-19 Encounter Options">
                        <option value="0">No</option>
                        <option value="1">Yes</option>
                    </select>
                    <label for="floatingSelect">COVID-19 Encounter</label>
                </div>
                <div class="form-floating" >
                    <input name="temp" required type="number" step=".01" pattern="^\d+(?:\.\d{1,2})?$"  class="form-control" id="txbTemp" placeholder="Temp">
                    <label for="txbTemp">Temperature<sup>(<i> Celcius </i>)</sup> </label>
                </div>
            </div>
            <div class="form-wrapper">
                <div class="form-floating" style="flex-grow: 1;">
                    <input name="email" required type="text" class="form-control" id="txbAddress" placeholder="Address">
                    <label for="txbAddress">Email</label>
                </div>
                <div class="form-floating" style="flex-grow: 1;">
                    <input name="contactno" required type="text" class="form-control" id="txbAddress" placeholder="Address">
                    <label for="txbAddress">Contact Number</label>
                </div>
                <div class="form-floating" style="flex-grow: 1;">
                    <input name="contactno2" required type="text" class="form-control" id="txbAddress" placeholder="Address">
                    <label for="txbAddress">Alternative Contact Number</label>
                </div>
            </div>
            <div>Disease Information</div>
            <div class="form-wrapper">
                <div class="form-floating" style="flex-grow: 1;">
                    <div class="form-check" >
                        <div class="btn-group" role="group" aria-label="Basic radio toggle button group">
                            <input type="radio" class="btn-check" name="isvaccinated"  value="0" id="isvaccinated1" autocomplete="off" checked>
                            <label class="btn btn-outline-primary" for="isvaccinated1">Not Vaccinated</label>
                            
                            <input type="radio" class="btn-check" name="isvaccinated"  value="1" id="isvaccinated2" autocomplete="off">
                            <label class="btn btn-outline-primary" for="isvaccinated2">Partially Vaccinated</label>
                            
                            <input type="radio" class="btn-check" name="isvaccinated"  value="2" id="isvaccinated3" autocomplete="off">
                            <label class="btn btn-outline-primary" for="isvaccinated3">Fully Vaccinated</label>
                        </div>
                    </div>
                    <div class="form-floating" style="flex-grow: 1;">
                        <input name="vaccinedetails" required type="text" class="form-control" id="txbAddress" placeholder="Address">
                        <label for="txbAddress">Vaccine Details</label>
                    </div> 
                </div>
            </div>
            <div class="form-wrapper">
                <div class="form-floating">
                    <select name="disease" required class="form-select" id="selectDiseases" aria-label="Disease Information">
                    </select>
                    <label for="floatingSelect">Disease Information</label>
                </div>
                <div class="form-floating" style="flex-grow: 1;">
                    <textarea name="symptoms" class="form-control" placeholder="Symptoms" id="floatingTextarea"></textarea>
                    <label for="txbAddress">Symptoms</label>
                </div>
            </div>
            <div class="form-wrapper" style="height:50px;">
                <div class="form-floating" style="flex-grow: 1;">
                    <textarea name="medicationdetails" class="form-control" placeholder="Medication" id="floatingTextarea"></textarea>
                    <label for="txbAddress">Medication Details<sup>(<i> If the patient is taking medications prior to consultation </i>)</sup></label>
                </div>
            </div>
            <div>Recommended Action</div>
            <div class="form-wrapper">
                <div class="btn-group" role="group" aria-label="Basic radio toggle button group">
                    <input name="recommendation" required type="radio" class="btn-check" id="btnradio1" autocomplete="off" value="1" checked>
                    <label class="btn btn-outline-primary" for="btnradio1">Out Patient Cosultation</label>
                    
                    <input name="recommendation" required type="radio" class="btn-check" id="btnradio2" autocomplete="off" value="2">
                    <label class="btn btn-outline-primary" for="btnradio2">Recommend for Hospital Admission</label>
                </div>
            </div>
            <?php if($id != ""):?>
                <input name="id" value="<?=$id;?>" type="hidden">                
            <?php endif;?>
        </form>
    </div>
</div>
<script>
    $("#chkVaccinated").change(function() {
        $(this).val($(this).prop('checked'));
    });
    $(document).ready(function () {
        function getDiseaseList() { 
            $.ajax({
                url: "api.php?method=get&action=diseaseslist",
                success: function (d) {
                    console.log(d);
                    $(d.data).each(function (i, d) { 
                        let o = $("<option>");
                        $(o).val(d.name);
                        $(o).text(d.name);
                        $(o).appendTo("#selectDiseases");
                    });
                }
            });
         }
         getDiseaseList();
    });
</script>
