# rtCamp Challenge - 2018

## Facebook Album Challenge

	Create a small PHP-script to accomplish following parts:

	Part-1: Album Slideshow
		User visits your script page
		User will be asked to connect using his FB account
		Once authenticated, your script will pull his album list from FB
		User will click on an album name/thumbnail
		A pure CSS and Plain JS slideshow will start showing photos in that album (in full-screen mode)
		
	Part-2: Download Album
		Beside every album icon (step #4 in part-1), add a new icon/button saying “Download This Album”
		When the user clicks on that button, your script will fetch all photos in that album behind the scene and zip them inside a folder on server.
		You may start a “progress bar” as soon as user-click download button as download process may take time.
		Once zip building on server completes, show user link to zip file.
		When user clicks zip-file link, it will download zip folder without opening any new page.
		Beside album names, add a checkbox. Then add a common “Download Selected Album” button. This button will download selected albums into a common zip that will contain one folder for each album. Folder-name will be album-name.
		Also, add a big “Download All” button. This button will download all albums in a zip, similar to above.
		
	Part-3: Backup albums to Google Drive
		Provide the user with an option to move albums to a Google Drive.
		The Google Drive will contain a master folder whose name will be of the format facebook_<username>_albums where username will be the Facebook username of the user.
		The user’s Facebook albums will be backed up in this master folder. Photos from each album will go inside their respective folders. Folder names will be the same as the Facebook album names.
		To improve the user experience, include the three following buttons:
		“Move” button- This button will appear under each album on your website. When clicked, the corresponding album only will be moved to Google Drive
		“Move Selected”- This button will work along with a checkbox system. The user can select a few albums via checkboxes and click on this button. Only the selected albums will be moved to Google Drive
		“Move All”- This button will immediately move all user albums to Google Drive within their respective folders.
		Make sure that the user is asked to connect to their Google account only once, no matter how many times they choose to move data.
		Note – Before submitting your challenge for review, please add Facebook profile with username ‘rtc.test‘ as tester while your app is in development mode. This will expedite the review process.


## Link to live Project : https://album-challenge.000webhostapp.com/
## Link to Github Project : https://github.com/Parth2412/rtCamp-Challenge-Facebook-Album


# User Guide :

	1. First of all in index page there is a single button which will allow user to login with thier facebook account and then it will redirect to display-album page.
	
	2. On the display-album page user will see all the album list with album names which is already in their facebook profile and in addtion user will also see the button "Download" and "Upload" under each album. furthermore, user will see small checkbox button at the right corner of album list. and user will see the button named "Download Selected Albums", "Move Selected Albums To Drive", "Download All Albums", "Move Selected Albums To Drive", and the "Logout" button respectivly.
	
	3. If user clicks on the album name or thumbnail of the album so it will redirect to the album-pictures page where user will see the list of photos and if user clicks any of the picture it will open in full screen mode.
	
	4. If user selected the "download" button of any album so the zip of that particular album will be downloaded.
	
	5. If user selected multiple albums and select the button "Download Selected Albums" so zip of selecte albums will created and downloaded.
	
	6. If user selected "Download All Albums" so zip of the all albums will be created and downloaded.
	
	7. If user selected "upload" button of any album so it will first redirect to the goolge login page and then it will redirect to display-album page again and if user click upload button again so it will redirect to the file-upload page and user will see all the photos of that perticuar album.
 

## External Libraries Used

	1. Facebook php sdk v5 - http://developers.facebook.com

	2. Google drive PHP client - http://developers.google.com

	3. Bootstrap 4.0 - http://www.getbootstrap.com
