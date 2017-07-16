<div class="page-view">

    <section class="text">

        <div class="profil-actor">

            <h2> <?php $this->echoHtml($page->getTitle()); ?></h2>

        </div>
    </section>

    <section class="text2">
        <div class="section-inner">
            <div class="content-director">
                <p><?php $this->echoRaw($page->getContent());  ?> </p>
            </div>
        </div>
    </section>

</div>

