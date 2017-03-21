<?php
/**
 * Cinnebar.
 *
 * My lightweight no-framework framework written in PHP.
 *
 * @package Cinnebar
 * @author $Author$
 * @version $Id$
 */

/**
 * Gravatar.
 *
 * @package Cinnebar
 * @subpackage Gravatar
 * @version $Id$
 */
class Gravatar
{
    /**
     * Defines the gravatar image request URL with its placeholders.
     */
    const GRAVATAR_URL = '//www.gravatar.com/avatar/%s/?d=%s&amp;s=%d&amp;r=%s';

    /**
     * Renders an gravatar (globally recognized avatar) for an given email address.
     *
     * @param string $email
     * @param int (optional) $size the size of the image
     * @param string (optional) $default one of [ 404 | mm | identicon | monsterid | wavatar ]
     * @param string (optional) $rating [ g | pg | r | x ]
     * @return string $URLToAGravatarImage
     */
    static public function src($email, $size = 80, $default = 'identicon', $rating = 'g')
    {
        return sprintf(self::GRAVATAR_URL, md5(mb_strtolower(trim($email))), urlencode($default), $size, $rating);        
    }
}
