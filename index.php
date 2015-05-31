<?php
	function getDir($dir) {
		$retval = array();
               $dirHndl = opendir('/mnt/hdd1/Share/cameraDump/' . $dir . '/JPEG/');

                while (false !== ($file = readdir($dirHndl)))
                {
                        if(strstr($file, ".jpg") !== false) {
				$retval[] = $file;
			}
                }

		return $retval;
	}

        function getAllDir() {
               $retval = array();
               $files = scandir('/mnt/hdd1/Share/cameraDump/');

                foreach($files as $file)
                {
			$fullPath = '/mnt/hdd1/Share/cameraDump/' . $file;
                        if(is_dir($fullPath) && strcmp($file, '.') != 0 && strcmp($file, '..') != 0) {
                                $retval[] = $file;
                        }
                }

                return $retval;
        }
?>
<!DOCTYPE html>
<html lang="en-us">
<head>
        <title>Camera Dump</title>

        <script src="js/jquery-1.11.0.min.js"></script>
        <script src="js/lightbox.min.js"></script>

        <link rel="stylesheet" href="css/screen.css">
        <link rel="stylesheet" href="css/lightbox.css">
</head>
<body>
	<?php
	$dir = $_GET['dir'];
	if(empty($dir)) {
		$dirs = getAllDir();
		foreach($dirs as $d) {
	?>
		<a href="?dir=<?php echo $d; ?>"><?php echo $d; ?></a><br/>
	<?php
		}
	} else
	{
	?>
        <section id="examples" class="examples-section">
                <div class="container">
                        <div class="image-row">
				<?php
					$dir = $_GET['dir'];

					$imgs = getDir($dir);

					$index = 0;
					foreach($imgs as $i) {
						$index++;

						$dataTitle = "<a href='/cameraDump/" . $dir . "/" . str_replace('jpg', 'dng', $i) . "' target='_blank'>Get raw file</a>";
						echo '<a class="example-image-link" href="/cameraDump/' . $dir . '/JPEG/' . $i . '" data-lightbox="previewGroup" data-title="' . $dataTitle . '"><img class="example-image" src="/cameraDump/' . $dir . '/JPEG/' . $i . '" alt="/' . $i . '" /></a>';
					}
				?>
			</div>
		</div>
	</section>
	<?php
	}	//if(empty($dir))
	?>
</body>
</html>
