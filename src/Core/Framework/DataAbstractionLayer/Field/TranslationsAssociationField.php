<?php declare(strict_types=1);

namespace Shopware\Core\Framework\DataAbstractionLayer\Field;

use Shopware\Core\Framework\DataAbstractionLayer\EntityTranslationDefinition;
use Shopware\Core\Framework\DataAbstractionLayer\Field\Flag\CascadeDelete;

class TranslationsAssociationField extends OneToManyAssociationField
{
    public const PRIORITY = 90;

    public function __construct(
        string $referenceClass,
        string $referenceField,
        string $propertyName = 'translations',
        string $localField = 'id'
    ) {
        if (!is_subclass_of($referenceClass, EntityTranslationDefinition::class)) {
            throw new \InvalidArgumentException('$referenceClass needs to be an `EntityTranslationDefinition`');
        }

        parent::__construct($propertyName, $referenceClass, $referenceField, false, $localField);
        $this->addFlags(new CascadeDelete());
    }

    public function getReferenceField(): string
    {
        return $this->referenceField;
    }

    public function getLanguageField(): string
    {
        return 'language_id';
    }

    public function getLocalField(): string
    {
        return $this->localField;
    }

    public function getExtractPriority(): int
    {
        return self::PRIORITY;
    }
}
