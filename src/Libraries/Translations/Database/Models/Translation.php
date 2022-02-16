<?php
declare(strict_types=1);

namespace Phlexus\Libraries\Translations\Database\Models;

use Phalcon\Mvc\Model;

/**
 * Class Translation
 *
 * @package Phlexus\Libraries\Translations\Database\Models
 */
class Translation extends Model
{
    public const DISABLED = 0;

    public const ENABLED = 1;

    public $id;

    public $key;

    public $translation;

    public $textTypeId;

    public $pageId;

    public $languageId;

    public $active;

    /**
     * Initialize
     *
     * @return void
     */
    public function initialize()
    {
        $this->setSource('translations');

        $this->hasOne('textTypeId', TextType::class, 'id', [
            'alias'    => 'TextType',
            'reusable' => true,
        ]);

        $this->hasOne('pageId', Page::class, 'id', [
            'alias'    => 'Page',
            'reusable' => true,
        ]);

        $this->hasOne('languageId', Language::class, 'id', [
            'alias'    => 'Language',
            'reusable' => true,
        ]);
    }
 
    /**
     * Get translation by Page and Type
     * 
     * @param string $page     Page to translate
     * @param string $type     Type to translate
     * @param string $Language Language to use
     * 
     * @return array
     */
    public static function getTranslationsType(string $page, string $type, string $language): array
    {
        $t_model = self::class;

        return self::query()
            ->columns($t_model .'.*')
            ->innerJoin(TextType::class, null, 'TT')
            ->innerJoin(Page::class, null, 'PG')
            ->innerJoin(Language::class, null, 'LNG')
            ->where('TT.type = :textType: AND PG.name = :pageName: AND LNG.language = :language:', [
                'textType' => $type,
                'pageName' => $page,
                'language' => $language
            ])
            ->execute()
            ->toArray();
    }

    /**
     * Create translation with Page and Type
     * 
     * @param string $page        Page
     * @param string $type        Type
     * @param string $Language    Language
     * @param string $key         Key
     * @param string $translation Translation
     * 
     * @return mixed Translation or null
     */
    public static function createTranslationsType(
        string $page, string $type, string $language,
        string $key, string $translation
    )
    {
        $languageModel = Language::findFirstBylanguage($language);

        $typeModel = TextType::findFirstBytype($type);

        if (!$languageModel || !$typeModel) {
            return false;
        }
    
        $pageModel = Page::findFirstByname($page);

        if ($pageModel) {
            return $pageModel;
        }

        $translationModel              = new self;
        $translationModel->key         = $key;
        $translationModel->translation = $translation;
        $translationModel->textTypeId  = $typeModel->id;
        $translationModel->pageId      = $pageModel->id;
        $translationModel->languageId  = $languageModel->id;

        return $translationModel->save() ? $translationModel : null;
    }
}
