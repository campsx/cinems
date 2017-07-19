<h1>Welcome dashboard backoffice</h1>
<div>

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
</div>
