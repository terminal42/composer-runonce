composer-runonce
================

A simple runonce executor for Contao CMS extensions that want to support both,
ER2 and Composer.

# Problem

Contao deletes `config/runonce.php` files when you install an extension.
Composer doesn't like this behaviour as it cannot handle deleted files. It
will tell you that your local version is corrupt and will stop working.

# Solution

The solution is pretty easy: Just don't provide any `config/runonce.php` when
installing via Composer. To still support ER2, you have to provide this file
only when uploading it to the ER2. Of course, you don't want to write all your
runonce code twice so we came up with a pretty straight forward solution:

Just upload your `config/runonce.php` file once to the ER. Everytime you import
new files (e.g. with the git tag importer) this file will remain where it is
because files won't get deleted, only existing files will be overridden.

# Usage

Usage is pretty easy. Just upload the `runonce.php` file of this repository to
your ER2 extension and adjust the runonces in this file you want to run.

Hint: We think it's best practise to only include one runonce file to be
executed and include other scripts there if needed. If you use multiple files
you will have to adjust the `config/runonce.php` uploaded onto ER2 everytime
you add a new script. But that's really up to you :-)
