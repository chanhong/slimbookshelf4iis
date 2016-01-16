# Slim Bookshelf for IIS

This is a simple Slim 3 application that manages a list of books based on Rob Allen but modified to work better for IIS but also tested with PHP buildin web server.

Create your project:

$ composer create-project -n -s dev chanhong/slimbookshelf4iis my-app

Changes:

. Remove Vagrant and related folder vm-provisioning

. In twig-view\TwigExtension.php to fix css issue not showing correctly

    + replace: return $this->uri->getBaseUrl();
    
    + with this: return preg_replace('/\/\w+\.php$/i', '', rtrim($this->uri->getBaseUrl(),'/'));
    
. Create Models folder to store models files
  
. Upgrade slim 3.1, twig-view 1.2.0, csrf 0.3.3, flash 0.1.0

. Run from "docroot" instead of "public" but if you want to run from "public" be sure to do the following:

    + At "docroot" rename web.config to rootweb.config
    
    + In "public" rename pubweb.config to web.config
       


Todo:

    



