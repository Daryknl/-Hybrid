<!DOCTYPE html>
<html lang="en">
    <head>
        <title><?php echo $this->title; ?></title>
		
		<?php
			foreach($this->getStylesheet() as $link)
			{
				echo sprintf('<link rel="stylesheet" href="%s" />', $link) . PHP_EOL;
			}
		?>
    </head>
    <body>
        <?php
			echo implode($this->body['content']);
			#echo implode($this->body['sidebar']);
        ?>
		<?php
			foreach($this->getJavascript() as $src)
			{
				echo sprintf('<script src"%s"></script>', $src) . PHP_EOL;
			}
		?>
    </body>
</html>