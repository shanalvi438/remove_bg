<?php
if(isset($_POST['submit'])){
    $rand = rand(111111111, 999999999);
    move_uploaded_file($_FILES['file']['tmp_name'], 'upload/'.$rand.$_FILES['file']['name']);
    $file = "https://zeeshan.techvengers.com/remove_bg/upload/".$rand.$_FILES['file']['name'];

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, 'https://api.remove.bg/v1.0/removebg');
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_POST, 1);
    $post = array(
        'image_url' => $file,
        'size' => 'auto'
    );
    curl_setopt($ch, CURLOPT_POSTFIELDS, $post);

    $headers = array();
    $headers[] = 'X-Api-Key: MXk337VikZkjNUky5Qn1LnBp';
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

    $result = curl_exec($ch);

    if ($result === false) {
        echo 'cURL Error: ' . curl_error($ch);
    } else {
        $status_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        if ($status_code === 200) {
            $fp = fopen('bg_removs/'.$rand.'.png', "wb");
            fwrite($fp, $result);
            fclose($fp);
            echo 'Image saved successfully.';
            $output_image_path = 'bg_removs/'.$rand.'.png';
            file_put_contents($output_image_path, $result);

            // Display both images in a div
            echo '<div style="display: flex;">';
            // Display the original image
            echo '<div style="margin-right: 10px;">';
            echo '<img src="' . $file . '" alt="Original Image">';
            echo '</div>';
            print_r($file);
            die;
            // Display the processed image
            echo '<div>';
            // echo '<img src="' . $output_image_path . '" alt="Processed Image">';
            echo '</div>';
            echo '</div>';
        } else {
            echo 'API Error: ' . $result;
        }
    }

    curl_close($ch);
}
?>
<form method="POST" enctype="multipart/form-data">
    <input type="file" name="file" id="">
    <input type="submit" value="remove image" name="submit">
</form>

<!doctype html>
<html lang="en">

<head>
    <title>Title</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="slider.css">
    <link rel="stylesheet" href="upload.css">
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-md-12 upload">
                <h1>Upload an image to remove background</h1>
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 box">
                <div class="image_upload">
                    <!-- <form method="post"> -->
                    <form action="" method="post" enctype="multipart/form-data">
                        <div>
                            <label for="inputTag" class="labels">
                              Select Image <br/>
                              <i class="fa fa-2x fa-camera"></i>
                              <input id="inputTag"  type="file" name="file" >
                              <br/>
                              <span id="imageName"></span>
                            </label>
                          </div>
                          <script>
                            let input = document.getElementById("inputTag");
                            let imageName = document.getElementById("imageName")
                    
                            input.addEventListener("change", ()=>{
                                let inputImage = document.querySelector("input[type=file]").files[0];
                    
                                imageName.innerText = inputImage.name;
                            })
                        </script>
                        <input type="submit" name="submit" value="Remove Image Background" class="btn" id="img_up"
                            style="  background: linear-gradient(115deg, #FF4040, #A90FCD);width: auto;margin: auto;height: 60px;cursor: pointer;-webkit-box-align: center;align-items: center;padding: 0px 22px;border-radius: 12px;border: none;font-weight: bold;color: #B5B5B5;margin: 40px;">
                    </form>
                    <!-- <button id="UploadImage__HomePage" type="file" class="btn">
                        <input type="file" accept=".png, .jpg, .jpeg, .webp" name="uploadImage" id="uploadImage"
                            style="display: none;">
                        <img alt="upload image"
                            src="https://cdn.pixelbin.io/v2/dummy-cloudname/h4HP0-/original/assets/images/upload.7b02f01.svg"
                            class="Upload__StyledUploadIcon-sc-11jl0r6-9 jLXKeO">
                        <span>Upload Image</span>
                    </button> -->
                    <!-- <input type="submit" value="Remove Image Background">
                </form> -->
                    <script>
                        document.getElementById("UploadImage__HomePage").addEventListener("click", function () {
                            document.getElementById("uploadImage").click();
                        });

                        document.getElementById("uploadImage").addEventListener("change", function () {
                            var selectedFile = this.files[0];
                            console.log("Selected file:", selectedFile);
                        });
                    </script>
                    <div>
                        <p class="Upload__Content-sc-11jl0r6-6 lbXoaO" style="margin-top: 12px;">or drop image
                            anywhere (upto resolution 5,000 x 5,000 px)</p>
                        <p>
                            Paste image or <a href="http://" target="_blank" rel="noopener noreferrer">
                                URL
                            </a>
                            <span style="font-size: 15px; font-weight: bold; border: 2px solid #3b3b3b; border-radius: 4px; padding: 5px;
                                border-radius: 4px; border: 1px solid rgba(255, 255, 255, 0.25);">
                                Ctrl
                            </span>
                            +
                            <span style="font-size: 15px; font-weight: bold; border: 2px solid #3b3b3b; border-radius: 4px; padding: 5px;
                                border-radius: 4px; border: 1px solid rgba(255, 255, 255, 0.25);">
                                V
                            </span>
                        </p>
                        <p>
                            Supported formats:
                            <span style="font-size: 15px; font-weight: bold; border: 2px solid #3b3b3b; border-radius: 4px; padding: 5px;
                                    border-radius: 4px; border: 1px solid rgba(255, 255, 255, 0.25);">png</span>
                            <span style="font-size: 15px; font-weight: bold; border: 2px solid #3b3b3b; border-radius: 4px; padding: 5px;
                                    border-radius: 4px; border: 1px solid rgba(255, 255, 255, 0.25);">jpeg</span>
                            <span style="font-size: 15px; font-weight: bold; border: 2px solid #3b3b3b; border-radius: 4px; padding: 5px;
                                    border-radius: 4px; border: 1px solid rgba(255, 255, 255, 0.25);">webp</span>
                            <span style="font-size: 15px; font-weight: bold; border: 2px solid #3b3b3b; border-radius: 4px; padding: 5px;
                                    border-radius: 4px; border: 1px solid rgba(255, 255, 255, 0.25);">jpg</span>
                        </p>
                        <span style="font-size: 12px;">
                            By uploading an image or URL you agree to our Terms of Use and Privacy Policy.
                        </span>
                    </div>

                    <div class="half_box">
                        <img src="https://cdn.pixelbin.io/v2/dummy-cloudname/original/common_assets/logos/pixelbin_75x75.png?f_auto=true"
                            alt="Pixelbin Logo" width="73" height="72" class="Demo__LogoImage-sc-l7jjwj-1 ikpuPd">
                        <p style="margin-top: 15px;">
                            Want to Remove Background from Images in bulk?
                        </p>
                        <p>
                            <b><a href="" style="color:#E7E7E7;">Get Early Access</a></b><span
                                style="font-size: 25px; color: white; "> <b>→</b> </span>
                        </p>
                    </div>
                </div>
                <script>
                    document.getElementById("uploadImage").addEventListener("change", function () {
                        var selectedFile = this.files[0];
                        var image_viewer = document.querySelector(".image_viewer");
                        var image = new Image();
                        image.src = URL.createObjectURL(selectedFile);
                        image_viewer.appendChild(image);
                    });

                </script>
                <div class="imagesection" style="margin-top: 15px;">
                    <div class="image_viewer">

                    </div>
                </div>
                <div class="SampleSection">
                    <img src="https://cdn.pixelbin.io/v2/dummy-cloudname/t.resize(h:60,w:60)/__erasebg_assets/sample4_org.jpeg?f_auto=true"
                        class="SampleSection__SampleImage-sc-fby6my-3 dDpERl">
                    <img src="https://cdn.pixelbin.io/v2/dummy-cloudname/t.resize(h:60,w:60)/__erasebg_assets/sample2_org.jpeg?f_auto=true"
                        class="SampleSection__SampleImage-sc-fby6my-3 dDpERl">
                    <img src="https://cdn.pixelbin.io/v2/dummy-cloudname/t.resize(h:60,w:60)/__erasebg_assets/sample1_org.jpeg?f_auto=true"
                        class="SampleSection__SampleImage-sc-fby6my-3 dDpERl">
                    <img src="https://cdn.pixelbin.io/v2/dummy-cloudname/t.resize(h:60,w:60)/__erasebg_assets/sample3_org.jpeg?f_auto=true"
                        class="SampleSection__SampleImage-sc-fby6my-3 dDpERl">
                </div>
            </div>
        </div>
    </div>


    <div class="container-fluid cards">
        <div class="container">
            <div class="products">
                <h1>Try Our Other Products</h1>
            </div>
            <div class="slider owl-carousel">
                <div class="card" style=" background-color: #1A1B1B;">
                    <div class="content">
                        <div class="OtherProducts">
                            <div class="OtherProducts__WrapperDiv-sc-dhe80s-8 iNrUZY"><img
                                    src="https://cdn.pixelbin.io/v2/dummy-cloudname/original/__convert_media/logo/convert-logo-white.png?f_auto=true&amp;v=12"
                                    alt="ConvertFiles.ai" width="500" height="96"
                                    class="OtherProducts__Icon-sc-dhe80s-7 jlaRMe">
                                <p class="global-styled-components__ContentDescr-sc-b9pb9l-12 gLklGw"
                                    style="margin-bottom: 30px;">ConvertFiles.ai is a format changer tool that lets you
                                    to change the image format for FREE.</p>
                            </div><a href="#" target="_blank" rel="noopener noreferrer nofollow"
                                class="OtherProducts__ExternalAnchor-sc-dhe80s-4 bITgCj"><button class="btn"
                                    style=" background: linear-gradient(115deg, #FF4040, #A90FCD);" width="auto"
                                    font-size="16px" class="FilledButton__StyledButton-sc-upeeeu-0 eySCdR">Try now for
                                    free</button></a>
                        </div>
                    </div>
                </div>
                <div class="card" style=" background-color: #1A1B1B;">

                    <div class="content">
                        <div class="OtherProducts">
                            <div class="OtherProducts__WrapperDiv-sc-dhe80s-8 iNrUZY"><img
                                    src="https://cdn.pixelbin.io/v2/dummy-cloudname/original/__convert_media/logo/convert-logo-white.png?f_auto=true&amp;v=12"
                                    alt="ConvertFiles.ai" width="500" height="96"
                                    class="OtherProducts__Icon-sc-dhe80s-7 jlaRMe">
                                <p class="global-styled-components__ContentDescr-sc-b9pb9l-12 gLklGw"
                                    style="margin-bottom: 30px;">ConvertFiles.ai is a format changer tool that lets you
                                    to change the image format for FREE.</p>
                            </div><a href="#" target="_blank" rel="noopener noreferrer nofollow"
                                class="OtherProducts__ExternalAnchor-sc-dhe80s-4 bITgCj"><button class="btn"
                                    style=" background: linear-gradient(115deg, #FF4040, #A90FCD);" width="auto"
                                    font-size="16px" class="FilledButton__StyledButton-sc-upeeeu-0 eySCdR">Try now for
                                    free</button></a>
                        </div>
                    </div>
                </div>
                <div class="card" style=" background-color: #1A1B1B;">
                    <div class="content">
                        <div class="OtherProducts">
                            <div class="OtherProducts__WrapperDiv-sc-dhe80s-8 iNrUZY"><img
                                    src="https://cdn.pixelbin.io/v2/dummy-cloudname/original/__convert_media/logo/convert-logo-white.png?f_auto=true&amp;v=12"
                                    alt="ConvertFiles.ai" width="500" height="96"
                                    class="OtherProducts__Icon-sc-dhe80s-7 jlaRMe">
                                <p class="global-styled-components__ContentDescr-sc-b9pb9l-12 gLklGw"
                                    style="margin-bottom: 30px;">ConvertFiles.ai is a format changer tool that lets you
                                    to change the image format for FREE.</p>
                            </div>
                            <a href="#" target="_blank" rel="noopener noreferrer nofollow"
                                class="OtherProducts__ExternalAnchor-sc-dhe80s-4 bITgCj">
                                <button class="btn" style=" background: linear-gradient(115deg, #FF4040, #A90FCD);"
                                    width="auto" font-size="16px"
                                    class="FilledButton__StyledButton-sc-upeeeu-0 eySCdR">Try now for
                                    free</button>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <script>
                $(".slider").owlCarousel({
                    loop: true,
                    autoplay: true,
                    autoplayTimeout: 2000, //2000ms = 2s;
                    autoplayHoverPause: true,
                });
            </script>
        </div>
    </div>
    <hr style="color: white;">

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
        crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
        integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1"
        crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
        integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM"
        crossorigin="anonymous"></script>
</body>

</html>