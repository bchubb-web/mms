# bchubbweb/mms

## Model Management System

MMS is built upon laravel and filamentPHP, it provides a simple way to edit and manage models via an admin interface, and allow full control over how the data is presented openly on the front end.

## Admin Interface

navigating to /admin will take you to the admin interface, where you can manage models, and view information about the platform via widgets and custom pages.

## Front End

The front end can be used exactly as in a normal laravel application, with custom controller templates and views, focusing your development around the functionality of a front end, leaving management to the admin interface.

### Pages

As part of MMS, there is a basic page builder system, allowing you to attribute fields to a page and render them in a view as you wish. 
Currently pages cannot be nested, but this is a feature that will be added in the future. If you wish to use your own frontend, you can remove the page controller from routes/web.php and remove the resource from the admin dashboard.

