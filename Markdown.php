<?php
/**
 * @link http://www.iisns.com/
 * @copyright Copyright (c) 2015 iiSNS
 * @license http://www.iisns.com/license/
 */

namespace iisns\markdown;

use yii\helpers\Html;
use yii\helpers\Inflector;
use yii\helpers\Json;
use yii\web\JsExpression;
use yii\widgets\InputWidget;

/**
 * @author Shiyang <dr@shiyang.me>
 */
class Markdown extends InputWidget
{
    /**
     * Markdown options you want to override
     * See https://github.com/NextStepWebs/simplemde-markdown-editor
     * @var array
     */
    public $mdeOptions = [];
    /**
     * ID of Textarea where editor will be placed
     * @var string
     */
    protected $id;

    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();
        if (empty($this->id)) {
            $this->id = $this->hasModel() ? Html::getInputId($this->model, $this->attribute) : $this->getId();
        }
        if (empty($this->mdeOptions['element'])) {
            $this->mdeOptions['element'] = new JsExpression('$("#' . $this->id . '")[0]');
        }
    }

    /**
     * @inheritdoc
     */
    public function run()
    {
        MarkdownAsset::register($this->view);
        $this->registerScripts();
        $this->options['id'] = $this->id;
        if ($this->hasModel()) {
            echo Html::activeTextArea($this->model, $this->attribute, $this->options);
        } else {
            echo Html::textArea($this->name, $this->value, $this->options);
        }
    }

    /**
     * Registers simplemde markdown assets
     */
    public function registerScripts()
    {
        $jsonOptions = Json::encode($this->mdeOptions);
        $varName = Inflector::classify('editor' . $this->id);
        $script = "var {$varName} = new SimpleMDE(" . $jsonOptions . ");";
        $this->view->registerJs($script);
    }
}
