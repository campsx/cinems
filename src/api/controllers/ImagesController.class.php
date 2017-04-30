<?php

class ImagesController extends AbstractController {

	public function indexAction($params)
	{
	    return null;
	}

    public function capchaAction($params)
    {
        header('Content-Type: image/png');

        //  configuration -----------------------------------------------------------------
        $fontDir = __DIR__ .DS."..".DS."..".DS."..".DS."public".DS."website".DS."fonts".DS;
        $filterDirectory = ['..', '.', '.DS_Store'];
        $nombreCaractereMin = 3;
        $nombreCaractereMax = 7;
        $tailleFontMin = 15;
        $tailleFontMax = 20;
        $width = 400;
        $height = 200;
        $angleBase = 45;
        $angleMax = -45;
        $nombreFormeMin = 3;
        $nombreFormeMax = 5;
        $chaine  = 'abcdefghijklmnopqrstuvwxyz0123456789';//ABCDEFGHIJKLMOPQRSTUVWXYZ';
        //  configuration -----------------------------------------------------------------


        // genere la chaine de characters
        $nombreCaractere = rand($nombreCaractereMin, $nombreCaractereMax);
        $chaine = str_shuffle($chaine);
        $capcha = substr($chaine, 0, $nombreCaractere);

        $this->getRequest()->session()->addSession('capcha', $capcha);

        // image de base
        $image = imagecreate($width, $height);

        // couleur du background
        $couleurR = rand(160,255);
        $couleurG = rand(160,255);
        $couleurB = rand(160,255);

        // le background
        $background = imagecolorallocate($image, $couleurR, $couleurG, $couleurB);

        // list les polices d'Ã©criture
        $fonts = array_diff(scandir($fontDir), $filterDirectory);

        // affiche les lettres
        $i = 1;
        foreach (str_split($capcha) as $lettre) {
            $size = rand($tailleFontMin, $tailleFontMax);

            $angle = rand($angleBase, $angleMax);
            $font = $fontDir.$fonts[array_rand($fonts)];

            $color = imagecolorallocate($image, rand(0,150), rand(0,150), rand(0,150));

            $x = ($width / $nombreCaractere * $i) - ($width / $nombreCaractere) / 2;
            $y = rand(($height / 5), $height - ($height / 5));

            imagettftext($image, $size, $angle, $x, $y, $color, $font, $lettre);
            $i++;
        }

        $nombreForme = rand($nombreFormeMin, $nombreFormeMax);
        for ($i=0; $i < $nombreForme; $i++) {
            $figure = rand(1,2);
            $color = imagecolorallocate($image, rand(0,150), rand(0,150), rand(0,150));

            switch ($figure) {
                case 1:
                    imagerectangle($image, rand(0,$width), rand(0,$height), rand(0,$width), rand(0,$height), $color);
                    break;
                case 2:
                    imageellipse ($image , rand(0,$width) , rand(0,$height) , rand(30,100) , rand(30,100) , $color);
                    break;
                default:
                    imagerectangle($image, rand(0,$width), rand(0,$height), rand(0,$width), rand(0,$height), $color);
                    break;
            }
        }

        return imagepng($image);
    }

}
