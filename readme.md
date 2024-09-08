Folder structure:

HealthLog
── index.php  
── db.php

/styles
── style.css  
── reset.css

/images
── logo.png  
── banner.jpg

/includes
── header.php  
── footer.php

/pages
── home.php  
── about.php --adminlogin
--doctorinfo
--doctorlogin
--doctorpatient
── contact.php

--patientinfo

/scripts
── navToggle.js  
── main.js

Database:
Tables:
--adminlogin: userName,password (admin,admin0)
--doctorinfo: did,name,surname,gender,specialization
--doctorlogin: did, password
--doctorpatient: did, pid
--patientinfo: pid, pName,phoneNumber,pGender, pDOB,pAllergies
--patienttest: pid,tid
--tests: tid,tname
