<!-- <?php
echo '<h1>Index</h1>' ?> -->
<?php include('../layouts/nav.php'); ?>

<div class="home">
    <!-- Slider -->
    <div id="carouselExampleIndicators" class="carousel slide">
        <div class="carousel-indicators">
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
        </div>
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="../images/slider1.jpg" class="d-block w-100" alt="slider1">
            </div>
            <div class="carousel-item">
                <img src="../images/slider2.jpg" class="d-block w-100" alt="slider2">
            </div>
            <div class="carousel-item">
                <img src="../images/slider3.jpeg" class="d-block w-100" alt="slider3">
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>
    <!-- End of Slider -->

    <!-- About US -->
     <div class="about">
        <div class="row">
            <div class="col-lg-6">
                <img src="../images/about.jpg" alt="about">
            </div>
            <div class="col-lg-6">
                <h2 class="text-center">About HealthLogs Hospital</h2>
                <p>At HealthLogs, we are committed to providing exceptional healthcare services to our community. Our dedicated team of professionals offers comprehensive medical care, advanced treatments, and compassionate support to ensure your health and well-being.</p>
                <div class="sub-content row">
                    <div class="col-md-6">
                        <h5>Our Vision</h5>
                        <p>our vision is to be a leader in healthcare, transforming lives through innovative medical practices and compassionate care. We strive to create a healthier community by prioritizing patient-centered services and promoting wellness for all.</p>
                    </div>
                    <div class="col-md-6">
                        <h5>Our Mission</h5>
                        <ul>
                            <li>To provide high-quality, compassionate healthcare to all patients.</li>
                            <li>To invest in advanced medical technology and training.</li>
                            <li>To promote wellness and preventive care in the community.</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
     </div>
    <!-- End of About Us -->

    <!-- Features -->
     <section>
        <div class="features">
            <h2>Features</h2>
            <div class="details row">
                <div class="infra col-6 row">
                    <div class="icon col-2">
                        <i class="fas fa-building"></i>
                    </div>
                    <div class="content col-10">
                        <h4>Great Infrastructure</h4>
                        <p>We pride ourselves on our state-of-the-art infrastructure. Our facility is equipped with advanced medical technologies and spacious, comfortable patient areas, ensuring a safe and efficient environment for both patients and staff. We continuously invest in modernizing our resources to provide the highest standard of care.</p>
                    </div>
                </div>
                <div class="medical col-6 row">
                    <div class="icon col-2">
                        <i class="fas fa-pills"></i>
                    </div>
                    <div class="content col-10">
                        <h4>Advanced Medical Facilities</h4>
                        <p>We offer cutting-edge medical facilities designed to meet diverse healthcare needs. Our hospital is equipped with the latest diagnostic tools, advanced surgical suites, and specialized treatment centers, ensuring our patients receive the highest quality of care. We are dedicated to using innovative technology to enhance patient outcomes and promote healing.</p>
                    </div>
                </div>
            </div>
            <div class="details row">
                <div class="social col-6 row">
                    <div class="icon col-2">
                    <i class="fas fa-hands-helping"></i>                    
                </div>
                    <div class="content col-10">
                        <h4>Social Services</h4>
                        <p>We believe in holistic care that extends beyond medical treatment. Our social services team is dedicated to supporting patients and their families through various programs, including counseling, financial assistance, and community outreach. We strive to address the social determinants of health, ensuring that every individual receives comprehensive support on their journey to wellness.</p>
                    </div>
                </div>
                <div class="excellent col-6 row">
                    <div class="icon col-2">
                        <i class="fa-solid fa-truck-medical"></i>
                    </div>
                    <div class="content col-10">
                        <h4>Excellent Ancillary Services</h4>
                        <p>We provide a range of excellent ancillary services that enhance patient care and streamline the treatment process. From diagnostic imaging and laboratory services to physical therapy and nutritional counseling, our expert teams work collaboratively to support our patients' health needs. We are committed to delivering high-quality, comprehensive services that ensure a seamless and positive healthcare experience. Feel free to adjust any part as needed!</p>
                    </div>
                </div>
            </div>
            <div class="details row">
                <div class="ambulance col-6 row">
                    <div class="icon col-2">
                        <i class="fa-solid fa-truck-medical"></i>
                    </div>
                    <div class="content col-10">
                        <h4>24/7 Ambulance Services</h4>
                        <p>We offer round-the-clock ambulance services to ensure timely medical assistance when you need it most. Our fully equipped ambulances are staffed by trained professionals who provide critical care during transport. We are dedicated to delivering safe and efficient emergency services, prioritizing the health and well-being of our community at all times.</p>
                    </div>
                </div>
                <div class="technology col-6 row">
                    <div class="icon col-2">
                        <i class="fas fa-robot"></i>                    
                    </div>
                    <div class="content col-10">
                        <h4>Cutting Edge Technology</h4>
                        <p>We leverage cutting-edge technology to enhance patient care and improve outcomes. Our facility is equipped with the latest medical devices, advanced diagnostic tools, and innovative treatment solutions. We are committed to integrating state-of-the-art technology into our practices, ensuring that our patients receive the highest standard of care in a modern healthcare environment.</p>
                    </div>
                </div>
            </div>
        </div>
     </section>
    <!-- End of Features -->

    <!-- Working Hours -->
     <section class="working">
        <div class="container-fluid">
            <img src="../images/slider2.jpg" class="d-block w-100" alt="bg-img">
            <div class="top-left">
                <h1 class="text-light">Our Clinic <br> Working Hours <br> Schedule</h1>
                <p>Here’s our clinic’s working hours schedule:</p>

                <div class="schedule row">
                    <div class="day col-12 col-md-6">
                        <i class="fa-solid fa-calendar-days"> Monday</i>
                    </div>
                    <div class="time col-12 col-md-6">
                        <p>8:00 AM - 8:00 PM</p>
                    </div>
                </div>
                <div class="schedule row">
                    <div class="day col-12 col-md-6">
                        <i class="fa-solid fa-calendar-days"> Tuesday</i>
                    </div>
                    <div class="time col-12 col-md-6">
                        <p>8:00 AM - 8:00 PM</p>
                    </div>
                </div>
                <div class="schedule row">
                    <div class="day col-12 col-md-6">
                        <i class="fa-solid fa-calendar-days"> Wednesday</i>
                    </div>
                    <div class="time col-12 col-md-6">
                        <p>8:00 AM - 8:00 PM</p>
                    </div>
                </div>
                <div class="schedule row">
                    <div class="day col-12 col-md-6">
                        <i class="fa-solid fa-calendar-days"> Thursday</i>
                    </div>
                    <div class="time col-12 col-md-6">
                        <p>8:00 AM - 8:00 PM</p>
                    </div>
                </div>
                <div class="schedule row">
                    <div class="day col-12 col-md-6">
                        <i class="fa-solid fa-calendar-days"> Friday</i>
                    </div>
                    <div class="time col-12 col-md-6">
                        <p>8:00 AM - 8:00 PM</p>
                    </div>
                </div>
            </div>
        </div>
      </section>
    
      <!-- End of Working Hours -->
     
</div>

<?php include '../layouts/footer.php';?>