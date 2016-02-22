<?php
/**
 * @link http://www.iisns.com/
 * @copyright Copyright (c) 2015 iiSNS
 * @license http://www.iisns.com/license/
 */

namespace iisns\markdown;

use yii\web\AssetBundle;

/**
 * @author Shiyang <dr@shiyang.me>
 */
class MarkdownAsset extends AssetBundle
{
    public $sourcePath = '@vendor/iisns/yii2-simplemde-markdown/assets';
    public $js = [
        'simplemde.min.js'
    ];
    public $css = [
        'simplemde.min.css'
    ];
    public $depends = [
        'yii\web\JqueryAsset',
    ];
}
