website
=======
For the public presence of 360 Giving

This takes the files from a WPEngine account, managed using git, and places them here for collaborative development.


Editor Notes
------------
Editors can make edits to the live site. This can include uploading files, altering text, and most configuration changes in the admin panel

They should NOT alter anything that potentially changes code e.g.
Update plugins, themes or Wordpress core

Editors should NOT push staging changes to live via the WPEngine interface without checking with developers first.


Developer Notes
---------------
The documentation of the standard is maintained in a GitHub repository.
That repository is included as a git submodule.
A plugin turns the markdown pages into web pages. Although there is a Markdown plugin as part of Jetpack - we are not using it, because it converts Markdown written into posts into HTML as the page is saved. The HTML is saved to the database and served up on page load. I could not find an easy way to hook into this behaviour. Instead we use a php markdown to html library.
See: wp-content/plugins/threesixty_docs

Jetpack
Need to add:
define( 'JETPACK_DEV_DEBUG', true);
to wp-config.php for local development with JetPack - it tries to get you to sign up to wordpress.com otherwise and cannot do that from a local environment.
wp-config is git ignored.

To update akismet locally via the admin interface I had problems setting permissions

When working locally, you will also need a copy of the staging database. If you use a different testing URL you may find `wp-cli` is a useful tool for rewriting the links in the database. Usage

`php wp-cli.phar search-replace 'http://example.com/' 'http://example2.com/' --skip-columns=guid`

You may also need to add the following to wp-config.php

  define('WP_HOME','http://example.com/');
  define('WP_SITEURL','http://example.com/');

Development Workflow
++++++++++++++++++++
All development should take place on local machines.

With git we can set up repositories to push to production or staging at WPEngine, 
BUT we CANNOT make changes in production/staging and then pull them locally
THEREFORE all development must done locally.

In order to collaborate on development, we use GitHub

On GitHub we have a master and live branch. We use master for development and live is the branch that gets deployed to WPEngine.
WPEnginge has a staging and a production branch. We can push anything we like to staging, but should only push our GitHub live branch to production.

Obviously, content and configuration changes can still be made on the live site, so we still have the Wordpress problem of keeping the database in synch.

When setting up your local environment therefore it is important to get the correct branch checked out locally, and to get a copy of the 
correct database to be working with. This may mean getting a copy of the live/production database or the staging database.

Remember that when we add plugins, themes, etc these cause changes to the database.

We have the added complication of keeping staging and production synched at wpengine.

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
This contains 3 git submodules:

* A markdown to HTML parser: parsedown
* Our documents from the Standard repo: standard
* Docson - Give Docson a JSON schema and it will generate beautiful documentation: docson

The SSOT of the documentation is at:
https://github.com/ThreeSixtyGiving/standard
and so we clone this repository into the plugin. 

In Wordpress we then use short codes of the form (standard page="<name>") to fetch the correct document to display, pass it through a markdown to HTML parser, and display it on the website.

Replace <name> with the filename of the markdown text you wish to display (without .md)
e.g. to display the identifiers.md document: (standard page="identifiers")

We construct Wordpress pages under /standard


How does the data on the Find Data page work?
---------------------------------------------
We have a custom plugin: threesixty_salesforce_data that fetches data from a JSON output.

We have created a dedicated template page called page-data.php. This will be displayed if there is a Wordpress page with the slug 'data'.

Once called this page performs works with the plugin, stores the data it fetches and displays some of it to screen.

There is a 1 hour cache in place. This uses wordpress transients. To bypass the cache you need to remove the transients from the database.


Logos
-----
On the front page a custom slider is used to display the logos.
Each needs to be uploaded individually. This can all be done via the user interface.
We name logos <something>_slider to show they are to be used for the slider
Otherwise we just use a name.

The slider is managed by the Meta Slider plug-in - accesible via the left hand menu in WP-Admin.  When a new logo for the slider needs to be added, click ``Add Slide`` and then add the URL to the logo uploaded - this will have a URL in the ``uploads`` folder

Logos on the Find Data page are stored on the site, but the plugin is used to call them.

To show a new logo
++++++++++++++++++
Make sure the logo has been added to the Wordpress site.
make sure the URL of the logo is in the Salesforce backend

To remove a logo
++++++++++++++++
| Remove the logo URL from Salesforce  
| You could also remove the logo directly from Salesforce.


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


