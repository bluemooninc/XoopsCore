<?php
/*
 You may not change or alter any portion of this comment or credits
 of supporting developers from this source code or any supporting source code
 which is considered copyrighted (c) material of the original comment or credit authors.

 This program is distributed in the hope that it will be useful,
 but WITHOUT ANY WARRANTY; without even the implied warranty of
 MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
*/

/**
 * images module
 *
 * @copyright       The XOOPS Project http://sourceforge.net/projects/xoops/
 * @license         GNU GPL 2 (http://www.gnu.org/licenses/old-licenses/gpl-2.0.html)
 * @author          Andricq Nicolas (AKA MusS)
 * @version         $Id$
 */

defined('XOOPS_ROOT_PATH') or die('Restricted access');

class ImagesCategory_imagemanagerForm extends XoopsThemeForm
{
    /**
     * @param Array
     *
     *        'obj'     => ImagesCategory|XoopsObject $obj
     *        'target'  => textarea id
     */
    public function __construct($param)
    {
        $xoops = Xoops::getInstance();
        $groups = $xoops->isUser() ? $xoops->user->getGroups() : XOOPS_GROUP_ANONYMOUS;
        extract($param);
        $helper = Xoops_Module_Helper::getHelper('images');
        $categories = $helper->getHandlerCategories()->getListByPermission($groups, 'imgcat_read');

        parent::__construct('', '', $xoops->getEnv('PHP_SELF'), 'post', false, 'inline');
        $select = new XoopsFormSelect('', 'imgcat_id', $imgcat_id);
        $select->addOption(0, _AM_IMAGES_CAT_SELECT);
        $select->addOptionArray($categories);
        if (isset($target)) {
            $select->setExtra("onchange='javascript:window.location.href=\"" . $xoops->getEnv('PHP_SELF') . "?target=" . $target . "&imgcat_id=\" + this.value'");
        } else {            $select->setExtra("onchange='javascript:window.location.href=\"" . $xoops->getEnv('PHP_SELF') . "?imgcat_id=\" + this.value'");
        }
        $this->addElement($select);

        if (isset($target)) {
            $this->addElement(new XoopsFormHidden('target', $target));
        }

        $write = $helper->getHandlerCategories()->getListByPermission($groups, 'imgcat_write');
        if ($imgcat_id > 0 && array_key_exists($imgcat_id, $write)) {            $this->addElement(new XoopsFormHidden('op', 'upload'));
            $button = new XoopsFormButton('', 'submit', _IMAGES_ADD, 'submit');
            $button->setClass('btn btn-success floatright');
            $this->addElement($button);
        }
    }
}
