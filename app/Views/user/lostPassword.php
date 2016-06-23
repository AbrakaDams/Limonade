<?php $this->layout('layout', ['title' => 'Mot de passe oublié']) ?>

<?php $this->start('main_content') ?>

<?php 
?>
<!-- 	<?php //if(isset($showFormPassword) && $showFormPassword == true): ?> -->
    	<form class="form-horizontal well well-sm" method="post">
            <input type="hidden" name="action" value="updatePassword">
            <input type="hidden" name="email" value="<?=$_GET['email'];?>">
            <input type="hidden" name="token" value="<?=$_GET['token'];?>">
            <div class="form-group">
                <label class="col-md-4 control-label" for="new_password">Votre nouveau mot de passe</label>
                <div class="col-md-4">
                    <input type="password" name="new_password" id="new_password" class="form-control">
                </div>
            </div>

            <div class="form-group">
                <label class="col-md-4 control-label" for="new_password_conf">Confirmation du mot de passe</label>
                <div class="col-md-4">
                    <input type="password" name="new_password_conf" id="new_password_conf" class="form-control">
                </div>
            </div>

            <div class="form-group">
                <div class="col-md-4 col-md-offset-4">
                    <button type="submit" class="btn btn-default">Mettre à jour mon mot de passe</button>
                </div>
            </div>
        </form>
     <!-- <?php //endif ?>
        <? //else ?>
        <h3>Vous n'etes pas sensé être ici ! </h3>   -->  
<?php $this->stop('main_content') ?>