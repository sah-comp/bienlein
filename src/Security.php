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
 * Some basic security stuff.
 *
 * @package Cinnebar
 * @subpackage Security
 * @version $Id$
 */
class Security
{
    /**
     * Returns a random string.
     *
     * @param int $strength
     * @return string
     */
    public static function generateRandomString($strength = 32)
    {
        return bin2hex(random_bytes($strength));
    }

    /**
     * Returns a token to prevent CSRF.
     *
     * Use this token in a form and send it via a POST request.
     *
     * @return string
     */
    public static function getCSRFToken()
    {
        @session_start();
        if (empty($_SESSION['csrf_tokens'])) {
            $_SESSION['csrf_tokens'] = [];
        }
        $nonce = Security::generateRandomString();
        $_SESSION['csrf_tokens'][$nonce] = true;
        return $nonce;
    }

    /**
     * Returns wether the CSRF token validates or not.
     *
     * @param string $token
     * @return bool
     */
    public static function validateCSRFToken($token)
    {
        @session_start();
        if (isset($_SESSION['csrf_tokens'][$token])) {
            unset($_SESSION['csrf_tokens'][$token]);
            return true;
        }
        return false;
    }
}
