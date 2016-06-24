<?php $this->layout('layout', ['title' => 'Mot de passe oublié']) ?>

<?php $this->start('main_content') ?>
    error :<br>
    <?php var_dump($error); ?>
    <hr>
    showFormPassword : <br>
    <?php var_dump($showFormPassword); ?>
    <hr>
    showConnectButton : <br>
    <?php var_dump($showConnectButton); ?>


    <?php if(isset($error) && !empty($error)) : ?>
         <div class="alert alert-danger">
            <ul>
                <?php foreach($error as $err) : ?>
                    <li><?php echo $err ?></li>
                <?php endforeach ?>
            </ul>
        </div>
    <?php endif; ?>

    <?php if($showConnectButton == true) :?> <!-- Ici le mot de passe a bien été modifié -->
        <div class="alert alert-success">
            Votre mot de passe a été bien changé.
            <br>
            Ne l'oubliez plus :)
            <a href="<?= $this->url('user_login'); ?>" class="btn btn-default btn-lg active" role="button">Connexion</a>
        </div>
    <?php endif; ?>

    <?php if(isset($showFormPassword) && $showFormPassword == true): ?>
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
    <?php endif ?>


<?php $this->stop('main_content') ?>