<?php
require './landingPage/link.php';
//require './landingPage/preloader.php';
require './landingPage/click2call.php';
require './landingPage/header.php';

$salesforce = file_get_contents("./data/salesforce-integration.json");
$salesforce = json_decode($salesforce, true);
$salesforce = $salesforce['viewModel'];

$salesforcedetails = '';
foreach ($salesforce['salesforcebanner'] as $value) {
        $salesforcedetails = $value;
}


$file = file_get_contents("/var/www/config.json");
$file = json_decode($file, true);
define("configAPI", $file['configAPI']);
define("_MONGODB_", $file['_MONGODB_']);
require "/var/www/html/vendor/autoload.php";
//require "/var/www/html/data/function.php";
$client = new MongoDB\Client;
$db = $client->{_MONGODB_};
@$flag = $_POST['flag'];
@$id = $_POST['id'];
$arr = [];
$blog = $db->blogall;
$blog1 = $blog->findOne(
        ["url" => $salesforce["salesforceBlogs"]["blog1"], "status" => true],
        ["projection" => ["_id" => 0, "thumbnail_image" => 1, "name" => 1,  "status" => 1, "url" => 1, "imgalttext" => 1, "description" => 1, "short_Description" => 1]]
);
$blog1 = (array) $blog1;
$blog2 = $blog->findOne(
        ["url" => $salesforce["salesforceBlogs"]["blog2"], "status" => true],
        ["projection" => ["_id" => 0, "thumbnail_image" => 1, "name" => 1,  "status" => 1, "url" => 1, "imgalttext" => 1, "description" => 1, "short_Description" => 1]]
);
$blog2 = (array) $blog2;
?>

<section id="salesforce-int-banner" class="banner-height">
        <div class="container">
                <div class="col-md-12 div-center-alignment">
                        <div class="row">
                                <div class="col-md-7">
                                        <h1 class="h1-responsive color-blue mb-1"><?php echo $salesforcedetails['bannerheading'] ?></h1>
                                        <p class="banner-description" style="font-size: 20px!important;"><?php echo $salesforcedetails['bannerparagraph']; ?></p>
                                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal"><?php echo $salesforcedetails['btnOne']; ?></button>
                                        <button type="button" class="btn btn-primary" onclick="model_open_embedUrl('<?php echo $salesforcedetails['btnTwoVideo']; ?>')" data-toggle="modal" data-target="#modal_video"><?php echo $salesforcedetails['btnTwo'] ?></button>
                                </div>
                                <div class="col-md-5">
                                        <img src="<?php echo  BASE_URL . $salesforcedetails['bannerimage']; ?>" width="100%" alt="">
                                </div>
                        </div>
                </div>
        </div>
</section>

<section class="client-logo pt-2">
        <div class="container">
                <h2 class="text-center mt-2 mx-auto sm-heading"><?php echo $salesforce['salesforceTrusted']['Trustedheading']; ?></h2>
                <div class="col-md-12 py-2">
                        <div class="row">
                                <?php
                                $salesforceTrusteddetails = '';
                                foreach ($salesforce['salesforceTrusted']['salesforceImages'] as $value) {
                                        $salesforceTrusteddetails = $value;

                                ?>
                                        <div class="col-md-2 col-6 text-center">
                                                <img src="<?php echo  BASE_URL . $salesforceTrusteddetails['image']; ?>" width="100%" alt="">
                                        </div>
                                <?php } ?>
                        </div>
                </div>
        </div>
</section>

<section class="salesforce-tab-section my-3">
        <div class="container">
                <ul class="nav nav-pills">
                        <?php

                        foreach ($salesforce['salesForceTab'] as $tabs) {
                                $active = ($tabs["tab"] == "Overview") ? "active" : "";
                        ?>
                                <li class="nav-item">
                                        <a class="nav-link <?php echo $active; ?>" href="#<?php echo $tabs["href"]; ?>" data-toggle="pill"><?php echo $tabs["tab"]; ?></a>
                                </li>
                        <?php
                        }
                        ?>

                </ul>
                <div class="tab-content d-block mt-3 p-0">
                        <div class="tab-pane container p-0 active" id="salesforce-overview">
                                <div class="row">
                                        <div class="col-md-6">
                                                <p class="mb-0"><?php echo $salesforce['salesforceoverview']['overviewtitle']; ?></p>
                                                <div class="dashline bg-blue mb-2"></div>
                                                <ul>
                                                        <?php
                                                        foreach ($salesforce['salesforceoverview']['overviewdescription'] as $item) {
                                                        ?>
                                                                <li class="d-flex"><i class="fa fa-check-square fa-lg" style="margin-top:5px;"></i>
                                                                        <p class="ml-2"><?php echo $item; ?></p>
                                                                </li>
                                                        <?php } ?>

                                                </ul>
                                        </div>
                                        <div class="col-md-6 text-center">
                                                <img class="overviewImg" src="<?php echo  BASE_URL . $salesforce['salesforceoverview']['overviewimage']; ?>" width="80%" alt="">
                                        </div>
                                </div>
                        </div>



                        <section class="tab-pane container fade p-0" id="salesforce-install">
                                <!-- Desktop view start -->
                                <div class="container salesforce-install-lg">
                                        <!--Carousel start -->
                                        <div id="demo" class="carousel slide" data-interval="false">
                                                <div class="carousel-inner">
                                                        <?php
                                                        $s = 0;
                                                        foreach ($salesforce["salesforceinstall"] as $saleForceValue) {
                                                                $s++;
                                                                $actSale = ($s == 1) ? "active" : "";
                                                        ?>
                                                                <div class="carousel-item <?= $actSale ?> border rounded p-2">
                                                                        <img src="<?php echo $saleForceValue["integrationimage"]; ?>" alt="screen-1" style="width:100%;">
                                                                        <p class="mt-2 border-top"><b><?php echo $s; ?>.</b> <?php echo $saleForceValue["integrationheading"]; ?></p>
                                                                </div>
                                                        <?php } ?>

                                                </div>

                                                <a class="carousel-control-prev bg-secondary" href="#demo" data-slide="prev" style="width:30px;height: 30px;top: 50%;border-radius: 50%;">
                                                        <span style="font-size:28px;"><</span>
                                                </a>
                                                <a class="carousel-control-next bg-secondary" href="#demo" data-slide="next" style="width:30px;height: 30px;top: 50%;border-radius: 50%;">
                                                        <span style="font-size:28px;">></span>
                                                </a>
                                        </div>
                                        <!--Carousel start -->

                                </div>
                                <!-- Desktop view end -->
                                <!-- Mobile view start -->

                                <div class="container salesforce-install-sm">
                                        <?php
                                        $s = 0;
                                        foreach ($salesforce["salesforceintegration"] as $saleForceValue) {
                                                $s++;
                                                $actSale = ($s == 1) ? "active" : "";
                                        ?>
                                                <div class="border rounded p-2 mb-1">
                                                        <img src="<?php echo $saleForceValue["integrationimage"]; ?>" alt="screen-1" style="width:100%;">
                                                        <p class="mt-2 border-top"><b><?php echo $s; ?>.</b> <?php echo $saleForceValue["integrationheading"]; ?></p>
                                                </div>
                                        <?php } ?>


                                </div>
                                <!-- Mobile view end -->
                        </section>

                        <!-- <div class="tab-pane container fade p-0" id="salesforce-screenshot"><?php echo $salesforce['salesforceinstall']['screenshots']; ?></div> -->
                        <div class="tab-pane container fade p-0" id="salesforce-screenshot">
                                <div class="row">
                                        <div class="gallarySlider-column col-md-3 mb-1" style="cursor:pointer;">
                                                <div class="border rounded p-2 d-flex h-100">
                                                        <img class="gallarySlider-img" src="<?php echo  BASE_URL . "/images/partners-page/salesforce-integration/CTI_SF.jpg"; ?>" style="width:100%" onclick="openModal();currentSlide(1)" class="hover-shadow cursor">
                                                </div>
                                        </div>
                                        <div class="gallarySlider-column col-md-3 mb-1" style="cursor:pointer;">
                                                <div class="border rounded p-2 d-flex h-100">
                                                        <img class="gallarySlider-img" src="<?php echo  BASE_URL . "/images/partners-page/salesforce-integration/CTI_Incall1.jpg"; ?>" style="width:100%" onclick="openModal();currentSlide(2)" class="hover-shadow cursor">
                                                </div>
                                        </div>
                                        <div class="gallarySlider-column col-md-3 mb-1" style="cursor:pointer;">
                                                <div class="border rounded p-2 d-flex h-100">
                                                        <img class="gallarySlider-img" src="<?php echo  BASE_URL . "/images/partners-page/salesforce-integration/CTI_Incall2.jpg"; ?>" style="width:100%" onclick="openModal();currentSlide(3)" class="hover-shadow cursor">
                                                </div>
                                        </div>
                                        <div class="gallarySlider-column col-md-3 mb-1" style="cursor:pointer;">
                                                <div class="border rounded p-2 d-flex h-100">
                                                        <img class="gallarySlider-img" src="<?php echo  BASE_URL . "/images/partners-page/salesforce-integration/CTI_Incall3.jpg"; ?>" style="width:100%" onclick="openModal();currentSlide(4)" class="hover-shadow cursor">
                                                </div>
                                        </div>
                                </div>

                                <div id="gallarySlider-myModal" class="modal gallarySlider-modal">
                                        <span class="close cursor gallarySlider-close" onclick="closeModal()">&times;</span>
                                        <div class="modal-content gallarySlider-content">

                                                <div class="gallarySlider-slides">
                                                        <div class="gallarySlider-numbertext">1 / 4</div>
                                                        <img class="gallarySlider-img" src="<?php echo  BASE_URL . "/images/partners-page/salesforce-integration/CTI_SF.jpg"; ?>" style="width:100%">
                                                </div>

                                                <div class="gallarySlider-slides">
                                                        <div class="gallarySlider-numbertext">2 / 4</div>
                                                        <img class="gallarySlider-img" src="<?php echo  BASE_URL . "/images/partners-page/salesforce-integration/CTI_Incall1.jpg"; ?>" style="width:100%">
                                                </div>

                                                <div class="gallarySlider-slides">
                                                        <div class="gallarySlider-numbertext">3 / 4</div>
                                                        <img class="gallarySlider-img" src="<?php echo  BASE_URL . "/images/partners-page/salesforce-integration/CTI_Incall2.jpg"; ?>" style="width:100%">
                                                </div>

                                                <div class="gallarySlider-slides">
                                                        <div class="gallarySlider-numbertext">4 / 4</div>
                                                        <img class="gallarySlider-img" src="<?php echo  BASE_URL . "/images/partners-page/salesforce-integration/CTI_Incall3.jpg"; ?>" style="width:100%">
                                                </div>

                                                <a class="gallarySlider-prev" onclick="plusSlides(-1)">&#10094;</a>
                                                <a class="gallarySlider-next" onclick="plusSlides(1)">&#10095;</a>


                                        </div>
                                </div>
                        </div>

                </div>
        </div>
</section>

<?php
$integrateddetails = '';
foreach ($salesforce['salesforceintegration'] as $value) {
        $integrateddetails = $value;
}

?>

<section class="bsst-section my-3 py-3 bg-blue text-center">
        <div class="container ">
                <h2 class="my-2 h2-width mx-auto text-white"><?php echo $integrateddetails['integrationheading']; ?></h2>
                <div class="imgDiv mx-auto">
                        <img src="<?php echo  BASE_URL . $integrateddetails['integrationimage']; ?>" width="100%" alt="">
                </div>
                <p class="text-white"><?php echo $integrateddetails['integrationtitle']; ?></p>
                <!-- <button class="btn btn-sm btn-outline-info waves-effect knowMoreConnectBtn text-capitalize fs-18 bg-white" data-toggle="modal" data-target="#exampleModal"><?php echo $integrateddetails['integrationbutton']; ?></button> -->
        </div>
</section>



<section class="pt-3">
        <div class="container">
                <?php
                $salesforcefeaturesdetails = '';
                foreach ($salesforce['salesforsefeatures']['featuredetails'] as $value) {
                        $salesforcefeaturesdetails = $value;

                        if ($salesforcefeaturesdetails['sectionorder'] == "odd") {

                ?>

                                <div class="col-md-12 mb-5">
                                        <div class="row">
                                                <div class="col-md-6">
                                                        <h2 class="sm-heading color-blue"><?php echo $salesforcefeaturesdetails['featureheading']; ?></h2>
                                                        <div class="dashline mb-2 bg-brown"></div>
                                                        <p><?php echo $salesforcefeaturesdetails['featuretitle']; ?></p>
                                                </div>
                                                <div class="col-md-6 text-center">
                                                        <img class="grid-img" src="<?php echo  BASE_URL . $salesforcefeaturesdetails['featureimage']; ?>" width="" alt="">
                                                </div>
                                        </div>
                                </div>

                        <?php }
                        if ($salesforcefeaturesdetails['sectionorder'] == "even") {

                        ?>
                                <div class="col-md-12 mb-5">
                                        <div class="row">
                                                <div class="col-md-6 text-center">
                                                        <img class="grid-img" src="<?php echo  BASE_URL . $salesforcefeaturesdetails['featureimage']; ?>" width="" alt="">
                                                </div>
                                                <div class="col-md-6">
                                                        <h2 class="sm-heading color-blue"><?php echo $salesforcefeaturesdetails['featureheading']; ?></h2>
                                                        <div class="dashline mb-2 bg-brown"></div>
                                                        <p><?php echo $salesforcefeaturesdetails['featuretitle']; ?></p>
                                                        <?php if ($salesforcefeaturesdetails['featurebutton'] == "Request Demo") { ?>
                                                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal"><?php echo $salesforcefeaturesdetails['featurebutton']; ?></button>
                                                        <?php } ?>
                                                </div>
                                        </div>
                                </div>

                <?php }
                } ?>



        </div>
</section>

<?php
$videodetails = '';
foreach ($salesforce['videosection'] as $value) {
        $videodetails = $value;
}

?>

<section class="my-3 py-3 video-section">
        <div class="container-fluid">
                <div class="row justify-content-md-center">
                        <div class="col-md-10 mt-2">
                                <div class="col-md-12">
                                        <div class="row align-items-center">
                                                <div class="col-md-5 p-4">
                                                        <div onclick="model_open_embedUrl('<?php echo $value['video_url']; ?>')" data-toggle="modal" data-target="#modal_video" style="cursor: pointer;">
                                                                <img src="<?php echo $value['videoimage']; ?>" width="100%" alt="NetMeds">
                                                                <i class="fab fa-youtube text-danger fs-40" style="position: absolute;left: 45%;top: 45%;"></i>
                                                        </div>
                                                </div>
                                                <div class="col-md-7 p-4 text-center mt-1 mt-sm-3 mt-md-3 mt-lg-3">
                                                        <h2 class="my-0 my-sm-2 my-md-2 my-lg-2 h2-width color-blue" id="netmeds"><?php echo $videodetails['videoheading'] ?></h2>
                                                        <p class="text-justify"><?php echo $videodetails['videotitle'] ?></p>
                                                        <h4 class="mb-0 bruce"> <b><?php echo $videodetails['videoheadingone'] ?></b> </h4>
                                                        <p class="text-muted chief"> <small><?php echo $videodetails['videodescription'] ?></small> </p>
                                                </div>
                                        </div>
                                </div>
                        </div>
                </div>
        </div>
</section>

<section class="cfs-features mt-3">
        <h2 class="text-center my-2 h2-width mx-auto color-blue" id=""><?php echo $salesforce['salesforcenewfeature']['salesforcenewheading']; ?></h2>
        <div class="container">
                <div class="row">
                        <?php
                        $newfeaturedetails = '';
                        foreach ($salesforce['salesforcenewfeature']['newfeturesdetails'] as $value) {
                                $newfeaturedetails = $value;
                        ?>
                                <div class="col-md-6 mt-3 cfs-features-grid d-flex">
                                        <div class="cfs-features-icon border border-secondary p-3 rounded">
                                                <img src="<?php echo  BASE_URL . $newfeaturedetails['newfeatureimage']; ?>" width="100%" alt="">
                                        </div>
                                        <div>
                                                <h2 class="sm-heading color-blue"><?php echo $newfeaturedetails['newfeatureheading']; ?></h2>
                                                <div class="dashline mb-2 bg-brown"></div>
                                                <p><?php echo $newfeaturedetails['newfeaturetitle']; ?></p>
                                        </div>
                                </div>

                        <?php } ?>
                </div>
        </div>
</section>

<section class="">
        <h2 class="text-center mt-2 mb-3 h2-width mx-auto color-blue">Related Articles</h2>
        <div class="container">
                <div class="col-md-12 mb-5">
                        <div class="row">
                                <div class="col-md-6">
                                        <div class="border rounded p-2 mb-2">
                                                <img src="<?php echo $blog1["thumbnail_image"]; ?>" alt="<?php echo $blog1["imgalttext"]; ?>" class="img-fluid" style="height: 200px;width: 100%;word-break: break-word;" />
                                                <h2 class="sm-heading color-blue"><?php echo $blog1["name"]; ?></h2>
                                                <div class="dashline mb-2 bg-brown"></div>
                                                <p class="mt-2"><?php echo $blog1["short_Description"]; ?>...</p>
                                                <div>
                                                        <a href="/blog/<?php echo $blog1["url"]; ?>">Read More</a>
                                                </div>
                                        </div>
                                </div>
                                <div class="col-md-6">
                                        <div class="border rounded p-2 mb-2">
                                                <img src="<?php echo $blog2["thumbnail_image"]; ?>" alt="<?php echo $blog2["imgalttext"]; ?>" class="img-fluid" style="height: 200px;width: 100%;word-break: break-word;" />
                                                <h2 class="sm-heading color-blue"><?php echo $blog2["name"]; ?></h2>
                                                <div class="dashline mb-2 bg-brown"></div>
                                                <p class="mt-2"><?php echo $blog2["short_Description"]; ?>...</p>
                                                <div>
                                                        <a href="/blog/<?php echo $blog2["url"]; ?>">Read More</a>
                                                </div>
                                        </div>
                                </div>
                        </div>
                </div>
        </div>
</section>


<section class="mt-3 py-3 salesforce-form-div">
        <h2 class="text-center mt-2 mb-3 h2-width mx-auto color-blue" id=""><?php echo $salesforce['salesforcecontact']['salesforcecontactheadingone']; ?></h2>
        <div class="container">
                <div class="salesforce-form bg-white px-3 py-4">
                        <h2 class="text-center my-2 h2-width mx-auto color-blue" id=""><?php echo $salesforce['salesforcecontact']['salesforcecontactheadingtwo'] ?></h2>
                        <div class="salesforce-form-inner pt-3">
                                <form method="post" action="" id="contact_formBookdemo" autocomplete="off">
                                        <div class="row mb-1">
                                                <div class="form-group col-md-6 mb-4">
                                                        <input type="text" name="name" maxlength="20" class="form-control-xs vmo-md-textbox" id="name" data-controlname="Name" placeholder="Name *" value="">
                                                        <small id="name_error" class="name_error_message text-danger"></small>
                                                </div>
                                                <div class="form-group col-md-6 mb-4">
                                                        <input type="text" name="phonenumberBookdemo" maxlength="20" class="form-control-xs vmo-md-textbox" id="phonenumberBookdemo" data-controlname="phonenumberBookdemo" placeholder="Mobile No. *" value="" style="width:75%;">
                                                        <small id="phonenumber_errorBookdemo" class="phone_error_message text-danger"></small>
                                                </div>
                                                <div class="form-group col-md-6 mb-4">
                                                        <input type="text" name="email" maxlength="50" class="form-control-xs vmo-md-textbox" id="email" placeholder="Business Email *" data-controlname="Email" value="">
                                                        <small id="email_error" class="email_error_message text-danger"></small>
                                                </div>
                                                <div class="form-group col-md-6 mb-4">
                                                        <input type="text" name="company" maxlength="50" class="form-control-xs vmo-md-textbox" id="company" data-controlname="Company" placeholder="Company Name *">
                                                        <small id="company_error" class="company_error_message text-danger"></small>
                                                </div>
                                        </div>

                                        <input type='hidden' name="mailType" value="bookDemo">
                                        <input type='hidden' id="global_number" name="global_number" value="freeTrailDemo">
                                        <input type='hidden' value="<?php echo $_SESSION['unique_key']; ?>" name="unique_key" />
                                        <input type="hidden" id="txtPhoneValidationStatusBookdemo2" name="txtPhoneValidationStatusBookdemo" value="">
                                        <input type='hidden' id='country_code_nameBookdemo2' value="" name="country_code_nameBookdemo" />
                                        <input type="hidden" name="country_codeBookdemo" id="country_codeBookdemo2" value="">

                                        <input type="hidden" name="adwords" id="adwords" value="Google Ad - UAE">
                                        <div class="text-center">
                                                <button type="submit" name="submit" class="btn btn-primary m-0" id="btnEmailRest" style="font-size: 1rem;">Book My Free Demo</button>
                                        </div>
                                </form>
                        </div>
                </div>
        </div>
</section>



<?php
require './landingPage/section-video-page.php';
require './landingPage/faqs.php';
require './landingPage/footer.php';
require './landingPage/video-model.php';
?>


<script>
        function get_faqs(arg, arg2) {
                $('#subjectmassage').val(arg2 + ' connect to sales');
                $('.set-faqs').load('<?php echo  BASE_URL . "/landingPage/faqs2.php?section="; ?>' + arg);
        }
        get_faqs('solution/cloud-contact-center', 'cloud-contact-center');
</script>

<style>
        .bg-blue {
                background: #0c82da !important;
        }

        .bg-brown {
                background: #4e2e07 !important;
        }

        .color-blue {
                color: #0c82da !important;
        }

        .color-brown {
                color: #4e2e07 !important;
        }

        .sm-heading {
                font-size: 22px !important;
        }

        .dashline {
                width: 100px;
                height: 3px;
                margin-bottom: 10px;
        }

        .cursor-p {
                cursor: pointer !important;
        }

        #salesforce-int-banner.banner-height {
                background: #fff !important;
                padding-top: 20px;
                /*padding-bottom: 0px;*/
                padding-bottom: 20px;
                height: auto;
                /*border-bottom: 1px solid #ddd;*/
        }

        #salesforce-int-banner.banner-height h1 {
                margin-top: 130px;
        }

        #salesforce-int-banner.banner-height button {
                margin-top: 50px;
        }

        .client-logo,
        .video-section {
                background: #f3f3f3;
        }

        .client-logo h2 {
                color: #999 !important;
        }

        .salesforce-tab-section ul {
                list-style-type: none !important;
                padding-left: 0 !important;
        }

        .salesforce-tab-section ul li {
                font-size: 16px !important;
                font-family: Roboto-Regular !important;
        }

        .salesforce-tab-section ul li .fa {
                color: #0c82da !important;
        }

        .salesforce-install-lg {
                display: block;
        }

        .salesforce-install-sm {
                display: none;
        }

        .bsst-section .imgDiv {
                width: 50%;
        }

        .grid-img {
                width: 70%;
        }

        .cfs-features-grid {
                gap: 1rem;
        }

        .cfs-features-icon {
                width: 80px;
                flex-shrink: 0;
                align-self: flex-start;
        }

        .salesforce-form-div {
                border-bottom: 5px solid #0c82da;
                background: #fbfbfb !important;
        }

        .salesforce-form {
                border: 2px solid #0c82da;
                border-radius: 10px;
        }

        .salesforce-form-inner {
                width: 80%;
                margin: 0 auto;
        }


        /*ScreenShots css start*/

        .row>.gallarySlider-column {
                padding: 0 8px;
        }

        .row:after {
                content: "";
                display: table;
                clear: both;
        }

        /* The Modal (background) */
        .gallarySlider-modal {
                display: none;
                position: fixed;
                z-index: 1111;
                /*  padding: 50px 0 50px 0;*/
                left: 0;
                top: 0;
                width: 100%;
                height: 100%;
                overflow: auto;
                background-color: black;
        }

        /* Modal Content */
        .gallarySlider-content {
                position: relative;
                /*  background-color: #fefefe;*/
                margin: auto;
                padding: 0;
                width: 90%;
                max-width: 1200px;
                display: flex;
                height: 100%;
                align-items: center;
                padding: 50px 0 50px 0;
        }

        /* The Close Button */
        .gallarySlider-close {
                color: white;
                position: absolute;
                top: 10px;
                right: 25px;
                font-size: 35px;
                font-weight: bold;
        }

        .gallarySlider-close:hover,
        .gallarySlider-close:focus {
                color: #999;
                text-decoration: none;
                cursor: pointer;
        }

        .gallarySlider-slides {
                display: none;
        }

        .cursor {
                cursor: pointer;
        }

        /* Next & previous buttons */
        .gallarySlider-prev,
        .gallarySlider-next {
                cursor: pointer;
                position: absolute;
                top: 50%;
                width: 35px;
                height: 35px;
                margin-top: -50px;
                font-weight: bold;
                font-size: 20px;
                transition: 0.6s ease;
                border-radius: 50%;
                user-select: none;
                -webkit-user-select: none;
                box-shadow: 0px 0px 5px 0px rgba(0, 0, 0, 0.3);
                display: flex;
                align-items: center;
                justify-content: center;
                background: #ffffff;
        }

        .gallarySlider-prev {
                left: -60px;
        }

        /* Position the "next button" to the right */
        .gallarySlider-next {
                right: -60px;
        }

        /* On hover, add a black background color with a little bit see-through */
        .gallarySlider-prev:hover,
        .gallarySlider-next:hover {
                background-color: #ddd;
        }

        /* Number text (1/3 etc) */
        .gallarySlider-numbertext {
                color: #f2f2f2;
                font-size: 12px;
                padding: 8px 12px;
                position: absolute;
                top: 0;
        }

        .gallarySlider-img {
                margin-bottom: -4px;
        }

        .active {
                opacity: 1;
        }

        .gallarySlider-img.hover-shadow {
                transition: 0.3s;
        }

        .hover-shadow:hover {
                box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
        }

        /*_______________________*/


        @media (min-width: 1200px) {

                .overviewImg {
                        margin-top: -100px;
                }


        }

        @media (max-width: 991px) and (min-width: 768px) {}

        @media (max-width: 600px) {

                .btn {
                        padding: .85rem 1.5rem;
                }

                h2 {
                        font-size: 30px;
                }

                #salesforce-int-banner.banner-height h1 {
                        margin-top: 15px;
                }

                #salesforce-int-banner.banner-height button {
                        margin-top: 10px;
                }

                #gallarySlider-myModal {
                        display: none !important;
                }

                .salesforce-install-lg {
                        display: none !important;
                }

                .salesforce-install-sm {
                        display: block !important;
                }

                .salesforce-tab-section .nav-pills {
                        justify-content: space-between;
                }

                .salesforce-tab-section .nav-link {
                        padding: .5rem 0.313rem !important;
                }

        }
</style>

<script type="text/javascript">
        $("#phonenumberBookdemo").intlTelInput({
                <?= (!empty($_SESSION["user"]['country_code_nameBookdemo'])) ? ("initialCountry:'" . $_SESSION["user"]['country_code_nameBookdemo'] . "',") : ('') ?>
                preferredCountries: ["in", "ae", "us", "id"],
                separateDialCode: true,
                //    utilsScript: "<?php echo BASE_URL; ?>/assets/intl-tel-input/build/js/utils.js",
        });
        var error = $("#phonenumberBookdemo").intlTelInput("getValidationError");
        var isValid = $("#phonenumberBookdemo").intlTelInput("isValidNumber");
        var telInput2 = $("#phonenumberBookdemo"),
                errorMsg = $(".phone_error_message"),
                validMsg = $(".phone_error_message");

        // initialise plugin
        telInput.intlTelInput({
                // utilsScript: "<?php echo BASE_URL; ?>/assets/intl-tel-input/build/js/utils.js",
        });
        var reset = function() {
                telInput2.removeClass("error");
        };
        telInput2.on("blur keyup", function() {
                reset();
                if ($.trim(telInput2.val())) {
                        if (telInput2.intlTelInput("isValidNumber")) {
                                $("#txtPhoneValidationStatusBookdemo2").val(1);
                                $("#phonenumber_errorBookdemo").html('');
                        } else {
                                telInput2.addClass("error");
                                $("#txtPhoneValidationStatusBookdemo2").val("error");
                                $("#phonenumber_errorBookdemo").html('* Valid phone number.');
                        }
                } else {
                        telInput2.addClass("error");
                        $("#txtPhoneValidationStatusBookdemo2").val("error");
                        $("#phonenumber_errorBookdemo").html('* Valid phone number.');
                }
        });

        // on keyup / change flag: reset
        telInput2.on("blur keyup", reset);
        telInput.on("blur keyup", reset);
        //===== end contry code set =============//
        $('#contact_formBookdemo').on('submit keyup', function(e) {
                if (e.type == 'submit') {
                        $("#phonenumberBookdemo").blur();
                }
                var reg = <?php echo _mailregex_; ?>;
                var namereg = /^[A-Za-z0-9 ]+$/;
                var companyreg = /^[A-Za-z0-9 ]+$/;
                var number = $("#phonenumberBookdemo").val().replace(/[^0-9.]/g, '');
                var name = $("#name").val();
                //alert(number);
                var email = $("#email").val().toLowerCase();
                var company = $("#company").val();
                $("#phonenumberBookdemo").val(number);
                $("#global_number").val($("#phonenumberBookdemo").intlTelInput("getSelectedCountryData").dialCode + " " + number);
                var country_code = $("#phonenumberBookdemo").intlTelInput("getSelectedCountryData");
                $("#country_codeBookdemo2").val(country_code.dialCode);
                $("#country_code_nameBookdemo2").val(country_code.iso2);
                $("#country_code_nameBookdemo").val(country_code.iso2);
                // var phonestatus = $("#phonenumber").val();
                if (name == "") {
                        $(".name_error_message").html(" * Name is required.");
                } else {
                        if (!namereg.test(name)) {
                                $(".name_error_message").html("Name, Only letters and white space allowed");
                        } else {
                                $(".name_error_message").html('');
                        }
                }
                if (reg.test(email) == false || email == "") {
                        $(".email_error_message").html('* Enter a valid business Email');
                } else {
                        $(".email_error_message").html('');
                }

                if (company == "") {
                        $(".company_error_message").html(" * Company is required.");
                } else {
                        if (!companyreg.test(company)) {
                                $(".company_error_message").html("Name, Only letters and white space allowed");
                        } else {
                                $(".company_error_message").html('');
                        }
                }
                if (name != "" && company != "" && reg.test(email) == true && email != '' && number != '' && namereg.test(name) == true) {
                        return true;
                } else {
                        return false;
                }
        });

        // ScreenShot js Start

        function openModal() {
                document.getElementById("gallarySlider-myModal").style.display = "block";
        }

        function closeModal() {
                document.getElementById("gallarySlider-myModal").style.display = "none";
        }

        var slideIndex = 1;
        showSlides(slideIndex);

        function plusSlides(n) {
                showSlides(slideIndex += n);
        }

        function currentSlide(n) {
                showSlides(slideIndex = n);
        }

        function showSlides(n) {
                var i;
                var slides = document.getElementsByClassName("gallarySlider-slides");
                if (n > slides.length) {
                        slideIndex = 1
                }
                if (n < 1) {
                        slideIndex = slides.length
                }
                for (i = 0; i < slides.length; i++) {
                        slides[i].style.display = "none";
                }
                slides[slideIndex - 1].style.display = "block";
        }
</script>