## File structure
Main directories are:
### app
-main sourcecode of this project, especially in folder Http

* app/Http/routes.php = **control navigation from view to view, or controller to controller, or both**

* app/Http/Controllers = **logic for each view here**

### resources/views
-UI goes here, e.g. 'home.blade.php' (as normal html file), **add other views here**

### config
-configurations such as database connection(mysql) 

Others
---

### public
-initial place to get the web up, no need to change anything, reference to MAMP or XAMP here
### database/migrations
-version control of database
### vendor
-just external libraries to make laravel works