Name of the Database: Healthlogdb  
Users:  
Admin: (Username: admin, Password: admin0)  
Doctor: (Username: D0822, Password: doctor)  

Installation Guide:  
Step 1: Install Xampp.  
Step 2: Unzip the file. OR, clone the repository from  
https://github.com/PrajwolM/HealthLog.git  
in C:\xampp\htdocs  
Step 3: Open Xampp and Start Apache and MySQL.  
Step 4: On a New Tab. Type localhost and press Enter.  
Step 5: Press on phpMyAdmin. This opens the database.  
Step 6: On the sidebar, press the ‘New’. This allows you to create a new database. The name of the database should be healthlogdb.  
Step 7: Press the Import button at the top of the site and press choose file to choose ‘healthlogdb (2).sql’. This imports all the tables and data in the sql file.  
Step 8: On a New Tab. Enter URL:  
http://localhost/HealthLog/pages/index.php  

Database: healthlogdb  
Tables:    
--adminlogin: userName,password (admin,admin0)  
--doctorinfo: did,name,surname,gender,specialization    
--doctorlogin: did, password (D0822,doctor)    
--doctorpatient: did, pid    
--patientinfo: pid, pName,phoneNumber,pGender, pDOB,pAllergies    
--patienttest: pid,tid,complete , result    
--inquiries:inquiryId,iname,iemail,icontact,inquiry    
--appointments: appointmentId,did,pid,appointmentDate    
--tests: tid,tname  
