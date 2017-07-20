<div class="one-block">
    <h1>Acteur</h1>
    <div class="pagination">
        <?php if ($page > 1): ?>
            <a href="<?php echo URL_WEBSITE;?>actor/page/<?php echo $page - 1; ?>">Page précédente</a> —
        <?php endif; ?>


        <?php for ($i = 1; $i <= $nbPage; $i++): ?>
            <a href="<?php echo URL_WEBSITE;?>actor/page/<?php echo $i; ?>"><?php echo $i; ?></a>
        <?php endfor; ?>


        <?php if ($page < $nbPage): ?>
            — <a href="<?php echo URL_WEBSITE;?>actor/page/<?php echo $page + 1; ?>">Page suivante</a>
        <?php endif; ?>
    </div>
    <div>
        <?php foreach ( $list as $actor ):?>
            <article class="list-block">
                <div>
                    <h2><?php $this->echoHtml($actor->getFirstname(). ' ' .$actor->getLastname()); ?></h2>
                    <a href="<?php echo URL_WEBSITE;?>actor/view/<?php $this->echoHtml($actor->getSlug())?>">
                        <div class="list-img" style="background-image:url(<?php $this->echoHtml(PATH_MEDIAS_UPLOAD.$actor->getImage()->getUrl());?>);background-position:50% 50%;background-size:cover;">
                        </div>
                    </a>
                </div>
                <div>
                    <div>
                        Poster le : <?php $this->echoHtml($actor->getCreated()); ?>
                    </div>
                    <div class="shortDescription">
                        <?php $this->echoHtml($actor->getShortDescription()); ?>
                    </div>
                </div>

            </article>
        <?php endforeach; ?>
    </div>

    <div class="pagination">
        <?php if ($page > 1): ?>
            <a href="<?php echo URL_WEBSITE;?>actor/page/<?php echo $page - 1; ?>">Page précédente</a> —
        <?php endif; ?>


        <?php for ($i = 1; $i <= $nbPage; $i++): ?>
            <a href="<?php echo URL_WEBSITE;?>actor/page/<?php echo $i; ?>"><?php echo $i; ?></a>
        <?php endfor; ?>


        <?php if ($page < $nbPage): ?>
            — <a href="<?php echo URL_WEBSITE;?>actor/page/<?php echo $page + 1; ?>">Page suivante</a>
        <?php endif; ?>
    </div>


</div>



