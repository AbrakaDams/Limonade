
<?php $this->layout('layoutNoConnect', ['title' => 'FAQ']) ?>

<?php $this->start('main_content') ?>
<h1 class="center" id="top">Foire aux questions,</h1>
<h2 class="center">les questions les plus fréquentes</h2>
<hr>
	
<div class="faq">
		<ul class="nav nav-pills nav-stacked">
			<li role="presentation" class="active"><a href="#account">Pourquoi et comment créer mon compte?</a></li>
			<li role="presentation" class="faqsection"><a href="#private-public">Quelle est la différence entre un événement privé et public?</a></li>
			<li role="presentation" class="faqsection"><a href="#task">Mode d'emploi ajout des événements et des tâches</a></li>
			<li role="presentation" class="faqsection"><a href="#comment">Laisser des commentaires à vos amis</a></li>
			<li role="presentation" class="faqsection"><a href="#invite">Inviter des participants</a></li>
		</ul>
</div>
<div class="reponses">
	<ul class="faqList">
		<li class="faqsection" id="account"><i class="fa fa-sign-in" aria-hidden="true"></i><br><br>
		Pour gérer votre événement sur le site Lemonade vous devez avant tout tout vous connecter, celà vous permettra de garder tout vos projets d'organisation sur votre compte et d'inviter vos amis à mettre en place des projets avec vous! <br><hr>
		<i class="fa fa-facebook-official" aria-hidden="true"></i><br>
		Vous pouvez aussi vous inscrire avec facebook, vous recevrez un mot de passe pour vous connecter les fois suivantes. </li><hr>
		<li class="faqsection" id="private-public"><i class="fa fa-circle" aria-hidden="true"></i><i class="fa fa-circle-o" aria-hidden="true"></i><br><br>
		Un événement public sera visible par tous sur le site, il peut être très utile pour rassembler du monde (conférence, vernissage etc...)
		Un événement privé n'est accessible que par vous et les amis que vous avez invités sur cet événement.</li><hr>
		<li class="faqsection" id="task"><i class="fa fa-plus" aria-hidden="true"></i><br><br>
		Pour ajouter un événement lorsque vous êtes en mode connectés vous n'avez qu'a cocher la petite croix d'ajout dévénement remplir les informations demandées, et enfin au sein d'une événement vous pourrez ajouter autant de taches que vous le souhaitez, elles seront utiles pour vous organiser.
		Par exemple, nous partons au camping, la liste 1 comprendra le nombre de tente nécessaire et combien nous en avons, la liste 2 comprendra les sac de couchages, la liste 3 les litres d'eau à emporter etc..</li><hr>
		<li class="faqsection" id="comment"><i class="fa fa-comment-o" aria-hidden="true"></i><br><br>
		Vous pouvez à tout moment laisser un commentaire à vos amis en dessous des listes de tâches.</li><hr>
		<li class="faqsection" id="invite"><i class="fa fa-user-plus" aria-hidden="true"></i><br><br>
		Vous pouvez inviter des amis déjà inscrits sur Lemonade avec leurs pseudo</li>
	</ul>
<div>
	
	<a href="#top" id="icone"><i id="top" class="fa fa-hand-o-up" aria-hidden="true"></i></a></li>
</div>
</div>

<?php $this->stop('main_content') ?>
<?php $this->start('js') ?>
<script type="text/javascript">
	$(function () {
	    $('a[href*="#"]:not([href="#"])').click(function () {
	        if (location.pathname.replace(/^\//, '') == this.pathname.replace(/^\//, '') && location.hostname == this.hostname) {
	            var target = $(this.hash);
	            target = target.length ? target : $('[name=' + this.hash.slice(1) + ']');
	            if (target.length) {
	                $('html, body').animate({
	                    scrollTop: target.offset().top
	                }, 1000);
	                return false;
	            }
	        }
	    });
	});
</script>
<?php $this->stop('js') ?>

