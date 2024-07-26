<?php
    if(isset($_SESSION['success'])){
        echo '
            <div aria-live="polite" aria-atomic="true" style="position: fixed; bottom: 20px; right: 20px; z-index: 9999;">
                <div class="toast-success toast" id="successToast" role="alert" aria-live="assertive" aria-atomic="true">
                    <div class="toast-body d-flex align-items-center">
                        <i class="fas fa-check-circle mr-3"></i>
                        <span class="mr-3">'.$_SESSION["success"].'</span>
                        <button type="button" class="close" data-dismiss="toast" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                </div>
            </div>
        ';
        unset($_SESSION['success']);
    }
?>