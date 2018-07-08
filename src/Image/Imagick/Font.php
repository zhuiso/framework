<?php
// +----------------------------------------------------------------------
// | Dscription:  The file is part of Zs
// +----------------------------------------------------------------------
// | Author: showkw <showkw@163.com>
// +----------------------------------------------------------------------
// | CopyRight: (c) 2018 zhuiso.com
// +----------------------------------------------------------------------
namespace Zs\Foundation\Image\Imagick;

use Zs\Foundation\Image\AbstractFont;
use Zs\Foundation\Image\Exceptions\RuntimeException;
use Zs\Foundation\Image\Image;

/**
 * Class Font.
 */
class Font extends AbstractFont
{
    /**
     * @param Image $image
     * @param int   $posx
     * @param int   $posy
     *
     * @return bool|void
     */
    public function applyToImage(Image $image, $posx = 0, $posy = 0)
    {
        $draw = new \ImagickDraw();
        $draw->setStrokeAntialias(true);
        $draw->setTextAntialias(true);
        if ($this->hasApplicableFontFile()) {
            $draw->setFont($this->file);
        } else {
            throw new RuntimeException('Font file must be provided to apply text to image.');
        }
        $color = new Color($this->color);
        $draw->setFontSize($this->size);
        $draw->setFillColor($color->getPixel());
        switch (strtolower($this->align)) {
            case 'center':
                $align = \Imagick::ALIGN_CENTER;
                break;
            case 'right':
                $align = \Imagick::ALIGN_RIGHT;
                break;
            default:
                $align = \Imagick::ALIGN_LEFT;
                break;
        }
        $draw->setTextAlignment($align);
        if (strtolower($this->valign) != 'bottom') {
            $dimensions = $image->getCore()->queryFontMetrics($draw, $this->text);
            switch (strtolower($this->valign)) {
                case 'center':
                case 'middle':
                    $posy = $posy + $dimensions['textHeight'] * 0.65 / 2;
                    break;
                case 'top':
                    $posy = $posy + $dimensions['textHeight'] * 0.65;
                    break;
            }
        }
        $image->getCore()->annotateImage($draw, $posx, $posy, $this->angle * (-1), $this->text);
    }
}
