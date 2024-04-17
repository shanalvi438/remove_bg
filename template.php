<?php
if(isset($_POST['submit'])){
    $rand = rand(111111111, 999999999);
    move_uploaded_file($_FILES['file']['tmp_name'], 'upload/'.$rand.$_FILES['file']['name']);
    $file = "http://localhost:8090/1/remove_bg/upload/".$rand.$_FILES['file']['name'];

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
    $headers[] = 'X-Api-Key: QY1UKj8iG97Yo8poFiss1LWt';
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

            // Display the processed image
            echo '<div>';
            echo '<img src="' . $output_image_path . '" alt="Processed Image">';
            echo '</div>';
            echo '</div>';
        } else {
            echo 'API Error: ' . $result;
        }
    }

    curl_close($ch);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Erase.bg-like Upload</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container">
        <h1>Remove Background from Image</h1>
        <p>Upload an image to remove its background.</p>
            <form method="POST" enctype="multipart/form-data">
                <input type="file" name="file" id="">
                <input type="submit" value="remove image" name="submit">
            </form>
		<!-- <form action="" method="post">
			<input type="file" id="imageInput" name="file" accept="image/*">
			<div id="previewContainer">
				<img id="previewImage" src="#" alt="Uploaded Image Preview">
			</div>
			<button type="submit" id="removeBackgroundBtn" name="submit" >Remove Background</button>
		</form> -->
    </div>
    <script src="script.js"></script>
</body>
</html>

