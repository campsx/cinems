

<div class="left-content">

  <section class="text">

     <div class="profil-directeur">

         <h2>Profil Directeur</h2>

         <div class="director-img">
             <div style="background-image:url(<?php $this->echoHtml(PATH_MEDIAS_UPLOAD.$director->getImage()->getUrl());?>);background-position:50% 50%;background-size:cover;">
             </div>
         </div>


         <div class="info">
             <p class="info-perso">
                 Nom
                 <span>
                <?php $this->echoHtml($director->getLastname()); ?>
            </span>
             </p>
             <p class="info-perso">
                 Prénom
                 <span>
                <?php $this->echoHtml($director->getFirstname()); ?>
            </span>
             </p>
             <p class="info-perso">
                 Date de naissance
                 <span>
                <?php $this->echoHtml($director->getAge()->format('Y-m-d')) ?>
            </span>
             </p>
             <p class="info-perso">
                 Age
                 <span>
                    <?php
                    $dateBorn = $director->getAge();
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
        <p><?php $this->echoRaw($director->getDescription());  ?> </p>
      </div>
    </div>
  </section>







</div>


<div class="right-bar">

    <aside>
        <h3>Ses films</h3>
        <ul>
            <?php foreach ( $director->getFilms() as $film ):?>
                <li>
                    <a href="<?php echo URL_WEBSITE;?>film/view/<?php $this->echoHtml($film->getSlug())?>">
                        <img src="<?php $this->echoHtml(PATH_MEDIAS_UPLOAD.$film->getImage()->getUrl());?>" alt="">
                    </a>
                </li>
            <?php endforeach; ?>
        </ul>
    </aside>

</div>

