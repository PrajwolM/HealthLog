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
── about.php
--loginRedirect
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
--adminlogin: userName,password (admin,admin0)(D0822,doctor)
--doctorinfo: did,name,surname,gender,specialization
--doctorlogin: did, password
--doctorpatient: did, pid
--patientinfo: pid, pName,phoneNumber,pGender, pDOB,pAllergies
--patienttest: pid,tid
--inquiries:inquiryId,iname,iemail,icontact,inquiry
--appointments: appointmentId,did,pid,adate
--tests: tid,tname
