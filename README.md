parikchya
=========
This is actually a custom-designed software made for processing results of students spanning across multiple schools. It can be tweaked to use for just a single school as well.

This used to be hosted in sourceforge at http://sourceforge.net/projects/parikchya/

Installation
------------
- Extract everything.
- Create a database using the SQL dump parikchya.sql
- Update ./connection.php to the correct host, DB name, user and password.
- Replace "YOUR PUBLIC API KEY HERE" and "YOUR PRIVATE API KEY HERE" in ./admin/index.php with your own reCAPTCHA public and private key. You can obtain them from http://www.google.com/recaptcha/
- Replace http://example.com/ with whatever location/URL you've installed at in all files. A simple way to do so is to open all the PHP files in a text-editor (Geany, Notepad++ off the top of my head) and just do a Replace in session thingy.

Some Important Stuff
--------------------
- There are certain subjects in the SQL dump. The code might need a little bit of tweaking to work if you want to add / remove subjects. 
- If you want to use this within one school, install the app and add just one school from the admin menu.
