<?php
/**
 * CodeBlender
 *
 * @category  CodeBlender
 * @package   CodeBlender_Version
 * @copyright Copyright (c) 2011 Triangle Solutions Ltd. (http://www.triangle-solutions.com/)
 * @license   http://codeblender.net/license
 */

/**
 * Class to store and retrieve the version of CodeBlender
 *
 * @category  CodeBlender
 * @package   CodeBlender_Version
 * @copyright Copyright (c) 2011 Triangle Solutions Ltd. (http://www.triangle-solutions.com/)
 * @license   http://codeblender.net/license
 */
final class CodeBlender_Version
{
    /**
     * CodeBlender version identification - see compareVersion()
     */
    const VERSION = '0.0.2';

    /**
     * Compare the specified CodeBlender version string $version
     * with the current CodeBlender_Version::VERSION of the CodeBlender Framework.
     *
     * @param  string  $version  A version string (e.g. "0.7.1").
     * @return boolean           -1 if the $version is older,
     *                           0 if they are the same,
     *                           and +1 if $version is newer.
     */
    public static function compareVersion($version)
    {
        return version_compare($version, self::VERSION);
    }
}
