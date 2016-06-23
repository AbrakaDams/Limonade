<?php $this->layout('layout', ['title' => 'Mot de passe oublié']) ?>

<?php $this->start('main_content') ?>

    <form class="form-horizontal well-well-sm" method="post">
        <div class="form-group">
            <label class="col-md-4 control-label" for="email">Email : </label>
            <div class="col-md-4">
                <input id="email" type="email" name="email" placeholder="votre@gmail.com" class="form-control input-md" required>
            </div>
        </div>

        <div class="form-group">
            <div class="col-md-4 col-md-offset-4">
                <button type='submit' class="btn btn-primary">Envoyez moi un nouveau de passe !</button>
            </div>
        </div>
     </form>

<?php $this->stop('main_content') ?>