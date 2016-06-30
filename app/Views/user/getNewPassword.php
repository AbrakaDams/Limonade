<?php $this->layout('layout', ['title' => 'Mot de passe oublié']) ?>

<?php $this->start('main_content') ?>

    <?php if(isset($error) && !empty($error)): ?>
        <div class="alert alert-danger">
            <ul>
                <?php foreach ($error as $err) : ?>
                    <li><?php echo $err ?></li>
                <?php endforeach ?>
            </ul>
        </div>
    <?php endif; ?>

    <?php if($success == true): ?>
        <div class="alert alert-success">
            Un lien vous a été envoyé par mail, veuillez cliquer sur ce lien pour modifier votre mot de passe.
        </div>
    <?php endif; ?>

    <?php if($showForm == true): ?>
        <form class="form-horizontal well-well-sm" method="post">
            <div class="form-group">
                <label class="col-md-4 control-label" for="email">Email :</label>
                <div class="col-md-4">
                    <input id="email" type="email" name="email" placeholder="votre_email@gmail.com" class="form-control input-md" required>
                </div>
            </div>

            <div class="form-group">
                <div class="col-md-4 col-md-offset-4">
                    <button type='submit' class="btn btn-primary">Envoyez moi un nouveau de passe !</button>
                </div>
            </div>
        </form>
    <?php endif; ?>
<?php $this->stop('main_content') ?>
