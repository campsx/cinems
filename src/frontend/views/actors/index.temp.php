<div class="left-content">

        <section class="text">

            <div class="profil-actor">

                <h2>Profil Acteur</h2>

                <div class="actor-img">
                    <div style="background-image:url(<?php $this->echoHtml(PATH_MEDIAS_UPLOAD.$actor->getImage()->getUrl());?>);background-position:50% 50%;background-size:cover;">
                    </div>
                </div>


                <div class="info">
                    <p class="info-perso">
                        Nom
                        <span>
                            <?php $this->echoHtml($actor->getLastname()); ?>
                        </span>
                    </p>
                    <p class="info-perso">
                        Prénom
                        <span>
                            <?php $this->echoHtml($actor->getFirstname()); ?>
                        </span>
                    </p>
                    <p class="info-perso">
                        Date de naissance
                        <span>
                            <?php $this->echoHtml($actor->getAge()->format('Y-m-d')) ?>
                        </span>
                    </p>
                    <p class="info-perso">
                        Age
                        <span>
                            <?php
                            $dateBorn = $actor->getAge();
                            $currentDate = new dateTime();
                            $age = $currentDate->diff($dateBorn);

                            $this->echoHtml($age->y);
                            ?>
                        </span>
                    </p>
                </div>



            </div>
        </section>

        <section class="text2">
            <div class="section-inner">
                <div class="content-director">
                    <p><?php $this->echoRaw($actor->getDescription());  ?> </p>
                </div>
            </div>
        </section>

    </div>

    <div class="right-bar">
        <aside>
            <h3>Ses films</h3>
            <ul>
                <?php foreach ( $actor->getFilms() as $film ):?>
                    <li>
                        <a href="<?php echo URL_WEBSITE;?>film/view/<?php $this->echoHtml($film->getSlug())?>">
                            <img src="<?php $this->echoHtml(PATH_MEDIAS_UPLOAD.$film->getImage()->getUrl());?>" alt="">
                        </a>
                    </li>
                <?php endforeach; ?>
            </ul>
        </aside>
    </div>
