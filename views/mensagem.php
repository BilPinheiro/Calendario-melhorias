<?php 
if(isset($_SESSION['mensagem'])): ?>

<div class="alert alert-warning alert-dismissible fade show" role="alert">
<?= $_SESSION['mensagem']; ?>
<button type="button" class="close" data-dismiss="alert" aria-label="Close">
<span aria-hidden="true">&times;</span>
</button>
</div>

<?php 
unset($_SESSION['mensagem']);
endif; ?>



<?php 
if(isset($_SESSION['paginaNaoEncontrada'])): ?>

<div class="alert alert-info alert-dismissible fade show" role="alert">
<?= $_SESSION['paginaNaoEncontrada']; ?>
<button type="button" class="close" data-dismiss="alert" aria-label="Close">
<span aria-hidden="true">&times;</span>
</button>
</div>

<?php 
unset($_SESSION['paginaNaoEncontrada']);
endif; ?>



<?php 
if(isset($_SESSION['dbUpdateError'])): ?>

<div class="alert alert-danger alert-dismissible fade show" role="alert">
<?php 

echo $_SESSION["dbUpdateError"]; 
 ?>
<button type="button" class="close" data-dismiss="alert" aria-label="Close">
<span aria-hidden="true">&times;</span>
</button>
</div>

<?php 
unset($_SESSION['dbUpdateError']);
endif; ?>