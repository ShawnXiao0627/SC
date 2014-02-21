<?php
/**
 * @author Denny.chen
 * @createTime 2013.12.03
 * @version 1.0.1
 */
class CaptchaCodeAction extends CAction
{
    //Random factor
    private $charset = 'abcdefghkmnprstuvwxyzABCDEFGHKMNPRSTUVWXYZ23456789';
    //Captcha code
    private $code;
    //Captcha code length
    private $codelen = 4;
    //Captcha code background width
    private $width = 130;
    //Captcha code background height
    private $height = 30;
    //Graphic resource handle
    private $img;
    //Font file location
    private $font;
    //Font size
    private $fontsize = 20;
    //Font color
    private $fontcolor;

    /**
     * Generate random code.
     */
    public function createCode()
    {
        $len = strlen($this->charset) - 1;

        for($i = 0; $i < $this->codelen; $i++)
        {
            $this->code .= $this->charset[mt_rand(0, $len)];
        }
    }

    /**
     * Generate background.
     */
    public function createBg()
    {
        //Create a image with 130*30
        $this->img = imagecreatetruecolor($this->width, $this->height);
        //Assign color to image
        $color = imagecolorallocate($this->img, mt_rand(157,255), mt_rand(157,255), mt_rand(157,255));
        //Draw a rectangle and fill the color
        imagefilledrectangle($this->img, 0, $this->height, $this->width, 0, $color);
    }

    //TODO resolve invalid font filename at line 67.
    /**
     * Create Font.
     */
    public function createFont()
    {
        //$this->font = Yii::app()->homeUrl .'/themes/font/monofont.ttf';
        $_x = $this->width / $this->codelen;

        for($i = 0; $i < $this->codelen; $i++)
        {
            $this->fontcolor = imagecolorallocate($this->img, mt_rand(0,156), mt_rand(0,156), mt_rand(0,156));
            //Write the TTF(True Type Fonts) font text to image
            imagettftext($this->img, $this->fontsize, mt_rand(-30,30), $_x * $i + mt_rand(1,5), $this->height/1.4, $this->fontcolor, 'monofont.ttf', $this->code[$i]);
        }
    }

    /**
     *  Create line.
     */
    public function createLine()
    {
        for($i = 0; $i < 6; $i++)
        {
            $color = imagecolorallocate($this->img, mt_rand(0,156), mt_rand(0,156), mt_rand(0,156));
            imageline($this->img, mt_rand(0, $this->width), mt_rand(0, $this->height), mt_rand(0, $this->width), mt_rand(0, $this->height), $color);
        }

        for($i = 0; $i < 100; $i++)
        {
            $color = imagecolorallocate($this->img, mt_rand(200,255), mt_rand(20,255), mt_rand(200,255));
            imagestring($this->img, mt_rand(1,5), mt_rand(0, $this->width), mt_rand(0, $this->height), '*', $color);
        }
    }

    public function output()
    {
        header('Content-type:image/png');
        //Output the png format image
        imagepng($this->img);
        imagedestroy($this->img);
    }
    

    public function run($rand = 123456)
    {
        $this->createBg();
        $this->createCode();

        //TODO
        //$this->createFont();

        $this->createLine();
        $this->output();
    }

}
