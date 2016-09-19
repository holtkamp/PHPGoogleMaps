<?php

namespace PHPGoogleMaps\Overlay;

/**
 * Marker Icon class
 * Attach these to markers to display custom marker icons.
 *
 * Example:
 * $icon = new \PHPGoogleMaps\Marker\MarkerIcon( $icon_url );
 * $icon->setSize( 30, 30 );
 * $shadow = \PHPGoogleMaps\Marker\MarkerIcon::create( $shadow_url )->setAnchor( 0, 30 );
 * $marker->setIcon( $icon );
 * $marker->setShadow( $shadow );
 */
class MarkerIcon  extends \PHPGoogleMaps\Core\MapObject
{
    /**
     * Url of the icon image.
     *
     * @var string
     */
    protected $icon;

    /**
     * Width of the icon.
     *
     * @var int
     */
    protected $width;

    /**
     * Height of the icon.
     *
     * @var int
     */
    protected $height;

    /**
     * X coordinate of the anchor.
     *
     * @var int
     */
    protected $anchor_x;

    /**
     * Y coordinate of the anchor.
     *
     * @var int
     */
    protected $anchor_y;

    /**
     * X coordinate of the origin.
     *
     * @var int
     */
    protected $origin_x;

    /**
     * Y coordinate of the origin.
     *
     * @var int
     */
    protected $origin_y;

    /**
     * Constructor
     * Sets the icon's image URL, width, height, origin and anchor
     * default origin ( 0, 0 )
     * default anchor ( w/2, h ).
     *
     * Throws an exception if the icon is invalid
     *
     * If allow_url_fopen is not enabled on your server you will need to explicity specify the dimensions of the icon
     *
     * @param string $icon    Absolute URL of the icon image
     * @param array  $options
     */
    public function __construct($icon, array $options = null)
    {
        $this->icon = $icon;

        if (!isset($options['width']) || !isset($options['height'])) {
            $size = @getimagesize($icon);
            list($this->width, $this->height) = $size;
        }

        if (isset($options['width'])) {
            $this->width = (int) $options['width'];
        }
        if (isset($options['height'])) {
            $this->height = (int) $options['height'];
        }

        $this->anchor_x = isset($options['anchor_x']) ? $options['anchor_x'] : floor($this->width / 2);
        $this->anchor_y = isset($options['anchor_y']) ? $options['anchor_y'] : $this->height;
        $this->origin_x = isset($options['origin_x']) ? $options['origin_x'] : 0;
        $this->origin_y = isset($options['origin_y']) ? $options['origin_y'] : 0;
    }

    /**
     * Static create method useful for method chaining.
     *
     * @param string $icon URL of the icon image
     *
     * @return $this
     */
    public static function create($icon, array $options = null)
    {
        return new self($icon, $options);
    }

    /**
     * Set the icon's height.
     *
     * @param int $height
     *
     * @return $this
     */
    public function setHeight($height)
    {
        $this->height = (int) $height;

        return $this;
    }

    /**
     * Set the icon's width.
     *
     * @param int $width
     *
     * @return $this
     */
    public function setWidth($width)
    {
        $this->width = (int) $width;

        return $this;
    }

    /**
     * Set the icon's size (width/height).
     *
     * @param int $width
     * @param int $height
     *
     * @return $this
     */
    public function setSize($width, $height)
    {
        $this->height = (int) $height;
        $this->width = (int) $width;

        return $this;
    }

    /**
     * Set the icon's anchor point
     * This is the point on the icon that will be placed on the map.
     *
     * @param int $x X coordinate of the anchor
     * @param int $y Y coordinate of the anchor
     *
     * @return $this
     */
    public function setAnchor($x = null, $y = null)
    {
        if ($x !== null) {
            $this->anchor_x = (int) $x;
        }
        if ($y !== null) {
            $this->anchor_y = (int) $y;
        }

        return $this;
    }

    /**
     * Set the icon's origin point
     * This is used when you are using a sprite for the marker.
     *
     * @param int $x X coord of the origin
     * @param int $y Y coord of the origin
     *
     * @return $this
     */
    public function setOrigin($x = null, $y = null)
    {
        if ($x !== null) {
            $this->origin_x = (int) $x;
        }
        if ($y !== null) {
            $this->origin_y = (int) $y;
        }

        return $this;
    }

    /**
     * Return string.
     */
    public function __toString()
    {
        return $this->icon;
    }
}
