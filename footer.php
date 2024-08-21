<!-- Upper Footer -->
<footer class="upper-footer">
    <hr class="footer-divider top">
    <div class="footer-container">
        <div class="footer-column welcome-column">
            <h2>Welcome to D'SIGNfly</h2>
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus lacinia odio vitae vestibulum. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus lacinia odio vitae vestibulum. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus lacinia odio vitae vestibulum.</p>
            <a href="#" class="read-more-button">Read more</a>
        </div>
        <div class="footer-column contact-column">
            <h2>Contact Us</h2>
            <p>Street 21 Planet, A-11, dapibus tristique. 123 551</p>
            <p>Tel: 123 456-7890; Fax: 123 456789</p>
            <p>Email: <span class="email">contactus@edsignfly.com</span></p>
            <div class="social-icons">
                <a href="#" class="social-icon facebook"><i class="fab fa-facebook-f"></i></a>
                <a href="#" class="social-icon google-plus"><i class="fab fa-google-plus-g"></i></a>
                <a href="#" class="social-icon linkedin"><i class="fab fa-linkedin-in"></i></a>
                <a href="#" class="social-icon pinterest"><i class="fab fa-pinterest"></i></a>
                <a href="#" class="social-icon twitter"><i class="fab fa-twitter"></i></a>
            </div>
        </div>
    </div>
</footer>


<!-- Lower Footer Divider -->
<hr class="footer-divider bottom">


    <!--Lower Footer -->
<footer class="site-footer">
    <div class="container">
        <p class="footer-copyright">
            &copy; <?php echo date('Y'); ?> D'Signfly | Designed by 
            <span class="author-name"><?php echo wp_get_theme()->get('Author'); ?></span>
        </p>
    </div>
    <?php wp_footer(); ?>
</footer>
</body>
</html>