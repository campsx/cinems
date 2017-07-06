<!--   debut partie container     -->



<div class="container">

<div class="left-content">

  <section class="text">

     <div class="profil-directeur">

         <h2>Profil Directeur</h2>
         <img src="img/tomcruise.jpg">

        <p class="info-perso">Nom <span><?php $this->echoHtml($director->getLastname()); ?></span></p>
        <p class="info-perso">Prénom <span><?php $this->echoHtml($director->getFirstname()); ?></span></p>
        <p class="info-perso">Date de naissance <span><?php $this->echoHtml($director->getAge()->format('Y-m-d')) ?></span></p>
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

  <aside class="info-section">

  <div class="section-inner">

    <div class="section-social">
    <h2>Filmographie</h2>
    </div>

    <div class="follow2">
      <img src="img/alpacino.jpg">
      <img src="img/assassins-creed.jpg">
      <img src="img/fantastisque.jpg">
      <img src="img/batmanVsuperman.jpg">
      <img src="img/alpacino.jpg">
      <img src="img/assassins-creed.jpg">
    </div>

    <div class="populaire-post">
      <h2>Popular posts</h2>
    </div>

    <div class="liste-populaire">
      <ul>
          <li><img src="img/assassins-creed.jpg"><p>Comment repérer un bon film ? Nos astuces et techniques</p><span>07 april 2015</span></li>
          <li><img src="img/fantastisque.jpg"><p>Film les plus vu de la semaine, les box-offices</p><span>05 july 2015</span></li>
      </ul>
    </div>

  </div>

  </aside>

</div>



</div>



<!--   fin partie container     -->