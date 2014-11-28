<!DOCTYPE html>
<html lang="en">
<?php
    # TODO: Generate lang="[language]";
?>
    <head>
        <?php
            # TODO: Generate Custom Meta Data
        ?>
        <title><?php echo $this->title; ?></title>
		
		<?php
            # TODO: Retrieve Javascript Source Files That Must Be At The Top Of The Page.
            
            # Require All Necessary Stylesheets For The Given View
			foreach($this->getStylesheet() as $link)
			{
				echo sprintf('<link rel="stylesheet" href="%s" />', $link) . PHP_EOL;
			}
		?>
    </head>
    <body>
        <?php
            # Implode Body Content
			echo implode($this->body['content']);
            
            # Check to see if components are enabled with body['rules'] array<bool>
            if(in_array('rules', $this->body))
            {
                # TODO: Create Layout GRID system.
                # [0] = Header Content.     or      [header][meta] = Header Meta, [header][stylesheet] = Header Stylesheets
                # [1] = Body Content        or      [body][]       = Body Content
                # [1][i]    = Begining      or      [body][ i = 0 ]= Beginning
                # [1][++i]  = Ending        or      [body][ ++i ]  = Ending
                
                # Check to see if sidebar is active. if true then implode sidebar content.
                if(isset($this->body['rules']['sidebar']) && $this->body['rules']['sidebar'] == true)
                {
                    echo implode($this->body['sidebar']);
                }
                # Check for custom compenents given by plugins.
                if(isset($this->body['rules']['custom_rule']) && $this->body['rules']['custom_rule'] == true)
                {
                    # TODO: Proccess Custom Template Rules
                }
            }
        ?>
		<?php
            # Require All Necessary Javascript Source Files For The Given View
			foreach($this->getJavascript() as $src)
			{
				echo sprintf('<script src"%s"></script>', $src) . PHP_EOL;
			}
		?>
    </body>
</html>