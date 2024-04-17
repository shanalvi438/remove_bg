<?php
if(isset($_POST['submit'])){
	$rand=rand(111111111,999999999);
	move_uploaded_file($_FILES['file']['tmp_name'],'upload/'.$rand.$_FILES['file']['name']);
	$file="upload/".$rand.$_FILES['file']['name'];
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, 'https://api.remove.bg/v1.0/removebg');
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_POST, 1);
	$post = array(
		'image_url' => 'https://encrypted-tbn2.gstatic.com/licensed-image?q=tbn:ANd9GcRqZydFPmlU7y1E7v4BDIZU4BBOCzHNKKjpIB7Ac8Pa1x-UkWzWO-C1BExTwiDScpy7hOD9fj9_MiBiSeg',
		'size' => 'auto'
	);
	curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
	$headers = array();
	$headers[] = 'X-Api-Key: CFF9UA1PMqS6nQZByVjowrkH';
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
            // echo 'Image saved successfully.';
            $output_image_path = 'bg_removs/'.$rand.'.png';
            file_put_contents($output_image_path, $result);
        
            echo '<img src="' . $output_image_path . '" alt="Processed Image">';

        } else {
            echo 'API Error: ' . $result;
        }
    }
    curl_close($ch);
}
?>

<form method="post" enctype="multipart/form-data">
	<input type="file" name="file"/>
	<input type="submit" name="submit"/>

</form>
<video autoplay muted controls>
<source src="https://sb.kaleidousercontent.com/67418/x/681f13b37d/emilia_compressed.mp4" type="video/mp4">

</video>
<video id="myVideo" preload="auto" class="w-full h-auto rounded-4xl max-w-[320px] lg:max-w-[420px]" 
	poster="https://sb.kaleidousercontent.com/67418/840x560/686381d375/emilia-poster.jpg" 
	autoplay="true" playsinline="true" 
	src="https://sb.kaleidousercontent.com/67418/x/681f13b37d/emilia_compressed.mp4"></video>


<script>
	function autoplayVideo() {
	var video = document.getElementById("myVideo");
	video.addEventListener("load", function() {
	video.play();
	});
}

</script>
