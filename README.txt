//Roberto Ramos

* There are 2 ways of installing this tool

	- Uploading the ZIP
	- Uploading every file individually
	
* Changing permissions

	- This is usually done by right clicking on a file and folder and selecting
		"Change Permissions" from the menu. There you can enter or select the desired permissions
	
	- These are the permissions we will be using:
	
		0755 = User: Read, Write, Execute. Group: Read, Execute. World: Read, Execute.
		0644 = User: Read, Write. Group: Read. World: Read.
		
** Uploading the ZIP file

	1.- Upload the ZIP file to your sever.

		NOTE: The folder where you put all of this should be added to the "YourWebsite" url
	
		For example: If my website is https://detailed.com/ and I upload everything to a folder 
			named "CoolStuff", everywhere where it says "YourWebsite" would be replaced by https://detailed.com/CoolStuff
			
	2.- UNZIP the folder. Make sure that the CodedWithLite folder has the permission 0755.

	3.- Run the file "set_permissions.php" from the browser, make sure that this file has the permission 0644. Like this:

		YourWebsite/CodedWithLite/set_permissions.php
	
		For example: https://detailed.com/CodedWithLite/set_permissions.php
	
	4.- Now CodedWith Lite should work & should be located here:

		YourWebsite/CodedWithLite/

		For example: https://detailed.com/CodedWithLite/

** Uploading the files individually

	1.- Create a folder where you will put all the files "CodedWithLite". Make sure that the CodedWithLite folder has the permission 0755.

		NOTE: The folder where you put all of this should be added to the "YourWebsite" url
	
		For example: If my website is https://detailed.com/ and I upload everything to a folder 
			named "CoolStuff", everywhere where it says "YourWebsite" would be replaced by https://detailed.com/CoolStuff

	2.- Upload all of the files and folders into this folder.
	
		- Folders should have the permission 0755
		- Files should have the permission 0644

	3.- Now CodedWith Lite should work & should be located here:

		YourWebsite/CodedWithLite/

		For example: https://detailed.com/CodedWithLite/
