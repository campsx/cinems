<h1>Welcome dashboard backoffice</h1>
<div>
    Total page vue sur site, total comment,
    des petits total avec top comment sur les films.
    formulaire require pour eviter bug sql
    injection sql dans le fichier model
    <div class="dashboard-block">
        <h2>Top view film</h2>
        <ul>
            <?php foreach ( $films as $film ):?>
                <li>
                    <div>
                        <?php $this->echoHtml('('.$film->getView().')'); ?>
                    </div>
                    <div>
                        <?php $this->echoHtml($film->getTitle()); ?>
                    </div>
                </li>
            <?php endforeach; ?>
        </ul>
    </div>

    <div class="dashboard-block">
        <h2>Top view director</h2>
        <ul>
            <?php foreach ( $directors as $director ):?>
                <li>
                    <div>
                        <?php $this->echoHtml('('.$director->getView().')'); ?>
                    </div>
                    <div>
                        <?php $this->echoHtml($director->getFirstname().' '.$director->getLastname()); ?>
                    </div>
                </li>
            <?php endforeach; ?>
        </ul>
    </div>

    <div class="dashboard-block">
        <h2>Top view actor</h2>
        <ul>
            <?php foreach ( $actors as $actor ):?>
                <li>
                    <div>
                        <?php $this->echoHtml('('.$actor->getView().')'); ?>
                    </div>
                    <div>
                        <?php $this->echoHtml($actor->getFirstname().' '.$actor->getLastname()); ?>
                    </div>
                </li>
            <?php endforeach; ?>
        </ul>
    </div>

    <div class="dashboard-block">
        <h2>Top view Page</h2>
        <ul>
            <?php foreach ( $pages as $page ):?>
                <li>
                    <div>
                        <?php $this->echoHtml('('.$page->getView().')'); ?>
                    </div>
                    <div>
                        <?php $this->echoHtml($page->getTitle()); ?>
                    </div>
                </li>
            <?php endforeach; ?>
        </ul>
    </div>
</div>
