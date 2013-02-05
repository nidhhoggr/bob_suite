<!DOCTYPE html>
<html lang="en">	
    <head>		
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />       
        <title>Bird Finder Administrator</title>
        <!--[if IE 6]>
            <link rel="stylesheet" href="/css/bobo/ie6.css" />
        <![endif]--> 
        <!--[if IE 7]>
            <link rel="stylesheet" href="/css/bobo/ie7.css" />
        <![endif]-->
        <?php include_http_metas() ?>
        <?php include_metas() ?>
        <?php include_title() ?>
        <?php use_stylesheet('bobo/style.css') ?>
        <?php use_stylesheet('admin.css') ?>
        <?php include_stylesheets() ?>
        <?php include_javascripts() ?>
        <script type="text/javascript">
        var frontend_root = '<?=sfConfig::get('sf_js_frontend_root')?>';
        var backend_root = '<?=sfConfig::get('sf_js_backend_root')?>';
    </script>
    </head>
    <body>	
        <div id="bobo_wrap">
            <div id="bobo_header">
                <h2>Bird Finder Administrator</h2>           	
                <div id="bobo_nav">
                    <ul id="nav-pages">
                        <li><?=link_to('Birds','bird/index')?></li>
                        <li><?=link_to('Taxonomies','bird_taxonomy/index')?></li>
                    </ul>
                </div><!--end nav-->
            </div><!--end header-->
            <div id="frontpage-content">      
    			
    			<div id="frontpage-intro">   	
                                    <?php echo $sf_content ?>
<!--
    					<a href="[ADD LINK TO PROJECT PAGE]" title="[ADD LINK TITLE]"><img class="featured-project-image" src="images/[ADD IMAGE FILE NAME]" alt="[ADD ALTERNATIVE TEXT]" /></a>
    					<a href="[ADD LINK TO PROJECT PAGE]" title="[ADD LINK TITLE]"><img class="featured-project-image" src="images/[ADD IMAGE FILE NAME]" alt="[ADD ALTERNATIVE TEXT]" /></a>
-->    				
    				 	
    			</div><!--end featured-projects--> 
    			    			
    		</div><!--end frontpage-content--> 
                <div id="bobo_nav">
                    <ul id="nav-pages">
                        <li><?=link_to('Bird','bird/index')?></li>
                        <li><?=link_to('Taxonomy Types','taxonomytype/index')?></li>
                        <li><?=link_to('Taxonomy','taxonomy/index')?></li>
                        <li><?=link_to('Bird Taxonomy','bird_taxonomy/index')?></li>
                    </ul>
                    <ul id="nav-pages">
                        <li><?=link_to('Source','source/index')?></li>
                        <li><?=link_to('Bird Source','bird/index')?></li>
                        <li><?=link_to('Taxonomy Source','taxonomy_source/index')?></li>
                        <li><?=link_to('Taxonomy Type Source','taxonomytype_source/index')?></li>
                    </ul><!--end nav-pages-->
                </div><!--end nav-->
    	
	
    		<div id="bobo_footer">
				
				<p class="bobo_copyright">Copyright &copy; 2012 &middot; Avianweb LLC &middot; All Rights Reserved</p>
				   
                </div><!--end footer-->
            
    	</div><!--end wrap-->	
    	
	</body>	
	
</html>
