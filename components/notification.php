<?php
session_start();
if (isset($_SESSION['msg'])) {
?>
    <div class="container">
        <div class="message <?php echo $_SESSION['msg'][1] ?>">
            <span><?php echo $_SESSION['msg'][0] ?></span>
        </div>
    </div>
<?php
}
?>