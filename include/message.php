<?php 

if (isset($_SESSION["log-mess-s"])) {
    echo '<div class="alert alert-success fade show custom-alert" role="alert">' . $_SESSION["log-mess-s"] . '</div>';
    unset($_SESSION["log-mess-s"]);
} else if (isset($_SESSION['log-mess-e'])) {
    echo '<div class="alert alert-danger alert-dismissible fade show custom-alert" role="alert">'
            . $_SESSION['log-mess-e'] . 
            '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>';
    unset($_SESSION['log-mess-e']);
} else if (isset($_SESSION['log-mess-warn'])) {
    echo '<div class="alert alert-warning alert-dismissible fade show custom-alert" role="alert">'
            . $_SESSION['log-mess-warn'] . 
            '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>';
    unset($_SESSION['log-mess-warn']);
}
?>
<style>
    .custom-alert {
    position: fixed;
    top: 20px;
    right: 20px;
    max-width: 500px;  
    z-index: 1050;     
    box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
    }
</style>