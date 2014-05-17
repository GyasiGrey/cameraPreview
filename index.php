<?php
	function getDir($dir) {
		$retval = array();
               $dirHndl = opendir('/media/hdd1/Share/cameraDump/' . $dir . '/JPEG/');

                while (false !== ($file = readdir($dirHndl)))
                {
                        if(strstr($file, ".jpg") !== false) {
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
        <section id="examples" class="examples-section">
                <div class="container">
                        <div class="image-row">
				<?php
					$perPage = 8;
					$startIndex = $_GET['start'];
					$dir = $_GET['dir'];
					
					$imgs = getDir($dir);

					$index = 0;
					foreach($imgs as $i) {
						$index++;
						if($index <= $startIndex) {
							continue;
						}

						echo '<a class="example-image-link" href="/cameraDump/' . $dir . '/JPEG/' . $i . '" data-lightbox="/' . $i . '"><img class="example-image" src="/cameraDump/' . $dir . '/JPEG/' . $i . '" alt="/' . $i . '" /></a>';
						if($index - $startIndex >= $perPage) {
							break;
						}
					}
				?>
			</div>
			<?php
				$nextIndex = intval($startIndex) + $perPage;
				$prevIndex = intval($startIndex) - $perPage;
				echo '<a href="?start=' . $prevIndex . '&dir=' . $dir . '">Prev</a> | ';
				echo '<a href="?start=0&dir=' . $dir . '">Start</a> | ';
				echo '<a href="?start=' . $nextIndex . '&dir=' . $dir . '">Next</a>';
			?>
		</div>
	</section>
</body>
</html>
