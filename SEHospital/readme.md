##File structure
Main directories are:
#app
-main sourcecode of this project, especially in folder Http
	- /Http/routes.php = control from view to view, or controller to controller, or both
	- /Http/Controllers = keep all controller here(for logic of the view)
#config
-configurations such as database connection(mysql) 
#resources/views
-ui goes here, e.g. 'home.blade.php' (as normal html file)

#public
-initial place to get the web up, no need to change anything, reference to MAMP or XAMP here
#database/migrations
-version control of database
#vendor
-just external libraries to make laravel works