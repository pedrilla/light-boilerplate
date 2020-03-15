<?php

namespace App\Module\Admin\Form;

use Light\Filter\Lowercase;
use Light\Filter\Trim;
use Light\Form;
use Light\Form\Element\Checkbox;
use Light\Form\Element\Image;
use Light\Form\Element\Images;
use Light\Form\Element\Text;
use Light\Form\Element\Textarea;
use Light\Form\Element\TrumbowygResponsive;
use Light\Form\Element\Trumbowyg;
use Light\Model;
use Light\Validator\StringLength;

class ModelForm extends Form
{
    /**
     * @var Model
     */
    public $data = null;

    /**
     * @param Model $model
     */
    public function init($model = null)
    {
        parent::init($model);

        $elements = array_filter([

            'Настройки' => array_filter([
                $this->addUrl(),
                $this->addEnabled(),
                $this->addDate(),
                $this->addDateTime()
            ]),

            'Содержимое' => array_filter([
                $this->addTitle(),
                $this->addDescription(),
                $this->addImage(),
                $this->addImages(),
                $this->addContentString(),
                $this->addContentArray(),
            ]),

            'Хлебные крошки' => $this->bread(),

            'Настройки Meta' => $this->seoMeta(),

            'Настройки Open Graph' => $this->seoOG()
        ]);

        parent::addElements($elements);
    }

    /**
     * @param string $property
     * @return bool
     */
    public function modelHasProperty(string $property)
    {
        return $this->data->getMeta()->hasProperty($property);
    }

    /**
     * @return Form\Element\ElementAbstract[]
     */
    public function bread()
    {
        if ($this->modelHasProperty('breadTitle')) {

            return [

                new Text('breadTitle', [
                    'value' => $this->data->breadTitle,
                    'label' => 'Заголовок'
                ]),

                new Image('breadImage', [
                    'value' => $this->data->breadImage,
                    'label' => 'Изображение'
                ]),
            ];
        }
    }

    /**
     * @return Form\Element\ElementAbstract[]
     */
    public function seoMeta()
    {
        if ($this->modelHasProperty('metaTitle')) {

            return [
                new Text('metaTitle', [
                    'value' => $this->data->metaTitle,
                    'label' => 'Заголовок',
                    'allowNull' => true
                ]),

                new Textarea('metaDescription', [
                    'value' => $this->data->metaDescription,
                    'label' => 'Описание',
                    'allowNull' => true
                ]),

                new Text('metaKeywords', [
                    'value' => $this->data->metaKeywords,
                    'label' => 'Ключевые слова',
                    'allowNull' => true
                ]),
            ];
        }
    }

    /**
     * @return Form\Element\ElementAbstract[]
     */
    public function seoOG()
    {
        if ($this->modelHasProperty('ogTitle')) {

            return [

                new Text('ogTitle', [
                    'value' => $this->data->ogTitle,
                    'label' => 'Заголовок',
                    'allowNull' => true
                ]),

                new Text('ogLocale', [
                    'value' => $this->data->ogLocale,
                    'label' => 'Локализация',
                    'allowNull' => true
                ]),

                new Textarea('ogDescription', [
                    'value' => $this->data->ogDescription,
                    'label' => 'Описание',
                    'allowNull' => true
                ]),

                new Image('ogImage', [
                    'value' => $this->data->ogImage,
                    'label' => 'Изображение',
                    'allowNull' => true
                ]),
            ];
        }
    }

    /**
     * @return Checkbox
     */
    public function addEnabled()
    {
        if ($this->modelHasProperty('enabled')) {

            return new Checkbox('enabled', [
                'value' => $this->data->enabled,
                'label' => 'Включен'
            ]);
        }
    }

    /**
     * @return Text
     */
    public function addUrl()
    {
        if ($this->modelHasProperty('url')) {

            return new Text('url', [
                'value' => $this->data->url,
                'label' => 'URL',
                'filters' => [Trim::class, Lowercase::class],
                'allowNull' => true,
                'validators' => [
                    StringLength::class => [
                        'options' => ['min' => 2, 'max' => 100],
                        'message' => 'URL должен содержать от 2 до 100 символов'
                    ]
                ]
            ]);
        }
    }

    /**
     * @return Form\Element\Date
     */
    public function addDate()
    {
        if ($this->modelHasProperty('date')) {

            return new Form\Element\Date('date', [
                'value' => $this->data->date,
                'label' => 'Дата'
            ]);
        }
    }

    /**
     * @return Form\Element\DateTime
     */
    public function addDateTime()
    {
        if ($this->modelHasProperty('dateTime')) {

            return new Form\Element\DateTime('dateTime', [
                'value' => $this->data->dateTime,
                'label' => 'Дата/Время'
            ]);
        }
    }

    /**
     * @return Text
     */
    public function addTitle()
    {
        if ($this->modelHasProperty('title')) {

            return new Text('title', [
                'value' => $this->data->title,
                'label' => 'Заголовок',
                'filters' => [Trim::class],
                'validators' => [
                    StringLength::class => [
                        'options' => ['min' => 1, 'max' => 100],
                        'message' => 'Заголовок должен содержать от 1 до 100 символов'
                    ]
                ]
            ]);
        }
    }

    /**
     * @return Image
     */
    public function addImage()
    {
        if ($this->modelHasProperty('image')) {

            return new Image('image', [
                'value' => $this->data->image,
                'label' => 'Изображение',
                'allowNull' => true
            ]);
        }
    }

    /**
     * @return Images
     */
    public function addImages()
    {
        if ($this->modelHasProperty('images')) {

            return new Images('images', [
                'value' => $this->data->images,
                'label' => 'Изображения'
            ]);
        }
    }

    /**
     * @return Textarea
     */
    public function addDescription()
    {
        if ($this->modelHasProperty('description')) {

            return new Textarea('description', [
                'value' => $this->data->description,
                'label' => 'Описание',
                'allowNull' => true,
                'filters' => [Trim::class],
                'validators' => [
                    StringLength::class => [
                        'options' => ['min' => 10, 'max' => 500],
                        'message' => 'Описание должно содержать от 10 до 500 символов'
                    ]
                ]
            ]);
        }
    }

    /**
     * @return TrumbowygResponsive
     */
    public function addContentArray()
    {
        try {

            if ($this->modelHasProperty('content') &&
                $this->data->getMeta()->getPropertyWithName('content')->getType() == 'array'
            ) {

                return new TrumbowygResponsive('content', [
                    'value' => $this->data->content,
                    'label' => 'Контент'
                ]);
            }
        } catch (\Exception $e) {
        }
    }

    /**
     * @return Trumbowyg
     */
    public function addContentString()
    {
        try {

            if ($this->modelHasProperty('content') &&
                $this->data->getMeta()->getPropertyWithName('content')->getType() == 'string'
            ) {

                return new Trumbowyg('content', [
                    'value' => $this->data->content,
                    'label' => 'Контент'
                ]);
            }
        } catch (\Exception $e) {
        }
    }
}
