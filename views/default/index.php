<?php
Yii::app()->clientScript->registerCoreScript('jquery');

$css = <<<EOD
.sidebar { width: 300px; margin-right: 40px; float: left;}

.tags p { width: auto; padding: 5px; float: left; margin: 0 10px 10px 0; cursor: pointer; border: 1px solid white;}
.tags p.selected { border: 1px solid red;}
.tags p:hover { color: blue; text-decoration: underline;}

.instructions { margin: 30px 0 0; padding:10px; border: 1px solid #ccc;}
.instructions p { none; margin: 0 0 10px;}

.links { width: 540px; float: left; padding:0; margin:0; }
.links.hidden { display:none;}
.links.active { display:block;}
.links li { margin: 0 0 10px;}
EOD;
Yii::app()->clientScript->registerCss('pageCSS', $css);
?>

<h1><?php echo $this->module->pageTitle;?></h1>

<div class="clearfix">

	<div class="sidebar">
        <div class="tags clearfix">
        <?php foreach ( $list as $name=>$tag ) : ?>
            <p data-tag="<?php echo $name;?>"><?php echo $name;?></p>
        <?php endforeach;?>
        </div>
        
        <div class="instructions">
            <p>To reload all tags:  /delicious/refresh</p>
            <p>To reload a tag:  /delicious/refresh/{tag}</p>
        </div>
    </div>
    
    
    <?php foreach ( $list as $name=>$tag ) : ?>
        <ol class="links hidden <?php echo $name;?>">
        <?php foreach ( $tag as $link ) : ?>
            <li><a href="<?php echo $link->u;?>"><?php echo $link->d;?></a></li>
        <?php endforeach;?>
        </ol>
    <?php endforeach;?>
</div>



<script>
$(function() {
	
	// when user clicks on a tag the ul.links for that tag are revealed
	$('.tags p').on('click',function() {
		var tagName = $(this).data('tag');
		$('.tags p.selected').removeClass('selected')
		$(this).addClass('selected')
		$('.links.active').removeClass('active').addClass('hidden');
		$('.links.'+tagName).addClass('active')
	})
	
	
});
</script>