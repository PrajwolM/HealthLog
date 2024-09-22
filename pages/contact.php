<?php include '../layouts/nav.php'; ?>

<section class="contact">
    <div class="conatiner-fluid">
        <div class="banner">
            <div class="row">
                <div class="col-7">
                    <h1>Reach Out To <br> HealthLogs Today</h1>
                    <p>At HealthLogs, we believe that your health deserves the highest standard of care. Our dedicated team of experts is here to support you every step of the way, providing personalized, compassionate, and comprehensive services tailored to your unique needs.</p>
                </div>
                <div class="col-5">
                    <img src="../images/slider2.jpg" alt="doctor-banner">
                </div>
            </div>

        </div>

        <div class="contact-us">
            <div class="row">
                <div class="col-lg-6">
                    <img src="../images/about.jpg" alt="contact-us">
                </div>

                <div class="col-lg-6">
                    <h2 class="text-center">We're Here To Assist You</h2>
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Doloribus itaque, laudantium aut
                        perferendis assumenda odio distinctio adipisci! Aliquam sint magni corrupti, cupiditate error
                        cum, ab repellendus hic quis ipsam eaque?</p>
                    <form id="contactForm" action="inquirySubmission.php" method="POST" novalidate>
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="name" class="form-label">Full Name</label>
                                <input type="text" class="form-control" name="name" id="name" required>

                                <div class="invalid-feedback">Please provide your full name.</div>
                            </div>
                            <div class="col-md-6">
                                <label for="contact" class="form-label">Phone</label>
                                <input type="tel" class="form-control" id="contact" name="contact" required>

                                <div class="invalid-feedback">Please provide your phone number.</div>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" name="email" required>

                            <div class="invalid-feedback">Please provide a valid email address.</div>
                        </div>

                        <div class="mb-3">
                            <label for="question" class="form-label">Message</label>
                            <textarea class="form-control" id="question" name="question" rows="4" required></textarea>

                            <div class="invalid-feedback">Please enter your message.</div>
                        </div>

                        <button type="submit" class="btn btn-primary">Submit Inquiry</button>
                    </form>

                </div>
            </div>
        </div>
    </div>
    <iframe
        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d6625.082799526283!2d151.206628574568!3d-33.87570791941476!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x6b12ae3d90c7b911%3A0x9e12beab95fef823!2sWestern%20Sydney%20University%20-%20Sydney%20City%20Campus!5e0!3m2!1sen!2sau!4v1723308053730!5m2!1sen!2sau"
        width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy"
        referrerpolicy="no-referrer-when-downgrade"></iframe>

</section>

<?php include '../layouts/footer.php'; ?>