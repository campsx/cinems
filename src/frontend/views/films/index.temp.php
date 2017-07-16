<div class="left-content film-content">

    <section class="text">

        <div class="profil-film">

            <h1><?php $this->echoRaw($film->getTitle());  ?> </h1>

            <div class="film-img">
                <div style="background-image:url(<?php $this->echoHtml(PATH_MEDIAS_UPLOAD.$film->getImage()->getUrl());?>);background-position:50% 50%;background-size:cover;">
                </div>
            </div>

        </div>
    </section>

    <section>
        <div class="film-actors">
           <h3>Liste des acteurs :</h3>
            <ul>
                <?php foreach ( $film->getActors() as $actor ):?>
                    <li>
                        <a href="<?php echo URL_WEBSITE;?>actor/view/<?php $this->echoHtml($actor->getSlug())?>">
                            <div style="background-image:url(<?php $this->echoHtml(PATH_MEDIAS_UPLOAD.$actor->getImage()->getUrl());?>);background-position:50% 50%;background-size:cover;">
                            </div>
                        </a>
                    </li>
                <?php endforeach; ?>
            </ul>
        </div>
    </section>

    <section>

        <div class="note">
            <h3>Note :</h3>
            <div>
                Notre note : <?php $this->echoHtml($film->getWriterNote());  ?>
            </div>
            <div>
                Votre note :
                <?php if (count($film->getComments()) === 0):?>
                    Pas encore de note
                <?php else: ?>
                   <?php $this->echoHtml((int)$this->commentAverage($film->getId())); ?> (<?php $this->echoHtml(count($film->getComments()));?>)
                <?php endif;?>
            </div>
        </div>

        <div>
            <h3>Notre critique :</h3>
            <div>
                <p><?php $this->echoRaw($film->getContent());  ?> </p>
            </div>
        </div>

    </section>

    <section>
        <div>
            <h3>Commentaire :</h3>

            <div>

                <?php if ($this->getRequest()->session()->getCurrentUser() !== null):?>
                    <?php foreach ($errors as $error):?>
                        <p style="color: red;"><?php echo $error ?></p>
                    <?php endforeach;?>
                    <div class="comment-wrap">
                        <div class="photo">
                            <?php if ($this->getRequest()->session()->getCurrentUser()->getImage() === null):?>
                                <div class="avatar" style="background-image: url(<?php echo PATH_MEDIAS_IMAGES ?>CineMS.png)"></div>
                            <?php else: ?>
                                <div class="avatar" style="background-image: url(<?php $this->echoHtml(PATH_MEDIAS_UPLOAD.$this->getRequest()->session()->getCurrentUser()->getImage()->getUrl());?>)"></div>
                            <?php endif;?>
                        </div>
                        <div class="comment-block">
                            <form method="POST" action="<?php echo URL_WEBSITE.'film/view/'.$film->getSlug() ?>">
                                <input placeholder="Title" required type="text" name="title">
                                <textarea required name="content" cols="30" rows="3" placeholder="Add comment..."></textarea>
                                Note :
                                <select required name="note">
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                    <option value="5">5</option>
                                </select>
                                <input type="hidden" name="token_add" value="<?php $this->echoHtml($token); ?>">
                                <input value="Valider" type="submit">
                            </form>
                        </div>
                    </div>
                <?php else: ?>
                    <div>
                        <a href="<?php echo URL_WEBSITE ?>user/login">Connecter vous pour l'essais un commentaire.</a>
                    </div>
                <?php endif;?>

            </div>

            <div class="comments">
                <?php foreach ( $film->getComments() as $comment ):?>
                <?php if ($comment->getvalid() == 0) {continue;}?>
                <div class="comment-wrap">
                    <div class="photo">
                        <?php if ($comment->getUser()->getImage() === null):?>
                            <div class="avatar" style="background-image: url(<?php echo PATH_MEDIAS_IMAGES ?>CineMS.png)"></div>
                        <?php else: ?>
                            <div class="avatar" style="background-image: url(<?php $this->echoHtml(PATH_MEDIAS_UPLOAD.$comment->getUser()->getImage()->getUrl());?>)"></div>
                        <?php endif;?>
                    </div>
                    <div class="comment-block">
                        <p class="comment-text">
                            <?php echo $comment->getContent(); ?>
                        </p>
                        <div class="bottom-comment">
                            <div class="comment-date">
                                <?php echo $comment->getCreated(); ?>
                            </div>
                            <div class="comment-note">
                                <?php echo $comment->getNote(); ?>/5
                            </div>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>

        </div>
    </section>

</div>

<div class="right-bar film-director">
    <aside>
        <h3>Director</h3>
        <a href="<?php echo URL_WEBSITE;?>director/view/<?php $this->echoHtml($film->getDirector()->getSlug())?>">
            <div style="background-image:url(<?php $this->echoHtml(PATH_MEDIAS_UPLOAD.$film->getDirector()->getImage()->getUrl());?>);background-position:50% 50%;background-size:cover;">
            </div>
        </a>
    </aside>
</div>

