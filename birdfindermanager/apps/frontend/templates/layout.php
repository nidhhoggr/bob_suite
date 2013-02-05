<!DOCTYPE html>
<html lang="en">	
    <head>		
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />       
        <title>SuperAccountant</title>
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
        <?php include_stylesheets() ?>
        <?php include_javascripts() ?>
        <script type="text/javascript">
        var frontend_root = '<?=sfConfig::get('sf_js_frontend_root')?>';
        var backend_root = '<?=sfConfig::get('sf_js_backend_root')?>';
    </script>
    </head>
    <body>	
        <div id="wrap">
            <div id="header">
                <a href="#" title="[ADD LINK TITLE]">
                    <img src="/images/logo.png" />
                </a>       	
                <h2>Title Of Application</h2>           	
                <div id="nav">
                    <ul id="nav-pages">
                    <?php
                    //include the menu respective to the nav
                    ?>
                    </ul><!--end nav-pages-->
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
    		
    		<div id="footer">
				
				<p class="copyright">Copyright &copy; 2012 &middot; SuperAccountant &middot; All Rights Reserved</p>
				   
                </div><!--end footer-->
            
    	</div><!--end wrap-->	
    	
	</body>	
	
</html>
