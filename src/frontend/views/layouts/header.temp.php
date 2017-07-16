
<!-- <header class="contenu-navbar">

   <div id="menu">

  <div id="hamburger">

      <div id="hamburger-content">

    <ul>
         <img src="<?php /*echo PATH_MEDIAS_IMAGES */?>CineMS.png" alt="" style="width: 42px;padding-top:10px">
         <li><a href="#home">Home</a></li>
         <li><a href="#news">News</a></li>
         <li><a href="#contact">Contact</a></li>
         <li><a href="#about">About</a></li>
         <li><a href="#news">News</a></li>
         <li><a href="#contact">Contact</a></li>
         <li><a href="#about">About</a></li>
      </ul>
    </div>
    <button id="hamburger-button">&#9776;</button>
    <div id="hamburger-sidebar">
        <div id="hamburger-sidebar-header"></div>
        <div id="hamburger-sidebar-body"></div>
    </div>
    <div id="hamburger-overlay"></div>
  </div>

  </div>

</header>-->


<header>
    <nav>
        <div class="nav-fostrap">
            <ul>
                <li>
                    <a href="<?php echo URL_WEBSITE ?>index" class="icon-cinems">
                        <img src="<?php echo PATH_MEDIAS_IMAGES ?>CineMS.png" alt="" style="width: 42px;">
                    </a>
                </li>
                <li class="nav-choice">
                    <a href="javascript:void(0)">Top films<span class="arrow-down"></span></a>
                    <ul class="dropdown">
                        <?php foreach ( $this->getTopFilms() as $topFilm ):?>
                            <li>
                                <a href="<?php echo URL_WEBSITE;?>film/view/<?php $this->echoHtml($topFilm->getSlug())?>">
                                    <?php $this->echoHtml($topFilm->getTitle()); ?>
                                </a>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                </li>
                <li class="nav-choice">
                    <a href="javascript:void(0)">
                        Top actors<span class="arrow-down"></span>
                    </a>
                    <ul class="dropdown">
                        <?php foreach ( $this->getTopActors() as $topActor ):?>
                        <li>
                            <a href="<?php echo URL_WEBSITE;?>actor/view/<?php $this->echoHtml($topActor->getSlug());?>">
                                <?php $this->echoHtml($topActor->getFirstname().' '.$topActor->getLastname()); ?>
                            </a>
                        </li>
                        <?php endforeach; ?>
                    </ul>
                </li>
                <li class="nav-choice">
                    <a href="javascript:void(0)">Pages<span class="arrow-down"></span></a>
                    <ul class="dropdown">
                        <?php foreach ( $this->getPages() as $headerpage ):?>
                            <li>
                                <a href="<?php echo URL_WEBSITE;?>page/view/<?php $this->echoHtml($headerpage->getSlug());?>">
                                    <?php $this->echoHtml($headerpage->getTitle()); ?>
                                </a>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                </li>

                <?php if($this->getRequest()->session()->getCurrentUser() === null) :?>
                    <li class="nav-choice">
                        <a href="<?php echo URL_WEBSITE ?>user/login">Connexion</a>
                    </li>

                    <li class="nav-choice">
                        <a href="<?php echo URL_WEBSITE ?>user/inscription">Inscription</a>
                    </li>
                <?php else: ?>
                    <li class="nav-choice">
                        <a href="<?php echo URL_WEBSITE ?>user/profil"><?php $this->echoHtml($this->getRequest()->session()->getCurrentUser()->getPseudo()); ?></a>
                    </li>

                    <li class="nav-choice">
                        <a href="<?php echo URL_WEBSITE ?>index/disconnect">Deconnexion</a>
                    </li>
                    <?php if($this->getRequest()->session()->isRole(Session::ROLE_ADMIN)) :?>
                        <li class="nav-choice">
                            <a href="<?php echo URL_WEBSITE_ADMIN ?>index/index">Admin</a>
                        </li>
                    <?php endif; ?>

                <?php endif;?>






            </ul>
        </div>
        <div class="nav-bg-fostrap">
            <div class="navbar-fostrap"> <span></span> <span></span> <span></span> </div>
        </div>
    </nav>
</header>


