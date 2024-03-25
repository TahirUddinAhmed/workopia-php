<?php
         if(isset($_SESSION['success_message'])): 
        ?>
        <div class="messagge bg-green-100 p-3 my-3">
            <?= $_SESSION['success_message'] ?>
        </div>
        <?php unset($_SESSION['success_message']); ?>
        <?php endif; ?>