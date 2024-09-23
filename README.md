# church
This is my church website


A general roadmap:

The front end of the website has five pages: 

1.Index.php:
This is the home page where you can view our location and hopefully I'll be able to make the slideshopw in the center completely dynamic some day
2.events.php
This only has an uly calender in the center right now but I hope to be able to change that in the future. I'm thinking to combine the events and sermobns pages together to make it so that I have less scripts in the file system so that it is easeier for me to maintain. 
Eventually, when the chruch decides to set up the youtube channel I can have this page dynamically change to show when we are live and display the live directly on the website. 
3.sermons.php
Mostly what was on line 13 applies here.
4.about.php
This page needs an entire rework. I don't know how to make an about page look good. I will have to sleep on this.
5.contact.php
Simple form. I think this is my favorite page on the entire front end. That says alot.

The backend of the website consists of every other page not mentioned above. This section has gone through 2 reworks so it is completely a mess at the moment. It went from normal website interaction where every page had to be loaded individually to an SPA that looked absolutely horrendous, to finally what it is right now. It seems it will also need a rework as well because it is actually starting to get a little complex. I'm thinking a framework like VUe js and maybe some laravel will make it perfect and I can finally stop remaking the entire thing. It really is a pain to have to rewrite 2000+ lines of code. But this time will be easier becuase most of the design won't change. It might actually be possible to just write a simple php script api to handle interaction with the database. Might not be as secure, but it is a church website, not a banking app. 

adminLogin.php is the access point to login to the admin portal. mainportal.php is the actual admin portal.

I hope to have many updates on this repository. Thank you.
