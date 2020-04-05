# KNOW THE DOMAIN AND ORIGINAL TEXT

Go to the functions.php file and check 'replaceDefaultWocommerceString' function.
Replace <MY_TEXT_TO_TEST> by your text you want to translate.
Check the domain (ex, wine-space-shopkeeper, shopkeeper, woocoomerce...).

# CHANGE A TRANSLATION

Go to https://poeditor.com/projects/ and select the project according to the domain.
Adding your term and add translation.

Go to wordpress admin, and go to Tools > POEditor tab.
Select the right file to update from the project and click to IMPORT (for each language).

/!\ PLEASE, DOWNLOAD FILES BEFORE TO DO THAT, IN CASE OF UPDATE 

After having click to import and update translations, please get files and copy to /wp-content/themes/wine-space-shopkeeper/languages/.
Commit and push updates.

# MIROR FOLDERS

Here, translation files into woocoomerce and shopkeeper folders are juste for verionning in git.
Please move the file into /wp-content/languages/themes

