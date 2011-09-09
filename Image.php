<?php

/**
 * CodeBlender
 *
 * @category  CodeBlender
 * @package   Image
 * @copyright Copyright (c) 2000-2011 Triangle Solutions Ltd. (http://www.triangle-solutions.com/)
 * @license   http://codeblender.net/license
 */

/**
 * Image Class
 *
 * @category  CodeBlender
 * @package   Image
 * @copyright Copyright (c) 2000-2011 Triangle Solutions Ltd. (http://www.triangle-solutions.com/)
 * @license   http://codeblender.net/license
 */
class CodeBlender_Image
{
    const TRANSPARENT = 127;
    const BLACK       = 0x000000;
    const WHITE       = 0xffffff;

    /**
     * The gd image resource handle.
     *
     * @var object
     */
    private $img;

    /**
     * Width of the image
     *
     * @var int
     */
    private $width;

    /**
     * Height of the image
     *
     * @var int
     */
    private $height;

    /**
     * Reads a file and returns an Image instance, or null if the file could not be parsed.
     *
     * @param string $fileName
     */
    public static function fromFile($fileName)
    {
        $gdimg = imagecreatefromstring(file_get_contents($fileName));
        return ($gdimg ? new CodeBlender_Image($gdimg) : null);
    }

    /**
     * Constructs a new Image using the specified GD image resource. Throws an exception if the argument is not valid.
     *
     * @param $gdImageResource
     */
    public function __construct($gdImageResource)
    {
        $w = @imagesx($gdImageResource);
        $h = @imagesy($gdImageResource);

        if ($w === FALSE || $h === FALSE) {
            throw new Exception('Not a valid GD image resource');
        }

        $this->img    = $gdImageResource;
        $this->width  = $w;
        $this->height = $h;
    }

    /**
     * Magic get method
     *
     * @param string $key
     */
    public function __get($key)
    {
        // Allow read-only access to width/height
        switch ($key) {
            case 'width':
                return $this->width;
            case 'height':
                return $this->height;
        }
    }

    /**
     * Frees the resource
     */
    public function dispose()
    {
        imagedestroy($this->img);
    }

    /**
     * Creates a resized version of this image (maintaining aspect ratio) to
     * fit within $tw x $th, and returns it.
     *
     * @param $tw
     * @param $th
     */
    public function resizePreserveAspect($tw, $th)
    {
        // Explicitly cast args, in case they came from SimpleXML or something.
        $tw = (int) $tw;
        $th = (int) $th;

        $sw = $this->width;
        $sh = $this->height;

        list($w, $h) = CodeBlender_Image::computeResizePreserveAspect($sw, $sh, $tw, $th);

        $newImg = imagecreatetruecolor($w, $h);

        if (!$newImg) {
            throw new Exception("Could not create image of size $w x $h");
        }

        if (!imagecopyresampled($newImg, $this->img, 0, 0, 0, 0, $w, $h, $sw, $sh)) {
            throw new Exception('Resize operation failed');
        }

        return new CodeBlender_Image($newImg);
    }

    /**
     * Like resizePreserveAspect, but the image is _always_ ($tw)x($th), and is padded with $letterboxColor.
     * $letterboxColor should be an int of the 0xrrggbb form, or Image::colorTransparent to use a transparent letterbox.
     *
     * @param $tw
     * @param $th
     * @param $letterboxColor
     */
    public function resizeWithLetterbox($tw, $th, $letterboxColor)
    {
        // Explicitly cast args, in case they came from SimpleXML or something.
        $tw = (int) $tw;
        $th = (int) $th;
        $letterboxColor = (int) $letterboxColor;

        $sw = $this->width;
        $sh = $this->height;

        list($w, $h) = CodeBlender_Image::computeResizePreserveAspect($sw, $sh, $tw, $th);

        $newImg = imagecreatetruecolor($tw, $th);

        if (!$newImg) {
            throw new Exception("Could not create image of size $tw x $th");
        }

        // Fill with letterbox colour.
        if ($letterboxColor === self::TRANSPARENT) {

            imagealphablending($newImg, false);
            imagesavealpha($newImg, true);
            $gdColor = imagecolorallocatealpha($newImg, 0, 0, 0, 127);

        } else {
            $gdColor = imagecolorallocate($newImg, ($letterboxColor >> 16) & 0xff, ($letterboxColor >> 8) & 0xff, ($letterboxColor >> 0) & 0xff);
        }

        // Fill the image
        imagefilledrectangle($newImg, 0, 0, $tw, $th, $gdColor);

        // Center the original image on top of the new image
        $xoff = ($tw - $w) / 2;
        $yoff = ($th - $h) / 2;

        if (!imagecopyresampled($newImg, $this->img, $xoff, $yoff, 0, 0, $w, $h, $sw, $sh)) {
            throw new Exception('Resize operation failed');
        }

        return new CodeBlender_Image($newImg);
    }

    /**
     * Given a source width/height, and a target (max) width and height, returns an array ($w, $h) of the
     * best width and height while preserving aspect ratio. At least one of $w,$h will be equal to $tw,$th
     * (both will be equal if the aspect ratios are identical).
     *
     * @param int $sw
     * @param int $sh
     * @param int $tw
     * @param int $th
     */
    private static function computeResizePreserveAspect($sw, $sh, $tw, $th)
    {
        $imgRatio    = floatval($sw) / floatval($sh);
        $targetRatio = floatval($tw) / floatval($th);

        if ($imgRatio > $targetRatio) {

            // Scale to max width
            $w = $tw;
            $h = $w * $sh / $sw;

        } else {

            // Scale to max height
            $h = $th;
            $w = $h * $sw / $sh;
        }

        $w = min($tw, intval(round($w)));
        $h = min($th, intval(round($h)));

        return array($w, $h);
    }

    /**
     * Adds a watermark to the image
     *
     * @param $path Watermark image path
     */
    public function watermark($path)
    {
        $photo     = $this->img;
        $watermark = imagecreatefrompng($path);

        imagealphablending($photo, true);

        // Copy the watermark onto the master, $offset px from the bottom right corner.
        $offset = 10;

        imagecopy($photo, $watermark, $this->width - imagesx($watermark) - $offset, $this->height - imagesy($watermark) - $offset, 0, 0, imagesx($watermark), imagesy($watermark));

        return new CodeBlender_Image($photo);
    }

    /**
     * Saves this image to a file. If the file already exists, it is deleted.
     *
     * @param $fileName
     * @param $imageType
     * @param $quality
     */
    public function save($fileName, $imageType = IMG_JPG, $quality = 90)
    {
        // Check if the file exists if it does delete it.
        if (file_exists($fileName)) {
            unlink($fileName);
        }

        // Create the quality of the image to be saved
        if ($quality < 1 || $quality > 100) {
            throw new Exception('For JPEG images, quality must be in the range of 1-100.');
        }

        // Check what image Type to save as defaults to IMG_JPG
        switch ($imageType) {

            case IMG_JPG:

                // Save the JPG
                if (!imagejpeg($this->img, $fileName, (int) $quality)) {
                    throw new Exception('JPG Image save failed');
                }

                break;

            case IMG_PNG:

                // Rejig the quality for the png 1-9 scale
                $pngQuality = ($quality - 100) / 11.111111;
                $pngQuality = round(abs($pngQuality));

                // Save PNG
                if (!imagepng($this->img, $fileName, (int) $pngQuality)) {
                    throw new Exception('PNG Image save failed');
                }

                break;

            default:
                throw new Exception('$imageType must be one of the constants IMG_JPG or IMG_PNG.');
        }
    }

}
