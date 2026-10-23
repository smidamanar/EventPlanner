<footer>
    <div class="container">
        <div class="footer-logo">Event <span>Planner</span></div>

        <form class="subscribe-form">
            <input type="email" class="subscribe-input" placeholder="Enter your mail">
            <button type="submit" class="subscribe-btn">Subscribe</button>
        </form>

        <div class="footer-links">
            <a href="/">Home</a>
            <a href="{{ route('register') }}">Sign UP</a>
            <a href="{{ route('login') }}">Sign in</a>
        </div>

        <p class="copyright">Non Copyrighted © {{ date('Y') }} Event Planner</p>
    </div>
</footer>