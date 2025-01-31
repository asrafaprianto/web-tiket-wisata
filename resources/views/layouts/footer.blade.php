<div class="footer-content justify-content-center">
    <div class="row">
        <div class="col-6 text-left">
            <span>2025 &copy;</span>
            <a href="{{ url('/') }}" style="color:rgb(13, 196, 74); text-decoration: none; font-weight: bold;">Sentana
                Teknologi</a>
        </div>
        <div class="col-6 text-right">
            <a href="{{ url('/about') }}"
                style="color:rgb(105, 105, 105); font-weight:500; text-decoration: none; margin-left: 15px;">About
                Us</a>
            <a href="{{ url('/support') }}"
                style="color:rgb(105, 105, 105); font-weight:500; text-decoration: none; margin-left: 15px;">Support</a>
            <a href="{{ url('/contact') }}"
                style="color:rgb(105, 105, 105); font-weight:500; text-decoration: none; margin-left: 15px;">Contact
                Us</a>
        </div>
    </div>
</div>

<style>
.footer-content {
    position: fixed;
    bottom: 0;

    width: 80%;

    background-color: #f8f9fa;
    padding: 10px 0;
    box-shadow: 0 -1px 5px rgba(0, 0, 0, 0.1);
}

.footer-content .row {
    margin: 0;
}

.footer-content .col-6 {
    padding: 0 15px;
}
</style>