website
=======
For the public presence of 360 Giving

This takes the files from a WPEngine account, managed using git, and places them here for collaborative development.


Developer Notes
---------------
Although there is a Markdown plugin as part of Jetpack - we are not using it. It converts Markdown written into posts into HTML as the page is saved. The HTML is saved to the database and served up on page load. I could not find an easy way to hook into this behaviour. Instead we use a php markdown to html library.

Need to add:
define( 'JETPACK_DEV_DEBUG', true);
to wp-config.php for local development with JetPack - it tries to get you to sign up to wordpress.com otherwise and cannot do that from a local environment.
wp-config is git ignored.

To update akismet locally via the admin interface I had problems setting permissions

Development Workflow
++++++++++++++++++++++
With git we can set up repositories to push to production or staging
We CANNOT make changes in production/staging and then pull them locally
THEREFORE all development must done locally.

In order to collaborate, we will need to use e.g. GitHub

Obviously, content and configuration changes can still be made on the live site, so we still have the wordpress/drupal problem of keeping the database in synch.

And when we add plugins, themes, etc these cause changes to the database.

We have the added complication of keeping staging and production synched at wpengine.


So we need to know which database we are woking with (staging or production)
For code we should be making GitHub our master repo, which we synch with locally, then we push changes back to git hub, and when ready we would:

Update local master from GitHub, push to staging, check, then push from local to production.

Locking the databases
;;;;;;;;;;;;;;;;;;;;;
At times you will need to grab the database from the staging/production server to do development work.
At that time, any changes people make to the production/staging database will be potentially lost.
Users need to be informed about not making changes
For some changes, such as adding plugins, these can be done locally, and then configured on the staging/production sites

Uploaded files
;;;;;;;;;;;;;;
These are not held in version control. To synch your local files with live/staging you will need
SFTP access, and manually copy across.

Setting up a local development environment
++++++++++++++++++++++++++++++++++++++++++
Follow the instructions here:
http://wpengine.com/git/

You will then need to add the GitHub repository as a remote:

    git remote add origin git@github.com:ThreeSixtyGiving/website.git
    
Makes sure the code you have downloaded and the GitHub repository are 
synchronised. Then you can start development.

Tests
+++++
Tests that use pytest and selenium are kept in the `/tests` directory
Run them from the wordpress root with: `py.test`

You can set the URL of the test website, so you can test locally, test
staging, or test the live site.

When adding features or fixing bugs, please create and run tests.

How do the docs work?
---------------------

We have created a new plugin: threesixty_docs to handle the documentation side of the website.
This contains 2 git submodules:
Our documents: threesixtygiving.github.io
A markdown to HTML parser: parsedown

The SSOT of the documentation is at:
https://github.com/ThreeSixtyGiving/threesixtygiving.github.io
and so we clone this repository into the plugin. 

In Wordpress we then use short codes of the form (standard page="<name>") to fetch the correct document to display, pass it through a markdown to HTML parser, and display it on the website.

Replace <name> with the filename of the markdown text you wish to display (without .md)
e.g. to display the identifiers.md document: (standard page="identifiers")

We construct Wordpress pages under /standard

How does the data from DKAN work?
---------------------------------
To do this we have not used a plug in, but just adapted our theme.
We use a child theme of the Responsive Theme.
The code to run the CKAN work is in /ckan
Within that directory we have to manually set up the following subdirectories and make sure they are writable:
ckan - saves json data for each 'group' call to ckan
urls  - saves json data for each 'package' call to ckan
data - not used but could store raw 360 data pulled from CKAN

We have created a dedicated template page called page-data.php. This will be displayed if there is a Wordpress page with the slug 'data'.

Once called this page performs the DKAN lookup, stores the data it fetches and displays some of it to screen.

There is a 2 hour cache in place. Filetime is checked and if data is over two hours old it is all called again. This causes a delay in page load, but we could potentially mitigate this by running a cron job.
(We can also look into using wp-cache options)
(Potential there should be cleverer ways of not pulling data if it has not changed at DKAN)

Logos
+++++
The DKAN call gives us the DKAN URL for the logos.
Our page simply use this URL as the img link.
We could look to pull and store the logos locally - but we need to think about how to refresh them over time.
(We may want to display some logos on the front page)


How do the banners work?
------------------------
We use the Custom Fields plugin.
This gives us editable fields in the home page screen.
We can alter the title of the banner, the wording in the buttons, and the page/post the buttons link to.
We use a custom home page template to display those custom fields.


Some Wordpress config
---------------------
We have set the site up to use a static front page and static blog page - in Settings.
The template for the home page is called index.php
The template for  the blog becomes home.php - this is standard Wordpress practice.


