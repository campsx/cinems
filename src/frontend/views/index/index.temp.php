<div class="left-content homepage">
    <h3 class="text-center">Dernier films</h3>
    <?php foreach ( $listOfFilms as $film ):?>
        <article class="list-block">
            <div>
                <h2><?php $this->echoHtml($film->getTitle()); ?></h2>
                <a href="<?php echo URL_WEBSITE;?>film/view/<?php $this->echoHtml($film->getSlug())?>">
                    <div class="list-img" style="background-image:url(<?php $this->echoHtml(PATH_MEDIAS_UPLOAD.$film->getImage()->getUrl());?>);background-position:50% 50%;background-size:cover;">
                    </div>
                </a>
            </div>
            <div>
                <div>
                    Poster le : <?php $this->echoHtml($film->getCreated()); ?>
                </div>
                <div class="shortDescription">
                    <?php $this->echoHtml($film->getShortDescription()); ?>
                </div>
            </div>

        </article>
    <?php endforeach; ?>
</div>

<div class="right-bar">
    <aside>
        <h3>Dernier acteurs</h3>
        <ul>
            <?php foreach ( $listOfActors as $actor ):?>
                <li>
                    <a href="<?php echo URL_WEBSITE;?>actor/view/<?php $this->echoHtml($actor->getSlug())?>">
                        <img src="<?php $this->echoHtml(PATH_MEDIAS_UPLOAD.$actor->getImage()->getUrl());?>" alt="">
                    </a>
                </li>
            <?php endforeach; ?>
        </ul>
    </aside>
</div>


