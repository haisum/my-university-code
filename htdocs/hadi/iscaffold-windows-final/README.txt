open config.php and make changes.
open templates/frame_public.tpl and modify menus part containing <li> tags this creates your menus
in hrefs end url with your table name. 
open applciation/config/routes.php to change default route to one of generated controller.

if your table name is email_config then url to its CRUD page will be:
localhost/yoururl/admincppath/index.php/email_config
change default_route to email_config to access this page at admincp/index.php 