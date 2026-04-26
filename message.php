<?php if(isset($_SESSION['success'])): ?>
<div class="popup-overlay">
    <div class="popup success">
        <div class="icon">✔</div>
        <h2>Success</h2>
        <p><?php echo $_SESSION['success']; ?></p>
        <button onclick="this.closest('.popup-overlay').style.display='none'">
Continue
</button>
        <!--<button onclick="closePopup()">Continue</button>-->
    </div>
</div>
<?php unset($_SESSION['success']); endif; ?>

<?php if(isset($_SESSION['error'])): ?>
<div class="popup-overlay">
    <div class="popup error">
        <div class="icon">✖</div>
        <h2>Error</h2>
        <p><?php echo $_SESSION['error']; ?></p>
        <button onclick="this.closest('.popup-overlay').style.display='none'">
Close
</button>
        <!--<button onclick="closePopup()">shere</button>-->
    </div> 
</div>
<?php unset($_SESSION['error']); endif; ?>
