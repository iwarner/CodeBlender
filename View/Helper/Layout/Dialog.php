<?php
/**
 * CodeBlender
 *
 * @category  CodeBlender
 * @package   Helper
 * @copyright Copyright (c) 2000-2011 Triangle Solutions Ltd. (http://www.triangle-solutions.com/)
 * @license   http://codeblender.net/license
 */

/**
 * Helper class to render the Dialog
 *
 * @category  CodeBlender
 * @package   Helper
 * @copyright Copyright (c) 2000-2011 Triangle Solutions Ltd. (http://www.triangle-solutions.com/)
 * @license   http://codeblender.net/license
 */
class CodeBlender_View_Helper_Layout_Dialog extends Zend_View_Helper_Abstract
{

    /**
     * Card for someone that has not entered before
     *
     * @return string
     */
    public function layout_Dialog($content, $id = 'index_dialog')
    {
        ?>
        <div class="dialog" id="<?php echo $id; ?>">
            <div class="dialogPopup">
                <table class="dialogTable">
                    <tr>
                        <td class="dialogTableTopLeft" />
                        <td class="dialogTableBorderTop" />
                        <td class="dialogTableTopRight" />
                    </tr>
                    <tr>
                        <td class="dialogTableBorderSide"/>
                        <td class="dialogTableContent">
                            <div class="dialogContent">
                                <div class="dialogBody">
                                    <?php
                                    echo $content;
                                    ?>
                                </div>
                                <a href="#" class="dialogClose">Close</a>
                            </div>
                        </td>
                        <td class="dialogTableBorderSide" />
                    </tr>
                    <tr>
                        <td class="dialogTableBorderBotLeft" />
                        <td class="dialogTableBorderBottom" />
                        <td class="dialogTableBorderBotRight" />
                    </tr>
                </table>
            </div>
        </div>
        <?php
    }

}
