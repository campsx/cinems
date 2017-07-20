<div class="one-block">
    <h1>Film</h1>
    <div class="pagination">
        <?php if ($page > 1): ?>
            <a href="<?php echo URL_WEBSITE;?>film/page/<?php echo $page - 1; ?>">Page précédente</a> —
        <?php endif; ?>


        <?php for ($i = 1; $i <= $nbPage; $i++): ?>
            <a href="<?php echo URL_WEBSITE;?>film/page/<?php echo $i; ?>"><?php echo $i; ?></a>
        <?php endfor; ?>


        <?php if ($page < $nbPage): ?>
            — <a href="<?php echo URL_WEBSITE;?>film/page/<?php echo $page + 1; ?>">Page suivante</a>
        <?php endif; ?>
    </div>
    <div>
        <?php foreach ( $list as $film ):?>
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

    <div class="pagination">
        <?php if ($page > 1): ?>
            <a href="<?php echo URL_WEBSITE;?>film/page/<?php echo $page - 1; ?>">Page précédente</a> —
        <?php endif; ?>


        <?php for ($i = 1; $i <= $nbPage; $i++): ?>
            <a href="<?php echo URL_WEBSITE;?>film/page/<?php echo $i; ?>"><?php echo $i; ?></a>
        <?php endfor; ?>


        <?php if ($page < $nbPage): ?>
            — <a href="<?php echo URL_WEBSITE;?>film/page/<?php echo $page + 1; ?>">Page suivante</a>
        <?php endif; ?>
    </div>


</div>



