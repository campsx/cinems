<?php

class RssController extends AbstractController {

	public function indexAction($params)
	{
	    return null;
	}

    public function topfilmAction($params)
    {
        $manager = new Manager();
        $rss = '<?xml version="1.0" encoding="UTF-8" ?>
            <rss version="2.0">
            <channel>
                <title>Top films</title>
                <link>'.URL_WEBSITE.'</link>
                <description>La list des meilleurs films</description>';

        foreach ($manager->topFilms(10) as $film){
            $rss .= '<item>
                <title>'.$film->getTitle().'</title>
                <link>'.URL_WEBSITE.'/film/view/'.$film->getSlug().'</link>
                <description>'.$film->getShortDescription().'</description>
                <author>'.$film->getUser()->getEmail().'</author>
                <category>Film</category>
                <pubDate>'.$film->getUpdated().'</pubDate>
            </item>';
        }

        $rss .= '</channel></rss>';
        echo $rss;
    }

    public function lastfilmAction($params)
    {
        $manager = new Manager();
        $rss = '<?xml version="1.0" encoding="UTF-8" ?>
            <rss version="2.0">
            <channel>
                <title>Dernier films</title>
                <link>'.URL_WEBSITE.'</link>
                <description>La list des derniers films</description>';

        foreach ($manager->lastFilms(10) as $film){
            $rss .= '<item>
                <title>'.$film->getTitle().'</title>
                <link>'.URL_WEBSITE.'/film/view/'.$film->getSlug().'</link>
                <description>'.$film->getShortDescription().'</description>
                <author>'.$film->getUser()->getEmail().'</author>
                <category>Film</category>
                <pubDate>'.$film->getUpdated().'</pubDate>
            </item>';
        }

        $rss .= '</channel></rss>';
        echo $rss;
    }

    public function lastdirectorAction($params)
    {
        $manager = new Manager();
        $rss = '<?xml version="1.0" encoding="UTF-8" ?>
            <rss version="2.0">
            <channel>
                <title>Dernier directeur</title>
                <link>'.URL_WEBSITE.'</link>
                <description>La list des derniers Directeur</description>';

        foreach ($manager->lastDirectors(10) as $director){
            $rss .= '<item>
                <title>'.$director->getFirstname().' '.$director->getLastname().'</title>
                <link>'.URL_WEBSITE.'/director/view/'.$director->getSlug().'</link>
                <description>'.$director->getShortDescription().'</description>
                <category>Film</category>
                <pubDate>'.$director->getUpdated().'</pubDate>
            </item>';
        }

        $rss .= '</channel></rss>';
        echo $rss;
    }

    public function lastactorAction($params)
    {
        $manager = new Manager();
        $rss = '<?xml version="1.0" encoding="UTF-8" ?>
            <rss version="2.0">
            <channel>
                <title>Dernier acteur</title>
                <link>'.URL_WEBSITE.'</link>
                <description>La list des derniers acteurs</description>';

        foreach ($manager->lastActors(10) as $actor){
            $rss .= '<item>
                <title>'.$actor->getFirstname().' '.$actor->getLastname().'</title>
                <link>'.URL_WEBSITE.'/actor/view/'.$actor->getSlug().'</link>
                <description>'.$actor->getShortDescription().'</description>
                <category>Film</category>
                <pubDate>'.$actor->getUpdated().'</pubDate>
            </item>';
        }

        $rss .= '</channel></rss>';
        echo $rss;
    }


}
