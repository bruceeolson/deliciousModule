<style>
.sidebar { width: 300px; margin-right: 40px; float: left;}

.tags { margin-left: -10px;}
.tags a { display:block; width: auto; padding: 2px 5px; float: left; margin: 0 0 0 5px; text-decoration:none; cursor: pointer; border: 1px solid white;}
.tags a.selected { border: 1px solid red;}
.tags p:hover { color: blue; text-decoration: underline;}

.instructions { margin: 30px 0 0; padding:10px; border: 1px solid #ccc;}
.instructions p { none; margin: 0 0 10px;}

.links { width: 400px; float: left; padding:0; margin:0; }
.links.hidden { display:none;}
.links.active { display:block;}
.links li { margin: 0 0 10px;}
</style>

<br/>
<div class="clearfix">

	<div class="sidebar">
        <h2><?php echo $this->module->pageTitle;?></h2>
        <div class="tags clearfix">
			<?php foreach ( $tags as $name=>$count ) : $selected = $name==$tag ? "selected" : ""; ?>
                <a href="<?php echo Yii::app()->baseUrl.'/delicious/'.$name;?>" class="<?php echo $selected;?>"><?php echo $name.' <span style="font-size:.8em; color:#999;">('.$count.')</span>';?></a>
            <?php endforeach;?>
        </div>    
    </div>
    
    <?php if ( $links ) : ?>
    <h2>Bookmarks for <strong><?php echo $tag;?></strong></h2>
    <ol class="links">
    <?php foreach ( $links as $link ) : ?>
        <li><a href="<?php echo $link->u;?>"><?php echo $link->d;?></a></li>
    <?php endforeach;?>
    </ol>
    <?php endif;?>
    
</div>