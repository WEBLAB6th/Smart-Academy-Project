<?php include "inc/header.php" ?>

<div class="row">
    <div class="col-md-12 text-center align-items-center bg-cover" id="blog-post" style=" height: 300px;">
        <div style="position: relative; top: 50%; transform: translateY(-50%); text-align: center;" data-aos="zoom-in"
            data-aos-duration="3000">
            <h1 class="text-white" data-aos="fade-down" data-aos-duration="3000">
                ABOUT US
            </h1>
            <div class="container my-3 ">
                <div class="row ">
                    <div class="col-12 text-center " data-aos="fade-up" data-aos-duration="3000">
                        <a href="#" class="text-white"> Home &nbsp; &#187; &nbsp;</a>
                        <a href="#" class="text-white">Gallery &nbsp; &#187; &nbsp; </a>
                        <a href="#" class="text-white">Courses &nbsp; &#187; &nbsp; </a>
                        <a href="#" class="text-white">Contact Us &nbsp; &#187; &nbsp; </a>
                        <a href="#" class="text-white">About Us</a>
                    </div>
                </div>

            </div>

        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <section class="about">
            <div class="container">

                <div class="row">
                    <div class="col-lg-6" data-aos="zoom-in" data-aos-duration="3000">
                        <img src="images/about.jpg" class="img-fluid" alt="">
                    </div>
                    <div class="col-lg-6 pt-4 pt-lg-0" data-aos="zoom-out" data-aos-duration="3000">
                        <h3>Embracing Life's Pleasures</h3>
                        <p class="fst-italic">
                            Indulge in the richness of life at Smart Institute IT and Safety - HSC, where we believe in
                            providing an education that goes beyond the ordinary. Our commitment to excellence is
                            reflected in every aspect of your learning journey.
                        </p>
                        <ul>
                            <li><i class="fas fa-check-circle"></i>Holistic Education: Immerse yourself in an education that transcends the conventional, fostering a deeper connection with the subjects and the world around you.</li>
                            <li><i class="fas fa-check-circle"></i> Passionate Instructors: Learn from industry professionals and passionate instructors dedicated to shaping your understanding of Information Technology and Health, Safety, and Environment.</li>
                            <li><i class="fas fa-check-circle"></i> Safety First: In the realm of IT and Safety, we prioritize your well-being. Our courses instill a deep understanding of safety protocols and best practices.</li>
                        </ul>
                        <p>
                            Join us on this journey of self-discovery, where the pursuit of knowledge is intertwined
                            with the joys of life. At Smart Institute IT and Safety - HSC, we embrace the dignissimos
                            provident quasi corporis voluptates sit assumenda — the pleasures that come from knowledge,
                            safety, and the endless possibilities that lie ahead.
                        </p>
                    </div>
                </div>

            </div>
        </section>
    </div>
</div>
<div class="row mt-5">
    <div class="col-md-12">
        <section id="counts" class="counts section-bg" data-aos="zoom-in" data-aos-duration="3000">
            <div class="container">

                <div class="row counters">

                    <?php 
                        $total_students = "SELECT count(*) AS total_students FROM apply_form_students";
                        $total_students_result = $con -> prepare($total_students);
                        $total_students_result-> execute();
                        $students = $total_students_result -> fetch(PDO::FETCH_ASSOC);
                        $total_students_result_total = $students['total_students'];
                    ?>
                    <div class="col-lg-3 col-6 text-center">
                        <span data-purecounter-start="0"
                            data-purecounter-end="<?php echo $total_students_result_total ?>"
                            data-purecounter-duration="3" class="purecounter"></span>
                        <h5>Students</h4>
                    </div>

                    <?php  
                        $total_courses = "SELECT count(*) AS total_course FROM courses";
                        $total_courses_result = $con-> prepare($total_courses);
                        $total_courses_result -> execute();
                        $total_courses = $total_courses_result -> fetch(PDO::FETCH_ASSOC);
                        $total_cour = $total_courses['total_course'];
                        
                        ?>
                    <div class="col-lg-3 col-6 text-center">
                        <span id="coursesCounter" data-purecounter-start="0"
                            data-purecounter-end="<?php echo $total_cour  ?>" data-purecounter-duration="3"
                            class="purecounter"></span>
                        <h5>Courses</h5>
                    </div>

                    <div class="col-lg-3 col-6 text-center">
                        <span data-purecounter-start="0" data-purecounter-end="42" data-purecounter-duration="3"
                            class="purecounter"></span>
                        <h5>Events</h5>
                    </div>

                    <div class="col-lg-3 col-6 text-center">
                        <span data-purecounter-start="0" data-purecounter-end="15" data-purecounter-duration="3"
                            class="purecounter"></span>
                        <h5>Trainers</h5>
                    </div>

                </div>

            </div>
        </section>

    </div>

</div>

<div class="row">
    <div class="col-md-12">
        <section class="skills">
            <div class="container">

                <div class="section-title">
                    <h2 data-aos="fade-down" data-aos-duration="3000">Our Skills</h2>
                    <p data-aos="fade-up" data-aos-duration="3000">
                        Smart Institute IT and Safety is a cutting-edge institution dedicated to providing comprehensive
                        training and education in the fields of Information Technology (IT) and Health, Safety, and
                        Environment (HSC). With a commitment to excellence, our institute equips individuals with the
                        skills and knowledge necessary to thrive in the dynamic and rapidly evolving sectors of IT and
                        safety.

                        Key Skills:

                        Information Technology (IT):

                        Programming and Coding: Proficiency in programming languages such as Python, Java, C++, etc.
                        Software Development: Hands-on experience in software development methodologies and tools.
                        Network Administration: Expertise in managing and securing computer networks.
                        Cybersecurity: Training in protecting digital systems from cyber threats.
                        Health, Safety, and Environment (HSC):

                        Occupational Health and Safety (OHS): Understanding and implementation of safety protocols in
                        workplaces.
                        Environmental Management: Strategies for sustainable and eco-friendly practices.
                        Emergency Response: Training in handling emergencies and crisis situations.
                        Regulatory Compliance: Knowledge of local and international safety regulations.
                        Our Approach:
                        Smart Institute IT and Safety adopts a holistic approach to education, combining theoretical
                        knowledge with hands-on practical experience. Our experienced instructors and state-of-the-art
                        facilities ensure that students not only understand the concepts but also gain valuable,
                        real-world skills.

                        Why Choose Smart Institute IT and Safety?

                        Industry-Relevant Curriculum: Our programs are designed to meet the current and future needs of
                        the IT and safety industries.
                        Experienced Instructors: Learn from professionals with practical experience in their respective
                        fields.
                        Cutting-Edge Facilities: Access to modern labs and technology for hands-on learning.
                        Career Guidance: Support in career development and job placement.
                        Contact Us:
                        [Include contact information for the institute, such as address, phone number, email, and
                        website.]

                        At Smart Institute IT and Safety, we believe in empowering individuals with the knowledge and
                        skills needed to excel in the dynamic landscapes of IT and safety. Join us on the journey to a
                        successful and fulfilling career.</p>
                </div>


            </div>
        </section>
    </div>
</div>

<?php include "inc/footer.php" ?>